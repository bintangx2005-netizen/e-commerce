@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add_product') }}" class="btn btn-primary">Add Product</a>

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">DataTable Example</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product Id</th>
                            <th>Product</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $product->product_id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="recent-product-img">
                                        <img src="{{ file_exists(public_path('uploaded/product/'.$product->thumbnail)) ? asset('uploaded/product/'.$product->thumbnail) : asset('uploaded/no_image.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-1 font-14">{{ $product->product_name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->brand_id }}</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>{{ $product->status }}</td>
                            <td>
                                <a href="{{ route('admin.edit_brand',$product->id) }}"
                                    class="btn btn-sm btn-primary">edit</a>
                                <a href="javascript:;" onclick="sure({{ $product->id }})"
                                    class="btn btn-sm btn-danger">delete</a>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Order Id</th>
                            <th>Product</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>


<script>
    function sure(id){
                swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    fetch("/admin/delete-product/"+id).then(res=>{
                        if(res.status=== 200){
                            swal("Brand Deleted Successfully!", {
                            icon: "success",
                            });
                            location.reload();
                        }else{
                            swal("Not Deleted");
                        }
                    })

                });
            }
</script>

@endsection