<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

//use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = auth()->guard('web')->user();
       return view('user.orders', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){
        $rules = [
            'email'=> 'required|email',
            'password' => 'required'
        ];

        try {
            $validator = Validator::make($request->all(), $rules);
//        $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
            {
                return apiResponse(402, $validator->errors());
            }

            $token = auth()->guard('api-user')->attempt($request->only(['email', 'password']));

            if (!$token)
            {
                return apiResponse(402, [], 'password or email is not correct.!');
            }

            $auth = auth()->guard('api-user')->user();
            $auth->auth_token = $token;
            return apiResponse(200, $auth);

        }catch (\Exception $e){
            return apiResponse(400, ['error' => $e->getMessage()], 'some thing error try again later.!');
        }
    }
}
