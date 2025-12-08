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
                            <th>Serial</th>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($active_vendors as $key => $vendor)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $vendor->name }}</td>
                            <td>{{ $vendor->user_name }}</td>
                            <td><button class="btn btn-sm btn-primary">{{ $vendor->status }}</button></td>
                            <td>
                                <a href="javascript:;" onclick="sure({{ $vendor->id }})"
                                    class="btn btn-sm btn-danger">delete</a>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>User Name</th>
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
                    fetch("/"+id).then(res=>{
                        if(res.status=== 200){
                            swal("Category Deleted Successfully!", {
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