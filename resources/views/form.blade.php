<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">

  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('save') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="date">Date</label>
        <input type="datetime-local" class="form-control" id="date" name="date" value="{{ old('date', isset($data) ? $data->date : '') }}" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <input type="number" class="form-control" id="status" name="status" value="{{ old('status', isset($data) ? $data->status : 0) }}">
    </div>

    <div class="form-group">
        <label for="type">Type</label>
        <input type="text" class="form-control" id="type" name="type" maxlength="50" value="{{ old('type', isset($data) ? $data->type : 'post') }}">
    </div>

    <div class="form-group">
        <label for="link">Link</label>
        <input type="url" class="form-control" id="link" name="link" maxlength="2083" value="{{ old('link', isset($data) ? $data->link : '') }}">
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" maxlength="255" value="{{ old('title', isset($data) ? $data->title : '') }}" required>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" rows="4">{{ old('content', isset($data) ? $data->content : '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" maxlength="100" value="{{ old('category', isset($data) ? $data->category : '') }}">
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" id="author" name="author" maxlength="100" value="{{ old('author', isset($data) ? $data->author : '') }}">
    </div>

    <div class="form-group">
        <label for="features_media">Features Media</label>
        <input type="text" class="form-control" id="features_media" name="features_media" maxlength="255" value="{{ old('features_media', isset($data) ? $data->features_media : '') }}">
    </div>

    <div class="form-group">
        <label for="comment_status">Comment Status</label>
        <input type="number" class="form-control" id="comment_status" name="comment_status" value="{{ old('comment_status', isset($data) ? $data->comment_status : 0) }}">
    </div>

    <div class="form-group">
        <label for="ping_status">Ping Status</label>
        <input type="number" class="form-control" id="ping_status" name="ping_status" value="{{ old('ping_status', isset($data) ? $data->ping_status : 0) }}">
    </div>

    <div class="form-group">
        <label for="format">Format</label>
        <input type="text" class="form-control" id="format" name="format" maxlength="50" value="{{ old('format', isset($data) ? $data->format : '') }}">
    </div>

    <div class="form-group">
        <label for="template">Template</label>
        <input type="text" class="form-control" id="template" name="template" maxlength="100" value="{{ old('template', isset($data) ? $data->template : '') }}">
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" maxlength="256" value="{{ old('slug', isset($data) ? $data->slug : '') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

</body>
</html>
