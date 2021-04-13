<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\D11161024_admin;
use Illuminate\Support\Facades\Validator;

class D11161024_adminController extends Controller
{
    public function index()
    {
        $posts = D11161024_admin::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data admin',
            'data'          => $posts
        ], 200);
    }
    public function show($id)
    {
        $post = D11161024_admin::findOrfail($id);
        return response()->json([
            'success'       => true,
            'message'       => 'Detail Data admin',
            'data'          => $post
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $post = D11161024_admin::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => $request->password
        ]);
        if($post){
            return response()->json([
                'success'   =>true,
                'message'   => 'Admin Created',
                'data'      => $post
            ], 201);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $post = D11161024_admin::findOrFail($id);
        if($post){
            $post->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => $request->password
            ]);
            return response()->json([
                'success'       => true,
                'message'       => 'Admin Updated',
                'data'          => $post
            ], 200);
        }
    }
    public function destroy($id)
    {
        $post = D11161024_admin::findOrfail($id);
        if($post){
            $post->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'Admin Deleted',
            ], 200);
        }
        return response()->json([
            'success'   => false,
            'message'   => 'Admin Not Found',
        ], 404);
    }

}
