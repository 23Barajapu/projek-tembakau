<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" sizes="76x76" href="{{ asset('image') }}/icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMD9Tl4CxMLeTVbVAvEzTlJl5hzi7fKfT5N8kyD" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="{{ asset('image') }}/icon.png" />
    <title>@yield('title')</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('Template') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('Template') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('Template') }}/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <meta name="cs rf-token" content="{{ csrf_token() }}">

</head>

<body class="g-sidenav-show bg-gray-200">
    @vite(['resources/js/app.js']);
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-QF4MYhCsQppavJ2pU8rmv/Ai0O6U8KvBi5i5RXm3oR9P5eU8IkmXK0zG0q4ABMim" crossorigin="anonymous">
    </script>
    <x-navbar></x-navbar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                            @yield('pages')
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">
                        @yield('title-pages')
                    </h6>
                </nav>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <style>
            /* Menambahkan jarak di bawah elemen utama (main) */
            .main-content {
                margin-bottom: 100px;
                /* Sesuaikan dengan jarak yang diinginkan */
            }

            /* Menambahkan jarak khusus untuk navbar bottom */
            .navbar-bottom-wrapper {
                padding-top: 20px;
                /* Atur jarak di atas navbar bottom */
            }
        </style>

        <div class="container">
            @yield('content')
        </div>


        <div class="navbar-bottom-wrapper">
            <x-navbarBottom></x-navbarBottom>
        </div>


        <!-- Bootstrap JS (with Popper.js) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

        <style>
            .blink {
                animation: blink-animation 1s steps(5, start) infinite;
                -webkit-animation: blink-animation 1s steps(5, start) infinite;
            }

            @keyframes blink-animation {
                to {
                    visibility: hidden;
                }
            }

            @-webkit-keyframes blink-animation {
                to {
                    visibility: hidden;
                }
            }
        </style>
    </main>
    <div class="fixed-plugin">
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('Template') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('Template') }}/assets/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('Template') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('Template') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf("Win") > -1;
        if (win && document.querySelector("#sidenav-scrollbar")) {
            var options = {
                damping: "0.5",
            };
            Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('Template') }}/assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
