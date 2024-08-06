<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sach cate</title>
</head>

<body>
    <h1>Danh sach cate</h1>
    <a href="{{ route('category.create') }}">Add new</a>
    @if (@session('success'))
        <h2>{{ session('success') }}</h2>
    @endif
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Start</th>
            <th>Update</th>
            <th>Action</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                    <a href="{{ route('category.show', $item) }}">Show</a>
                    <a href="{{ route('category.edit', $item) }}">Edit</a>
                    <form action="{{ route('category.destroy', $item) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Chắc chắn muốn xóa không')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $data->links() }}
</body>

</html>
