<div class="sidebar">
    @php $hasHighlight = false; @endphp
    <div class="card mb-3">
        <h5 class="card-header">Highlight Publikasi</h5>
        @foreach($highlightData as $publikasi)
            @if($publikasi['publish'] && $publikasi['highlight'])
                @php $hasHighlight = true; @endphp
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('publikasiShow', ['id' => $publikasi['id']]) }}" class="text-decoration-none text-dark">
                            {{ $publikasi['nama'] }}
                        </a>
                    </h5>
                    <p class="card-text">
                        {{ $publikasi['dosen_nama'] }} - {{ $publikasi['tahun'] }}
                    </p>
                </div>
                <hr>
            @endif
        @endforeach
        @if(!$hasHighlight)
            <div class="card-body">
                <p class="text-muted">Belum ada publikasi yang di-highlight.</p>
            </div>
        @endif
    </div>
</div>
