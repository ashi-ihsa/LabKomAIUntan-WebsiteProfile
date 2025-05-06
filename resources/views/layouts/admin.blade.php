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

    <!-- jQuery tetap dibutuhkan -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Summernote versi lite (tanpa bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

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
            
            <div class="cardBox formCard">
                <div class="card">
                    <div>
                        <div class="cardHeader">
                            <h2>{{$title}}</h2>
                        </div>
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
