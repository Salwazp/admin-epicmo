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
                            <li class="breadcrumb-item"><a href="{{ request()->route("admin.preference") }}">Preference</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @if ($data == null)
                                Create Preference
                                @else
                                Update Preference:
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
            <form action="{{ route('admin.preference.update', $data->id) }}" method="POST" enctype="multipart/form-data"> <!-- jika form tambah -->
            @else
            <form action="{{ route('admin.preference.store') }}" id="jquery-val-form" method="POST" enctype="multipart/form-data"> <!-- jika form edit -->
            @endif
                @csrf
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if ($data == null)
                                    Create Preference
                                    @else
                                    Update Preference
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="file-upload  @error('logo') border-danger @enderror" style="width: 100%;">
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add logo</button>
                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="logo" />
                                                <div class="drag-text">
                                                    @if ($data !== null)
                                                        <img class="file-upload-image" src="{{ isset($data->value['logo']) ? $data->value['logo'] : '' }}" alt="your image" />
                                                    @else
                                                        <h3>Drag and drop a file or select add logo</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content">
                                                <img class="file-upload-image" src="{{ isset($data->value['logo']) ? $data->value['logo'] : '' }}" alt="your image" />
                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded image</span></button>
                                                </div>
                                            </div>
                                            <small class="text-danger">** Max 1.5mb</small> <br>
                                            @error('logo')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="file-upload  @error('favicon') border-danger @enderror" style="width: 100%;">
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input-2').trigger( 'click' )">Add favicon</button>
                                            <div class="image-upload-wrap-2">
                                                <input class="file-upload-input-2" type='file' onchange="readURL2(this);" accept="image/*" name="favicon" />
                                                <div class="drag-text">
                                                    @if ($data !== null)
                                                        <img class="file-upload-image-2" src="{{ isset($data->value['favicon']) ? $data->value['favicon'] : ''  }}" alt="your image" />
                                                    @else
                                                        <h3>Drag and drop a file or select add favicon</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content-2">
                                                <img class="file-upload-image-2" src="{{ isset($data->value['favicon']) ? $data->value['favicon'] : ''  }}" alt="your image" />
                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload2()" class="remove-image-2">Remove <span class="image-title-2">Uploaded image</span></button>
                                                </div>
                                            </div>
                                            <small class="text-danger">** Max 1.5mb</small> <br>
                                            @error('favicon')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control @error('meta_title') border-danger @enderror" value="{{ isset($data->value['meta_title']) ? $data->value['meta_title'] : ''  }}">
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Meta Description</label>
                                    <textarea name="meta_deskripsi" id="text_id" cols="30" rows="10" class="form-control">{{ isset($data->value['meta_deskripsi']) ? $data->value['meta_deskripsi'] : ''  }}</textarea>
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