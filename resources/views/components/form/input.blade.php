@props([

'type' => 'text', 'value' => '', 'name', 'label' => false

])

@if($label)
<lable>{{$label}}</lable>
@endif

<input type="{{$type}}" name="{{$name}}" value="{{old($name, $value)}}" {{$attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name)
])}}>
@error($name)
<div class="text-danger">{{$message}}</div>
@enderror



<!-- @class([ 'form-control' , 'is-invalid'=> $errors->has($name)
]) -->