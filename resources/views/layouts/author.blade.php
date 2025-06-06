<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>

    <!-- ======= Styles ====== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- jQuery tetap dibutuhkan -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Summernote versi lite (tanpa bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <style>
    body
    {
        min-height: 100vh;
    }
    .back-to-top {
        position: fixed;
        bottom: 40px;
        right: 40px;
        display: none; /* awalnya sembunyi */
        z-index: 999;
        padding: 12px 12px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 24px;
    }
    </style>
</head>

<body>
    <main>
    @include('partials.sidebarAuthor')
        <div class="main">
           @if(isset($error))
                <div class="alert alert-danger text-center" role="alert">
                    {{ $error }}
                </div>
            @endif

            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>
            @yield('content')
        </div>
    </main>
    <a href="#" class="btn btn-secondary back-to-top" id="backToTop" aria-label="Back to Top">
    <ion-icon name="arrow-up-outline"></ion-icon>
    </a>
    <!-- ======= Scripts (paling bawah) ====== -->
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
    window.onscroll = function () {
        const btn = document.getElementById("backToTop");
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        btn.style.display = "block";
        } else {
        btn.style.display = "none";
        }
    };
    document.getElementById("backToTop").addEventListener("click", function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    </script>
</body>
</html>
