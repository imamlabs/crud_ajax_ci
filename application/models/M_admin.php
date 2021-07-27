<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function select_all() {
		$this->db->select('*');
		$this->db->from('admincrud');
		// menghasilkan : SELECT * FROM admincrud (mengambil seluruh kolom dari tabel admin crud)
		$data = $this->db->get();
		//Digunakan untuk menyeleksi seluruh data pada suatu table di database.
		return $data->result();
		
	}
	public function update($data, $id) {
		
		$this->db->where("id", $id);
		$this->db->update("admincrud", $data);
		// menghasilkan : UPDATE admincrud SET (data array) WHERE id='(id yang di Post)'(mengubah isi data dari data array yang di Post berdasarkan id Post)
		return $this->db->affected_rows();
		//mengambil seluruh data dari tabel admin crud dimana id nya itu adalah berdasarkan data id yang di post
		//affected rows digunakan untuk mengetahui jumlah data yang terlibat dalam sebuah operasi query yang di buat
	}

	   // Delete record
	public function deleteAdminSelected($id = array()) {
		foreach($id as $idadmin){
			//foreach perulangan sebanyak jumlah data , setiap $idamin adalah $id
		$sql = "DELETE FROM admincrud WHERE id='".$idadmin."'";
		//mendeklarasikan variabel $sql adalah query menghapus baris dari tabel admincrud dimana idnya adalah nilai dari $idadmin
		$dataok = $this->M_admin->select_by_id($idadmin);
		//mendeklarasikan variabel $dataok adalah memanggi M_admin yang merupakan model dengan method select by id, isinya bisa dilihat di M_admin,php bagian select_by_id
		if($dataok->foto!=='avatar.png'){
			//menegaskan apakah $dataok->foto yang merupakan nama foto pada tabeln admincrud tidak sama dengan avatar.png jika ya maka eksekusi statemen true
			unlink('./assets/img/'.$dataok->foto);
			//unlink berfungsi untuk menghapus isi file pada server dengan nama file pada hasil query $dataok->foto di path ./assets/img/
		}
		$this->db->query($sql);
		//menjalankan isi perintah pada @$ql
		}
		return $this->db->affected_rows();
		//mengembalikan nila affected rows yang digunakan untuk mengetahui jumlah data yang terlibat dalam sebuah operasi query yang di buat
	}



	public function updateAdmin($data) {
		$sql = "UPDATE admincrud SET nama='" .$data['nama'] ."' WHERE id='" .$data['id'] ."'";
		//mendeklarasikan variabel $sql adalah query mengubah kolom nama pada tabel admincrud dengan nilai nama yang dikirim/Post ke $data dimana id berdasarkan $id yang din Post
		$this->db->query($sql);
		//menjalankan isi perintah pada @$ql
		return $this->db->affected_rows();
		//mengembalikan nila affected rows yang digunakan untuk mengetahui jumlah data yang terlibat dalam sebuah operasi query yang di buat
	}

	public function select($id = '') {
		//menggunakan parameter $id
		if ($id != '') {
			//mengecek apakah $id tidak sama dengan ''
			$this->db->where('id', $id);
			//apabila $id bernilai true atau tidak sama dengan '' maka ekesekusi baris ini
		}
		$data = $this->db->get('admincrud');
		//menampilkan seluruh kolom dari tabel admincrud
		return $data->row();
		//mengembalikan baris tunggal. Jika ternyata query yang di tulis menghasilkan lebih dari satu data, maka row() hanya akan mengambil baris pertama. Nilai yang dikembalikan berupa objek
	}
	public function select_by_id($id) {
		$sql = "SELECT id AS id_admin, nama,  password, foto FROM admincrud WHERE id ='".$id."'";
		//mendeklarsikan perintah query untuk menampilkan kolom id sebagai id_admin, nama, password dan foto dari tabel adminc rud dimana id nyaadlah berdasarkan paramenter $id (id yang di Post)
		$data = $this->db->query($sql);
		//menjalankan isi perintah pada @$ql
		return $data->row();
			//mengembalikan baris tunggal. Jika ternyata query yang di tulis menghasilkan lebih dari satu data, maka row() hanya akan mengambil baris pertama. Nilai yang dikembalikan berupa objek

	}
	
	
	public function delete($id) {
		$sql = "DELETE FROM admincrud WHERE id='".$id."'";
		//mendeklarsikan perintah query untuk menghapus baris dari tabel admincrud dimana id nya berdasarkan paramenter $id (id yang di Post)
		$this->db->query($sql);
		//menjalankan isi perintah pada @$ql
		return $this->db->affected_rows();
			//affected rows digunakan untuk mengetahui jumlah data yang terlibat dalam sebuah operasi query yang di buat
	}

	public function check_username($nama) {
		//pada fungsi ini terdapat parameter $nama
		$this->db->where('username', $nama);
		$data = $this->db->get('admincrud');
		//menampilkan seluruh kolom dari tabel admincrud dimana usernamenya adalah nilai parameter yang dipost
		return $data->num_rows();
			//mengembalikan baris tunggal. Jika ternyata query yang di tulis menghasilkan lebih dari satu data, maka row() hanya akan mengambil baris pertama. Nilai yang dikembalikan berupa objek
	}
	
	public function insert($data) {
			//pada fungsi ini terdapat parameter $data
		$sql = "INSERT INTO admincrud VALUES('','" .$data['username']."','" .md5($data['password'])."','" .$data['nama'] ."','" .$data['foto']."')";
		//mendeklarsikan perintah query untuk insert data ke tabel admincrud , pada kolom password menggunakan md5 yang bertujuan menkonver plain text menjadi terenkripsi
		$this->db->query($sql);
		//menjalankan isi perintah pada @$ql
		return $this->db->affected_rows();
		//mengembalikan nila affected rows yang digunakan untuk mengetahui jumlah data yang terlibat dalam sebuah operasi query yang di buat
	}
	
	public function insert_batch($data) {
		$this->db->insert_batch('admincrud', $data);
		
		return $this->db->affected_rows();
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */