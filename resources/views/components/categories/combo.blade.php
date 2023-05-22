<div>
    <select class="form-control select2" name="{{$name}}">
        @if(!empty($list))
            @foreach($list as $item)
                <option value="{{$item->id}}">{{str_repeat(' -- ' , $item->level).$item->name}}</option>
            @endforeach
        @endif
    </select>
</div>
