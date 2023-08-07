@extends('layouts.main')

@section('title')
    Layanan Konsultasi | Admin
@endsection

@section('sidebar')
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #F57009">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
                            style="color: #1C1A30"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin-home') }}" class="nav-link" style="color: #1C1A30">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <form class="form-inline ">
                    <div class="input-group input-group-sm ">
                        <p class="form-control text-center form-control-navbar text-light"
                            style="border-radius: 5px;background-color:#1C1A30; color: #FDE4D0;">
                            <script type="text/javascript">
                                //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
                                function tampilkanwaktu() {
                                    //buat object date berdasarkan waktu saat ini
                                    var waktu = new Date();
                                    //ambil nilai jam, 
                                    //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
                                    var sh = waktu.getHours() + "";
                                    //ambil nilai menit
                                    var sm = waktu.getMinutes() + "";
                                    //ambil nilai detik
                                    var ss = waktu.getSeconds() + "";
                                    //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
                                    document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" +
                                        sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
                                }
                            </script>

                            <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                                <span id="clock"></span>
                                <?php
                                $hari = date('l');
                                /*$new = date('l, F d, Y', strtotime($Today));*/
                                if ($hari == 'Sunday') {
                                    echo 'Minggu';
                                } elseif ($hari == 'Monday') {
                                    echo 'Senin';
                                } elseif ($hari == 'Tuesday') {
                                    echo 'Selasa';
                                } elseif ($hari == 'Wednesday') {
                                    echo 'Rabu';
                                } elseif ($hari == 'Thursday') {
                                    echo 'Kamis';
                                } elseif ($hari == 'Friday') {
                                    echo "Jum'at";
                                } elseif ($hari == 'Saturday') {
                                    echo 'Sabtu';
                                }
                                ?>,
                                <?php
                                $tgl = date('d');
                                echo $tgl;
                                $bulan = date('F');
                                if ($bulan == 'January') {
                                    echo ' Januari ';
                                } elseif ($bulan == 'February') {
                                    echo ' Februari ';
                                } elseif ($bulan == 'March') {
                                    echo ' Maret ';
                                } elseif ($bulan == 'April') {
                                    echo ' April ';
                                } elseif ($bulan == 'May') {
                                    echo ' Mei ';
                                } elseif ($bulan == 'June') {
                                    echo ' Juni ';
                                } elseif ($bulan == 'July') {
                                    echo ' Juli ';
                                } elseif ($bulan == 'August') {
                                    echo ' Agustus ';
                                } elseif ($bulan == 'September') {
                                    echo ' September ';
                                } elseif ($bulan == 'October') {
                                    echo ' Oktober ';
                                } elseif ($bulan == 'November') {
                                    echo ' November ';
                                } elseif ($bulan == 'December') {
                                    echo ' Desember ';
                                }
                                $tahun = date('Y');
                                echo $tahun;
                                ?>
                        </p>
                    </div>
                </form>
                <li class="nav-item text-nowrap">

                    <form action="{{ route('logout') }}" method="get">
                        @csrf
                        <button type="submit" class="nav-link px3 border-0"
                            style="border-radius: 5px; height: 30px; margin: 6%; padding: 2px 15px; background-color:#1C1A30; color: #FDE4D0;">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>
                    </form>
                </li>

                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #F57009">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block" style="color: #1C1A30">Admin</a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- Profil -->
                        <li class="nav-item">
                            <a href="{{ route('admin-home') }}" class="nav-link">
                                <i class="nav-icon fas fa-house-user" style="color: #1C1A30"></i>
                                <p style="color: #1C1A30">
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin-user-data') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-edit" style="color: #1C1A30"></i>
                                <p style="color: #1C1A30">
                                    User
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin-request') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-edit" style="color: #1C1A30"></i>
                                <p style="color: #1C1A30">
                                    Request
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin-history') }}" class="nav-link">
                                <i class="nav-icon fas fa-history" style="color: #1C1A30"></i>
                                <p style="color: #1C1A30">
                                    History
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin-set-index') }}" class="nav-link">
                                <i class="nav-icon fas fa-sliders" style="color: #1C1A30"></i>
                                <p style="color: #1C1A30">
                                    Status
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    {{-- <div class="row mb-2">
                        <div class="col-sm-6"> --}}
                    @yield('container')

                    {{-- </div>
                    </div> --}}
                </div>
        </div><!-- /.container-fluid -->
        </section>
        <footer class="main-footer" style="background-color: #F57009">
            <strong style="color: #1C1A30"> &copy; 2022 made with by PKL UINSA Tim</a></strong>
        </footer>
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/dist/js/demo.js"></script>

    <script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- ChartJS -->
    <script src="/assets/plugins/chart.js/Chart.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"
        integrity="sha512-9jr6up7aOKJkN7JmtsxSdU+QibDjV6m6gL+I76JdpX1qQy8Y5nxAWVjvKMaBkETDC3TP3V2zvIk+zG7734WqPA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
