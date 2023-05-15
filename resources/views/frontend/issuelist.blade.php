@extends('includes/master')
@section('content')
    <div class="container mt-5">


        @include('includes/flash-message')


        <div class="card m-5">
            <div class="card-header p-3">
                <h3 class=" d-flex justify-content-center ">
                    List of book issued
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
                                <td>
                                    {{-- {{ $issue['date_of_return']? $issue['date_of_return'] : 'Not approved yet' }} --}}
                                    @if($issue['date_of_return'])
                                        {{$issue['date_of_return']}}
                                        @else 
                                            <a href="/issue/{{ $issue->id }}/cancel" class="text-white btn btn-danger">Cancel</a>
                                    @endif
                                </td>
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
                                    <a href="/pay-fine/{{ $issue->id }}" class="text-white btn btn-warning">Pay fine</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>












    </div>
@endsection
