<?php
include("wdywfm/myLoad.php");
userData::checkSession();
$view = "Listar Revista";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include('template/header.html');
?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php
include("template/navbar.html");
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Revistas</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/default.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="validaciones/cerrar_sesion.php" class="d-block"><?php echo $_SESSION['username']; ?></a>
        </div>
      </div>
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <?php
      include('template/sidebar.html');
      ?>
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><?php echo $view; ?></h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid py-2">
          <!--- datatable last -->
          <table id="table_id" class="table  table-condensed table-hover responsive table-striped">
            <thead>
              <tr>
                <th>Edicion</th>
                <th>Date</th>
                <th>Foto</th>
                <th>Url</th>
                <th>Creado por</th>
		<th>Editar</th>
		<th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $conn = Conexion::getInstance()->getConnection();
              $sql = "select * from revista;";
              $query = mysqli_query($conn,$sql);
              while($rep = mysqli_fetch_assoc($query)) {
            ?>
              <tr>
                <td><?php echo $rep['edicion']; ?></td>
                <td><?php echo $rep['date']; ?></td>
                <td><img src="<?php echo $rep['foto']; ?>" alt="" width="20%"></td>
                <td><?php echo $rep['url']; ?></td>
                <td><?php echo $rep['id_usuario']; ?></td>
             	<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal<?php echo $rep['id_revista']; ?>">Editar</button></td>
		<td><a href = "validaciones/eliminar_revista.php?id=<?php echo $rep['id_revista']; ?>" ><button type="button" class="btn btn-danger">Eliminar</button></a></td> 
	     </tr>


<div class="modal fade" id="exampleModal<?php echo $rep['id_revista']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $rep['edicion']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form method="POST" action="validaciones/editar_revista.php" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $rep['id_revista'] ?>">
                              <div class="card-body">
                                 <div class="form-group">
                                    <label for="">Edicion</label>
                                    <input type="number" class="form-control" name="edicion" placeholder="Ingrese la edicion" required autocomplete="off" value="<?php echo $rep['edicion']; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="">Fecha</label>
                                    <input type="month" class="form-control" name="fecha" required autocomplete="off" value="<?php echo $rep['date']; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" class="form-control" name="foto" required autocomplete="off">
                                 </div>
                                 <div class="form-group">
                                    <label for="">Url</label>
                                    <input type="text" class="form-control" name="url" placeholder="Ingrese el enlace" required autocomplete="off" value="<?php echo $rep['url']; ?>">
                                 </div>
                              </div>
                              <div class="card mr-4 ml-4">
                                 <button type="submit" class="btn btn-primary">Enviar</button>
                              </div>
                           </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

            <?php
              }
            ?>
            </tbody>
          </table>
        </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<?php
include("template/footer.html");
?>
</body>
</html>
