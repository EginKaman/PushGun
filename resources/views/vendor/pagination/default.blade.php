@if ($paginator->hasPages())
    <div class="blog-dots">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pp" aria-hidden="true" aria-disabled="true"
                  aria-label="@lang('pagination.previous')">&lsaquo;</span>
        @else
            <a class="pp" href="{{ $paginator->previousPageUrl() }}" rel="prev"
               aria-label="@lang('pagination.previous')">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="pp">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pp">{{ $page }}</span>
                    @else
                        <a class="pp" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        @else
            <span class="pp" aria-hidden="true" aria-disabled="true"
                  aria-label="@lang('pagination.next')">&rsaquo;</span>
        @endif
    </div>
@endif
