@extends('admin/dashboard')
@section('admin-content')
    <div class="container mt-5">


        @include('includes/flash-message')


        <div class="card m-5">
            <div class="card-header p-3">
                <h3 class=" d-flex justify-content-center ">
                    List of book issued
                </h3>
                <a href="/admin/remind/all/issue" class="text-white btn btn-primary d-flex justify-content-center">Remind all</a>
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
                                        // $returnday = date_create($issue['date_of_return']);
                                        // $late=date_diff($returnday,$today)->format('%d days');
                                        // $late=date_diff($today,$returnday)->format('%R%a days');
                                        
                                        // $late = $today->diff($returnday)->days;
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
                                <td>
                                    <a href="/admin/issue/{{ $issue->id }}/renew"
                                        class="text-white btn btn-warning">Renew</a>
                                    <a href="/admin/issue/{{ $issue->id }}/receive"
                                        class="text-white btn btn-success">Receive</a>
                                    <a href="/admin/remind/issue/{{ $issue->id }}"
                                        class="text-white btn btn-danger">Remind</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>












    </div>
@endsection
