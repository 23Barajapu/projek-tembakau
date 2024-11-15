<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/admin" class="logo d-flex align-items-center">
                <img src="Template/assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">
                    <h5><b>Sistem Pertanian Tembakau</b></h5>
                </span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <!-- ======= Sidebar ======= -->
            <aside id="sidebar" class="sidebar">

                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin') ? ' ' : 'collapsed' }}" href="/admin">
                            <i class="bi bi-house"></i>
                            <span>Dashboard</span>
                        </a>
                    </li><!-- End Dashboard Nav -->

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('barang_panen') ? '' : 'collapsed' }}" href="/barang_panen">
                            <i class="bi bi-box"></i>
                            <span>Daftar Barang</span>
                        </a>
                    </li><!-- End Daftar Barang Nav -->

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kategori') ? ' ' : 'collapsed' }}" href="/kategori">
                            <i class="bi bi-tags"></i>
                            <span>Kategori</span>
                        </a>
                    </li><!-- End Kategori Nav -->

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/status') ? ' ' : 'collapsed' }}"
                            href="/admin/status">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>Status</span>
                        </a>
                    </li><!-- End Status Nav -->

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/laporan') ? ' ' : 'collapsed' }}"
                            href="/admin/laporan">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Laporan</span>
                        </a>
                    </li><!-- End Laporan Nav -->

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/history') ? ' ' : 'collapsed' }}"
                            href="/admin/history">
                            <i class="bi bi-clock-history"></i>
                            <span>History</span>
                        </a>
                    </li><!-- End History Nav -->

                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span>Profile</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>My Profile</h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center {{ request()->is('users-profile.html') ? ' ' : 'collapsed' }}"
                                    href="/admin/profile">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/logout">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                    <!--<div>

                        <div>

                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="bi bi-menu-button-wide"></i><span>Components</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="components-alerts.html">
                                            <i class="bi bi-circle"></i><span>Alerts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-accordion.html">
                                            <i class="bi bi-circle"></i><span>Accordion</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-badges.html">
                                            <i class="bi bi-circle"></i><span>Badges</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-breadcrumbs.html">
                                            <i class="bi bi-circle"></i><span>Breadcrumbs</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-buttons.html">
                                            <i class="bi bi-circle"></i><span>Buttons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-cards.html">
                                            <i class="bi bi-circle"></i><span>Cards</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-carousel.html">
                                            <i class="bi bi-circle"></i><span>Carousel</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-list-group.html">
                                            <i class="bi bi-circle"></i><span>List group</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-modal.html">
                                            <i class="bi bi-circle"></i><span>Modal</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-tabs.html">
                                            <i class="bi bi-circle"></i><span>Tabs</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-pagination.html">
                                            <i class="bi bi-circle"></i><span>Pagination</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-progress.html">
                                            <i class="bi bi-circle"></i><span>Progress</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-spinners.html">
                                            <i class="bi bi-circle"></i><span>Spinners</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-tooltips.html">
                                            <i class="bi bi-circle"></i><span>Tooltips</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> End Components Nav -->

                    <!--<li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="bi bi-journal-text"></i><span>Forms</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="forms-elements.html">
                                            <i class="bi bi-circle"></i><span>Form Elements</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="forms-layouts.html">
                                            <i class="bi bi-circle"></i><span>Form Layouts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="forms-editors.html">
                                            <i class="bi bi-circle"></i><span>Form Editors</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="forms-validation.html">
                                            <i class="bi bi-circle"></i><span>Form Validation</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> End Forms Nav -->

                    <!--<li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="tables-general.html">
                                            <i class="bi bi-circle"></i><span>General Tables</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tables-data.html">
                                            <i class="bi bi-circle"></i><span>Data Tables</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> End Tables Nav -->

                    <!--<li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="bi bi-bar-chart"></i><span>Charts</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="charts-chartjs.html">
                                            <i class="bi bi-circle"></i><span>Chart.js</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="charts-apexcharts.html">
                                            <i class="bi bi-circle"></i><span>ApexCharts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="charts-echarts.html">
                                            <i class="bi bi-circle"></i><span>ECharts</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> End Charts Nav -->

                    <!--<li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="icons-bootstrap.html">
                                            <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="icons-remix.html">
                                            <i class="bi bi-circle"></i><span>Remix Icons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="icons-boxicons.html">
                                            <i class="bi bi-circle"></i><span>Boxicons</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> End Icons Nav -->

                    <!--<li class="nav-heading">Pages</li>
        
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="users-profile.html">
                                    <i class="bi bi-person"></i>
                                    <span>Profile</span>
                                </a>
                            </li> End Profile Page Nav -->

                    <!-- <li class="nav-item">
                                <a class="nav-link collapsed" href="pages-faq.html">
                                    <i class="bi bi-question-circle"></i>
                                    <span>F.A.Q</span>
                                </a>
                            </li> End F.A.Q Page Nav -->

                    <!--<li class="nav-item">
                                <a class="nav-link collapsed" href="pages-contact.html">
                                    <i class="bi bi-envelope"></i>
                                    <span>Contact</span>
                                </a>
                            </li> End Contact Page Nav -->
                    <!--
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="pages-register.html">
                                    <i class="bi bi-card-list"></i>
                                    <span>Register</span>
                                </a>
                            </li> End Register Page Nav -->
                    <!--
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="pages-login.html">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>Login</span>
                                </a>
                            </li> End Login Page Nav -->
                    <!--
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="pages-error-404.html">
                                    <i class="bi bi-dash-circle"></i>
                                    <span>Error 404</span>
                                </a>
                            </li> End Error 404 Page Nav -->
                    <!--
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="pages-blank.html">
                                    <i class="bi bi-file-earmark"></i>
                                    <span>Blank</span>
                                </a>
                            </li> End Blank Page Nav -->
                    </div>
                    </div>


                </ul>

            </aside><!-- End Sidebar-->
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

</body>

</html>