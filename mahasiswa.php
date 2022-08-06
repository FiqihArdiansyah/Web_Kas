<?php 
  require 'connection.php';
  checkLogin();
  $mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama_mahasiswa ASC");
  if (isset($_POST['btnEditmahasiswa'])) {
    if (editmahasiswa($_POST) > 0) {
      setAlert("mahasiswa has been changed", "Successfully changed", "success");
      header("Location: mahasiswa.php");
    }
  }

  if (isset($_POST['btnTambahmahasiswa'])) {
    if (addmahasiswa($_POST) > 0) {
      setAlert("mahasiswa has been added", "Successfully added", "success");
      header("Location: mahasiswa.php");
    }
  }
  if (isset($_GET['toggle_modal'])) {
    $toggle_modal = $_GET['toggle_modal'];
    echo "
    <script>
      $(document).ready(function() {
        $('#$toggle_modal').modal('show');
      });
    </script>
    ";
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>mahasiswa</title>
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
        <div class="row justify-content-center mb-2">
          <div class="col-sm text-left">
            <h1 class="m-0 text-dark">mahasiswa</h1>
          </div><!-- /.col -->
          <div class="col-sm text-right">
            <?php if ($_SESSION['id_jabatan'] !== '3'): ?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmahasiswaModal"><i class="fas fa-fw fa-plus"></i> Tambah mahasiswa</button>
              <!-- Modal -->
              <div class="modal fade text-left" id="tambahmahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="tambahmahasiswaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="tambahmahasiswaModalLabel">Tambah mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="nama_mahasiswa">Nama mahasiswa</label>
                          <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label>Jenis Kelamin</label><br>
                          <input type="radio" id="pria" name="jenis_kelamin" value="pria"> <label for="pria">Pria</label> |
                          <input type="radio" id="wanita" name="jenis_kelamin" value="wanita"> <label for="wanita">Wanita</label>
                        </div>
                        <div class="form-group">
                          <label for="no_telepon">No. Telepon</label>
                          <input type="number" name="no_telepon" id="no_telepon" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" name="email" id="email" class="form-control">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary" name="btnTambahmahasiswa"><i class="fas fa-fw fa-save"></i> Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            <?php endif ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg">
            <div class="table-responsive">
              <table class="table table-striped table-hover table-bordered" id="table_id">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama mahasiswa</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <?php if ($_SESSION['id_jabatan'] !== '3'): ?>
                      <th>Aksi</th>
                    <?php endif ?>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($mahasiswa as $ds): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= ucwords(htmlspecialchars_decode($ds['nama_mahasiswa'])); ?></td>
                      <td><?= ucwords($ds['jenis_kelamin']); ?></td>
                      <td><?= $ds['no_telepon']; ?></td>
                      <td><?= $ds['email']; ?></td>
                      <?php if ($_SESSION['id_jabatan'] !== '3'): ?>
                        <td>
                          <!-- Button trigger modal -->
                          <a href="ubah_mahasiswa.php?id_mahasiswa=<?= $ds['id_mahasiswa']; ?>" class="badge badge-success" data-toggle="modal" data-target="#editmahasiswa<?= $ds['id_mahasiswa']; ?>">
                            <i class="fas fa-fw fa-edit"></i> Ubah
                          </a>
                          <!-- Modal -->
                          <div class="modal fade" id="editmahasiswa<?= $ds['id_mahasiswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="editmahasiswa<?= $ds['id_mahasiswa']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="post">
                                <input type="hidden" name="id_mahasiswa" value="<?= $ds['id_mahasiswa']; ?>">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editmahasiswaModalLabel<?= $ds['id_mahasiswa']; ?>">Ubah mahasiswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="nama_mahasiswa<?= $ds['id_mahasiswa']; ?>">Nama mahasiswa</label>
                                      <input type="text" id="nama_mahasiswa<?= $ds['id_mahasiswa']; ?>" value="<?= $ds['nama_mahasiswa']; ?>" name="nama_mahasiswa" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                      <label>Jenis Kelamin</label><br>
                                      <?php if ($ds['jenis_kelamin'] == 'pria'): ?>
                                        <input type="radio" id="pria<?= $ds['id_mahasiswa']; ?>" name="jenis_kelamin" value="pria" checked="checked"> <label for="pria<?= $ds['id_mahasiswa']; ?>">Pria</label> |
                                        <input type="radio" id="wanita<?= $ds['id_mahasiswa']; ?>" name="jenis_kelamin" value="wanita"> <label for="wanita<?= $ds['id_mahasiswa']; ?>">Wanita</label>
                                      <?php else: ?>
                                        <input type="radio" id="pria<?= $ds['id_mahasiswa']; ?>" name="jenis_kelamin" value="pria"> <label for="pria<?= $ds['id_mahasiswa']; ?>">Pria</label> |
                                        <input type="radio" id="wanita<?= $ds['id_mahasiswa']; ?>" name="jenis_kelamin" value="wanita" checked="checked"> <label for="wanita<?= $ds['id_mahasiswa']; ?>">Wanita</label>
                                      <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                      <label for="no_telepon<?= $ds['id_mahasiswa']; ?>">No. Telepon</label>
                                      <input type="number" name="no_telepon" value="<?= $ds['no_telepon']; ?>" id="no_telepon<?= $ds['id_mahasiswa']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label for="email<?= $ds['id_mahasiswa']; ?>">Email</label>
                                      <input type="email" name="email" value="<?= $ds['email']; ?>" id="email<?= $ds['id_mahasiswa']; ?>" class="form-control">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnEditmahasiswa"><i class="fas fa-fw fa-save"></i> Save</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <?php if ($_SESSION['id_jabatan'] == '1'): ?>
                            <a data-nama="<?= $ds['nama_mahasiswa']; ?>" class="btn-delete badge badge-danger" href="hapus_mahasiswa.php?id_mahasiswa=<?= $ds['id_mahasiswa']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                          <?php endif ?>
                        </td>
                      <?php endif ?>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
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
