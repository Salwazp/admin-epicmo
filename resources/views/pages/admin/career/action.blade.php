@extends('layouts.admin.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Career</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="content-body">
        <section class="bs-validation">
            @if ($data !== null)
            <form action="{{ route('admin.career.update', $data->id) }}" method="POST" enctype="multipart/form-data"> <!-- jika form tambah -->
            @else
            <form action="{{ route('admin.career.store') }}" id="jquery-val-form" method="POST" enctype="multipart/form-data"> <!-- jika form edit -->
            @endif
                @csrf
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if ($data == null)
                                    Create Career
                                    @else
                                    Update Career
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
                                                            <img class="file-upload-image" src="{{ isset($data->image) ? $data->image: '' }}" alt="your image" />
                                                        @else
                                                        <h3>Drag and drop a file or select add image</h3>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="file-upload-content">
                                                    <img class="file-upload-image" src="{{ isset($data->image) ? $data->image: '' }}" alt="your image" />
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
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') border-danger @enderror" value="{{ $data ? $data->title : '' }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date" name="date" class="form-control @error('date') border-danger @enderror" value="{{ $data ? $data->date : '' }}">
                                    @error('date')
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
        function hapus(id){
            var table = $('#data-notif').DataTable();
            clearToastObj = toastr['error'](
                'Are You Delete?<br /><br /><button type="button" class="btn btn-danger btn-sm delete">Yes</button>',
                'Deleted',
                {
                    closeButton: true,
                    timeOut: 0,
                    extendedTimeOut: 0,
                    tapToDismiss: false,
                }
                );
        }
    </script>
    <script>
        $(function (){
            $('.hapus').on('click', function () {
                var id = $(this).attr('data-id');
                console.log(id);
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
