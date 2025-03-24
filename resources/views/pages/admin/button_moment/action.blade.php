@extends('layouts.admin.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <h2>Edit Button Moment</h2>
    </div>
</div>

<div class="content-body">
    <section>
        <form action="{{ route('admin.button_moment.action', $button->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $button->title }}" required>
            </div>
            <div class="form-group">
                <label for="link_button">Button Link</label>
                <input type="url" name="link_button" class="form-control" value="{{ $button->link_button }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update Button</button>
            <a href="{{ route('admin.moment.button') }}" class="btn btn-secondary">Back</a>
        </form>
    </section>
</div>
@endsection
