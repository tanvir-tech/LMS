@extends('includes/master')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h1>
                    Add a new Book
                </h1>

            </div>
            @include('includes/flash-message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </p>

                </div>
            @endif
            <div class="card-body">
                <form class="row" action="{{ route('book.update' , $book->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="col-md-6 p-4">
                        <label class="form-label">Book Name</label>
                        <input class="form-control" name="bookname" value="{{$book->bookname}}">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Author Name</label>
                        <input class="form-control" name="authorname" value="{{$book->authorname}}">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Publisher</label>
                        <input class="form-control" name="publisher" value="{{$book->publisher}}">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Category</label>
                        <input class="form-control" name="category" value="{{$book->category}}">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Edition</label>
                        <input type="number" class="form-control" name="edition" value="{{$book->edition}}">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Language</label>
                        <input class="form-control" name="language" value="{{$book->language}}">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="{{$book->quantity}}">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Call ID</label>
                        <input class="form-control" name="callid" value="{{$book->callid}}">
                    </div>

                    <div class="col-md-6 p-4">
                        <label for="bookcover">Book cover is not replaceable.</label>
                    </div>

                    <div class="col-md-4 p-4 m-2">
                        <button type="submit" class="btn btn-primary">Update Book</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
