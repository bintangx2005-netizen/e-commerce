<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function index(): View
    {
        $categories = Category::latest()->get();
        return view('admin.category.all_category', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.category.add_category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|max:2024'
        ]);

        $image = $request->file('image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();


        Image::make($image)->resize(120, 120)->save(public_path('uploaded/categories/' . $image_name));


        Category::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $image_name
        ]);
        $alert = [
            'message' => 'Category Added Successfully!',
            'type' => 'success'
        ];

        return redirect()->route('admin.all_category')->with($alert);
    }


    public function edit(Category $category)
    {
        return view('admin.category.edit_category', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|max:2024'
        ]);
        $image = $request->file('image');
        if ($image) {
            if ($category->image && file_exists(public_path('uploaded/categories/' . $category->image))) {
                unlink(public_path('uploaded/categories/' . $category->image));
            }
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(120, 120)->save(public_path('uploaded/categories/' . $image_name));
            $category->image = $image_name;
        }
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        $alert = [
            'message' => 'Category Updated Successfully!',
            'type' => 'success'
        ];
        return redirect()->route('admin.all_category')->with($alert);
    }

    public function destroy(Category $category)
    {
        if (file_exists(public_path('/uploaded/categories/' . $category->image))) {
            unlink(public_path('/uploaded/categories/' . $category->image));
        }
        return $category->delete();
    }
}
