@extends('includes/master')
@section('content')
    <div class="container mt-5">
        <div class="col-lg-10 bg-info text-white rounded d-flex justify-content-center p-2 m-2">
            <form action="/yearfilter" method="POST">
                @csrf
                <h3 class="text-center">Year filter</h3>
                <div class="row p-2">
                    <div class="col-md-4">
                        <input class="form-control mr-sm-2" type="number" placeholder="Early" name="early">
                    </div>
                    <div class="col-md-4">
                        <input class="form-control mr-sm-2" type="number" placeholder="Late" name="late">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" type="submit">Find</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container mt-5">
        @include('includes/flash-message')
        <div class="row">
            @foreach ($books as $book)
            {{-- Book card start --}}

            <div class="card bg-secondary col-md-3 p-2 m-2">
                <a href="/detail/{{ $book['id'] }}">
                    <div class="card-body">
                        <img class="bookimg" src="{{ asset('gallery/' . $book['bookcoverlink']) }}" alt="Book photo">
                    </div>
                    <div class="card-footer text-white">
                        <h3>{{ $book['bookname'] }}</h3>
                        {{-- <h5>Edition : {{ $book['edition'] }}</h5> --}}
                        <h6>Author : {{ $book['authorname'] }}</h6>
                        {{-- <h6>Category: {{ $book['category']['name'] }}</h6> --}}
                        {{-- <h6>Publisher: {{ $book['publisher'] }}</h6> --}}
                        <h6>Publication year: {{ $book['year'] }}</h6>
                    </div>
                </a>
            </div>

            {{-- Book card end --}}
        @endforeach
        </div>









    </div>
@endsection
