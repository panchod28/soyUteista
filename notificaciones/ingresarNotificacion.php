<?php
include("wdywfm/myLoad.php");
userData::checkSession();
$view = "Ingresar Notificacion";
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
      <span class="brand-text font-weight-light">Notificaciones</span>
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
      <div class="container-fluid">
          <!--- datatable last -->
          <section class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12 col-lg-12 col-12">
                        <div class="card card-primary">
                           <div class="card-header">
                              <h3 class="card-title">Ingresar datos</h3>
                           </div>
                           <form method="POST" action="validaciones/crearNotificacion.php">
                              <div class="card-body">
                                 <div class="form-group">
                                    <label for="">Tiulo</label>
                                    <input type="text" class="form-control" name="titulo" placeholder="Ingrese el titulo" required autocomplete="off">
                                 </div>
                                 <div class="form-group">
                                    <label for="">Cuerpo</label>
                                    <input type="text" class="form-control" name="cuerpo" placeholder="Ingrese el cuerpo" required autocomplete="off">
                                 </div>
                                 <div class="form-group">
                                    <label for="">Enlace</label>
                                    <input type="text" class="form-control" name="link" placeholder="Ingrese el enlace" required autocomplete="off">
                                 </div>
                              </div>
                              <div class="card mr-4 ml-4">
                                 <button type="submit" class="btn btn-primary">Enviar</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
      </div>
    </section>
  </div>
<?php
include("template/footer.html");
?>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
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
</body>
</html>
