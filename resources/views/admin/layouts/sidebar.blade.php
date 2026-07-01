<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    @auth

                        <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                    @endauth
                    @guest

                        <a class="nav-link" href="/">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Beranda
                        </a>
                    @endguest

                    {{-- UBUDIYAH --}}
                    @if (Auth::check() && Auth::user()->role === 'ubudiyah')
                        <a class="nav-link {{ Request::is('admin/khotibMuazin') ? 'active' : '' }}"
                            href="{{ route('khotibMuazin.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>Khotib dan
                            Muazin
                        </a>
                        <a class="nav-link {{ Request::is('admin/agenda') ? 'active' : '' }}"
                            href="{{ route('agenda.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>Agenda
                        </a>
                        <div class="sb-sidenav-menu-heading">Galeri</div>
                        <a class="nav-link {{ Request::is('admin/kategori-galeri') ? 'active' : '' }}"
                            href="{{ route('kategori-galeri.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-list-ul"></i></div>Kategori
                        </a>
                        <a class="nav-link {{ Request::is('admin/folder-galeri') ? 'active' : '' }}"
                            href="{{ route('folder-galeri.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>Folder
                        </a>
                        <a class="nav-link {{ Request::is('admin/galeri') ? 'active' : '' }}"
                            href="{{ route('galeri.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-image"></i></div>Foto
                        </a>

                    @endauth




                    {{-- TAMPILAN --}}

                    {{-- AMIL --}}


                    {{-- BENDAHARA --}}
                    @if (Auth::check() && Auth::user()->role === 'bendahara')
                        <a class="nav-link {{ Request::is('admin/saldo-awal') ? 'active' : '' }}"
                            href="{{ route('saldo-awal.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                            Saldo Awal
                        </a>
                        <a class="nav-link {{ Request::is('admin/keterangan_kas') ? 'active' : '' }}"
                            href="{{ route('keterangan_kas.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-align-left"></i></div>
                            Keterangan Kas
                        </a>
                        <a class="nav-link {{ Request::is('admin/kas_operasional') ? 'active' : '' }}"
                            href="{{ route('kas_operasional.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice"></i></i>
                            </div>
                            Laporan Kas
                        </a>

                    @endif



                    {{-- KETUA --}}
                    @if (Auth::check() && Auth::user()->role === 'ketua')

                        <a class="nav-link {{ Request::is('admin/ketua-profil') ? 'active' : '' }}"
                            href="{{ route('ketua-profil.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-mosque"></i></div>
                            Profil Masjid
                        </a>


                        {{-- bendahara menu --}}
                        <div class="sb-sidenav-menu-heading">Bendahara</div>
                        <a class="nav-link {{ Request::is('admin/saldo-awal') ? 'active' : '' }}"
                            href="{{ route('saldo-awal.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                            Saldo Awal
                        </a>
                        <a class="nav-link {{ Request::is('admin/keterangan_kas') ? 'active' : '' }}"
                            href="{{ route('keterangan_kas.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-align-left"></i></div>
                            Keterangan Kas
                        </a>
                        <a class="nav-link {{ Request::is('admin/kas_operasional') ? 'active' : '' }}"
                            href="{{ route('kas_operasional.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice"></i>
                            </div>
                            Laporan Kas
                        </a>
                        {{-- ubudiyah menu --}}
                        <div class="sb-sidenav-menu-heading">Ubudiyah</div>
                        <a class="nav-link {{ Request::is('admin/khotibMuazin') ? 'active' : '' }}"
                            href="{{ route('khotibMuazin.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>Khotib dan
                            Muazin
                        </a>
                        <a class="nav-link {{ Request::is('admin/agenda') ? 'active' : '' }}"
                            href="{{ route('agenda.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>Agenda
                        </a>
                        <a class="nav-link {{ Request::is('admin/kategori-galeri') ? 'active' : '' }}"
                            href="{{ route('kategori-galeri.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-list-ul"></i></div>Kategori
                        </a>
                        <a class="nav-link {{ Request::is('admin/folder-galeri') ? 'active' : '' }}"
                            href="{{ route('folder-galeri.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>Folder
                        </a>
                        <a class="nav-link {{ Request::is('admin/galeri') ? 'active' : '' }}"
                            href="{{ route('galeri.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-image"></i></div>Foto
                        </a>
                    @endif

                    {{-- guest --}}
                    @guest
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Jadwal Imam
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                @guest
                                    <a class="nav-link" href="{{ route('imamJumat-front-web.index') }}">Jadwal
                                        Imam
                                        Jumat</a>
                                    <a class="nav-link" href="{{ route('imamFardhu-front-web.index') }}">Jadwal
                                        Imam
                                        Fardhu</a>
                                @endguest
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Buletin
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link" href="{{ route('agenda-front-web.index') }}">Program</a>

                            </nav>
                        </div>
                    @endguest

            </div>
        </div>
        <div class="sb-sidenav-footer">
            @auth
                <div class="small">Logged in as:</div>
                {{ Auth::user()->name }}
            @endauth
            @guest
                Guest
            @endguest
        </div>
    </nav>
</div>
<div id="layoutSidenav_content">
    <main>
