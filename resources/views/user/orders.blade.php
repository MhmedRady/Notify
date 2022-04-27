@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="h2 text-center text-capitalize text-decoration-underline mt-2 mb-5">Seller Dashboard</h2>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <h5 class="card-header text-capitalize">Orders</h5>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Receiving</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->orders as $key => $order)
                                <tr>
                                    <th scope="row">{{$key +1}}</th>
                                    <td>{{$order->product->name}}</td>
                                    <td>{{$order->product->stock}}</td>
                                    <td>{{$order->product->price}}</td>
                                    <td>{{$order->received_at??'Not shipped yet'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('seller.deliveryModal')
                    @include('components.toastr')
                </div>
                <hr class="my-5">
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script async>
        let deliveryName = document.getElementById('deliveryName');
        let orderShipped = document.getElementById('orderShipped');
        let deliveryArrival = document.getElementById('deliveryArrival');
        let deliveryAddress = document.getElementById('deliveryAddress');
        let deliveryOrder = document.querySelectorAll('[id^=deliveryOrder_]');
        const xhr = new XMLHttpRequest();

        deliveryOrder.forEach((el)=>{
            el.onclick = ev => {

                let orderId = ev.target.dataset.order;
                let url = `{{route('seller.orders.delivery')}}/${orderId}`;
                fetch(url, { method: 'GET' }).then(async resp => {
                    let json = await resp.json();
                    deliveryName.lastElementChild.innerText = json.data.deliveryName;
                    deliveryArrival.lastElementChild.innerText = json.data.deliveryArrived;
                    deliveryAddress.lastElementChild.innerText = json.data.deliveryAddress;
                    orderShipped.dataset.order = orderId;
                }).catch(err => {
                    console.error(err);
                });

                orderShipped.onclick = (ev) => {
                    console.log('sdadsad');
                    let order = ev.target.dataset.order;
                    xhr.open('GET', `{{route('seller.update.orders.delivery')}}/${order}`, true);

                    xhr.onreadystatechange = function () {
                        if (xhr.status === 200){
                            el.removeAttribute('id');
                            el.classList.remove('btn-primary');
                            el.classList.add('btn-warning');
                            el.innerText='In Shipping';

                        }
                    }
                    xhr.send();
                    toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                    toastr.success("A notification has been sent to user of the receiving time ..!");
                }

            };
        });



    </script>
@endpush
