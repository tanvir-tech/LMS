@extends('includes/master')
@section('content')
    <div class="container">





        <div class="card m-5">
            <div class="card-header d-flex justify-content-center p-3">
                <h3>
                    List of book issue requests
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book</th>
                            <th scope="col">Author</th>
                            <th scope="col">Member</th>
                            <th scope="col">From</th>
                            <th scope="col">Till</th>
                            <th scope="col" colspan="2">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Live on the edge</td>
                            <td>Writer</td>
                            <td>Username</td>
                            <td>02-05-2023</td>
                            <td>08-05-2023</td>
                            <td>
                                <button class="btn btn-success">
                                    Approve
                                </button>
                                <button class="btn btn-danger">
                                    Deny
                                </button>
                            </td>
                        </tr>
                        {{-- @foreach ($schedules as $schedule)
                            <tr>
                                <th scope="row">{{ $schedule['id'] }}</th>
                                <td>{{ $schedule['faculty'] }}</td>
                                <td>{{ $schedule['course'] }}</td>
                                <td>{{ $schedule['room'] }}</td>
                                <td>{{ $schedule['date'] }}</td>
                                <td>{{ $schedule['start'] }}</td>
                                <td>{{ $schedule['end'] }}</td>
                                <td>
                                    <button class="btn btn-warning">
                                        Edit
                                    </button>

                                </td>
                                <td>
                                    <form action="{{ route('schedule.destroy', ['schedule' => $schedule->id]) }}"
                                        method="POST">
                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>












    </div>
@endsection
