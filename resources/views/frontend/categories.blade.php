@extends('includes/master')
@section('content')
    <div class="container">


        @php
            use App\Models\Category;
            $categories = Category::where('parent_id', null)->get();
        @endphp
        @foreach ($categories as $category)
            <section style="background-color: rgba(238, 238, 238, 0.664);" class="m-5">
                <div class="container p-5">

                    <a class=" " href="/category/{{ $category->id }}">
                        <h2 class="text-center text-white mb-5"><strong>{{ $category->name }}</strong></h2>
                    </a>
                    <div class="row">
                        @php
                            $subcategories = Category::where('parent_id', $category->id)->get();
                        @endphp

                        @foreach ($subcategories as $subcategory)
                            <div class="col-lg-4 col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body bg-warning">

                                    </div>
                                    <div class="card-footer ">
                                        <div class="card-title">
                                            <a href="/category/{{ $subcategory->id }}">
                                                <h1 class="text-center">
                                                    {{ $subcategory->name }}
                                                </h1>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </section>
        @endforeach






    </div>
@endsection
