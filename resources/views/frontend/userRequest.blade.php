@extends('includes/master')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h1>
                    Book Request
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
                <form class="row" action="/request" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 p-4">
                        <label class="form-label">Book Name</label>
                        <input class="form-control" name="bookname">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Author Name</label>
                        <input class="form-control" name="authorname">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Publisher</label>
                        <input class="form-control" name="publisher">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Category</label>
                        <input class="form-control" name="category">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Edition</label>
                        <input type="number" class="form-control" name="edition">
                    </div>
                    <div class="col-md-6 p-4">
                        <label class="form-label">Language</label>
                        <input class="form-control" name="language">
                    </div>
                    

                    <div class="col-md-4 p-4 m-2">
                        <button type="submit" class="btn btn-primary">Request</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
