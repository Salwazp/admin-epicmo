@extends('layouts.admin.app')
@section('content')
    <link rel="stylesheet" href="/backend/app-assets/css/uploader.css">
    <link rel="stylesheet" href="/backend/app-assets/css/uploader-2.css">

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ request()->route("admin.why") }}">Why Choose</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @if ($data == null)
                                Create Why Choose
                                @else
                                Update Why Choose: {{ $data->title }}
                                @endif
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
    <!-- Validation -->
        <section class="bs-validation">
            @if ($data !== null)
            <form action="{{ route('admin.why.update', $data->id) }}" method="POST" enctype="multipart/form-data"> <!-- jika form tambah -->
            @else
            <form action="{{ route('admin.why.store') }}" id="jquery-val-form" method="POST" enctype="multipart/form-data"> <!-- jika form edit -->
            @endif
                @csrf
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if ($data == null)
                                    Create Why Choose
                                    @else
                                    Update Why Choose
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="file-upload  @error('image1') border-danger @enderror" style="width:100%">
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add image 1</button>
                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image1" />
                                                <div class="drag-text">
                                                    @if ($data !== null)
                                                        <img class="file-upload-image" src="{{ isset($data->image['image1']) ? $data->image['image1'] : ''  }}" alt="your image" />
                                                    @else
                                                        <h3>Drag and drop a file or select add image</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content">
                                                <img class="file-upload-image" src="{{ isset($data->image['image1']) ? $data->image['image1'] : ''  }}" alt="your image" />
                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded image 1</span></button>
                                                </div>
                                            </div>
                                            <div class="mt--1">
                                                <small class="text-danger">** Max 2mb</small> 
                                                {{-- <small class="text-danger float-right">Dimensions : 1200 × 855 px</small> --}}
                                            </div>
                                            @error('image')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="file-upload-2  @error('image2') border-danger @enderror" style="width: 100%;">
                                            <button class="file-upload-btn-2" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image 2</button>
                                            <div class="image-upload-wrap-2">
                                                <input class="file-upload-input-2" type='file' onchange="readURL2(this);" accept="image/*" name="image2" />
                                                <div class="drag-text-2">
                                                    @if ($data !== null)
                                                        <img class="file-upload-image-2" src="{{ isset($data->image['image2']) ? $data->image['image2'] : ''  }}" alt="your image" />
                                                    @else
                                                    <h3>Drag and drop a file or select add image</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content-2">
                                                <img class="file-upload-image-2" src="{{ isset($data->image['image2']) ? $data->image['image2'] : ''  }}" alt="your image" />
                                                <div class="image-title-wrap-2">
                                                    <button type="button" onclick="removeUpload2()" class="remove-image-2">Remove <span class="image-title">Uploaded Image 2</span></button>
                                                </div>
                                            </div>
                                            <div class="mt--1">
                                                <small class="text-danger">** Max 2mb</small> 
                                                {{-- <small class="text-danger float-right">Dimensions : 1134 x 708 px</small> --}}
                                            </div>
                                            @error('image2')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="file-upload-3  @error('image3') border-danger @enderror" style="width: 100%;">
                                            <button class="file-upload-btn-3" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image 3</button>
                                            <div class="image-upload-wrap-3">
                                                <input class="file-upload-input-3" type='file' onchange="readURL3(this);" accept="image/*" name="image3" />
                                                <div class="drag-text-3">
                                                    @if ($data !== null)
                                                        <img class="file-upload-image-3" src="{{ isset($data->image['image3']) ? $data->image['image3'] : ''  }}" alt="your image" />
                                                    @else
                                                    <h3>Drag and drop a file or select add image</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content-3">
                                                <img class="file-upload-image-3" src="{{ isset($data->image['image3']) ? $data->image['image3'] : ''  }}" alt="your image" />
                                                <div class="image-title-wrap-3">
                                                    <button type="button" onclick="removeUpload3()" class="remove-image-3">Remove <span class="image-title">Uploaded Image 3</span></button>
                                                </div>
                                            </div>
                                            <div class="mt--1">
                                                <small class="text-danger">** Max 2mb</small> 
                                                {{-- <small class="text-danger float-right">Dimensions : 174 × 80 px</small> --}}
                                            </div>
                                            @error('logo')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <input type="text" name="title" class="form-control @error('title') border-danger @enderror" value="{{ $data ? $data->title : '' }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Subtitle 1</label>
                                    <input type="text" name="subtitle1" class="form-control @error('subtitle1') border-danger @enderror" value="{{ $data && isset($data->value['subtitle1'])  ? $data->value['subtitle1'] : '' }}">
                                    @error('subtitle1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description 1</label>
                                    <textarea name="deskripsi1" id="text_id1" cols="30" rows="10" class="form-control">{{ $data && isset($data->value['deskripsi1'])  ? $data->value['deskripsi1'] : '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Subtitle 2</label>
                                    <input type="text" name="subtitle2" class="form-control @error('subtitle2') border-danger @enderror" value="{{ $data && isset($data->value['subtitle2'])  ? $data->value['subtitle2'] : '' }}">
                                    @error('subtitle2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description 2</label>
                                    <textarea name="deskripsi2" id="text_id2" cols="30" rows="10" class="form-control">{{ $data && isset($data->value['deskripsi2'])  ? $data->value['deskripsi2'] : '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Subtitle 3</label>
                                    <input type="text" name="subtitle3" class="form-control @error('subtitle3') border-danger @enderror" value="{{ $data && isset($data->value['subtitle3'])  ? $data->value['subtitle3'] : '' }}">
                                    @error('subtitle3')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description 3</label>
                                    <textarea name="deskripsi3" id="text_id3" cols="30" rows="10" class="form-control">{{ $data && isset($data->value['deskripsi3'])  ? $data->value['deskripsi3'] : '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Subtitle 4</label>
                                    <input type="text" name="subtitle4" class="form-control @error('subtitle4') border-danger @enderror" value="{{ $data && isset($data->value['subtitle4'])  ? $data->value['subtitle4'] : '' }}">
                                    @error('subtitle4')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description 4</label>
                                    <textarea name="deskripsi4" id="text_id4" cols="30" rows="10" class="form-control">{{ $data && isset($data->value['deskripsi4'])  ? $data->value['deskripsi4'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <button type="submit"
                        data-initial-text="Update <i class='icon-paperplane ml-2'></i>"
                        data-loading-text="<i class='fas fa-spinner fa-spin'></i> Loading..."
                        class="btn btn-primary"> Save Changes </button>
                    </div>
                </div>
            </form>
        </section>
    </div>

@endsection

@section('script')
<script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
<script>
    $(function(){
        var textarea1 = document.getElementById('text_id1');
        CKEDITOR.replace(textarea1);
    })
    $(function(){
        var textarea2 = document.getElementById('text_id2');
        CKEDITOR.replace(textarea2);
    })
    $(function(){
        var textarea3 = document.getElementById('text_id3');
        CKEDITOR.replace(textarea3);
    })
    $(function(){
        var textarea4 = document.getElementById('text_id4');
        CKEDITOR.replace(textarea4);
    })
</script>
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
            $('.image-upload-wrap').hide();

            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();

            $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }

    $(function (){
        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });

        $('.image-upload-wrap').bind('dragleave', function () {
                $('.image-upload-wrap').removeClass('image-dropping');
        });
    });

    

    function readURL2(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
            $('.image-upload-wrap-2').hide();
            
            $('.file-upload-image-2').attr('src', e.target.result);
            $('.file-upload-content-2').show();

            $('.image-title-2').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload2() {
        $('.file-upload-input-2').replaceWith($('.file-upload-input-2').clone());
        $('.file-upload-content-2').hide();
        $('.image-upload-wrap-2').show();
        $('.file-upload-image-2').attr('src', imageUrl);
        
    }

    $(function (){
        $('.image-upload-wrap-2').bind('dragover', function () {
            $('.image-upload-wrap-2').addClass('image-dropping');
        });

        $('.image-upload-wrap-2').bind('dragleave', function () {
                $('.image-upload-wrap-2').removeClass('image-dropping');
        });
    });


    
    function readURL3(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
            $('.image-upload-wrap-3').hide();
            
            $('.file-upload-image-3').attr('src', e.target.result);
            $('.file-upload-content-3').show();

            $('.image-title-3').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload3() {
        $('.file-upload-input-3').replaceWith($('.file-upload-input-3').clone());
        $('.file-upload-content-3').hide();
        $('.image-upload-wrap-3').show();
        $('.file-upload-image-3').attr('src', imageUrl);
        
    }

    $(function (){
        $('.image-upload-wrap-3').bind('dragover', function () {
            $('.image-upload-wrap-3').addClass('image-dropping');
        });

        $('.image-upload-wrap-3').bind('dragleave', function () {
                $('.image-upload-wrap-3').removeClass('image-dropping');
        });
    });

    </script>
    @if(Session::get('create'))
        <script type="text/javascript">
            $(document).ready(function(){

             // Success Type
                toastr['success']('Successfully Create Data.', 'Successfully', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                });

            });
        </script>
    @endif

    @if(Session::get('update'))
    <script type="text/javascript">
        $(document).ready(function(){

            // Success Type
            toastr['success']('Successfully Update Data.', 'Successfully', {
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
            });

        });
    </script>
    @endif

@endsection