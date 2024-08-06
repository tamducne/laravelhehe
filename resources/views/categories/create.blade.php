<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Them Cate moi ne</title>
</head>
<body>
    <h1>Them Cate moi ne </h1>
    
    <form action="{{ route('category.store', $category) }}" method="post">
    @csrf
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">Save</button>
    </form>
</body>
</html>