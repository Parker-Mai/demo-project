<ul class="list-group">
    @foreach($childs as $child)

    <li class="list-group-item">

        <a href="../articles/create_page?frame_id={{$child['id']}}">
            <div class="form-check-inline">
                <span class="badge badge-center bg-label-primary">{{$child['id']}}</span>
                {{$child['frame_display_name']}}

                @if($child['frame_type'] != 4 && $child['is_index'] == 0)
                <button type="button" class="btn btn-xs btn-primary">帶入</button>
                @endif
            </div>
        </a>
        @if(count($child->childs))
            @include('backend.modules.articles.frame_tree_edit',['childs' => $child->childs])
        @endif

    </li>

    @endforeach
</ul>