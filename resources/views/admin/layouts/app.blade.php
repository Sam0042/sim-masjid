<style>
    /* mini hp */
    .judul-header {
        color: white;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    #target-bcm {
        color: #20c997;
    }

    #jml-foto {
        position: absolute;
        right: 12px;
        transform: translateY(-100%);
        background: rgba(0, 0, 0, 0.441);
        color: #20c997;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 1.3rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    #exampleModal,
    #editModal,
    .apus {
        margin-top: 3.5rem;
    }

    /* tablet */
    @media (min-width: 768px) {
        .judul-header {
            font-size: 2.4rem;
        }

        /* HAPUS height: 300px dari #konten agar tingginya otomatis memanjang */
        #konten {
            height: auto;
        }
    }

    /* laptop */
    @media (min-width: 1024px) {
        /* isi */
    }
</style>

@include('admin.layouts.header')
@auth
    @include('admin.layouts.sidebar')
@endauth

<div style="min-height: 60vh;">
    @yield('konten')
</div>

@include('admin.layouts.footer')
