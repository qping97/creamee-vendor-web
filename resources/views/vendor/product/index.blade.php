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
                <h2>Product</h2>
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
                <th data-sortable="false">Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Amount</th>
                <th data-sortable="false">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($product)
            @foreach($product as $c)
            <tr>
                <td data-sortable="false">
                    <img src="{{ asset($c->product_img)}}" style="width: 40px; height: 40px; border-radius:0%;"/>
                </td>
                <!-- <td>{{$c->id}}</td> -->
                <td>{{$c->name}}</td>
                <td>{{$c->category->name}}</td>
                <td>{{$c->product_price}}</td>
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
<div class="modal fade" id="add-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="AddModal"></h4>
                <button type="button" class="btn btn-link" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="add-form" name="CategoryForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
               

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="add-name" class="form-control" name="name" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-12">
                        <select name="product_category_id" class="form-control" id="category-id">
                            <option value="">Select</option>
                            @foreach($category as $cat)
                            <option  value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div> 

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" id="add-price" class="form-control" name="product_price" placeholder="Enter Price" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="add-image" name="add-image" placeholder="Enter Image" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="textarea" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" name="description" id="add-description" rows="4" placeholder="Enter Description" required=""></textarea>
                            <!-- <input type="textarea" id="add-description" class="form-control" name="description" placeholder="Enter Description" maxlength="50" required=""> -->
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
<div class="modal fade" id="product-edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ProductEditModal"></h4>
                <button type="button" class="btn btn-link" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="EditCategoryForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="pro-id"> 
                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-12">
                        <select name="edit-category" class="form-control" id="edit-category-id">
                        <option value="">Select</option>
                            <option value="">Select</option>
                            @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div> 

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-price" name="product_price" placeholder="Enter Price" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="edit-image" name="product_img" placeholder="Enter Image" >
                        </div>
                        <div id="saved-image" style="padding: 10px;"></div>
                    </div>

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" name="description" id="edit-description" rows="4" placeholder="Enter Description" required=""></textarea>
                            <!-- <input type="textarea" id="edit-description" class="form-control" name="description" placeholder="Enter Name" required=""> -->
                        </div>
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
    $('#add-form').trigger("reset");
    $('#AddModal').html("Add Product");
    $('#add-modal').modal('show');
}

//category
$('#btn-save').on('click',function(){
    
    var name = $('#add-modal').find('#add-name').val();
    var product_price = $('#add-modal').find('#add-price').val();
    var description = $('#add-modal').find('#add-description').val();
    var category_id = $('#add-modal').find('#category-id').val();
    var imageData = $('#add-modal').find('#add-image')[0].files[0];
    var data = new FormData();
    data.append('name',name);
    data.append('product_price',product_price);
    data.append('description',description);
    data.append('product_img',imageData);
    data.append('product_category_id',category_id);
    data.append('_token','{{csrf_token()}}');
    $.ajax({
        method:"POST",
        url: "{{ url('product/store') }}",
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function(res){
            window.location = '{{ url("product")}}';
        },
    });

});

var productId = ''; 
function editFunc(id,obj){
    productId = id;
    $('#ProductEditModal').html("Edit Product");
    $('#product-edit-modal').modal('show');
    $.ajax({
        type:"GET",
        url: "{{ url('product/edit') }}/" + id, 
        dataType: 'json',
        success: function(res){
            $('#edit-name').val(res.name);
            $('#edit-category').val(res.product_category_id);
            $('#edit-price').val(res.product_price);
            $('#edit-description').val(res.description);            
            $('#pro-id').val(res.id);
            var path = '{{url("/")}}/' + res.product_img;
            $('#saved-image').html(`<img src="${path}"  width="70" class="img-thumbnail"/>`);
        }
    })
}

$('#btn-save-edit').on('click',function(){

    var id = $('#product-edit-modal').find('#pro-id').val();
    var name = $('#product-edit-modal').find('#edit-name').val();
    var product_category_id = $('#product-edit-modal').find('#edit-category-id').val();
    var product_price = $('#product-edit-modal').find('#edit-price').val();
    var description = $('#product-edit-modal').find('#edit-description').val();
    var imageData = $('#product-edit-modal').find('#edit-image')[0].files[0];
    var data = new FormData();
    data.append('id',id);
    data.append('name',name);
    data.append('product_category_id',product_category_id);
    data.append('product_price',product_price);
    data.append('description',description);
    data.append('product_img',imageData);

    data.append('_token','{{csrf_token()}}');

    $.ajax({
        method:"POST",
        url: "{{ url('product/update') }}/" + productId, 
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function(res){
            window.location = '{{ url("product")}}';
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
    url: "{{ url('product/delete') }}/" + id,
    dataType: 'json',
    success: function(res){
        window.location = '{{ url("product")}}';
    }
    });
    }
}

</script>
@endsection