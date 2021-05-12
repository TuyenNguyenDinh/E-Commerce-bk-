@extends('layouts.admin')
@section('main')
@section('title','Edit Brands')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Brands</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands</a></li>
                    <li class="breadcrumb-item active">Edit Brands</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <form id="edit_brands" method="POST" data-route="{{ route('brands.update', $brands->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name brands</label>
                                <br>
                                <input required type="text" id="name" name="name" value="{{ $brands->name }}" class="form-control">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('name')}}</strong></br>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" name="image" id="img1" type='file' accept="image/*" onchange="readURL(this, $('.file-upload-image'), $('.image-upload-wrap'), $('.file-upload-content'))" />
                                    <div class="drag-text">
                                        <h3>Drag and drop a file or select add Image</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove </button>
                                    </div>
                                </div>
                            </div>                            
                            <!--  -->
                            <div class="alert alert-danger print-error-msg" style="display:none">
								<ul></ul>
							</div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.container-fluid -->
        <div class="row">
            <div class="col-12">
                <a href="{{ route('categories.index')}}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Update" class="btn btn-success float-right" onsubmit="updateBrands('{{$brands->id}}')">
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
<script>
   $('#edit_brands').submit(function(event) {
		var route = $('#edit_brands').data('route');
		var form_date = $(this)
		$.ajax({
			method: 'POST',
			url: route,
			processData: false, // Important!
			contentType: false,
			cache: false,
			data: new FormData(this),
			success: function(response) {
				swal({
					closeOnClickOutside: false,
					icon: "success",
					title: 'Success, edit sussecfully!',
					showSpinner: true
				});
				$(location).attr("href", "http://localhost/ecommerce/E-Commerce/public/admin/brands");
			},
			error: function(response) {
				$(".print-error-msg").find("ul").html('');
				$(".print-error-msg").css('display', 'block');
				var err = JSON.parse(response.responseText);
				$.each(err.errors, function(key, value) {
					$(".print-error-msg").find("ul").append('<li>' + value[0] + '</li>');
				})

			}
		})
		event.preventDefault();
	});
</script>
@stop