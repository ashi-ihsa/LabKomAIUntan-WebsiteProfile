<nav>
  <div class="nav-left">
    <img class="Untan" src="{{ asset('LogoUntan.webp') }}" alt="Logo Untan" />
    <a href="{{ route('dosenIndex') }}" class="logo-link">
        <span class="logo-text">Laboratorium Komputasi & Kecerdasan Buatan</span>
    </a>
  </div>

  <input type="checkbox" id="check" />
  <label for="check" class="checkbtn">
    <i class="fas fa-bars"></i>
  </label>
  
  <ul>
    <li><a href="{{ route('publikasiIndex') }}" class="{{ request()->routeIs('publikasiIndex') ? 'active' : '' }}">Publikasi</a></li>
    <li><a href="{{ route('artikelIndex') }}" class="{{ request()->routeIs('artikelIndex') ? 'active' : '' }}">Artikel</a></li>
    <li><a href="{{ route('agendaIndex') }}" class="{{ request()->routeIs('agendaIndex') ? 'active' : '' }}">Agenda</a></li>
    <li><a href="{{ route('kerjasamaIndex') }}" class="{{ request()->routeIs('kerjasamaIndex') ? 'active' : '' }}">Kerjasama</a></li>
    <li><a href="{{ route('tentangIndex') }}" class="{{ request()->routeIs('tentangIndex') ? 'active' : '' }}">Tentang</a></li>
  </ul>
</nav>
