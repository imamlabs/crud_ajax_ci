<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>No Telp</th>
          <th>Asal kota</th>
          <th>Jenis Kelamin</th>
          <th>Posisi</th>
          <th width="150" class="text-center"><input type="checkbox" id="checkall" value='1'>
             </th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-pegawai">
        
      </tbody>
    </table>
  </div>
  <div class="box-header">
    <div class="col-md-3" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-pegawai"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('Pegawai/export'); ?>" class="form-control btn btn btn-primary"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn btn-primary" data-toggle="modal" data-target="#import-pegawai"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
    <div class="col-md-3">
    <input class="form-control btn btn btn-primary" type="button" id="delete" value='Delete Selected'>
</div>
  </div>
</div>

<?php echo $modal_tambah_pegawai; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataPegawai', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Pegawai';
  $data['url'] = 'Pegawai/import';
  echo show_my_modal('modals/modal_import', 'import-pegawai', $data);
?>
<!-- Script -->
<script type="text/javascript">
         function tampilPegawai() {
		$.get('<?php echo base_url('Pegawai/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pegawai').html(data);
			refresh();
		});
	}
     $(document).ready(function(){

        // Check all
        $("#checkall").change(function(){

           var checked = $(this).is(':checked');
           if(checked){
              $(".checkbox").each(function(){
                  $(this).prop("checked",true);
              });
           }else{
              $(".checkbox").each(function(){
                  $(this).prop("checked",false);
              });
           }
        });

        // Changing state of CheckAll checkbox 
        $(".checkbox").click(function(){

           if($(".checkbox").length == $(".checkbox:checked").length) {
               $("#checkall").prop("checked", true);
           } else {
               $("#checkall").prop("checked",false);
           }

        });

        // Delete button clicked
        $('#delete').click(function(){

           // Confirm alert
           var deleteConfirm = confirm("Are you sure?");
           if (deleteConfirm == true) {

              // Get userid from checked checkboxes
              var id_arr = [];
              $(".checkbox:checked").each(function(){
                  var id = $(this).val();

                  id_arr.push(id);
              });

              // Array length
              var length = id_arr.length;

              if(length > 0){

                 // AJAX request
                 $.ajax({
                    url: '<?= base_url() ?>Pegawai/deleteSelected',
                    type: 'post',
                    data: {id: id_arr},
                    success: function(response){

                       // Remove <tr>
                       $(".checkbox:checked").each(function(){
                           var id = $(this).val();
                           console.log = id;

                           $('#tr_'+id).remove();
                       });
                       tampilPegawai();
                    }
                 });
                 
         
              }
           } 

        });

      });
      </script>
