<div class="text-center">
    <ul class="pagination post-pagination">

        @if ($paginator->onFirstPage())
            <li><a href="#">上一頁</a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}">上一頁</a></li>
        @endif

        @foreach ($elements as $element)

            @if (is_array($element))

                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())

                        <li class="active"><a href="#">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>

                    @endif

                @endforeach

            @endif
            
        @endforeach
        
        @if ($paginator->hasMorePages())

            <li><a href="{{ $paginator->nextPageUrl() }}">下一頁</a></li>
        @else

            <li><a href="#">下一頁</a></li>

        @endif

        

    </ul>
</div>