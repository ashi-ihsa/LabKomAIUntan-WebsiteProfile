<div class="container-fluid bg-primary text-white mt-5 pt-4 px-4 footer">
    <div class="row gx-4 gy-4 justify-content-between">
        <!-- Deskripsi Singkat -->
        <div class="col-lg-4 col-md-6">
            <div class="d-flex align-items-start">
                <img src="{{ asset('LogoUntan.webp') }}" alt="Logo" style="height: 35px; margin-right: 10px;">
                <div>
                    <h6 class="mb-1 fw-semibold" style="line-height: 1.2;">
                        Lab Komputasi & Kecerdasan Buatan
                    </h6>
                    <p class="small mb-0" style="text-align: justify;">
                        Fokus pada penelitian Artificial Intelligence, Machine Learning, Natural Language Processing, dan Sistem Cerdas untuk kemajuan teknologi Indonesia.
                    </p>
                </div>
            </div>
        </div>


        <!-- Kontak -->
        <div class="col-lg-4 col-md-6">
            <h6 class="text-white mb-2">Kontak</h6>
            <p class="small mb-1"><i class="fa fa-map-marker-alt me-2"></i>Gg Trikora, Kec. Batu Layang, Pontianak Utara</p>
            <p class="small mb-0"><i class="fa fa-envelope me-2"></i>lab.ai@untan.ac.id</p>
        </div>

        <!-- Link Terkait -->
        <div class="col-lg-3 col-md-6">
            <h6 class="text-white mb-2">Link Terkait</h6>
            <ul class="list-unstyled small mb-0">
                <li><a class="text-white text-decoration-underline" href="{{ route('dosenIndex') }}">Beranda</a></li>
                <li><a class="text-white text-decoration-underline" href="{{ route('publikasiIndex') }}">Publikasi</a></li>
                <li><a class="text-white text-decoration-underline" href="{{ route('artikelIndex') }}">Artikel</a></li>
                <li><a class="text-white text-decoration-underline" href="{{ route('agendaIndex') }}">Agenda</a></li>
                <li><a class="text-white text-decoration-underline" href="{{ route('kerjasamaIndex') }}">Kerjasama</a></li>
                <li><a class="text-white text-decoration-underline" href="{{ route('tentangIndex') }}">Tentang</a></li>
            </ul>
        </div>
    </div>

    <div class="text-center border-top border-light pt-3 mt-4 small">
        &copy; {{ date('Y') }} <strong>Laboratorium Komputasi & Kecerdasan Buatan</strong>. All rights reserved.
    </div>
</div>
