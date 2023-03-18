@extends('admin/dashboard')
@section('admin-content')
    <div class="container">

        @include('includes/flash-message')



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
                            <th scope="col">Call ID</th>
                            <th scope="col" colspan="2">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($issues as $issue)
                            <tr>
                                <th scope="row">{{ $issue['id'] }}</th>
                                <td>{{ $issue['book_id'] }}_{{ $issue['book']? $issue['book']['bookname'] : 'BOOK DELETED' }}</td>
                                <td>{{ $issue['user_id'] }}_{{ $issue['user']['name'] }}</td>
                                <td>{{ $issue['approval'] }}</td>
                                <td>{{ $issue['book']['callid'] }}</td>
                                
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
