<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('test.store')}}" method="post">
        @csrf
        <label for="name">masukan nama:</label>
        <input type="text" name="name" id="name" placeholder="name" >
        <br>
        <br>
        <!-- <label for="name">masukan Gambar:</label>
        <input type="file" name="image" id="iamge" placeholder="masukan gambar" > -->
        <br>
        <br>
        <button type="submit">simpan</button>
    </form>

    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Nama</th>
                <th>gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tests as $test )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$test->id}}</td>
                <td>{{$test->name}}</td>
                <!-- <td>{{$test->image}}</td> -->
                <td>{{$test->create_at}}</td>
                <td>
                    @if (isset($test))
                        <form action="{{route('test.destroy', $test->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">delete</button>
                        </form>
                    @else
                        <p>data ngga ada</p>
                    @endif
                </td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
</body>
</html>