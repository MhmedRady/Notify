@extends('seller.home')


@section('home.content')
    <h5 class="card-header text-capitalize">#{{$order->id}} Order Details</h5>
    <div class="card-body">
       <div class="row">
           <div class="col-lg-6 d-grid justify-content-lg-start">
               <h5 class="h5 text-capitalize text-decoration-underline mb-0 pb-0">user Details</h5>
               <ul class="list-unstyled">
                   <li>
                       <h6 id="deliveryName" class="h5 text-capitalize">
                           <strong class="text-primary">User Name :</strong> <span>{{$order->user->name}}</span>
                       </h6>
                   </li>
                   <li>
                       <h5 id="deliveryName" class="h5 text-capitalize">
                           <strong class="text-primary">City :</strong> <span>{{$order->user->userAddress->address}}</span>
                       </h5>
                   </li>
                   <li>
                       <h5 id="deliveryName" class="h5 text-capitalize">
                           <strong class="text-primary">Address :</strong> <span>{{$order->user->userAddress->address}}</span>
                       </h5>
                   </li>
                   @if($order->received_at)
                       <li>
                           <h5 id="deliveryName" class="h5 text-capitalize">
                               <strong class="text-primary">Received At:</strong> <span>{{$order->arrived_at}}</span>
                           </h5>
                       </li>
                   @endif
               </ul>
           </div>
           <div class="col-lg-6 d-grid justify-content-lg-end">
               <h5 class="h5 text-capitalize text-decoration-underline">Seller Details</h5>
               <ul class="list-unstyled">
                   <li>
                       <h6 id="deliveryName" class="h5 text-capitalize">
                           <strong class="text-primary">Seller Name :</strong> <span>{{$order->product->seller->name}}</span>
                       </h6>
                   </li>
                   <li>
                       <h5 id="deliveryName" class="h5 text-capitalize">
                           <strong class="text-primary">City :</strong> <span>{{$order->product->seller->userAddress->address}}</span>
                       </h5>
                   </li>
                   <li>
                       <h5 id="deliveryName" class="h5 text-capitalize">
                           <strong class="text-primary">Statues :</strong> <span>{{$order->status->name}}</span>
                       </h5>
                   </li>
                   @if($order->arrived_at)
                       <li>
                           <h5 id="deliveryName" class="h5 text-capitalize">
                               <strong class="text-primary">Arrived At:</strong> <span>{{$order->arrived_at}}</span>
                           </h5>
                       </li>
                   @endif
               </ul>
           </div>
       </div>
        @if(!$order->arrived_at)
            <form action="{{route('delivery.save.order.offer', $order)}}" method="post">
                @csrf
                <div class="row">
                    <h5>Seller Arrival Date</h5>
                    <div class="col-lg-6">
                        <label for="arrived_data" class="form-label h5 text-capitalize text-decoration-underline mb-3 pb-0">Set arrived date</label>
                        <input id="arrived_data" class="form-control" type="date" name="seller_date"/>
                    </div>
                    <div class="col-lg-6">
                        <label for="arrived_time" class="form-label h5 text-capitalize text-decoration-underline mb-3 pb-0">Set arrived Time</label>
                        <input id="arrived_time" class="form-control" type="time" value="01:00:00" name="seller_time"/>
                    </div>

                    <hr class="mt-3">

                    <h5>User receiving Date</h5>
                    <div class="col-lg-6">
                        <label for="arrived_data" class="form-label h5 text-capitalize text-decoration-underline mb-3 pb-0">Set arrived date</label>
                        <input id="arrived_data" class="form-control" type="date" name="user_date"/>
                    </div>
                    <div class="col-lg-6">
                        <label for="arrived_time" class="form-label h5 text-capitalize text-decoration-underline mb-3 pb-0">Set arrived Time</label>
                        <input id="arrived_time" class="form-control" type="time" value="01:00:00" name="user_time"/>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-primary btn-sm fw-bold text-capitalize mb-3 mt-3">Send Offer</button>
                    </div>
                </div>
            </form>
        @endif
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Price</th>
                    <th scope="col">weight</th>
                </tr>
            </thead>
            <tbody>
{{--            @foreach($order->product as $key => $order->product)--}}
                <tr>
                    <th scope="row">{{1}}</th>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->product->stock}}</td>
                    <td>{{$order->product->price}}</td>
                    <td>{{$order->product->weight}}</td>
                    <td></td>
                </tr>
{{--            @endforeach--}}
            </tbody>
        </table>


    </div>

@endsection

@push('scripts')
    <script>
        document.getElementById('arrived_data').value;
    </script>
@endpush
