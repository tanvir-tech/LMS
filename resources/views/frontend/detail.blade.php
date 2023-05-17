@extends('includes/master')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


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
                                    <button type="submit" class="btn btn-danger delete-confirm">Delete</button>
                                </form>
                            </div>
                        </div>
                    @elseif(Auth::guard('web')->check() && Auth::user()->hasRole('user'))

                        <form action="/borrow" method="GET" >
                            <div class="row">
                                <div class="col-md-3"> 
                                    <select class="form-select" aria-label="Default select example" name="booktoken_id">
                                        @foreach ($booktokens as $booktoken)
                                            <option value="{{$booktoken->id}}">{{$booktoken->book_copy_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="hidden" name="book_id" value="{{ $book['id'] }}">
                                    <button type="submit" class="btn btn-success">Borrow</button>
                                </div>
                            </div>
                        </form>
                        
                        
                    @endif
                </div>

            </div>

        </div>


    </div>
    {{-- Book card end --}}




    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>








</div>
@endsection
