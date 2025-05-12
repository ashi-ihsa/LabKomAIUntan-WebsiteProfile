<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <!-- Logo dan Teks -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('dosenIndex') }}">
      <img src="{{ asset('LogoUntan.webp') }}" alt="Logo Untan" style="height: 40px;" class="me-2">
      <div class="d-none d-md-block">
        Laboratorium Komputasi & Kecerdasan Buatan
      </div>
      <div class="d-block d-md-none" style="font-size: 0.8rem; line-height: 1.2;">
        Laboratorium Komputasi<br>& Kecerdasan Buatan
      </div>
    </a>

    <!-- Toggle Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Navigasi -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('publikasiIndex') ? 'active' : '' }}" href="{{ route('publikasiIndex') }}">Publikasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('artikelIndex') ? 'active' : '' }}" href="{{ route('artikelIndex') }}">Artikel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('agendaIndex') ? 'active' : '' }}" href="{{ route('agendaIndex') }}">Agenda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('kerjasamaIndex') ? 'active' : '' }}" href="{{ route('kerjasamaIndex') }}">Kerjasama</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('tentangIndex') ? 'active' : '' }}" href="{{ route('tentangIndex') }}">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light ms-lg-3 mt-2 mt-lg-0" href="{{ route('login') }}">Course Online!</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar -->