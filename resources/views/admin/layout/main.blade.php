@include('admin.layout.partial.header')


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.layout.partial.navbar')
        @include('admin.layout.partial.asidbar', ['active' => 'active'])
        {{-- <x-nav/> --}}

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title', 'Page Title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @section('breadcrumb')
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                @show
                                <li>
                                    <form action="{{ route('logout') }}" method="post" class="d-inline-block ml-2">
                                        @csrf
                                        {{-- {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                                        <button type="submit" class="btn btn-sm btn-outline-danger">LogOut</button>
                                    </form>
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->


        </div>
        <!-- /.content-wrapper -->

        @include('admin.layout.partial.footer')



    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        const userID="{{ Auth::id() }}"
    </script>
    @vite('resources/js/app.js')


    @stack('scripts')
</body>

</html>
