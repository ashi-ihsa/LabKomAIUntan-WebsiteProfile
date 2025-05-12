<div class="sidebar">
    @php $hasHighlight = false; @endphp
    <div class="card mb-3">
        <h5 class="card-header">Highlight Artikel</h5>
        @foreach($highlightData as $artikel)
            @if($artikel['publish'] && $artikel['highlight'])
                @php $hasHighlight = true; @endphp
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('artikelShow', ['id' => $artikel['id']]) }}" class="text-decoration-none text-dark">
                            {{ $artikel['nama'] }}
                        </a>
                    </h5>
                    <p class="card-text">
                        {{ \Carbon\Carbon::parse($artikel['created_at'])->format('d-m-Y') }}
                    </p>
                </div>
                <hr>
            @endif
        @endforeach
        @if(!$hasHighlight)
            <div class="card-body">
                <p class="text-muted">Belum ada artikel yang di-highlight.</p>
            </div>
        @endif
    </div>
</div>
