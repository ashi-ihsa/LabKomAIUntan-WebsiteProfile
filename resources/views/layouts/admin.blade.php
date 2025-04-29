<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>

    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('css/sidebarAdmin.css') }}">

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>

    <div class="container">
        @include('partials.sidebarAdmin')
        <div class="main">

            @if(isset($error))
                <div style="color: red; margin-bottom: 10px;">
                    {{ $error }}
                </div>
            @endif

            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>
            
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="cardName">{{$title}}</div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>

    <!-- ======= Scripts (paling bawah) ====== -->
    <script src="{{ asset('js/sidebarAdmin.js') }}"></script>

</body>
</html>
