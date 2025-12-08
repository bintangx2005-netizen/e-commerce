<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class SubCategoryController extends Controller
{

    public function index(): View
    {
        $sub_categories = SubCategory::latest()->get();
        return view('admin.sub_category.all_sub_category', compact('sub_categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.sub_category.add_sub_category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);



        SubCategory::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id
        ]);
        $alert = [
            'message' => 'Sub Category Added Successfully!',
            'type' => 'success'
        ];

        return redirect()->route('admin.all_sub_category')->with($alert);
    }


    public function edit(SubCategory $sub_category)
    {
        $categories = Category::all();
        return view('admin.sub_category.edit_sub_category', compact('sub_category', 'categories'));
    }

    public function update(Request $request, SubCategory $sub_category)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);

        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        $sub_category->category_id = $request->category_id;
        $sub_category->save();
        $alert = [
            'message' => 'Category Updated Successfully!',
            'type' => 'success'
        ];
        return redirect()->route('admin.all_sub_category')->with($alert);
    }

    public function destroy(SubCategory $sub_category)
    {
        return $sub_category->delete();
    }
}
