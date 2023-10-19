<div class="form-group">
    <lable>Category Name</lable>
    <input type="text" name="name" class="form-control" value="{{$category->name}}">
</div>
<div class="form-group">
    <lable>Category Parent</lable>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>

        @foreach($parents as $parent)
        <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>{{$parent->name}}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <lable>Descreption</lable>
    <textarea name="description" class="form-control"> {{ $category->description }}</textarea>
</div>

<div class="form-group">
    <lable>Image</lable>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if($category->image)
    <img src="{{ asset('storage/' . $category->image) }}" height="100" alt="">
    @endif
</div>

<div class="form-group">
    <lable for="">Status</lable>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked($category->status == 'active')>
            <label class="form-check-label">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" @checked($category->status == 'archived')>
            <label class="form-check-label">
                Archived
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">{{$btn_lable ?? 'Save'}}</button>
</div>