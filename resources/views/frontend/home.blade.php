@extends('includes/master')
@section('content')
    <div class="container">
        @include('includes/flash-message')
        @foreach ($books as $book)
            {{-- Book card start --}}
            <div class="card p-2">
                <div class="row">
                    <div class="col-md-3">
                        <img class="bookimg" src="{{ asset('gallery/' . $book['bookcoverlink']) }}" alt="Book photo">
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
                                <div class="row">
                                    <div class="col">
                                        <a href="/admin/book/{{ $book->id }}/edit" class="text-white btn btn-warning">Edit</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('book.destroy', ['book' => $book->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @elseif(Auth::guard('web')->check() && Auth::user()->hasRole('user'))
                                <a href="/book/{{ $book->id }}/borrow" class="text-white btn btn-success">Borrow</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Book card end --}}
        @endforeach









    </div>
@endsection
