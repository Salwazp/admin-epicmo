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
                            <li class="breadcrumb-item"><a href="{{ request()->route("admin.contact") }}">Contact</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @if ($data == null)
                                Create Contact
                                @else
                                Update Contact:
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
            <form action="{{ route('admin.contact.update', $data->id) }}" method="POST" enctype="multipart/form-data"> <!-- jika form tambah -->
            @else
            <form action="{{ route('admin.contact.store') }}" id="jquery-val-form" method="POST" enctype="multipart/form-data"> <!-- jika form edit -->
            @endif
                @csrf
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if ($data == null)
                                    Create Contact
                                    @else
                                    Update Contact
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Location</label>
                                    <textarea name="lokasi" id="text_id" cols="30" rows="10" class="form-control">{{ isset($data->value['lokasi']) ? $data->value['lokasi'] : ''  }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomer Telepon</label>
                                    <input type="text" name="nomer_telepon" class="form-control @error('nomer_telepon') border-danger @enderror" value="{{ isset($data->value['nomer_telepon']) ? $data->value['nomer_telepon'] : ''  }}">
                                    @error('nomer_telepon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control @error('email') border-danger @enderror" value="{{ isset($data->value['email']) ? $data->value['email'] : ''  }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Google Maps URL</label>
                                    <input type="text" name="maps" class="form-control @error('maps') border-danger @enderror" value="{{ isset($data->value['maps']) ? $data->value['maps'] : ''  }}">
                                    @error('maps')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Facebook</label>
                                    <input type="text" name="facebook" class="form-control @error('facebook') border-danger @enderror" value="{{ isset($data->value['facebook']) ? $data->value['facebook'] : ''  }}">
                                    @error('facebook')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Instagram</label>
                                    <input type="text" name="instagram" class="form-control @error('instagram') border-danger @enderror" value="{{ isset($data->value['instagram']) ? $data->value['instagram'] : ''  }}">
                                    @error('instagram')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">LinkedIn</label>
                                    <input type="text" name="linkedin" class="form-control @error('linkedin') border-danger @enderror" value="{{ isset($data->value['linkedin']) ? $data->value['linkedin'] : ''  }}">
                                    @error('linkedin')
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
    $(function(){
        var textarea1 = document.getElementById('text_id');
        CKEDITOR.replace(textarea1);
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