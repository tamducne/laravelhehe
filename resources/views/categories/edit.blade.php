<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Cate moi ne{{ $category->name }}</title>
</head>
<body>
    <h1>Edit Cate moi ne </h1>
    
    <form action="{{ route('category.update', $category) }}" method="post">
    @csrf
    @method('PUT')
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required value="{{ $category->name }}">
    <button type="submit">Save</button>
    </form>
</body>
</html>
