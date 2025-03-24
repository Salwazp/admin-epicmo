@extends('layouts.admin.app')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Moment</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <!-- Tombol Add Moment -->
        <a href="{{ route('admin.moment.create') }}" class="btn btn-primary mb-3">Add Moment</a>

        <!-- Basic table -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $moment)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        @if($moment->image)
                            <img src="{{ asset('storage/' . $moment->image) }}" width="100" alt="Moment Image">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $moment->title }}</td>
                    <td>{{ $moment->description }}</td>
                    <td>
                        <a href="{{ route('admin.moment.edit', $moment->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('admin.moment.delete', $moment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!--/ Basic table -->
    </div>
@endsection
