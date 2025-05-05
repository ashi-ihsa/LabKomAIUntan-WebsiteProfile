<div class="navigation">
    <ul>
        <li>
            <a href="#">
                <span class="icon">
                    <ion-icon name="logo-apple"></ion-icon>
                </span>
                <span class="title">Brand Name</span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.dosen.index')}}">
                <span class="icon">
                    <ion-icon name="chatbubble-outline"></ion-icon>
                </span>
                <span class="title">Dosen</span>
            </a>
        </li>
        
        <li>
            <a href="{{route('admin.publikasi.index')}}">
                <span class="icon">
                    <ion-icon name="help-outline"></ion-icon>
                </span>
                <span class="title">Publikasi</span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.artikel.index')}}">
                <span class="icon">
                    <ion-icon name="settings-outline"></ion-icon>
                </span>
                <span class="title">Artikel</span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.agenda.index')}}">
                <span class="icon">
                    <ion-icon name="settings-outline"></ion-icon>
                </span>
                <span class="title">Agenda</span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.kerjasama.index')}}">
                <span class="icon">
                    <ion-icon name="settings-outline"></ion-icon>
                </span>
                <span class="title">KerjaSama</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('admin.tentang.index') }}">
                <span class="icon">
                    <ion-icon name="information-circle-outline"></ion-icon>
                </span>
                <span class="title">Tentang</span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.author.index')}}">
                <span class="icon">
                    <ion-icon name="people-outline"></ion-icon>
                </span>
                <span class="title">Author</span>
            </a>
        </li>


        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span class="title">Sign Out</span>
            </a>

            <form id="logout-form" action="{{route('doLogout')}}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

    </ul>
</div>