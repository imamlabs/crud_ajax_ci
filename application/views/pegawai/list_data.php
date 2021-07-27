<?php
  foreach ($dataPegawai as $pegawai) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $pegawai->pegawai; ?></td>
      <td><?php echo $pegawai->telp; ?></td>
      <td><?php echo $pegawai->kota; ?></td>
      <td><?php echo $pegawai->kelamin; ?></td>
      <td><?php echo $pegawai->posisi; ?></td>
      <td align="center"><input type="checkbox" class='checkbox' name='delete'  value='<?php echo $pegawai->id ?>' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataPegawai" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
        <button class="btn btn-danger konfirmasiHapus-pegawai" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Delete</button>
      </td>
    </tr>
    <?php
  }
?>