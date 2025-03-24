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
                            <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Event</a>
                            </li>
                            <li class="breadcrumb-item active">Category</li>
                            <li class="breadcrumb-item active">
                                @if ($data == null)
                                    Create Event Category
                                @else
                                    Update Event Category: {{ $data->title }}
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
                <form action="{{ route('admin.event.category.update', $data->id) }}" method="POST" enctype="multipart/form-data" id="event-category-form">
            @else
                <form action="{{ route('admin.event.category.store') }}" method="POST" enctype="multipart/form-data" id="event-category-form">
            @endif
            @csrf
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                @if ($data == null)
                                    Create Event Category
                                @else
                                    Update Event Category
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
                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input" type='file' onchange="readURL(this);"
                                                    accept="image/*" name="image" />
                                                <div class="drag-text">
                                                    @if ($data !== null && isset($data->image))
                                                        <img class="file-upload-image"
                                                            src="{{ $data->image }}"
                                                            alt="your image" />
                                                    @else
                                                        <h3>Drag and drop a file or select add image</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content">
                                                <img class="file-upload-image"
                                                    src="{{ isset($data->image) ? $data->image : '' }}" alt="your image" />
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
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title"
                                    class="form-control @error('title') border-danger @enderror"
                                    value="{{ $data ? $data->title : '' }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text_id">Description</label>
                                <textarea name="description" id="text_id" cols="30" rows="10" class="form-control">{{ $data ? $data->description : '' }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Button</label>
                                <div class="card p-2 mb-2">
                                    <div class="row">
                                        <div class="col-md-5 mb-1">
                                            <label for="button_text">Button Text</label>
                                            <input type="text" name="button_text" id="button_text" class="form-control" 
                                                placeholder="e.g. Pesan Sekarang!" 
                                                value="{{ $data && isset($data->button_text) ? $data->button_text : '' }}">
                                            @error('button_text')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5 mb-1">
                                            <label for="button_link">Button Link</label>
                                            <input type="text" name="button_link" id="button_link" class="form-control" 
                                                placeholder="e.g. https://wa.me/your-number"
                                                value="{{ $data && isset($data->button_link) ? $data->button_link : '' }}">
                                            @error('button_link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 mb-1">
                                            <label for="display_order">Display Order</label>
                                            <input type="number" name="display_order" id="display_order" class="form-control" 
                                                placeholder="1" min="1"
                                                value="{{ $data && isset($data->display_order) ? $data->display_order : '' }}">
                                            @error('display_order')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
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
    <!-- Updated to latest LTS version of CKEditor -->
    <script src="https://cdn.ckeditor.com/4.25.1-lts/full/ckeditor.js"></script>
    <script>
        $(function() {
            var textarea1 = document.getElementById('text_id');
            CKEDITOR.replace(textarea1, {
                removePlugins: 'exportpdf',
                extraAllowedContent: 'span(*)[*]{*};div(*)[*]{*};p(*)[*]{*};br(*)[*]{*};a(*)[*]{*}',
                disallowedContent: 'script; *[on*]'
            });

            // Initialize button data if exists
            @if ($data && isset($data->button_text) && isset($data->button_link))
                $('#button_text').val('{{ $data->button_text }}');
                $('#button_link').val('{{ $data->button_link }}');
            @endif
            
            @if ($data && isset($data->display_order))
                $('#display_order').val({{ $data->display_order }});
            @endif
        });
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

        $(function() {
            $('.image-upload-wrap').bind('dragover', function() {
                $('.image-upload-wrap').addClass('image-dropping');
            });

            $('.image-upload-wrap').bind('dragleave', function() {
                $('.image-upload-wrap').removeClass('image-dropping');
            });
        });
    </script>
    @if (Session::get('create'))
        <script type="text/javascript">
            $(document).ready(function() {
                // Success Type
                toastr['success']('Successfully Create Data.', 'Successfully', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                });
            });
        </script>
    @endif

    @if (Session::get('contact'))
        <script>
            $(document).ready(function() {
                Swal.fire(
                    'Successfully!',
                    'You have successfully subscribed',
                    'success'
                )
            });
        </script>
    @endif
@endsection