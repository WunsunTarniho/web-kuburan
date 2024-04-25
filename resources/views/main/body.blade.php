@include('main.head')

        <!-- Sidebar -->
        @include('component.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Navbar -->
                @include('component.navbar')
                <!-- End of Navbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    @yield('container')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('component.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

   @include('main.footer')