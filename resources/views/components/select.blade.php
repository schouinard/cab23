<select name="{{$name}}" class="form-control">
    <option value="">Tous</option>
    @foreach($items as $item)
        <option @if(isset($filters[$name]))
                @if($filters[$name] == $item->id) selected
                @endif
                @endif
                value="{{$item->id}}">{{$item->nom}}</option>
    @endforeach
</select>