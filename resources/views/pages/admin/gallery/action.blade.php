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
                            <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @if ($data == null)
                                Create Gallery 
                                @else
                                Update Gallery 
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
            @if ($data == null)
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @else
            <form action="{{ route('admin.gallery.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if ($data == null)
                                    Create Gallery
                                    @else
                                    Update Gallery
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control @error('title') border-danger @enderror" value="{{ $data ? $data->title : old('title') }}" required>
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
                                
                                <div class="form-group">
                                    <label for="text_id">Description</label>
                                    <textarea name="description" id="text_id" cols="30" rows="10" class="form-control">{{ $data ? $data->description : '' }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            @if ($data == null)
                            Create Gallery
                            @else
                            Update Gallery
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.25.1-lts/full/ckeditor.js"></script>
    <script>
        $(function() {
            var textarea1 = document.getElementById('text_id');
            CKEDITOR.replace(textarea1, {
                removePlugins: 'exportpdf',
                extraAllowedContent: 'span(*)[*]{*};div(*)[*]{*};p(*)[*]{*};br(*)[*]{*};a(*)[*]{*}',
                disallowedContent: 'script; *[on*]'
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