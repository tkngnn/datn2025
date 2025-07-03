@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center" aria-label="Page navigation">
        <ul>
            @if ($paginator->onFirstPage())
                <li><span><i class="bi bi-arrow-left"></i><span class="d-none d-sm-inline" aria-label="Previous page">  Previous</span></span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="bi bi-arrow-left"></i><span
                            class="d-none d-sm-inline" aria-label="Previous page">Trước</span></a></li>
            @endif

            @foreach ($paginator->links()->elements as $element)
                @if (is_string($element))
                    <li class="ellipsis">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="active" href="#">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}"><span class="d-none d-sm-inline" aria-label="Next page">Sau</span><i
                            class="bi bi-arrow-right"></i></a></li>
            @else
                <li><span><span class="d-none d-sm-inline" aria-label="Next page">Next</span><i class="bi bi-arrow-right"></i></span></li>
            @endif
        </ul>
    </nav>
@endif