@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination__item pagination__item--disabled"></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-outline-primary pagination__item">&laquo; Anterior</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline-primary pagination__item ml-2">Próximo &raquo;</a>
        @else
            <span class="pagination__item pagination__item--disabled"></span>
        @endif
    </nav>
@endif