@extends('includes/master')
@section('content')
    <div class="container">


        {{-- {{View::make('auth/login')}} --}}



        <section style="background-color: rgba(238, 238, 238, 0.664);" class="m-5">
            <div class="container p-5">
                <h2 class="text-center text-white mb-5"><strong>Authors</strong></h2>

                <div class="row">
                    @foreach($authors as $author)
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="/author/{{$author->authorname}}">
                            <div class="card">
                                <div class="card-body bg-primary">
    
                                </div>
                                <div class="card-footer ">
                                    <div class="card-title">
                                        <h1 class="text-center">
                                            {{$author->authorname}}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    
                    @endforeach



            </div>

        </section>
    </div>
@endsection
