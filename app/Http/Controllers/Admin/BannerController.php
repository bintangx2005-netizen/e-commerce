<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{

    public function index(): View
    {
        $banners = Banner::latest()->get();
        return view('admin.banner.all_banner', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banner.add_banner');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'image' => 'required|image|max:2024'
        ]);

        $image = $request->file('image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();


        Image::make($image)->resize(800, 450)->save(public_path('uploaded/banners/' . $image_name));


        Banner::insert([
            'title' => $request->title,
            'url' => $request->url,
            'image' => $image_name
        ]);
        $alert = [
            'message' => 'Banner Added Successfully!',
            'type' => 'success'
        ];

        return redirect()->route('admin.all_banner')->with($alert);
    }


    public function edit(Banner $banner)
    {
        return view('admin.banner.edit_banner', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'image' => 'image|max:2024'
        ]);
        $image = $request->file('image');
        if ($image) {
            if ($banner->image && file_exists(public_path('uploaded/banners/' . $banner->image))) {
                unlink(public_path('uploaded/banners/' . $banner->image));
            }
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 450)->save(public_path('uploaded/banners/' . $image_name));
            $banner->image = $image_name;
        }
        $banner->title = $request->title;
        $banner->url = $request->url;
        $banner->save();
        $alert = [
            'message' => 'Banner Updated Successfully!',
            'type' => 'success'
        ];
        return redirect()->route('admin.all_banner')->with($alert);
    }

    public function destroy(Banner $banner)
    {
        if (file_exists(public_path('/uploaded/banners/' . $banner->image))) {

            unlink(public_path('/uploaded/banners/' . $banner->image));
        }
        return $banner->delete();
    }
}
