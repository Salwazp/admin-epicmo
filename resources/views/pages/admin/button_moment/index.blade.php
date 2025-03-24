@extends('layouts.admin.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <h2>Manage Button Moments</h2>
    </div>
</div>

<div class="content-body">
    <section>
        <form action="{{ route('admin.button_moment.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="link_button">Button Link</label>
                <input type="url" name="link_button" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Button</button>
        </form>
    </section>

    <section class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Button Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buttons as $index => $button)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $button->title }}</td>
                        <td><a href="{{ $button->link_button }}" target="_blank">View</a></td>
                        <td>
                            <a href="{{ route('admin.button_moment.edit', $button->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.button_moment.delete', $button->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
