@extends('layouts.main')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product Category</h2>
            </div>

            <div class="pull-right mb-2">
                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create New</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card-body">
        <table class="table table-bordered ajax-crud-datatable">
            <thead>
            <tr>
                <!-- <th>Id</th> -->
                <th>Name</th>
                <th data-sortable="false">Image</th>
                <th data-sortable="false">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($category)
            @foreach($category as $c)
            <tr>
                <!-- <td>{{$c->id}}</td> -->
                <td>{{$c->name}}</td>
                <td><img src="{{ asset($c->image)}}" style="width: 40px; height: 40px; border-radius:0%;"/></td>
                <td>
                    <a class="btn btn-success" onClick="editFunc({{$c->id}},this)" href="javascript:void(0)">Edit</a>
                    <a class="btn btn-danger" onClick="deleteFunc({{$c->id}}, this)" href="javascript:void(0)">Delete</a>
                </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<!-- boostrap company model -->
<div class="modal fade" id="category-add-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CategoryAddModal"></h4>
                <button type="button" class="btn btn-link" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="category-add-form" name="CategoryForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
               

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="add-name" class="form-control" name="name" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="add-image" name="add-image" placeholder="Enter image" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="category-edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CategoryEditModal"></h4>
                <button type="button" class="btn btn-link" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="EditCategoryForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="cat_id" id="cat-id"> 
                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="edit-image" name="image" placeholder="Enter image" >
                        </div>
                        <div id="saved-image" style="padding: 10px;"></div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-save-edit">Save changes</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@endsection
<!-- end bootstrap model -->
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
$('.ajax-crud-datatable').DataTable();
});

function add(){
    $('#category-add-form').trigger("reset");
    $('#CategoryAddModal').html("Add Category");
    $('#category-add-modal').modal('show');
}

$('#btn-save').on('click',function(){

    var name = $('#category-add-modal').find('#add-name').val();
    var imageData = $('#category-add-modal').find('#add-image')[0].files[0];
    var data = new FormData();
    data.append('name',name);
    data.append('image',imageData);
    data.append('_token','{{csrf_token()}}');

    $.ajax({
        method:"POST",
        url: "{{ url('product-category/store') }}",
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function(res){
            window.location = '{{ url("product-category")}}';
        },
        error: function(res){
            alert("Error in saving data");
        },
    });

});

var categoryId = ''; 
function editFunc(id,obj){
    categoryId = id;
    $('#CategoryEditModal').html("Edit Category");
    $('#category-edit-modal').modal('show');
    $.ajax({
        type:"GET",
        url: "{{ url('product-category/edit') }}/" + id, 
        dataType: 'json',
        success: function(res){
            $('#edit-name').val(res.name);
            $('#cat-id').val(res.id);
            var path = '{{url("/")}}/' + res.image;
            console.log(path);
            $('#saved-image').html(`<img src="${path}"  width="70" class="img-thumbnail"/>`);
        }
    })
}

$('#btn-save-edit').on('click',function(){

    var id = $('#category-edit-modal').find('#cat-id').val();
    var name = $('#category-edit-modal').find('#edit-name').val();
    var imageData = $('#category-edit-modal').find('#edit-image')[0].files[0];
    var data = new FormData();
    data.append('id',id);
    data.append('name',name);
    data.append('image',imageData);

    data.append('_token','{{csrf_token()}}');

    $.ajax({
        method:"POST",
        url: "{{ url('product-category/update') }}/" + categoryId, 
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function(res){
            window.location = '{{ url("product-category")}}';
        },
        error: function(res){
            alert("Error in saving data");
        },
    });

});

function deleteFunc(id, obj){
    
    if (confirm("Delete Record?") == true) {
    $.ajax({
    type:"GET",
    url: "{{ url('product-category/delete') }}/" + id,
    dataType: 'json',
    success: function(res){
        window.location = '{{ url("product-category")}}';
    }   
    });
    }
}

</script>
@endsection