@extends('delivery.home')


@section('home.content')
    <h5 class="card-header text-capitalize">Orders</h5>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th scope="col">Product</th>
                <th scope="col">Amount</th>
                <th scope="col">arrival</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->ordersOnDelivery as $key => $order)
                <tr>
                    <th scope="row">{{$key +1}}</th>
                    <td>{{$order->status->name}}</td>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->product->price}}</td>
                    <td>{{$order->arrived_at?date('Y/m/d',strtotime($order->arrived_at)):'-'}}</td>
                    <td>
                        <button class="btn btn-warning btn-sm fw-bolder" readonly="">{{$order->status->name}}</button>
{{--                        @if(!is_null($order->delivery))--}}
                            <a href="{{route('delivery.order', $order)}}" class="btn btn-primary btn-sm fw-bolder">Order Info</a>
{{--                        @else--}}

{{--                        @endif--}}
{{--                        <button id="userInfo_{{$order->id}}" class="btn btn-info btn-sm fw-bolder"  data-bs-toggle="modal" data-bs-target="#userModal" data-order="{{$order->id}}">User Info</button>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('delivery.deliveryModal')
@endsection

@push('scripts')
    <script async>
        let userName = document.getElementById('userName');
        let userCity = document.getElementById('userCity');
        let userAddress = document.getElementById('userAddress');
        let userReceiving = document.getElementById('userReceiving');
        let userOrder = document.querySelectorAll('[id^=userInfo_]');
        const xhr = new XMLHttpRequest();

        userOrder.forEach((el)=>{
            el.onclick = ev => {

                let orderId = ev.target.dataset.order;
                console.log(orderId)
                let url = `{{route('delivery.user.order')}}/${orderId}`;

                fetch(url, { method: 'GET' }).then(async resp => {
                    let json = await resp.json();
                    // deliveryName.lastElementChild.innerText = json.data.deliveryName;
                    // deliveryArrival.lastElementChild.innerText = json.data.deliveryArrived;
                    // deliveryAddress.lastElementChild.innerText = json.data.deliveryAddress;
                    // orderShipped.dataset.order = orderId;
                }).catch(err => {
                    console.error(err);
                });

        {{--        orderShipped.onclick = (ev) => {--}}

        {{--            let order = ev.target.dataset.order;--}}
        {{--            console.log(`{{route('seller.update.orders.delivery')}}/${order}`);--}}
        {{--            xhr.open('GET', `{{route('seller.update.orders.delivery')}}/${order}`, true);--}}

        {{--            xhr.onreadystatechange = function () {--}}
        {{--                if (xhr.status === 200){--}}
        {{--                    el.removeAttribute('id');--}}
        {{--                    el.classList.remove('btn-primary');--}}
        {{--                    el.classList.add('btn-warning');--}}
        {{--                    el.innerText='In Shipping';--}}
        {{--                }--}}
        {{--            }--}}
        {{--            xhr.send();--}}
        {{--        }--}}

            };
        });



    </script>
@endpush
