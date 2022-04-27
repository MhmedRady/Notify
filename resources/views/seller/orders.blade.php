@extends('seller.home')


@section('home.content')
    <h5 class="card-header text-capitalize">Orders</h5>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th scope="col">Product</th>
                <th scope="col">Stock</th>
                <th scope="col">Amount</th>
                <th scope="col">Sipping</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->sellerOrders as $key => $order)
                <tr>
                    <th scope="row">{{$key +1}}</th>
                    <td>{{$order->status->name}}</td>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->product->stock}}</td>
                    <td>{{$order->product->price}}</td>
                    <td>
                        @if(!is_null($order->delivery))
                            @if($order->status_id == 2)
                                <button id="deliveryOrder_{{$order->id}}" data-order="{{$order->id}}" class="btn btn-primary btn-sm fw-bolder" data-bs-toggle="modal" data-bs-target="#deliveryModal">Delivery</button>
                            @else
                                <button class="btn btn-warning btn-sm fw-bolder">In Shipping</button>
                            @endif
                        @else
                            <button class="btn btn-secondary btn-sm fw-bolder disabled" readonly="">No Delivery</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('seller.deliveryModal')
    @include('components.toastr')
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
