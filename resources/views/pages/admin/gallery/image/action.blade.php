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
                            <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a>
                            </li>
                            <li class="breadcrumb-item active">Image</li>
                            <li class="breadcrumb-item active">
                                @if (empty($data))
                                    Create Gallery Image
                                @else
                                    Update Gallery Image
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
            @if (!empty($data))
                <form action="{{ route('admin.gallery.image.update', $data->id) }}" method="POST" enctype="multipart/form-data" id="gallery-image-form">
            @else
                <form action="{{ route('admin.gallery.image.store') }}" method="POST" enctype="multipart/form-data" id="gallery-image-form">
            @endif
            @csrf
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                @if (empty($data))
                                    Create Gallery Image
                                @else
                                    Update Gallery Image
                                @endif
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="file-upload @error('image') border-danger @enderror">
                                            <button class="file-upload-btn" type="button"
                                                onclick="$('.file-upload-input').trigger('click')">Add image</button>
                                            <div class="image-upload-wrap" style="{{ !empty($data) && !empty($data->image) ? 'display: none;' : '' }}">
                                                <input class="file-upload-input" type='file' onchange="readURL(this);"
                                                    accept="image/*" name="image" />
                                                <div class="drag-text">
                                                    <h3>Drag and drop a file or select add image</h3>
                                                </div>
                                            </div>
                                            <div class="file-upload-content" style="{{ !empty($data) && !empty($data->image) ? 'display: block;' : '' }}">
                                                <img class="file-upload-image"
                                                    src="{{ !empty($data) && !empty($data->image) ? $data->image : '' }}" alt="your image" />
                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload()"
                                                        class="remove-image">Remove <span class="image-title">Uploaded
                                                            image</span></button>
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
                                <label for="display_order">Display Order</label>
                                <input type="number" id="display_order" name="display_order"
                                    class="form-control @error('display_order') border-danger @enderror"
                                    value="{{ !empty($data) ? $data->display_order : '' }}" min="1">
                                @error('display_order')
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
                        data-initial-text="{{ !empty($data) ? 'Update' : 'Save' }} <i class='icon-paperplane ml-2'></i>"
                        data-loading-text="<i class='fas fa-spinner fa-spin'></i> Loading..."
                        class="btn btn-primary"> 
                        {{ !empty($data) ? 'Update' : 'Save' }} Changes 
                    </button>
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
            $('.file-upload-input').val('');
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }

        $(document).ready(function() {
            $('.image-upload-wrap').bind('dragover', function() {
                $('.image-upload-wrap').addClass('image-dropping');
            });

            $('.image-upload-wrap').bind('dragleave', function() {
                $('.image-upload-wrap').removeClass('image-dropping');
            });

            // Submit form with loading state
            $('#gallery-image-form').on('submit', function() {
                const submitButton = $(this).find('button[type="submit"]');
                const initialText = submitButton.data('initial-text');
                const loadingText = submitButton.data('loading-text');
                
                submitButton.html(loadingText);
                submitButton.prop('disabled', true);
                
                return true;
            });
        });
    </script>
    
    @if (Session::get('create'))
        <script>
            $(document).ready(function() {
                toastr['success']('Successfully Create Data.', 'Successfully', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                });
            });
        </script>
    @endif

    @if (Session::get('update'))
        <script>
            $(document).ready(function() {
                toastr['success']('Successfully Update Data.', 'Successfully', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                });
            });
        </script>
    @endif
@endsection