<x-form.alert />
<div class="form-group">
    <x-form.label>Product Name</x-form.label>
    <x-form.input type="text" name="name" :value="$product->name" />
</div>
<div class="form-group">
    <x-form.label>Category</x-form.label>
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category</option>

        @foreach(App\Models\Category::all() as $category)
        <option value="{{$category->id}}" @selected(old('parent_id', $product->category_id) == $category->id)>{{$category->name}}</option>
        @endforeach

    </select>

</div>

<div class="form-group">
    <x-form.label>Description</x-form.label>
    <x-form.textarea name="description" :value="$product->description" />
</div>

<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" height="100" alt="">
    @endif
    @error('image')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <x-form.label>price</x-form.label>
    <x-form.input type="number" name="price" step="0.1" :value="$product->price" />
</div>

<div class="form-group">
    <x-form.label>Compare Price</x-form.label>
    <x-form.input type="number" name="compare_price" step="0.1" :value="$product->compare_price" />
</div>

<div class="form-group">
    <x-form.label>Tags</x-form.label>
    <x-form.input type="text" name="tags" :value="$tags" />
</div>


<div class="form-group">
    <x-form.label>Status</x-form.label>
    <div>
        <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" />
    </div>
    @error('status')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">{{$btn_lable ?? 'Save'}}</button>
</div>

@push('style')
<link href="{{ asset('css/tagify.css')}}" rel=" stylesheet" type="text/css" />
@endpush

@push('script')
<script src="{{asset('js/tagify.js')}}"></script>
<script src="{{asset('js/tagify.polyfills.min.js')}}"></script>
<script>
    var inputElm = document.querySelector('[name=tags]'),
        tagify = new Tagify(inputElm);
</script>
@endpush