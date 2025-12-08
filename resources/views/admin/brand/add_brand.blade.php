@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-8 mx-auto">
                    <form action="{{ route('admin.store_brand') }}" method="post" enctype="multipart/form-data"
                        id='demo'>
                        @csrf

                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Brand Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{ old('name')}}" name="name"
                                            id="name" />
                                        @error('name')
                                        <div class="row  text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="nameError" class="row  text-danger d-none"></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control" name="image" id="photo" />
                                        @error('name')
                                        <div class="row  text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="row  text-danger d-none" id='photoError'></div>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-sm-6 m-auto text-secondary">
                                        <img id="showPhoto" src="{{asset('uploaded/no_image.jpg') }}" alt="Brand Logo"
                                            width="200">
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
    const showPhoto = document.querySelector('#showPhoto');
    const photo = document.querySelector('#photo');
    const photoError = document.querySelector('#photoError');

    const demo = document.querySelector('#demo');
    const name = document.querySelector('#name');
    const nameError = document.querySelector('#nameError');

    // validation check
    demo.onsubmit = ()=> {
        let problem = 0;
        if(name.value===''){
            problem++;
            nameError.classList.remove('d-none');
            nameError.innerHTML = "Name Field Can't be Empty";
        }
        if(photo.files.length === 0){
            problem++;
            photoError.classList.remove('d-none');
            photoError.innerHTML = "Image Field Can't be Empty";
        }
        else if(!['png','jpg','jpeg'].includes(photo.files[0].type.split('/')[1])){
            photoError.classList.remove('d-none');
            photoError.innerHTML = "ONly png,jpg,jpeg is allowed";
        }
        else if(photo.files[0].size/1000 > 2024){
            photoError.classList.remove('d-none');
            photoError.innerHTML = "Image Size should be less than 2024Kb";
        }
        else{
            photoError.classList.add('d-none');
            console.log(photo.files)
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