@if(isset($getThana))
    <option value="0">Select Thana</option>
@foreach($getThana as $thana)
    <option value="{{$thana->id}}">{{$thana->name}}</option>
@endforeach
@endif