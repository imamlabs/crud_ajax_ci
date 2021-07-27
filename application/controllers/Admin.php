<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		//setiap file controller ini dipanggil maka akan meload model M_admin
	}

	public function index() {
		//setiap controller ini dipanggil fungsi index yang pertama kali dijalankan
		$data['userdata'] 	= $this->userdata;
		//mendeklarasikan userdata session
		$data['dataAdmin'] 	= $this->M_admin->select_all();
		//mendeklarasikan nilai dari model M_admin pada method/fungsi select_All() isi bisa lihat M_Admin.php fungsi select_all
		$data['page'] 		= "admin";
		//mendeklarasikan page pada variabel $data array dengan nama admin 
		$data['judul'] 		= "Data Admin";
		//mendeklarasikan judul pada variabel $data array dengan nama Data admin
		$data['deskripsi'] 	= "Manage Data Admin";
		//mendeklarasikan deskripsi pada variabel $data array dengan nama Data admin
		$data['modal_tambah_admin'] = show_my_modal('modals/modal_tambah_admin', 'tambah-admin', $data);
		//mendeklarasikan modal_tambah_admin pada variabel $data array dengan memanggil show_my_modal(ini sudah dideklarasikan di helper), file modal ada di bagian view
		$this->template->views('admin/home', $data);
		//melakukan parsing seluruh nilai dari $data ke view admin/home 
	}

	public function tampil() {
		$data['dataAdmin'] = $this->M_admin->select_all();
		$this->load->view('admin/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('username', 'Nama', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('foto', 'Foto', 'trim|required');
		
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_admin->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Admin Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Admin Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);
		$data['dataAdmin'] = $this->M_admin->select_by_id($id);
		echo show_my_modal('modals/modal_update_admin', 'update-admin', $data);
	}
	

	public function deleteSelected() {
		$id = $this->input->post('id');
		// Delete records
		$result = $this->M_admin->deleteAdminSelected($id);
			if ($result > 0) {
			echo show_succ_msg('Data Admin Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Admin Gagal dihapus', '20px');
		}
	}
	public function prosesUpdate() {
		$this->form_validation->set_rules('id', 'Id', 'trim|required');
	$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
	$data 	= $this->input->post();
	if ($this->form_validation->run() == TRUE) {
		$result = $this->M_admin->updateAdmin($data);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Admin Berhasil diupdate', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Admin Gagal diupdate', '20px');
		}
	} else {
		$out['status'] = 'form';
		$out['msg'] = show_err_msg(validation_errors());
	}
		echo json_encode($out);
	}



	public function delete() {
		$id = $_POST['id'];
		
		$dataok = $this->M_admin->select_by_id($id);
		$result = $this->M_admin->delete($id);
		if($dataok->foto!=='avatar.png'){
			unlink('./assets/img/'.$dataok->foto);
		}
		if ($result > 0) {
		
			echo show_succ_msg('Data Admin Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Admin Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_admin->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "User Name");
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', "Foto");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->username); 
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nama);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->foto);  
		    $rowCount++; 
		} 

		$date = date('ymdhms');
		$file = $date.'-Data Admin.xlsx';

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/'.$file); 

		$this->load->helper('download');
	
		force_download('./assets/excel/'.$file, NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$check = $this->M_admin->check_username($value['B']);

						if ($check != 1) {
							$resultData[$index]['username'] = ucwords($value['B']);
							$resultData[$index]['nama'] = ucwords($value['C']);
							$resultData[$index]['password'] = md5('admin');
							$resultData[$index]['foto'] = 'avatar.png';

						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_admin->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Admin Berhasil diimport ke database'));
						redirect('Admin');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Kota Admin diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Admin');
				}

			}
		}
	}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */