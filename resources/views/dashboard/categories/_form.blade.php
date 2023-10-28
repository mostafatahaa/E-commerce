<x-form.alert />
<div class="form-group">
    <x-form.label>Category Name</x-form.label>
    <x-form.input type="text" name="name" :value="$category->name" />

</div>
<div class="form-group">
    <x-form.label>Category Parent</x-form.label>

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

    <x-form.label>Description</x-form.label>
    <x-form.textarea name="description" :value="$category->description" />

</div>

<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if($category->image)
    <img src="{{ asset('storage/' . $category->image) }}" height="100" alt="">
    @endif
    @error('image')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <x-form.label>Status</x-form.label>

    <div>
        <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
    @error('status')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">{{$btn_lable ?? 'Save'}}</button>
</div>