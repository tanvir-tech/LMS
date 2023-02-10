@extends('includes/master')
@section('content')
    <div class="container">

        @foreach ($books as $book)
            {{-- Book card start --}}
            <div class="card p-2">
                <div class="row">
                    <div class="col-md-3">
                        <img class="bookimg" src="{{asset('gallery/'.$book['bookcoverlink'])}}"
                            alt="Book photo">
                    </div>
                    <div class="col-md-6">
                        <div class="card-header">
                            <h3>{{ $book['bookname'] }}</h3>
                            <h5>Edition : {{ $book['edition'] }}</h5>
                            <h6>Author : {{ $book['authorname'] }}</h6>
                        </div>

                        <div class="card-body">

                            <p>{{ $book['description'] }}</p>

                        </div>

                        <div class="card-footer">
                            <h6>
                                Category: {{ $book['category'] }}
                                <br>
                                Publisher: {{ $book['publisher'] }}
                            </h6>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="">
                            <h6>
                                Available Quantity: {{ $book['quantity'] }}
                                <br>
                                Call ID: {{ $book['callid'] }}
                            </h6>

                            @if (Auth::guard('web')->check() && Auth::user()->hasRole('admin'))
                                <form action="{{ route('book.destroy', ['book' => $book->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @elseif(Auth::guard('web')->check() && Auth::user()->hasRole('user'))
                                <button class="btn btn-success">
                                    Borrow
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Book card end --}}
        @endforeach









    </div>
@endsection
