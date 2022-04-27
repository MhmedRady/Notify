@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="h2 text-center text-capitalize text-decoration-underline mt-2 mb-5">Seller Dashboard</h2>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @yield('home.content')
            </div>
            <hr class="my-5">
        </div>
    </div>
</div>
@endsection
