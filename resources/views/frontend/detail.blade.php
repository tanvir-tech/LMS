@extends('includes/master')
@section('content')
    <div class="container mt-5">
        @include('includes/flash-message')
        {{-- Book card start --}}
        <div class="card bg-secondary text-white p-2">
            <div class="row">
                <div class="col-md-3">
                    <img class="bookimg" src="{{ asset('gallery/' . $book['bookcoverlink']) }}" alt="Book photo">
                </div>
                <div class="col-md-9">
                    <div class="card-header">
                        <h3>{{ $book['bookname'] }}</h3>
                        <h5>Edition : {{ $book['edition'] }}</h5>
                        <h6>Author : {{ $book['authorname'] }}</h6>
                        <h6>Category: {{ $book['category']['name'] }}</h6>
                        <h6>Publisher: {{ $book['publisher'] }}</h6>
                        <h6>Publication year: {{ $book['year'] }}</h6>
                    </div>

                    <div class="card-footer">
                        <h6>Available Quantity: {{ $book['quantity'] }}</h6>
                        <h6>Call ID: {{ $book['callid'] }}</h6>



                        @if (Auth::guard('web')->check() && Auth::user()->hasRole('admin'))
                            <div class="row">
                                <div class="col">
                                    <a href="/admin/book/{{ $book->id }}/edit"
                                        class="text-white btn btn-warning">Edit</a>
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









    </div>
@endsection
