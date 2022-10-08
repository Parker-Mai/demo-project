<ul class="list-group">
    @foreach($childs as $child)

    <li class="list-group-item">

        <a href="../backend/articles?frame_id={{$child['id']}}">
            <div class="form-check-inline">
                <span class="badge badge-center bg-label-primary">{{$child['id']}}</span>
                {{$child['frame_display_name']}}
            </div>

            @if(count($child->childs))
                @include('backend.modules.articles.frame_tree',['childs' => $child->childs])
            @endif
        </a>
    </li>

    @endforeach
</ul>