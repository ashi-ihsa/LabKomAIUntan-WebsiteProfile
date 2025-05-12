<div class="content">
    @php $found = false; @endphp
    @foreach($artikelData as $artikel)
        @if($artikel['publish'])
            @php $found = true; @endphp
            <div class="card mb-3" style="width: 100%;">
                <div class="row g-0">
                    @if($artikel['thumbnail'])
                        <div class="col-md-4 thumbnail-wrapper">
                            <img src="{{ asset('storage/' . $artikel['thumbnail']) }}"
                                class="img-fluid rounded-start content-thumbnail"
                                alt="{{ $artikel['nama'] }}">
                        </div>
                    @endif
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('artikelShow', ['id' => $artikel['id']]) }}" class="text-decoration-none text-dark">
                                    {{ $artikel['nama'] }}
                                </a>
                            </h5>
                            <p class="card-text">
                                <small class="text-muted">{{ \Carbon\Carbon::parse($artikel['created_at'])->format('d-m-Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @if(!$found)
        <div class="alert alert-info">Belum ada artikel yang tersedia.</div>
    @endif
</div>
