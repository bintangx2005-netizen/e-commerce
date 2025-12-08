<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreProductRequest;

class VendorProductController extends Controller
{

    public function index()
    {
        $products = Product::where('vendor_id', Auth::id())->latest()->get();
        return view('vendor.prdouct.all_product', compact('products'));
    }

    public function create()
    {
        $categories = Category::with('sub_categories')->orderByDesc('id')->get();
        $brands = Brand::latest()->get();
        return view('vendor.prdouct.add_product', compact('categories', 'brands'));
    }

    public function store(StoreProductRequest $request)
    {
        $thumbnail = $request->file('photo');

        $thumbnail_name = '';
        if ($thumbnail) {
            $thumbnail_name = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(800, 800)->save(public_path('uploaded/product/' . $thumbnail_name));
        }



        // return $request->all();
        $request->merge(['thumbnail' => $thumbnail_name]);
        $request->merge(['vendor_id' => Auth::id()]);
        $request->merge(['product_slug' => Str::slug($request->product_name)]);
        $request->merge(['product_id' =>  "#" . str_replace(" ", "_", $request->product_name) . '_' . date('i_s')]);


        $product_id = Product::insertGetId($request->except(['_token', 'multi_images', 'photo']));
        $alert = [
            'message' => 'Successfully Added Product!',
            'type' => 'success'
        ];


        $multi_images = $request->file('multi_images');
        if ($multi_images) {
            foreach ($multi_images as  $multi_image) {
                $file_name = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
                Image::make($multi_image)->resize(800, 800)->save(public_path('uploaded/product/' . $file_name));
                MultiImage::insert([
                    'product_id' => $product_id,
                    'image' => $file_name
                ]);
            }
        }




        return redirect()->route('vendor.all_product')->with($alert);
    }

    public function destroy(Product $product)
    {
        if (file_exists(public_path('uploaded/product/' . $product->thumbnail))) {
            unlink(public_path('uploaded/product/' . $product->thumbnail));
        }
        $multi_images = $product->multiple_images;
        if ($multi_images) {
            foreach ($multi_images as $item) {
                if (file_exists(public_path('uploaded/product/' . $item->image))) {
                    unlink(public_path('uploaded/product/' . $item->image));
                }
            }
        }
        return $product->delete();
    }
}
