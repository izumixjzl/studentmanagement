{{-- Expects: $paginator, $route, $search, $days, $perPage --}}
@if($paginator->total() > 0)

    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $pages = collect([1, $last])
            ->merge(range(max(1, $current - 2), min($last, $current + 2)))
            ->unique()
            ->sort()
            ->values();
    @endphp

    <div class="sl-pagination">

        @if($paginator->onFirstPage())
            <span class="sl-page disabled"><i class="bi bi-chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="sl-page"><i class="bi bi-chevron-left"></i></a>
        @endif

        @foreach($pages as $i => $page)

            @if($i > 0 && $page - $pages[$i - 1] > 1)
                <span class="sl-page disabled">&bull;&bull;&bull;</span>
            @endif

            @if($page == $current)
                <span class="sl-page active">{{ $page }}</span>
            @else
                <a href="{{ $paginator->url($page) }}" class="sl-page">{{ $page }}</a>
            @endif

        @endforeach

        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="sl-page"><i class="bi bi-chevron-right"></i></a>
        @else
            <span class="sl-page disabled"><i class="bi bi-chevron-right"></i></span>
        @endif

        <form method="GET" action="{{ route($route) }}" class="ms-2">

            <input type="hidden" name="search" value="{{ $search }}">
            <input type="hidden" name="days" value="{{ $days ?: '' }}">

            <select
                name="per_page"
                class="form-select sl-select"
                onchange="this.form.submit()"
            >
                @foreach([10, 25, 50] as $size)
                    <option value="{{ $size }}" @selected($perPage === $size)>{{ $size }} / page</option>
                @endforeach
            </select>

        </form>

    </div>

@endif

