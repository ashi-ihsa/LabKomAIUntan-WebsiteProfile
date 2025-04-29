<h1>Hallo Author</h1>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <span class="icon">
        <ion-icon name="log-out-outline"></ion-icon>
    </span>
    <span class="title">Sign Out</span>
</a>

<form id="logout-form" action="/doLogout" method="POST" style="display: none;">
    @csrf
</form>