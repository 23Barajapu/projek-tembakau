<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            <img src="{{ asset('image') }}/icon.png" alt="">
            <span class="ms-1 font-weight-bold text-white">Menu Utama</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2" />
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('/') ? 'active bg-gradient-primary' : '' }} "
                    href="/">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">home</i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('lahan1') ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('lahan.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-seedling navbar-brand-img h-100 text-white"></i>
                        <!-- Font Awesome monitor icon -->
                    </div>

                    <span class="nav-link-text ms-1">Data Lahan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('monitoring') ? 'active bg-gradient-primary' : '' }}"
                    href="/monitoring">
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
                        rel="stylesheet" />

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tv opacity-10"></i>
                        <!-- Font Awesome monitor icon -->
                    </div>

                    <span class="nav-link-text ms-1">Monitoring Lahan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('panen') ? 'active bg-gradient-primary' : '' }}"
                    href="/panen">
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
                        rel="stylesheet" />

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-scale-unbalanced navbar-brand-img h-100 text-white"></i>
                        <!-- Font Awesome monitor icon -->
                    </div>

                    <span class="nav-link-text ms-1">Data Hasil Panen</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('anggotaTani') ? 'active bg-gradient-primary' : '' }}"
                    href="/anggotaTani">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user navbar-brand-img h-100 text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Anggota Tani</span>
                </a>
            </li>
            <li class="nav-item"></li>
            <a class="nav-link text-white {{ request()->is('kelompokTani') ? 'active bg-gradient-primary' : '' }}"
                href="/kelompokTani">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-users navbar-brand-img h-100 text-white"></i>
                </div>
                <span class="nav-link-text ms-1">Data Kelompok Tani</span>
            </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('jadwal') ? 'active bg-gradient-primary' : '' }}"
                    href="/jadwal">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                        <i class="fas fa-calendar h-100 text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Lahan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('history-jadwal') ? 'active bg-gradient-primary' : '' }}"
                    href="/history-jadwal">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                        <i class="fas fa-history h-100 text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">History Jadwal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('tahapan') ? 'active bg-gradient-primary' : '' }}"
                    href="/tahapan">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                        <i class="fas fa-sync h-100 text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tahapan</span>
                </a>
            </li>

            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                    Account pages
                </h6>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-white"
                        style="background: none; border: none; cursor: pointer;">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">logout</i>
                        </div>
                        <span class="nav-link-text ms-1">Sign Out</span>
                    </button>
                </form>
            </li>

        </ul>
    </div>
</aside>


{{-- 

@php
    $user = Auth::user();
    $id = $user ? $user->id : null;
    $cacheKey = 'form_submitted_' . $id . '_' . date('Y-m-d');
@endphp

@if ($user && !Cache::has($cacheKey))
    <form action="{{ route('kirim_pesan.pesan', ['id' => $id]) }}" method="POST" id="autoSubmitForm">
        @csrf
        <input type="hidden" value="{{ $id }}" name="id_user" id="id_user">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("autoSubmitForm").submit();
        });
    </script>

    @php
        Cache::put($cacheKey, true, now()->endOfDay());
    @endphp
@endif --}}
