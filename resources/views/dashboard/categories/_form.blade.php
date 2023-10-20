@if($errors->any())
<div class="alert alert-danger">
    <h3>Error Occurred!</h3>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-group">
    <lable>Category Name</lable>
    <input type="text" name="name" @class([ 'form-control' , 'is-invalid'=> $errors->has('name')
    ])
    value="{{old('name', $category->name)}}">


    @error('name')
    <div class="text-danger">{{$message}}</div>
    @enderror

</div>
<div class="form-group">
    <lable>Category Parent</lable>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>

        @foreach($parents as $parent)
        <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id)==$parent->id)>{{$parent->name}}</option>
        @endforeach

    </select>
    @error('parent_id')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <lable>Description</lable>
    <textarea name="description" class="form-control"> {{ old('description', $category->description) }}</textarea>
    @error('description')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <lable>Image</lable>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if($category->image)
    <img src="{{ asset('storage/' . $category->image) }}" height="100" alt="">
    @endif
    @error('image')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <lable for="">Status</lable>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked(old('status', $category->status)=='active' )>
            <label class="form-check-label">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" @checked(old('status', $category->status)=='archived' )>
            <label class="form-check-label">
                Archived
            </label>
        </div>
    </div>
    @error('status')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">{{$btn_lable ?? 'Save'}}</button>
</div>