<?php
  $no = 1;
  foreach ($dataAdmin as $admin) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $admin->username; ?></td>
      <td><?php echo $admin->nama; ?></td>
      <td> <img src="<?php echo base_url(); ?>assets/img/<?php echo $admin->foto; ?>" class="img-circle" alt="User Image" width="30" height="40">
      <td align="center"><input type="checkbox" class='checkbox' name='delete'  value='<?php echo $admin->id ?>' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

   </td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataAdmin" data-id="<?php echo $admin->id; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
        <button class="btn btn-danger konfirmasiHapus-admin" data-id="<?php echo $admin->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>

  