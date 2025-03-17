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
                            <li class="breadcrumb-item"><a href="{{ request()->route("admin.about") }}">About</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @if ($data == null)
                                Create About
                                @else
                                Update About: {{ $data->text }}
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
            <form action="{{ route('admin.about.update', $data->id) }}" method="POST" enctype="multipart/form-data"> <!-- jika form tambah -->
            @else
            <form action="{{ route('admin.about.store') }}" id="jquery-val-form" method="POST" enctype="multipart/form-data"> <!-- jika form edit -->
            @endif
                @csrf
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if ($data == null)
                                    Create About
                                    @else
                                    Update About
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="file-upload  @error('banner') border-danger @enderror" style="width:100%">
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add banner</button>
                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="banner" />
                                                <div class="drag-text">
                                                    @if ($data !== null)
                                                        <img class="file-upload-image" src="{{ $data && isset($data->banner) ? ($data->banner) : ''  }}" alt="your image" />
                                                    @else
                                                        <h3>** Max 2mb, Format : JPG, PNG, JPEG</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content">
                                                <img class="file-upload-image" src="{{ $data ? $data->banner : '' }}" alt="your image" />
                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded banner</span></button>
                                                </div>
                                            </div>
                                            <div class="mt--1">
                                                <small class="text-danger">** Max 2mb, Format : JPG, PNG, JPEG</small>
                                                {{-- <small class="text-danger float-right">Dimensions : 180px X 158px</small> --}}
                                            </div>
                                            @error('banner')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="file-upload-2  @error('image') border-danger @enderror" style="width: 100%;">
                                            <button class="file-upload-btn-2" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add image</button>
                                            <div class="image-upload-wrap-2">
                                                <input class="file-upload-input-2" type='file' onchange="readURL2(this);" accept="image/*" name="image" />
                                                <div class="drag-text-2">
                                                    @if ($data !== null)
                                                        <img class="file-upload-image-2" src="{{ $data && isset($data->image) ? $data->image : '' }}" alt="your image" />
                                                    @else
                                                    <h3>** Max 2mb, Format : JPG, PNG, JPEG</h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="file-upload-content-2">
                                                <img class="file-upload-image-2" src="{{ $data ? $data->image : '' }}" alt="your image" />
                                                <div class="image-title-wrap-2">
                                                    <button type="button" onclick="removeUpload2()" class="remove-image-2">Remove <span class="image-title">Uploaded Icons</span></button>
                                                </div>
                                            </div>
                                            <div class="mt--1">
                                                <small class="text-danger">** Max 2mb, Format : JPG, PNG, JPEG</small> 
                                                {{-- <small class="text-danger float-right">Dimensions : 16px X 16px</small> --}}
                                            </div>
                                            @error('image')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Visi</label>
                                    <textarea name="visi" id="text_id1" cols="30" rows="10" class="form-control">{{ $data ? $data->visi : '' }}</textarea>
                                    @error('visi')
                                        <span class="text-danger">*{{ $message }}</span>
                                     @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Misi</label>
                                    <textarea name="misi" id="text_id2" cols="30" rows="10" class="form-control">{{ $data ? $data->misi : '' }}</textarea>
                                    @error('misi')
                                        <span class="text-danger">*{{ $message }}</span>
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
                removeUpload2();
            }
        }
    
        function removeUpload2() {
            $('.file-upload-input-2').replaceWith($('.file-upload-input-2').clone());
            $('.file-upload-content-2').hide();
            $('.image-upload-wrap-2').show();
        }
    
        $(function (){
            $('.image-upload-wrap-2').bind('dragover', function () {
                $('.image-upload-wrap-2').addClass('image-dropping-2');
            });
    
            $('.image-upload-wrap-2').bind('dragleave', function () {
                    $('.image-upload-wrap-2').removeClass('image-dropping-2');
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