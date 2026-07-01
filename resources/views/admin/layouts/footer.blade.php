</main>
<style>
    .footer-modern {
        margin-top: 100px;
        padding-bottom: 30px;
        padding-top: 2rem;
        background: #212529;
    }

    .footer-logo {
        width: 70px;
        margin-bottom: 20px;
    }

    .footer-title {
        font-size: 34px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 14px;
    }

    .footer-desc {
        max-width: 650px;
        margin: auto;
        color: #cbd5e1;
        line-height: 1.8;
    }

    .footer-contact {
        margin-top: 35px;
        color: #f8f9fa;
        font-weight: 600;
    }

    .footer-contact div {
        margin-bottom: 12px;
    }

    .footer-contact i {
        color: #20c997;
        margin-right: 8px;
    }

    .footer-bottom {
        margin-top: 45px;
        padding-top: 25px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: #adb5bd;
        font-size: 14px;
    }

    @media (max-width: 991px) {

        .footer-modern {
            padding-top: 30px;
        }

        .footer-title {
            font-size: 28px;
        }

        .footer-desc {
            font-size: 15px;
        }
    }
</style>

{{-- ORIGINAL FOOTER --}}
{{-- <footer class="py-4 bg-dark mt-auto">
    <div class="container-fluid px-4" @guest
style="height: 100px" @endguest>
        <div class="d-flex justify-content-center mt-4">
            <div class="text-light text-center xxl">
                Masjid Jami Roudhotul Jannah | Perumahan Taman Raya Citayam Blok E3 No.35 RT.7 RW.12
                <br /> Instagram: masjidjamiroudhotuljannah | Telepon: 083805281875
            </div>
        </div>
    </div>
</footer> --}}

<footer class="footer-modern">

    <div class="container text-center">

        @guest
            <img src="{{ asset('front/assets/img/logo-masjid.png') }}" class="footer-logo" alt="Logo">

            <h2 class="footer-title">
                Masjid Jami’ Roudhotul Jannah
            </h2>

            <p class="footer-desc">
                Website resmi masjid sebagai pusat informasi kegiatan,
                agenda dakwah, layanan jamaah, dokumentasi,
                dan media publikasi masjid.
            </p>

            <div class="footer-contact">

                <div>
                    <i class="fa-solid fa-location-dot"></i>
                    {{ $profil->alamat }}
                </div>

                <div>
                    <i class="fa-brands fa-instagram"></i>
                    {{ $profil->instagram }}
                </div>

                <div>
                    <i class="fa-solid fa-phone"></i>
                    {{ $profil->telepon }}
                </div>

            </div>

            <div class="footer-bottom">

                © {{ date('Y') }}
                Masjid Jami’ Roudhotul Jannah.
                All rights reserved.

            </div>
        @endguest
        @auth
            <img src="{{ asset('front/assets/img/logo-masjid.png') }}" class="footer-logo" alt="Logo">

            <h2 class="footer-title">
                Masjid Jami’ Roudhotul Jannah
            </h2>
            <div class="footer-bottom" style="border-top: none">

                © {{ date('Y') }}
                Masjid Jami’ Roudhotul Jannah.
                All rights reserved.

            </div>
        @endauth

    </div>

</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('admin') }}/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="{{ asset('admin') }}/js/datatables-simple-demo.js"></script>
</body>

</html>
