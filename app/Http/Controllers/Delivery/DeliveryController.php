<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function home()
    {
        $user = auth()->guard('delivery_auth')->user();
        $user->ordersOnDelivery = Order::query()->where('delivery_id', $user->id)->orWhereNull('delivery_id')->orderByDesc('id')->get();
        return view('delivery.orders', compact('user'));
    }

    public function order($order)
    {
        $order = Order::query()->findOrFail($order);
        return view('delivery.viewOrder', compact('order'));
    }

    public function saveOrderOffer(Request $request,$order)
    {
        $order = Order::query()->findOrFail($order);
        $seller = $request->get('seller_date') . ' ' . $request->get('seller_time');
        $user = $request->get('user_date') . ' ' . $request->get('user_time');

        try {
            $order->update(['arrived_at' => $seller, 'received_at' => $user, 'status_id' => 2, 'delivery_id'=>auth()->guard('delivery_auth')->id()]);
            return redirect()->route('delivery.home')->with('message', 'A notification has been sent to the Seller of the arrival time ..!');
        }catch (\Exception $e){
            return redirect()->route('delivery.home')->with('error', 'Error While Saving Data Try again later..!');
        }
    }

    public function userOrderInfo(Order $order)
    {
        return $order->user;
    }

    ########## USER LOGIN & LOGOUT ##########
    public function login()
    {
        $route = route('delivery.user.login');
        return view('auth.login',compact('route'));
    }

    public function user_login(Request $request)
    {
        $user = $request->only(['email', 'password']);

        try {

            if (auth()->guard('delivery_auth')->attempt($user)){
                return redirect()->route('delivery.home');

            }else {
                return redirect()->route('delivery.login');
            }
        }   catch (\Exception $e){
            return apiResponse($e->getCode(), '', $e->getMessage());
        }

    }

    public function logout()
    {
        auth()->guard('delivery_auth')->logout();
        return redirect()->route('delivery.login');
    }
}
