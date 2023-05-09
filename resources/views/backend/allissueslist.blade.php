@extends('admin/dashboard')
@section('admin-content')
    <div class="container mt-5">


        @include('includes/flash-message')


        <div class="card m-5">
            <div class="card-header p-4">
                <h3 class="float-left">
                    List of book issued
                </h3>
                <div class="float-right">
                    <form class="form-inline my-2 my-lg-0" action="/admin/searchissue" method="GET">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search issue by user ID" aria-label="Search"
                            name="query">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
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
                            <th>Late</th>
                            <th>Fine</th>
                            {{-- <th width="270px">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Carbon\Carbon;
                            $today = Carbon::now();
                        @endphp
                        @foreach ($issues as $issue)
                            <tr>
                                <th scope="row">{{ $issue['id'] }}</th>
                                <td>{{ $issue['book_id'] }}_{{ $issue['book']? $issue['book']['bookname'] : 'BOOK DELETED' }}</td>
                                <td>{{ $issue['user_id'] }}_{{ $issue['user']['name'] }}</td>
                                <td>{{ $issue['approval'] }}</td>
                                <td>{{ $issue['date_of_return'] }}</td>
                                <td>
                                    @php
                                        $late = $today->diff($issue['date_of_return'])->format('%R%a days');
                                        
                                        if (str_contains($late, '+')) {
                                            $lateint = 0;
                                        } else {
                                            $lateint = intval($today->diff($issue['date_of_return'])->format('%a'));
                                        }
                                        
                                    @endphp
                                    {{ $lateint }} days
                                </td>
                                <td>{{ 10 * $lateint }} Taka</td>
                                {{-- <td>
                                    <a href="/admin/issue/{{ $issue->id }}/renew"
                                        class="text-white btn btn-warning">Renew</a>
                                    <a href="/admin/issue/{{ $issue->id }}/receive"
                                        class="text-white btn btn-success">Receive</a>
                                    <a href="/admin/remind/issue/{{ $issue->id }}"
                                        class="text-white btn btn-danger">Remind</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>












    </div>
@endsection
