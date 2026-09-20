@if ($paginator->hasPages())
    <nav class="al-pagination-wrap" aria-label="Page navigation">
        <ul class="al-pagination mb-0">
            {{-- Previous --}}
            @if (!$paginator->onFirstPage())
                <li class="al-page-item">
                    <a class="al-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="al-page-item al-disabled"><span class="al-page-link al-dots">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="al-page-item active" aria-current="page">
                                <span class="al-page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="al-page-item">
                                <a class="al-page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="al-page-item">
                    <a class="al-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
