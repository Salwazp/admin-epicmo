@extends('layouts.admin.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Media</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-body">
        <section class="bs-validation">
            @if (isset($data))
                <form action="{{ route('admin.media.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
            @else
                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
            @endif

            @csrf
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                @if (!isset($data))
                                    Create Media
                                @else
                                    Update Media
                                @endif
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- Input Title -->
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control @error('title') border-danger @enderror"
                                    value="{{ isset($data) ? $data->title : '' }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Input Description -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control @error('description') border-danger @enderror">{{ isset($data) ? $data->description : '' }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Input highlight -->
                            <div class="form-group">
                                <label>Text Hightlight</label>
                                <input type="text" name="text_highlight" class="form-control @error('text_highlight') border-danger @enderror"
                                    value="{{ isset($data) ? $data->title : '' }}">
                                @error('text_highlight')
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
                        @if (!isset($data)) Create @else Update @endif
                    </button>
                </div>
            </div>
        </form>
        </section>
    </div>
@endsection
