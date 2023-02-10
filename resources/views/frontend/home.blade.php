@extends('includes/master')
@section('content')
    <div class="container">
        
{{-- Book card start --}}
        <div class="card p-2">
            <div class="row">
                <div class="col-md-3">
                    <img class="bookimg" src="https://edu41.net/wp-content/uploads/2021/03/sarah-book-2.jpg" alt="Book photo">
                </div>
                <div class="col-md-6">
                    <div class="card-header">
                        <h3>Living on the edge</h3>
                        <h5>Edition : 6th</h5>
                        <h6>Author : author-name</h6>
                    </div>

                    <div class="card-body">

                        <p>-------------Description-------------</p>

                    </div>

                    <div class="card-footer">
                        <h6>
                            Category:
                            <br>
                            Publisher:
                        </h6>
                    </div>

                </div>
                <div class="col-md-3">
                    
                    <div class="">
                        <h6>
                            Available Quantity :
                            <br>
                            Call ID :
                        </h6>
                    </div>
                </div>
            </div>
        </div>
{{-- Book card end --}}























    </div>
@endsection
