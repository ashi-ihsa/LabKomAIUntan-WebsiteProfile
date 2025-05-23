<div class="navigation">
    <ul>
        <li>
            <a href="#">
                <span class="icon">
                <ion-icon name="people-circle-outline"></ion-icon>
                </span>
                <span class="title">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.artikel.index')}}">
                <span class="icon">
                    <ion-icon name="book-outline"></ion-icon>
                </span>
                <span class="title">Artikel</span>
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