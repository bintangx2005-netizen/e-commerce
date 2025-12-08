@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">eCommerce</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                        href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add New Product</h5>
            <hr />

            <div class="form-body mt-4">
                <form action="{{ route('admin.store_product') }}" method="post" enctype="multipart/form-data"
                    id="productForm">
                    <div class="row">
                        @csrf
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Title</label>
                                    <input type="text" class="form-control" name="product_name" id="inputProductTitle"
                                        placeholder="Enter product title" value="{{ old('product_name') }}">
                                    @error('product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Description</label>
                                    <textarea name="short_desc" class="form-control" id="inputProductDescription"
                                        rows="3">{{ old('short_desc') }}</textarea>

                                </div>
                                <div class="mb-3">
                                    <textarea id="mytextarea" name="long_desc">{{ old('long_desc') }}</textarea>
                                </div>



                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Product Size</label>
                                    <input name="product_sizes" type="text" class="form-control visually-hidden"
                                        data-role="tagsinput" value="{{ old('product_sizes') ?? " sm,md,xl" }}">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Product Tags</label>
                                    <input name="product_tags" type="text" class="form-control visually-hidden"
                                        data-role="tagsinput" value="{{ old('product_tags') ?? 'new,best,hot' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Product Color</label>
                                    <input name="product_colors" type="text" class="form-control visually-hidden"
                                        data-role="tagsinput" value="{{ old('product_sizes') ?? 'red,blue,cyan' }}">
                                </div>


                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Product Images</label>
                                    <input id="image" class="form-control" type="file" name="photo">
                                    @error('photo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div>
                                        <img src="#" alt="" id="showImage" width="100">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Product Multiple
                                        Image</label>
                                    <input id="images" class="form-control" name="multi_images[]" type="file" multiple>
                                    <div id="showImages"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Price</label>
                                        <input name="selling_price" type="text" class="form-control" id="inputPrice"
                                            placeholder="00.00" value="{{ old('selling_price')  }}">
                                        @error('selling_price')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                        <input name="discount" type="text" class="form-control" id="inputCompareatprice"
                                            placeholder="00.00" value="{{ old('discount') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputQuantity" class="form-label">Quantity</label>
                                        <input name="product_quantity" type="text" class="form-control"
                                            id="inputQuantity" placeholder="00.00"
                                            value="{{ old('product_quantity') }}">
                                        @error('product_quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-12">
                                        <label for="inputProductType" class="form-label">Brand</label>
                                        <select name="brand_id" class="form-select" id="inputBrand">
                                            <option disabled selected value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('brand_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputVendor" class="form-label">Category</label>
                                        <select name="category_id" class="form-select" id="category">
                                            <option selected disabled value="">Select a Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCollection" class="form-label">Sub Category</label>
                                        <select class="form-select" id="sub_category" name="sub_category_id">
                                            <option selected disabled>Select Sub Category</option>

                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Save Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end row-->
            </div>
        </div>
    </div>

</div>

<script>
    // image upload
    const image = document.getElementById('image');
    const showImage = document.getElementById('showImage');
    const images = document.getElementById('images');
    const showImages = document.getElementById('showImages');
    image.onchange = (e)=>{
        const reader = new FileReader();
        reader.onload = (e)=>{
            showImage.setAttribute('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    }
    images.onchange = (e)=>{
        if(showImages.childElementCount){
            console.log(showImages.childElementCount);

            while(showImages.firstChild){

                showImages.removeChild(showImages.firstChild);
            }
        }
        for(let item of e.target.files){
            const reader = new FileReader();
            reader.onload = (e)=>{



                const tempImg = document.createElement('img');
                tempImg.src = e.target.result;
                tempImg.width = '100';
                showImages.appendChild(tempImg);
            }
            reader.readAsDataURL(item);
        }
    };

    // sub category load
    const category = document.getElementById('category');
    const sub_category = document.getElementById('sub_category');
    const categories = [
            @foreach ($categories as $category)
            [{{ $category->id }},[
            @foreach ($category->sub_categories as $sub_category )
            [{{ $sub_category->id }},"{{ $sub_category->name }}"],
            @endforeach
            ]
            ],
            @endforeach
        ];

        console.log(categories);

    category.onchange = (e)=>{
        const id =+(e.target.value);
        console.log(typeof(id));


        for(let category of categories){
            console.log(category);
            if(category.length > 1 && category[0] === id){

                    for(const sub_category_item of category[1]){
                        console.log(sub_category_item);
                    const optionElement = document.createElement('option');
                    optionElement.value = sub_category_item[0];
                    optionElement.text  = sub_category_item[1];
                    sub_category.appendChild(optionElement);
                }
            }

        }

    };

// form validation

const productForm = document.getElementById('productForm');
const inputProductTitle = document.getElementById('inputProductTitle');
const inputProductDescription = document.getElementById('inputProductDescription');
const inputPrice = document.getElementById('inputPrice');
const inputQuantity = document.getElementById('inputQuantity');



productForm.onsubmit = ()=>{
    return true;
    let problem = true;

    if(inputProductTitle.value === ''){
        problem = false;
       errorMessage(inputProductTitle);
    }else{
        removeErrorMessage(inputProductTitle);
    }

    if(inputProductDescription.value === ''){
        problem = false;
       errorMessage(inputProductDescription);
    }else{
    removeErrorMessage(inputProductDescription);
    }
    if(inputQuantity.value === ''){
        problem = false;
       errorMessage(inputQuantity);
    }else{
    removeErrorMessage(inputQuantity);
    }

    if(inputPrice.value === ''){
        problem = false;
       errorMessage(inputPrice);
    }else{
    removeErrorMessage(inputPrice);
    }

    if(inputBrand.value === ''){
        problem = false;
       errorMessage(inputBrand);
    }else{
    removeErrorMessage(inputBrand);
    }

    if(category.value === ''){
        problem = false;
       errorMessage(category);
    }else{
    removeErrorMessage(category);
    }

    if(image.files.length < 1){
        problem = false;
        errorMessage(image);
    }else if(!['png','jpg','jpeg'].includes((image.files[0].type).split('/')[1])){
    problem = false;
    errorMessage(image,"Only png,jpg,jpeg format image allowed");
    }
    else if(image.files[0].size / 1000 > 200 ){
       problem = false;
        errorMessage(image,"Image size allow only under 2mb");
    }
    else{
    removeErrorMessage(image);
    }

return problem;

}



function errorMessage(ele,message="Field shouldn't be empty") {
    const check = document.getElementsByClassName(ele.id);
    if(check.length<1){
        const customError = document.createElement("div");
        customError.classList.add('text-danger',ele.id);
        customError.innerHTML = message;
        ele.parentNode.appendChild(customError);
    }
}

function removeErrorMessage(el){
  const item = document.getElementsByClassName(el.id);
  console.log(item[0]);
    item[0].parentNode.removeChild(item[0]);
}


</script>


@endsection