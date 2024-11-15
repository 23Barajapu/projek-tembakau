<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Tembakau</title>
</head>

<body>

    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                            class="text-white">Subang</a></small>
                    <!--<small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                            class="text-white"></a></small>-->
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6">Pertanian Tembakau</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                        <a href="/tentangKami"
                            class="nav-item nav-link {{ request()->is('tentangKami') ? 'active' : '' }}">Tentang
                            Kami</a>
                        <a href="/testimoni"
                            class="nav-item nav-link {{ request()->is('testimoni') ? 'active' : '' }}">Testimoni</a>
                        <!--<a href="#" class="nav-item nav-link">Contact</a>-->
                        <a href="/login"
                            class="nav-item nav-link {{ request()->is('login') ? 'active' : '' }}">Login</a>
                        <a href="/register"
                            class="nav-item nav-link {{ request()->is('register') ? 'active' : '' }}">Registrasi</a>
                    </div>
                </div>

            </nav>
        </div>
    </div>
    <!-- Navbar End -->

</body>

</html>
