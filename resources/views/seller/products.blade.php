@extends('seller.home')


@section('home.content')
    <h5 class="card-header text-capitalize">Products</h5>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                <th scope="col">Orders</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->productsWhereHasOrder as $key => $product)
                <tr>
                    <th scope="row">{{$key +1}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->orders()->count()}}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
