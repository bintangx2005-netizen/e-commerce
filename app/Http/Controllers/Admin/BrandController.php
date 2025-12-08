<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.all_brand', compact('brands'));
    }

    public function create(): View
    {
        return view('admin.brand.add_brand');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|max:2024'
        ]);

        $image = $request->file('image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();


        Image::make($image)->resize(300, 300)->save(public_path('uploaded/brands/' . $image_name));


        Brand::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $image_name
        ]);
        $alert = [
            'message' => 'Brand Added Successfully!',
            'type' => 'success'
        ];

        return redirect()->route('admin.all_brand')->with($alert);
    }


    public function edit(Brand $brand)
    {
        return view('admin.brand.edit_brand', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|max:2024'
        ]);
        $image = $request->file('image');
        if ($image) {
            if ($brand->image && file_exists(public_path('uploaded/brands/' . $brand->image))) {
                unlink(public_path('uploaded/brands/' . $brand->image));
            }
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save(public_path('uploaded/brands/' . $image_name));
            $brand->image = $image_name;
        }
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->save();
        $alert = [
            'message' => 'Brand Updated Successfully!',
            'type' => 'success'
        ];
        return redirect()->route('admin.all_brand')->with($alert);
    }

    public function destroy(Brand $brand)
    {
        unlink(public_path('/uploaded/brands/' . $brand->image));
        return $brand->delete();
    }
}
