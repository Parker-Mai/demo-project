<ul class="list-group">
    @foreach($childs as $child)

    <li class="list-group-item">

        <div class="form-check-inline">
            <span class="badge badge-center bg-label-primary">{{$child['id']}}</span>
            {{$child['frame_display_name']}}
        </div>
        

        <div class="form-check-inline">
            <a href="/backend/sitemap_frames/update_page/{{$child['id']}}" class="btn btn-sm btn-primary">編輯</a>
        </div>
        
        <div class="form-check form-check-inline form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="is_index_{{$data['id']}}">
            <label class="form-check-label" for="is_index_{{$data['id']}}">首頁</label>
        </div>

        <div class="form-check form-check-inline form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="is_disabled_{{$data['id']}}">
            <label class="form-check-label" for="is_disabled_{{$data['id']}}">隱藏</label>
        </div>

        @if(count($child->childs))
            @include('backend.modules.sitemap_frames.frame_tree',['childs' => $child->childs])
        @endif

    </li>

    @endforeach
</ul>