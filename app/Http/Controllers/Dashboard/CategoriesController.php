<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        $query = Category::query();

        if ($name = $request->query('name')) {
            $query->where('name', 'LIKE', "%{$name}%");
        }

        if ($status = $request->query('status')) {
            $query->where('status', '=', $status);
        }

        $categories = $query->paginate(1);

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parents = Category::all();

        // this for form in create.blade.view and this object will return empty vlaues
        $category = new Category();

        return view('dashboard.categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data after validate
        $clean_data = $request->validate(Category::rules(), [
            'name.required' => 'Sorry This Filead (:attribute) Is Required',
            'name.unique' => 'This Name Is Already Exists'
        ]);

        // Requset merge
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');

        $data['image'] = $this->uploadedImage($request);

        $category = Category::create($data);

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Created Successfly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')
                ->with('info', 'Category Not Found');
        }

        // SELECT * FROM categories WHERE id != $id
        // AND (parent_id IS NULL is OR parent_id = $id)

        $parents = Category::where('id', '<>', $id)

            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id');
                $query->orWhere('parent_id', '<>', $id);
            })->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {


        // will stop updating data if id is not exists and redirect ot 400 page
        $category = Category::findOrFail($id);
        $data = $request->except('image');

        $old_image = $category->image;

        // Request merge

        $new_image = $this->uploadedImage($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }


        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }


        $category->update($data);
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        dd($category);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Deleted Successfully');
    }

    protected function uploadedImage(Request $request)
    {
        // if request hasn't it will make this method return null and if not it will return the path
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image'); // return uploadedFile object
        $path =  $file->store('uploads', [
            'disk' => 'public'
        ]); // or i can put key and value ('disk' => 'public')
        return $path;
    }
}
