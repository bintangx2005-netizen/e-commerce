@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Sub Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Sub Category</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-8 mx-auto">
                    <form action="{{ route('admin.update_sub_category',$sub_category->id) }}" method="post" id='demo'>
                        @csrf

                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Sub Category Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control"
                                            value="{{ old('name') ?? $sub_category->name}}" name="name" id="name" />
                                        @error('name')
                                        <div class="row  text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="nameError" class="row  text-danger d-none"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Category Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-control" id='category' name="category_id">
                                            <option value="" disabled selected> Choose option</option>
                                            @foreach ($categories as $category)


                                            <option {{ $category->id === $sub_category->category_id ? 'selected' :'' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="row  text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="categoryError" class="row  text-danger d-none"></div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const demo = document.querySelector('#demo');
    const name = document.querySelector('#name');
    const nameError = document.querySelector('#nameError');
    const category = document.querySelector('#category');
    const categoryError = document.querySelector('#categoryError');

    // validation check
    demo.onsubmit = ()=> {
        let problem = 0;
        if(name.value===''){
            problem++;
            nameError.classList.remove('d-none');
            nameError.innerHTML = "Name Field Can't be Empty";
        }
        if(category.value===''){
            problem++;
            categoryError.classList.remove('d-none');
            categoryError.innerHTML = "Category Field Can't be Empty";
        }


        return problem > 0 ? false : true;

    };

    // image show
    photo.onchange = (e)=>{
        const reader = new FileReader();
        reader.onload = (e)=>{
        showPhoto.setAttribute('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    }

</script>
@endsection