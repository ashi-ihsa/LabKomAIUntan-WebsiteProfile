<div class="content">
    @php $found = false; @endphp
    @foreach($publikasiData as $publikasi)
        @if($publikasi['publish'])
            @php $found = true; @endphp
            <div class="card mb-3" style="width: 100%;">
                <div class="row g-0">
                    @if($publikasi['thumbnail'])
                        <div class="col-md-4 thumbnail-wrapper">
                            <img src="{{ asset('storage/' . $publikasi['thumbnail']) }}"
                                class="img-fluid rounded-start content-thumbnail"
                                alt="{{ $publikasi['nama'] }}">
                        </div>
                    @endif
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('publikasiShow', ['id' => $publikasi['id']]) }}" class="text-decoration-none text-dark">
                                    {{ $publikasi['nama'] }}
                                </a>
                            </h5>
                            <p class="card-text">{{ $publikasi['deskripsi'] }}</p>
                            <p class="card-text">
                                <small class="text-muted">{{ $publikasi['dosen_nama'] }} - {{ $publikasi['tahun'] }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @if(!$found)
        <div class="alert alert-info">Belum ada publikasi yang tersedia.</div>
    @endif
</div>
