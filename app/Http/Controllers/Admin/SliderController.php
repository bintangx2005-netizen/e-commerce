<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{

    public function index(): View
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.all_slider', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.slider.add_slider');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'required|image|max:2024'
        ]);

        $image = $request->file('image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();


        Image::make($image)->resize(120, 120)->save(public_path('uploaded/sliders/' . $image_name));


        Slider::insert([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'image' => $image_name
        ]);
        $alert = [
            'message' => 'Slider Added Successfully!',
            'type' => 'success'
        ];

        return redirect()->route('admin.all_slider')->with($alert);
    }


    public function edit(Slider $slider)
    {
        return view('admin.slider.edit_slider', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'image|max:2024'
        ]);
        $image = $request->file('image');
        if ($image) {
            if ($slider->image && file_exists(public_path('uploaded/sliders/' . $slider->image))) {
                unlink(public_path('uploaded/sliders/' . $slider->image));
            }
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2450, 800)->save(public_path('uploaded/sliders/' . $image_name));
            $slider->image = $image_name;
        }
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->save();
        $alert = [
            'message' => 'Slider Updated Successfully!',
            'type' => 'success'
        ];
        return redirect()->route('admin.all_slider')->with($alert);
    }

    public function destroy(Slider $slider)
    {
        if (file_exists(public_path('/uploaded/sliders/' . $slider->image))) {

            unlink(public_path('/uploaded/sliders/' . $slider->image));
        }
        return $slider->delete();
    }
}
