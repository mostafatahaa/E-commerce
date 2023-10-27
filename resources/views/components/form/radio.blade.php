@props([
'name', 'options', 'checked' => false, 'label' => false
])

@if($label)
<lable>{{$label}}</lable>
@endif

@foreach($options as $value => $text)

<div class="form-check">
    <input type="radio" name="{{$name}}" value="{{$value}}" @checked(old($name, $checked)==$value ) {{$attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($name)
        ])}}>
    <label class="form-check-label">
        {{$text}}
    </label>
</div>

@endforeach