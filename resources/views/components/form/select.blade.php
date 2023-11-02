@props(['name', 'options', 'selected' => '', 'label' => false])

@if($label)
<lable>{{$label}}</lable>
@endif

<select name="{{$name}}" {{$attributes->class([
    'form-control',
    'form-select',
    'is-invalid' => $errors->has($name)
    ])}}>
    @foreach($options as $value => $text)
    <option value="{{$value}}" @selected($value==$selected )>{{$text}}</option>
    @endforeach
</select>