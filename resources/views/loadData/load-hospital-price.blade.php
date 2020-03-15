@if(isset($getHospitalPrice))
    <option value="0">Select Hospital Price</option>
    @foreach($getHospitalPrice as $hospitalPrice)
        <option value="{{$hospitalPrice->id}}" data-hospital-price="{{$hospitalPrice->hospital_price}}">{{$hospitalPrice->hospital_price}}</option>
    @endforeach
@endif