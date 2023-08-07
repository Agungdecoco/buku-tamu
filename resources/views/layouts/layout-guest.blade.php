@extends('layouts.main')

@section('tittle')
    Layanan Konsultasi | Tamu
@endsection

@section('sidebar')
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light" style="background-color: #DCD6F7">
            <!-- Left navbar links -->
            <ul class="navbar-nav" style="background-color: #DCD6F7">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
                            style="color: #000957"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ 'guest-home' }}" class="nav-link" style="color: #000957">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-warning">5</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header"> 5 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>

                <form class="form-inline ">
                    <div class="input-group input-group-sm ">
                        <p class="form-control text-center form-control-navbar text-light"
                            style="border-radius: 5px;background-color: #000957;">
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
                            </body>
                        </p>
                    </div>
                </form>

                <li class="nav-item text-nowrap">

                    <form action="{{ route('logout') }}" method="get">
                        @csrf
                        <button type="submit" class="nav-link px3 border-0 "
                            style="border-radius: 5px; height: 30px; margin: 6%; padding: 2px 15px; background-color:#000957;; color: white;"><i
                                class="bi bi-box-arrow-right text-light"></i>
                            Logout
                        </button>
                    </form>
                </li>
                {{-- </li> --}}
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #000957;">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('/user_file/' . auth()->user()->guest->foto) }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ 'biodata' }}" class="d-block"
                            style="color:#DCD6F7">{{ auth()->user()->guest->nama_tamu }}</a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- Profil -->
                        <li class="nav-item">
                            <a href="{{ route('guest-home') }}" class="nav-link">
                                <i class="nav-icon fas fa-house-user" style="color:#DCD6F7"></i>
                                <p style="color:#DCD6F7">
                                    Home
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user" style="color:#DCD6F7"></i>
                                <p style="color:#DCD6F7">
                                    Profil
                                    <i class="fas fa-angle-left right" style="color:#DCD6F7"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('biodata') }}" class="nav-link">
                                        <i class="nav-icon fas fa-edit" style="color:#DCD6F7"></i>
                                        <p style="color:#DCD6F7">
                                            Biodata
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('foto-profil') }}" class="nav-link">
                                        <i class="nav-icon fas fa-id-card" style="color:#DCD6F7"></i>
                                        <p style="color:#DCD6F7">
                                            Photo Profile
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('edit-pass') }}" class="nav-link">
                                        <i class="nav-icon fas fa-unlock-alt" style="color:#DCD6F7"></i>
                                        <p style="color:#DCD6F7">
                                            Account
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item">
                            <a href="{{ route('guest-create') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt" style="color:#DCD6F7"></i>
                                <p style="color:#DCD6F7">
                                    Reserve
                                </p>
                            </a>
                        </li>

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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @yield('section')
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                                                        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                                                        crossorigin="anonymous">
                            </script>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- /.container-fluid -->
        <footer class="main-footer" style="background-color: #DCD6F7">
            <strong style="color:#424874"> &copy; 2022 made with by PKL UINSA Tim</a></strong>
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

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                minDate: moment().add('d', 1).toDate(),
            });
        });
    </script>
@endsection
