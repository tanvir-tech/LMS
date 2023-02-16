@extends('includes/master')
@section('content')
    <div class="container">





        <div class="card m-5">
            <div class="card-header d-flex justify-content-center p-3">
                <h3>
                    Approval for book issue
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book_ID</th>
                            <th scope="col">User_ID</th>
                            <th scope="col">Approval</th>
                            <th scope="col">Date of Return</th>
                            <th scope="col" colspan="2">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <th scope="row">1</th>
                            <td>3</td>
                            <td>2</td>
                            <td>0</td>
                            <td>02-05-2023</td>
                            <td>
                                <button class="btn btn-warning">
                                    Renew
                                </button>
                                <button class="btn btn-success">
                                    Receive
                                </button>
                            </td>
                        </tr> --}}
                        @foreach ($issues as $issue)
                            <tr>
                                <th scope="row">{{ $issue['id'] }}</th>
                                <td>{{ $issue['book_id'] }}</td>
                                <td>{{ $issue['user_id'] }}</td>
                                <td>{{ $issue['approval'] }}</td>
                                <td>{{ $issue['date'] }}</td>
                                
                                <td>
                                    <a href="/admin/issue/{{ $issue->id }}/approve" class="text-white btn btn-success">Approve</a>
                                    <a href="/admin/issue/{{ $issue->id }}/deny" class="text-white btn btn-danger">Deny</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>












    </div>
@endsection
