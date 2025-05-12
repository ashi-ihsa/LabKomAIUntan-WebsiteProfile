<style>
.kerjasama-boxed {
  padding: 0px 0;
}

.kerjasama-boxed .item {
  display: flex;
  margin-bottom: 30px;
}

.kerjasama-boxed .box {
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  text-align: center;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.kerjasama-boxed .kerjasama-img {
  width: 250px;
  height: 250px;
  border-radius: 50%;
  object-fit: cover;
  object-position: center;
  margin: 0 auto;
}

.kerjasama-boxed .name {
  font-size: 18px;
  font-weight: bold;
  margin-top: 20px;
}
</style>
@extends('layouts.websiteProfile')
@section('content')
<main class="container show-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3 mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dosenIndex') }}">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Kerjasama</li>
        </ol>
    </nav>

    <h2 class="text-center my-4">Kerjasama</h2>
    <hr class="w-25 mx-auto">
    <section class="content">
        <div class="kerjasama-boxed">
            <div class="container">
                <div class="row">
                    @foreach($kerjasamaData as $kerjasama)
                        @if($kerjasama['publish'])
                            <div class="col-md-6 col-lg-4 item">
                                <div class="box h-100 d-flex flex-column align-items-center justify-content-between">
                                    @if($kerjasama['thumbnail'])
                                        <img class="kerjasama-img" src="{{ asset('storage/' . $kerjasama['thumbnail']) }}" alt="{{ $kerjasama['nama'] }}">
                                    @endif
                                    <h3 class="name text-center mt-3">
                                        <a href="{{ route('kerjasamaShow', ['id' => $kerjasama['id']]) }}" class="text-decoration-none text-dark">
                                            {{ $kerjasama['nama'] }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>


</main>
@endsection
