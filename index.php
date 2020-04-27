<?php
  session_start();
  if ( !isset($_SESSION["username"]) ) {
    header("Location: login.php");
    exit;
  }
  if (!isset($_GET['page']) || $_GET['page']=='')
    $_GET['page'] = 'blank';

  include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Penjualan ATK</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/myCSS.css" rel="stylesheet">
  <!-- Custom styles for datatable -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow" style="background-color: #2ea8ff;">
          <a class="navbar-brand" href="index.php">Penjualan ATK</a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <a class="nav-link <?php if ($_GET['page'] == 'penjualan') echo 'active'; ?>" href="?page=penjualan">Transaksi</a>
              </li>
              <li class="nav-item dropdown <?php if (($_GET['page'] == 'barang')||($_GET['page'] == 'kategori')) echo 'active'; ?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Produk
                </a>
                <div class="dropdown-menu dropdown-menu-left animated--grow-in" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="?page=barang">Barang</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="?page=kategori">Kategori</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if ($_GET['page'] == 'karyawan') echo 'active'; ?>" href="?page=karyawan">Karyawan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if ($_GET['page'] == 'laporan') echo 'active'; ?>" href="?page=laporan">Laporan</a>
              </li>
            </ul>
            
          </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <span class="mr-2 d-none d-lg-inline text-white big">
                <?php
                  echo $_SESSION['username'];
                ?>
                </span>
                
            </li>
            <li>
              <span class="topbar-divider"></span>
            </li>
            <li class="nav-item">
              <a id="aLogout" style="text-decoration: none;" name="logout" href="logout.php">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-white"></i>
                <span class="mr-2 d-none d-lg-inline big">Logout</span>
              </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"></h1>
          <?php 
            $page = $_GET['page'];
            // require_once('page/'.$_GET['page'].'.php');
            if ($page == "blank") {
              require_once('page/'.'blank.php');
            }
            else if ($page == "barang") {
              require_once('page/barang/'.'barang.php'); 
            }
            else if ($page == "kategori") {
              require_once('page/kategori/'.'kategori.php'); 
            }
            else if ($page == "penjualan") {
              require_once('page/penjualan/'.'penjualan.php'); 
            }
            else if ($page == "karyawan") {
              require_once('page/karyawan/'.'karyawan.php'); 
            }
            else if ($page == "laporan") {
              require_once('page/laporan/'.'laporan.php'); 
            }
            else {
              require_once('page/blank.php');
            }
          ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
          
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
