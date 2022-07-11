
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Aplikasi Kasir
  </title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="{{ asset('template-admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('template-admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="{{ asset('template-admin/assets/css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet" />

</head>

<body class="g-sidenav-show  bg-gray-200">

    <div id="app">
        <aside v-show="$route.path === '/' ? false : true" class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main" style="display: none;">
            <div class="sidenav-header">
              <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
              <a class="navbar-brand m-0" href="#">
                <img src="{{ asset('template-admin/assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">Aplikasi Kasir</span>
              </a>
            </div>
            <hr class="horizontal light mt-0 mb-2">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <router-link class="nav-link text-white bg-gradient-primary" to="/home">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                  </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link text-white " to="/orderMenu">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">view_in_ar</i>
                      </div>
                      <span class="nav-link-text ms-1">Order Menu</span>
                    </router-link>
                  </li>
                <li class="nav-item">
                  <router-link class="nav-link text-white" active-class="active" to="/user">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Pengguna</span>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link text-white" active-class="active" to="/category">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                    </div>
                    <span class="nav-link-text ms-1">Kategori</span>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link text-white" active-class="active" to="/product">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Produk</span>
                  </router-link>
                </li>
                <li class="nav-item mt-3">
                  <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Laporan</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="#">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                      </div>
                      <span class="nav-link-text ms-1">Laporan Transaksi</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Stock Gudang</h6>
                  </li>
                <li class="nav-item">
                    <router-link class="nav-link text-white " to="/barangMasuk">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                      </div>
                      <span class="nav-link-text ms-1">Barang Masuk</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link text-white " to="/barangKeluar">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                      </div>
                      <span class="nav-link-text ms-1">Barang Keluar</span>
                    </router-link>
                </li>
              </ul>
        </aside>

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <nav v-show="$route.path === '/' ? false : true"  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true" style="display: none;">
              <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">

                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <router-link to="/logout" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">LogOut</span>
                      </router-link>
                    </li>
                  </ul>

                </div>
              </div>
            </nav>


            <div class="container-fluid py-4">
                <router-view></router-view>
            </div>
        </main>
    </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('admin-template/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('admin-template/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin-template/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('admin-template/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('admin-template/assets/js/plugins/chartjs.min.js') }}"></script>

  <script>
    let token = localStorage.getItem('token');
    if(token){
        $("#sidenav-main").css("display", "");
        $("#navbarBlur").css("display", "");
    }
  </script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('template-admin/assets/js/material-dashboard.min.js?v=3.0.4') }}"></script>
</body>

</html>
