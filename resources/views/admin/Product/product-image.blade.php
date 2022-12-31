@extends('admin.layout.master')

@section('title','Product Images List')

@section('body')
    <!-- Main -->
    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Product Images
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Product Name</label>
                            <div class="col-md-9 col-xl-8">
                                <input disabled placeholder="Product Name" type="text"
                                    class="form-control" value="{{$product->name}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="" class="col-md-3 text-md-right col-form-label">Images</label>
                            <div class="col-md-9 col-xl-8">
                                <ul class="text-nowrap" id="images">
                                    <div id="box-photo-upload" class="d-flex flex-wrap photo-upload" data-id="{{$product->id}}">
                                    </div>

                                    <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                        <div style="width: 100%; max-height: 220px; overflow: hidden;">
                                            <img style="width: 100%; cursor: pointer;"
                                                class="thumbnail"
                                                data-toggle="tooltip" title="Click to add image" data-placement="bottom"
                                                src="dashboard/assets/images/add-image-icon.jpg" alt="Add Image">

                                            <input name="image" id="fileUpload" type="file" onchange="AutoUploadPhoto()"
                                                accept="image/x-png,image/gif,image/jpeg"
                                                class="image form-control-file" style="display: none;">

                                            <input type="hidden" name="product_id" value="">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-3">
                                <a href="{{route('ProductDetails',$product->id)}}" class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-check fa-w-20"></i>
                                    </span>
                                    <span>OK</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->

@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
         LoadPhotos();
    });

    function LoadPhotos()
    {
        var box = $("#box-photo-upload");
        var id = box.data("id");
        box.empty();

        $.ajax({
            type: "GET",
            url: "/admin/product/images-list",
            data: {productId : id},
            success: function (response){

                response.forEach( function (item){
                    var newItem =$(
                        '<li class="float-left d-inline-block mr-2 mb-2" style="position: relative; width: 32%;">' +
                        '<span class="btn btn-sm btn-outline-danger border-0 position-absolute" onclick="setClickDeletePhoto('+item.id +')" data-id="'+ item.id + '">X</span>' +
                        '<div style="width: 100%; height: 220px; overflow: hidden;">' +
                        '<img  src="front/img/products/'+ item.path +'" alt="Image">' +
                        '</div>' +
                        '</li>'
                    );

                    box.append(newItem);
                });

            },
            error: function (response){}
        });
    }

    function AutoUploadPhoto()
    {
        var formData = new FormData();
        formData.append("_token",'{{csrf_token()}}');

        var id = $("#box-photo-upload").data("id");
        formData.append("id", id);

        var sofile = document.getElementById("fileUpload").files.length;
        if (sofile == 0)  return;
        var fileData = document.getElementById("fileUpload").files[0];
        formData.append("FileUpload", fileData)

        $.ajax({
            type: "POST",
            url: "admin/product/images-upload",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: formData ,

            success: function (response){
                if(response == 'success!'){
                    LoadPhotos();
                }
            },
            error: function (){
                alert('something wrong when to trying upload image!');
            }
        });
    }

    function setClickDeletePhoto(imageId)
    {
        $.ajax({
            type: "DELETE",
            url: "admin/product/images-delete",
            // dataType: 'text',
            // cache: false,
            // contentType: false,
            // processData: false,
            data: {_token:'{{csrf_token()}}',imageId:imageId} ,

            success: function (response){
                if(response == 'success!'){
                    LoadPhotos();
                }
            },
            error: function (){
                alert('something wrong when to trying delete an image!');
            }
        });
    }
</script>
