@extends('includes/master')
@section('content')
    <div class="container">
        <div class="card m-5">
            <div class="card-header d-flex justify-content-center">
                <h1>
                    Add a new Category
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
                <form class="row" action="/admin/createCat" method="POST">
                    @csrf
                    <div class="col-md-6 p-4">
                        <label class="form-label">Category name</label>
                        <input class="form-control" name="name">
                    </div>



                    <div class="col-md-6 p-4">
                        <label class="form-label">Parent category name</label>
                        <select class="form-select" aria-label="Default select example" name="parent_id">

                            <option selected value=0>Not sub-category</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4 p-4 m-2">
                        <button type="submit" class="btn btn-primary">Creat category</button>
                    </div>


                </form>
            </div>
        </div>

    </div>
@endsection
