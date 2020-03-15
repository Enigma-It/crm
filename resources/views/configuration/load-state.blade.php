<option value="0">----Select State----</option>
@foreach($state as $value)
<option value="{{$value->id}}">{{$value->name}}</option>
@endforeach