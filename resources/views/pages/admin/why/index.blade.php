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
                            <li class="breadcrumb-item"><a href="{{ route('admin.why.index') }}">Why Choose</a>
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
            <form action="{{ route('admin.why.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @else
            <form action="{{ route('admin.why.store') }}" id="jquery-val-form" method="POST" enctype="multipart/form-data">
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
                                    <div class="col-md-12">
                                        <div class="file-upload @error('image') border-danger @enderror" style="width:100%">
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger('click')">Add image</button>
                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image" />
                                                <div class="drag-text">
                                                    @if ($data !== null && $data->image)
                                                        <img class="file-upload-image" src="{{ Storage::url($data->image) }}" alt="your image" />
                                                    @else
                                                        <h3>Drag and drop a file or select add image</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content">
                                                <img class="file-upload-image" src="{{ $data && $data->image ? Storage::disk('s3')->url($data->image) : '' }}" alt="your image" />
                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded image</span></button>
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
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <input type="text" name="title" class="form-control @error('title') border-danger @enderror" value="{{ $data ? $data->title : '' }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="highlight_text">Highlight Text</label>
                                            <input type="text" id="highlight_text" name="highlight_text" class="form-control @error('highlight_text') border-danger @enderror" value="{{ $data ? $data->highlight_text : old('highlight_text') }}" required>
                                            @error('highlight_text')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Section 1 -->
                                <div class="form-group">
                                    <label for="">Subtitle 1</label>
                                    <input type="text" name="subtitle1" class="form-control @error('subtitle1') border-danger @enderror" value="{{ $data && isset($data->value['subtitle1'])  ? $data->value['subtitle1'] : '' }}">
                                    @error('subtitle1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Icon 1</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="icon1" name="icon1" accept="image/*, .gif">
                                        <label class="custom-file-label" for="icon1">Choose icon (image or gif)</label>
                                    </div>
                                    @if($data && isset($data->value['icon1']))
                                        <div class="mt-2">
                                            <img src="{{ Storage::disk('s3')->url($data->value['icon1']) }}" alt="Icon 1" style="max-width: 50px; max-height: 50px;">
                                        </div>
                                    @endif
                                    @error('icon1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted">Max 1mb, Supported formats: PNG, JPG, JPEG, GIF</small>
                                </div>
                                <div class="form-group">
                                    <label for="">Description 1</label>
                                    <textarea name="deskripsi1" id="text_id1" cols="30" rows="10" class="form-control">{{ $data && isset($data->value['deskripsi1'])  ? $data->value['deskripsi1'] : '' }}</textarea>
                                </div>

                                <!-- Section 2 -->
                                <div class="form-group">
                                    <label for="">Subtitle 2</label>
                                    <input type="text" name="subtitle2" class="form-control @error('subtitle2') border-danger @enderror" value="{{ $data && isset($data->value['subtitle2'])  ? $data->value['subtitle2'] : '' }}">
                                    @error('subtitle2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Icon 2</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="icon2" name="icon2" accept="image/*, .gif">
                                        <label class="custom-file-label" for="icon2">Choose icon (image or gif)</label>
                                    </div>
                                    @if($data && isset($data->value['icon2']))
                                        <div class="mt-2">
                                            <img src="{{ Storage::disk('s3')->url($data->value['icon2']) }}" alt="Icon 2" style="max-width: 50px; max-height: 50px;">
                                        </div>
                                    @endif

                                    @error('icon2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted">Max 1mb, Supported formats: PNG, JPG, JPEG, GIF</small>
                                </div>
                                <div class="form-group">
                                    <label for="">Description 2</label>
                                    <textarea name="deskripsi2" id="text_id2" cols="30" rows="10" class="form-control">{{ $data && isset($data->value['deskripsi2'])  ? $data->value['deskripsi2'] : '' }}</textarea>
                                </div>

                                <!-- Section 3 -->
                                <div class="form-group">
                                    <label for="">Subtitle 3</label>
                                    <input type="text" name="subtitle3" class="form-control @error('subtitle3') border-danger @enderror" value="{{ $data && isset($data->value['subtitle3'])  ? $data->value['subtitle3'] : '' }}">
                                    @error('subtitle3')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Icon 3</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="icon3" name="icon3" accept="image/*, .gif">
                                        <label class="custom-file-label" for="icon3">Choose icon (image or gif)</label>
                                    </div>
                                    @if($data && isset($data->value['icon3']))
                                        <div class="mt-2">
                                            <img src="{{ Storage::disk('s3')->url($data->value['icon3']) }}" alt="Icon 3" style="max-width: 50px; max-height: 50px;">
                                        </div>
                                    @endif

                                    @error('icon3')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted">Max 1mb, Supported formats: PNG, JPG, JPEG, GIF</small>
                                </div>
                                <div class="form-group">
                                    <label for="">Description 3</label>
                                    <textarea name="deskripsi3" id="text_id3" cols="30" rows="10" class="form-control">{{ $data && isset($data->value['deskripsi3'])  ? $data->value['deskripsi3'] : '' }}</textarea>
                                </div>

                                <!-- Section 4 -->
                                <div class="form-group">
                                    <label for="">Subtitle 4</label>
                                    <input type="text" name="subtitle4" class="form-control @error('subtitle4') border-danger @enderror" value="{{ $data && isset($data->value['subtitle4'])  ? $data->value['subtitle4'] : '' }}">
                                    @error('subtitle4')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Icon 4</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="icon4" name="icon4" accept="image/*, .gif">
                                        <label class="custom-file-label" for="icon4">Choose icon (image or gif)</label>
                                    </div>
                                    @if($data && isset($data->value['icon4']))
                                        <div class="mt-2">
                                            <img src="{{ Storage::disk('s3')->url($data->value['icon4']) }}" alt="Icon 4" style="max-width: 50px; max-height: 50px;">
                                        </div>
                                    @endif
                                    @error('icon4')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted">Max 1mb, Supported formats: PNG, JPG, JPEG, GIF</small>
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
    
    // Display file name for custom file inputs
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
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

    @if(Session::get('delete'))
    <script type="text/javascript">
        $(document).ready(function(){

            // Success Type
            toastr['success']('Successfully Delete Data.', 'Successfully', {
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
            });

        });
    </script>
    @endif
@endsection