<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{

    public function home()
    {
        $user = auth()->guard('seller_auth')->user();
        return view('seller.products', compact('user'));
    }

    public function login(){
        $route = route('seller.user.login');
        return view('auth.login',compact('route'));
    }

    public function user_login(Request $request){
        $user = $request->only(['email', 'password']);

        try {
            if (auth()->guard('seller_auth')->attempt($user))
            {
                return redirect()->route('seller.home');
            }
            return redirect()->route('seller.login');
        }catch (\Exception $e){
            return apiResponse($e->getCode(), '', $e->getMessage());
        }

    }

    public function orders()
    {
        $user = auth()->guard('seller_auth')->user();
//        return $user->sellerOrders->find(1)->status;
        return view('seller.orders', compact('user'));
    }

    public function orderDelivery($id)
    {
        $order = Order::query()->find($id);
        if ($order){
            $data = [
                'deliveryArrived' => $order->arrived_at,
                'deliveryName' => $order->delivery->name,
                'deliveryAddress' => $order->user->userAddress->address??'-',
            ];
//        $user = User::query()->find($id);
            return apiResponse(200, $data);
        }
        return apiResponse(200, []);
    }

    public function updateOrderDelivery($id)
    {
        $order = Order::query()->find($id);
        if ($order){
            $order->update([
                'status_id' => 3,
                'sipping_at' => now(),
            ]);
            return $order;
        }
    }

    public function logout()
    {
        auth()->guard('seller_auth')->logout();
        return redirect()->route('seller.login');
    }

}
