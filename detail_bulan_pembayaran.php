<?php 
  require 'connection.php';
  checkLogin();
  $id_bulan_pembayaran = $_GET['id_bulan_pembayaran'];
  $detail_bulan_pembayaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bulan_pembayaran WHERE id_bulan_pembayaran = '$id_bulan_pembayaran'"));
  $mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama_mahasiswa ASC");
  $mahasiswa_baru = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id_mahasiswa NOT IN (SELECT id_mahasiswa FROM uang_kas) ORDER BY nama_mahasiswa ASC");
  $uang_kas = mysqli_query($conn, "SELECT * FROM uang_kas INNER JOIN mahasiswa ON uang_kas.id_mahasiswa = mahasiswa.id_mahasiswa INNER JOIN bulan_pembayaran ON uang_kas.id_bulan_pembayaran = bulan_pembayaran.id_bulan_pembayaran WHERE uang_kas.id_bulan_pembayaran = '$id_bulan_pembayaran' ORDER BY nama_mahasiswa ASC");

  if (isset($_POST['btnEditPembayaranUangKas'])) {
    if (editPembayaranUangKas($_POST) > 0) {
      setAlert("Pembayaran has been changed", "Successfully changed", "success");
      header("Location: detail_bulan_pembayaran.php?id_bulan_pembayaran=$id_bulan_pembayaran");
    }
  }

  if (isset($_POST['btnTambahmahasiswa'])) {
    if (tambahmahasiswaUangKas($_POST) > 0) {
      setAlert("mahasiswa has been added", "Successfully added", "success");
      header("Location: detail_bulan_pembayaran.php?id_bulan_pembayaran=$id_bulan_pembayaran");
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>Detail Bulan Pembayaran : <?= ucwords($detail_bulan_pembayaran['nama_bulan']); ?> <?= $detail_bulan_pembayaran['tahun']; ?></title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php include 'include/navbar.php'; ?>

  <?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Detail Bulan Pembayaran : <?= ucwords($detail_bulan_pembayaran['nama_bulan']); ?> <?= $detail_bulan_pembayaran['tahun']; ?></h1>
            <h4>Rp. <?= number_format($detail_bulan_pembayaran['pembayaran_perminggu']); ?> / minggu</h4>
          </div><!-- /.col -->
          <div class="col-sm text-right">
            <?php if ($_SESSION['id_jabatan'] !== '3'): ?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmahasiswaModal"><i class="fas fa-fw fa-plus"></i> Tambah mahasiswa</button>
            <?php endif ?>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid bg-white p-3 rounded">
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered" id="table_id">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama mahasiswa</th>
                <th>Minggu ke 1</th>
                <th>Minggu ke 2</th>
                <th>Minggu ke 3</th>
                <th>Minggu ke 4</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($uang_kas as $duk): ?>
                <?php if ($_SESSION['id_jabatan'] == '3'): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= ucwords(htmlspecialchars_decode($duk['nama_mahasiswa'])); ?></td>
                    <?php if ($duk['minggu_ke_1'] == $duk['pembayaran_perminggu']): ?>
                      <td class="text-success"><?= number_format($duk['minggu_ke_1']); ?></td>
                    <?php else: ?>
                      <td class="text-danger"><?= number_format($duk['minggu_ke_1']); ?></td>
                    <?php endif ?>

                    <?php if ($duk['minggu_ke_2'] == $duk['pembayaran_perminggu']): ?>
                      <td class="text-success"><?= number_format($duk['minggu_ke_2']); ?></td>
                    <?php else: ?>
                      <td class="text-danger"><?= number_format($duk['minggu_ke_2']); ?></td>
                    <?php endif ?>

                    <?php if ($duk['minggu_ke_3'] == $duk['pembayaran_perminggu']): ?>
                      <td class="text-success"><?= number_format($duk['minggu_ke_3']); ?></td>
                    <?php else: ?>
                      <td class="text-danger"><?= number_format($duk['minggu_ke_3']); ?></td>
                    <?php endif ?>

                    <?php if ($duk['minggu_ke_4'] == $duk['pembayaran_perminggu']): ?>
                      <td class="text-success"><?= number_format($duk['minggu_ke_4']); ?></td>
                    <?php else: ?>
                      <td class="text-danger"><?= number_format($duk['minggu_ke_4']); ?></td>
                    <?php endif ?>
                  </tr>
                <?php else: ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $duk['nama_mahasiswa']; ?></td>
                    <?php if ($duk['minggu_ke_1'] == $duk['pembayaran_perminggu']): ?>
                      <?php if ($duk['minggu_ke_2'] !== "0"): ?>
                        <td>
                          <button type="button" class="badge badge-success" data-container="body" data-toggle="popover" data-placement="top" data-content="Tidak bisa mengubah minggu ke 1, kalau minggu ke 2 dan seterusnya sudah lunas, jika ingin mengubah, ubahlah minggu ke 2 atau ke 3 atau ke 4 terlebih dahulu menjadi 0.">
                            <i class="fas fa-fw fa-check"></i> Sudah bayar
                          </button>
                        </td>
                      <?php else: ?>
                        <td><a href="" data-toggle="modal" data-target="#editMingguKe1<?= $duk['id_uang_kas']; ?>" class="badge badge-success"><i class="fas fa-fw fa-check"></i> Sudah bayar</a></td>
                      <?php endif ?>
                    <?php else: ?>
                      <td><a href="" data-toggle="modal" data-target="#editMingguKe1<?= $duk['id_uang_kas']; ?>" class="badge badge-danger"><?= number_format($duk['minggu_ke_1']); ?></a></td>
                    <?php endif ?>
                    <?php if ($duk['minggu_ke_1'] !== $duk['pembayaran_perminggu']): ?>
                      <td><---</td>
                      <td><---</td>
                      <td><---</td>
                    <?php else: ?>
                      <?php if ($duk['minggu_ke_2'] == $duk['pembayaran_perminggu']): ?>
                      <?php if ($duk['minggu_ke_3'] !== "0"): ?>
                        <td><button type="button" class="badge badge-success" data-container="body" data-toggle="popover" data-placement="top" data-content="Tidak bisa mengubah minggu ke 2, jika minggu ke 3 dan seterusnya sudah lunas, jika ingin mengubah, ubahlah minggu ke 3 atau ke 4 terlebih dahulu menjadi 0."><i class="fas fa-fw fa-check"></i> Sudah bayar</button></td>
                      <?php else: ?>
                        <td><a href="" data-toggle="modal" data-target="#editMingguKe2<?= $duk['id_uang_kas']; ?>" class="badge badge-success"><i class="fas fa-fw fa-check"></i> Sudah bayar</a></td>
                      <?php endif ?>
                      <?php else: ?>
                        <td><a href="" data-toggle="modal" data-target="#editMingguKe2<?= $duk['id_uang_kas']; ?>" class="badge badge-danger"><?= number_format($duk['minggu_ke_2']); ?></a></td>
                      <?php endif ?>
                      <?php if ($duk['minggu_ke_2'] !== $duk['pembayaran_perminggu']): ?>
                        <td><---</td>
                        <td><---</td>
                      <?php else: ?>
                        <?php if ($duk['minggu_ke_3'] == $duk['pembayaran_perminggu']): ?>
                          <?php if ($duk['minggu_ke_4'] !== "0"): ?>
                            <td><button type="button" class="badge badge-success" data-container="body" data-toggle="popover" data-placement="top" data-content="Tidak bisa mengubah minggu ke 3, jika minggu ke 4 sudah lunas, jika ingin mengubah, ubahlah minggu ke 4 terlebih dahulu menjadi 0."><i class="fas fa-fw fa-check"></i> Sudah bayar</button></td>
                          <?php else: ?>
                            <td><a href="" data-toggle="modal" data-target="#editMingguKe3<?= $duk['id_uang_kas']; ?>" class="badge badge-success"><i class="fas fa-fw fa-check"></i> Sudah bayar</a></td>
                          <?php endif ?>
                        <?php else: ?>
                          <td><a href="" data-toggle="modal" data-target="#editMingguKe3<?= $duk['id_uang_kas']; ?>" class="badge badge-danger"><?= number_format($duk['minggu_ke_3']); ?></a></td>
                        <?php endif ?>
                        <?php if ($duk['minggu_ke_3'] !== $duk['pembayaran_perminggu']): ?>
                          <td><---</td>
                        <?php else: ?>
                          <?php if ($duk['minggu_ke_4'] == $duk['pembayaran_perminggu']): ?>
                            <td><a href="" data-toggle="modal" data-target="#editMingguKe4<?= $duk['id_uang_kas']; ?>" class="badge badge-success"><i class="fas fa-fw fa-check"></i> Sudah bayar</a></td>
                          <?php else: ?>
                            <td><a href="" data-toggle="modal" data-target="#editMingguKe4<?= $duk['id_uang_kas']; ?>" class="badge badge-danger"><?= number_format($duk['minggu_ke_4']); ?></a></td>
                          <?php endif ?>
                        <?php endif ?>
                      <?php endif ?>
                    <?php endif ?>
                  </tr>
                    
                  <div class="modal fade" id="editMingguKe1<?= $duk['id_uang_kas']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMingguKe1Label<?= $duk['id_uang_kas']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="post">
                        <input type="hidden" name="id_uang_kas" value="<?= $duk['id_uang_kas']; ?>">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editMingguKe1Label<?= $dbp['id_bulan_pembayaran']; ?>">Ubah Minggu Ke-1 : <?= $duk['nama_mahasiswa']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="minggu_ke_1">Minggu Ke-1</label>
                              <input type="hidden" name="uang_sebelum" value="<?= $duk['minggu_ke_1']; ?>">
                              <input max="<?= $duk['pembayaran_perminggu']; ?>" type="number" name="minggu_ke_1" class="form-control" value="<?= $duk['minggu_ke_1']; ?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                            <button type="submit" name="btnEditPembayaranUangKas" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="modal fade" id="editMingguKe2<?= $duk['id_uang_kas']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMingguKe2Label<?= $duk['id_uang_kas']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="post">
                        <input type="hidden" name="id_uang_kas" value="<?= $duk['id_uang_kas']; ?>">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editMingguKe2Label<?= $dbp['id_bulan_pembayaran']; ?>">Ubah Minggu Ke-2 : <?= $duk['nama_mahasiswa']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="minggu_ke_2">Minggu Ke-2</label>
                              <input type="hidden" name="uang_sebelum" value="<?= $duk['minggu_ke_2']; ?>">
                              <input max="<?= $duk['pembayaran_perminggu']; ?>" type="number" name="minggu_ke_2" class="form-control" value="<?= $duk['minggu_ke_2']; ?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                            <button type="submit" name="btnEditPembayaranUangKas" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="modal fade" id="editMingguKe3<?= $duk['id_uang_kas']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMingguKe3Label<?= $duk['id_uang_kas']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="post">
                        <input type="hidden" name="id_uang_kas" value="<?= $duk['id_uang_kas']; ?>">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editMingguKe3Label<?= $dbp['id_bulan_pembayaran']; ?>">Ubah Minggu Ke-3 : <?= $duk['nama_mahasiswa']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="minggu_ke_3">Minggu Ke-3</label>
                              <input type="hidden" name="uang_sebelum" value="<?= $duk['minggu_ke_3']; ?>">
                              <input max="<?= $duk['pembayaran_perminggu']; ?>" type="number" name="minggu_ke_3" class="form-control" value="<?= $duk['minggu_ke_3']; ?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                            <button type="submit" name="btnEditPembayaranUangKas" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="modal fade" id="editMingguKe4<?= $duk['id_uang_kas']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMingguKe4Label<?= $duk['id_uang_kas']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="post">
                        <input type="hidden" name="id_uang_kas" value="<?= $duk['id_uang_kas']; ?>">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editMingguKe4Label<?= $dbp['id_bulan_pembayaran']; ?>">Ubah Minggu Ke-4 : <?= $duk['nama_mahasiswa']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="minggu_ke_4">Minggu Ke-4</label>
                              <input type="hidden" name="uang_sebelum" value="<?= $duk['minggu_ke_4']; ?>">
                              <input max="<?= $duk['pembayaran_perminggu']; ?>" type="number" name="minggu_ke_4" class="form-control" value="<?= $duk['minggu_ke_4']; ?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                            <button type="submit" name="btnEditPembayaranUangKas" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php endif ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<?php if ($_SESSION['id_jabatan'] !== '3'): ?>
  <div class="modal fade" id="tambahmahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="tambahmahasiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post">
        <input type="hidden" name="id_bulan_pembayaran" value="<?= $id_bulan_pembayaran; ?>">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahmahasiswaModalLabel">Tambah mahasiswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="id_mahasiswa">Nama mahasiswa</label>
              <select name="id_mahasiswa" id="id_mahasiswa" class="form-control">
                <?php foreach ($mahasiswa_baru as $dsb): ?>
                  <option value="<?= $dsb['id_mahasiswa']; ?>"><?= $dsb['nama_mahasiswa']; ?></option>
                <?php endforeach ?>
              </select>
              <a href="mahasiswa.php?toggle_modal=tambahmahasiswaModal">Tidak ada nama mahasiswa diatas? Tambahkan mahasiswa disini!</a>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
            <button type="submit" name="btnTambahmahasiswa" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php endif ?>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 By Fiqih Ardiansyah.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
</body>
</html>
