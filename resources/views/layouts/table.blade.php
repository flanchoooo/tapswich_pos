<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Secure Payments</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dt/vendor/fontawesome-free/css/all.min.css' ) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dt/datatable/font.css' ) }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{asset('dt/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('dt/datatable/datatable.css')}}" rel="stylesheet">
    <link href="{{asset('dt/datatable/buttons.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('/dt/js/button.js')}}"></script>
    <script type="text/javascript" src="{{asset('dt/datatable/datatablejQueryMin.js')}}"></script>
    <script type="text/javascript" src="{{asset('dt/datatable/buttondatatablejQueryMin.js')}}"></script>
    <script type="text/javascript" src="{{asset('dt/datatable/pdf.js')}}"></script>
    <script type="text/javascript" src="{{asset('dt/datatable/pdf2.js')}}"></script>
    <script type="text/javascript" src="{{asset('dt/datatable/html5buttons.js')}}"></script>
    <script type="text/javascript" src="{{asset('dt/datatable/print.js')}}"></script>
    <script type="text/javascript" src="{{asset('dt/datatable/dataTable.swf')}}"></script>





    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#example thead tr').clone(true).appendTo( '#example thead' );
            $('#example thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder=" '+title+'" />' );

                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            var table = $('#example').DataTable( {
                orderCellsTop: true,
                fixedHeader: false,
                "pageLength": 10,
                "order": [[0, "desc"]],
                dom: 'Bfrtip',
                buttons: [
                    {
                        "extend":"excel",
                        "text":"Export to Excel",
                        "className":"btn btn-primary"
                    },{
                        "extend":"print",
                        "text":"Export to PDF",
                        "className":"btn btn-primary"
                    },

                    {
                        "extend":"copy",
                        "text":"Copy to File",
                        "className":"btn btn-primary"
                    },
                ]
            } );
        });
    </script>

</head>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>

            @yield('content')

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Secure Payments 2019</span>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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


                <form class="modal-form" id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button class="btn btn-primary">Logout</button>
                </form>


            </div>
        </div>
    </div>
</div>
</body>
<!--Dropdown Side bar menu-->
<script src="{{asset('dt/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dt/js/demo/datatables-demo.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('dt/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('dt/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('dt/js/demo/chart-pie-demo.js')}}"></script>
<script src="{{asset('dt/js/demo/chart-area-demo.js')}}"></script>


</html>






