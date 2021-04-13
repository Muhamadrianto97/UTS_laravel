<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\D11161024_news;
use Illuminate\Support\Facades\Validator;

class D11161024_newsController extends Controller
{
    public function index()
    {
        $posts = D11161024_news::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data news',
            'data'          => $posts
        ], 200);
    }
    public function show($id)
    {
        $post = D11161024_news::findOrfail($id);
        return response()->json([
            'success'       => true,
            'message'       => 'Detail Data News',
            'data'          => $post
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'img_url'   => 'required',
            'sub_desc'  => 'required',
            'desc'      => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $post = D11161024_news::create([
            'title'         => $request->title,
            'img_url'       => $request->img_url,
            'sub_desc'      => $request->sub_desc,
            'desc'          => $request->desc
        ]);
        if($post){
            return response()->json([
                'success'   =>true,
                'message'   => 'News Created',
                'data'      => $post
            ], 201);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'img_url'   => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $post = D11161024_news::findOrFail($id);
        if($post){
            $post->update([
                'title'         => $request->title,
                'img_url'       => $request->img_url,
                'sub_desc'      => $request->sub_desc,
                'desc'          => $request->desc
            ]);
            return response()->json([
                'success'       => true,
                'message'       => 'News Updated',
                'data'          => $post
            ], 200);
        }
    }
    public function destroy($id)
    {
        $post = D11161024_news::findOrfail($id);
        if($post){
            $post->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'News Deleted',
            ], 200);
        }
        return response()->json([
            'success'   => false,
            'message'   => 'News Not Found',
        ], 404);
    }

}
