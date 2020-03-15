@if(isset($getDisctrict))
    <option value="0">Select District</option>
    @foreach($getDisctrict as $disctrict)
        <option value="{{$disctrict->id}}">{{$disctrict->name}}</option>
        
    @endforeach
@endif