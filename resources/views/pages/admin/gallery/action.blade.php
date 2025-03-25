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
                            <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}">Banner</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @if ($data == null)
                                    Create Banner
                                @else
                                    Update Banner: {{ $data->title }}
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
                <form action="{{ route('admin.banner.update', $data->id) }}" method="POST" enctype="multipart/form-data" id="banner-form">
            @else
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data" id="banner-form">
            @endif
            @csrf
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                @if ($data == null)
                                    Create Banner
                                @else
                                    Update Banner
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
                                <label for="highlight_text">Highlight Text</label>
                                <input type="text" id="highlight_text" name="highlight_text"
                                    class="form-control @error('highlight_text') border-danger @enderror"
                                    value="{{ $data ? $data->highlight_text : '' }}">
                                @error('highlight_text')
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
                                <label>Buttons</label>
                                <input type="hidden" name="buttons" id="buttonsJsonInput">

                                <div class="card p-2 mb-2">
                                    <h6 class="mb-1">Button 1</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-1">
                                            <label for="button1_text">Button Text</label>
                                            <input type="text" class="form-control"
                                                id="button1_text"
                                                placeholder="e.g. Pesan Sekarang!">
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label for="button1_link">Button Link</label>
                                            <input type="text" class="form-control"
                                                id="button1_link"
                                                placeholder="e.g. https://wa.me/your-number">
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label for="button1_style">Button Style</label>
                                            <select class="form-control" id="button1_style">
                                                <option value="primary">Primary</option>
                                                <option value="outline">Outline</option>
                                                <option value="secondary">Secondary</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card p-2 mb-2">
                                    <h6 class="mb-1">Button 2</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-1">
                                            <label for="button2_text">Button Text</label>
                                            <input type="text" class="form-control"
                                                id="button2_text" placeholder="e.g. View Gallery">
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label for="button2_link">Button Link</label>
                                            <input type="text" class="form-control"
                                                id="button2_link"
                                                placeholder="e.g. #gallery-section">
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label for="button2_style">Button Style</label>
                                            <select class="form-control" id="button2_style">
                                                <option value="primary">Primary</option>
                                                <option value="outline" selected>Outline</option>
                                                <option value="secondary">Secondary</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @error('buttons')
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
    <!-- Updated to latest LTS version of CKEditor -->
    <script src="https://cdn.ckeditor.com/4.25.1-lts/full/ckeditor.js"></script>
    <script>
        $(function() {
            var textarea1 = document.getElementById('text_id');
            CKEDITOR.replace(textarea1, {
                removePlugins: 'exportpdf',
                extraAllowedContent: 'span()[]{};div()[]{};p()[]{};br()[]{};a()[]{*}',
                disallowedContent: 'script; [on]'
            });

            let buttonsData = [];

            @if ($data && isset($data->buttons))
                try {
                    buttonsData = {!! $data->buttons !!};
                } catch (e) {
                    console.error("Error parsing buttons JSON");
                }
            @endif

            // Populate form fields with data
            if (buttonsData.length > 0) {
                $('#button1_text').val(buttonsData[0].text || '');
                $('#button1_link').val(buttonsData[0].link || '');
                $('#button1_style').val(buttonsData[0].style || 'primary');
            }

            if (buttonsData.length > 1) {
                $('#button2_text').val(buttonsData[1].text || '');
                $('#button2_link').val(buttonsData[1].link || '');
                $('#button2_style').val(buttonsData[1].style || 'outline');
            }

            // Update hidden field on form submission
            $('#banner-form').on('submit', function() {
                const buttonsJson = JSON.stringify([{
                        text: $('#button1_text').val(),
                        link: $('#button1_link').val(),
                        style: $('#button1_style').val()
                    },
                    {
                        text: $('#button2_text').val(),
                        link: $('#button2_link').val(),
                        style: $('#button2_style').val()
                    }
                ]);

                $('#buttonsJsonInput').val(buttonsJson);
            });
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