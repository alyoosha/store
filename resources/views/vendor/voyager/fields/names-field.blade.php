@if($action == 'browse')
<span>{{$packages[$data->{$row->field}]->name}}</span>
@elseif($action == 'add')
    <select class="select2" name="{{$row->field}}" id="{{$row->field}}">
        @foreach($packages as $package)
            <option value="{{$package->id}}">{{$package->name}}</option>
        @endforeach
    </select>
@elseif($action == 'edit')
    <select class="select2" name="{{$row->field}}" id="{{$row->field}}">
    @foreach($packages as $package)
        @if($package->id == $dataTypeContent->package_id)
                <option selected value="{{$package->id}}">{{$package->name}}</option>
            @else
                <option value="{{$package->id}}">{{$package->name}}</option>
            @endif

        @endforeach
    </select>
@elseif($action == 'read')
    <p>{{$packages[$dataTypeContent->package_id]->name}}</p>
@endif
