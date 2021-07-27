<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Nama</th>
          <th>Foto</th>
          <th width="150" class="text-center"><input type="checkbox" id="checkall" value='1'>
             </th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-admin">
        
      </tbody>
    </table>
  </div>
  <div class="box-header">
    <div class="col-md-3" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-admin"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('Admin/export'); ?>" class="form-control btn btn btn-primary"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button  class="form-control btn btn btn-primary" data-toggle="modal" data-target="#import-admin"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
    <div class="col-md-3">
    <button class="btn btn-danger" id="delete" data-toggle="modal" data-target="#konfirmasiHapusSelected"><i class="glyphicon glyphicon-trash"></i> Delete Selected</button>
  </div>
  </div>
</div>

<?php echo $modal_tambah_admin; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataAdmin', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php show_my_confirm('konfirmasiHapusSelected', 'hapus-dataAdmin-selected', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Admin';
  $data['url'] = 'Admin/import';
  echo show_my_modal('modals/modal_import', 'import-admin', $data);
?>
 <!-- Script -->
 <script type="text/javascript">
         function tampilPegawai() {
		$.get('<?php echo base_url('Admin/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-admin').html(data);
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



      });
      </script>
