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
                            <li class="breadcrumb-item"><a href="{{ request()->route("admin.gallery") }}">Gallery Image</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @if ($data == null)
                                Create Gallery Image 
                                @else
                                Update Gallery Image: 
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
            <form action="{{ route('admin.gallery.image.update', $data->id) }}" method="POST" enctype="multipart/form-data"> <!-- jika form tambah -->
            @endif
                @csrf
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if ($data == null)
                                    Create Gallery Image
                                    @else
                                    Update Gallery Image {{ $data->dimensi }}
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="file-upload  @error('image') border-danger @enderror">
                                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add image</button>
                                                <div class="image-upload-wrap">
                                                    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image" />
                                                    <div class="drag-text">
                                                        @if ($data !== null)
                                                            <img class="file-upload-image" src="{{ $data->image }}" alt="your image" />
                                                        @else
                                                        <h3>Drag and drop a file or select add image</h3>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="file-upload-content">
                                                    <img class="file-upload-image" src="" alt="your image" />
                                                    <div class="image-title-wrap">
                                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded image</span></button>
                                                    </div>
                                                </div>
                                                <small class="text-danger">** Max 2mb, Format : JPG, PNG, JPEG</small>
                                                <br>
                                                @error('image')
                                                    <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="dimensi" class="form-control @error('dimensi') border-danger @enderror" value="{{ $data ? $data->dimensi : '' }}">
                                    @error('dimensi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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