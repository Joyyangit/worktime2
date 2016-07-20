@foreach ($data as $k => $v)
<option value="{{$k}}" {{$k == $slt ? 'selected' : ''}}>{{$v}}</option>
@endforeach
