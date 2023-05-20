@extends('includes/master')
@section('content')
    <div class="container mt-5">
        @include('includes/flash-message')

        <div class="row">
            @foreach ($books as $book)
                {{-- Book card start --}}

                <div class="card bg-secondary col-md-3 ">
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

        
        <div class="container d-flex justify-content-center">
            {!! $books->links() !!}
        </div>
    </div>
@endsection
