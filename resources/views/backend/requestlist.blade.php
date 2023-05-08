@extends('admin/dashboard')
@section('admin-content')


<div class="container bg-light p-5">
    <h1>Book requests to bring</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>User_ID</th>
                <th>Book name</th>
                <th>Author name</th>
                <th>Publisher</th>
                <th>Edition</th>
                <th>Year</th>
                <th>Language</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookrequests as $bookrequest)
            <tr>
                <td>{{ $bookrequest['id'] }}</td>
                <td>{{ $bookrequest['user_id'] }}</td>
                <td>{{ $bookrequest['bookname'] }}</td>
                <td>{{ $bookrequest['authorname'] }}</td>
                <td>{{ $bookrequest['publisher'] }}</td>
                <td>{{ $bookrequest['edition'] }}</td>
                <td>{{ $bookrequest['year'] }}</td>
                <td>{{ $bookrequest['language'] }}</td>
                <td width="200px">
                    <button class="btn btn-success">Avail</button>
                    <button class="btn btn-danger">Cancel</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>






@endsection