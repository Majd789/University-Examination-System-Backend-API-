<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\articleResource;
use App\Http\Trait\apiResponseTrait;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use apiResponseTrait;
    /**
     * Display a listing of the resource.
     * @param $article
     * @return mixed
     */
    public function index()
    {
        $articles = Article::all();
        return $this->apiResponse($articles,  205 , 'These are all the articles');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            if ($user != null) {
                $articles = Article::insert([
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'body' => $request->body,
                    'image' => $request->image,
                ]);
                return $this->apiResponse($articles, 201, 'create success');
            } else {
                return $this->apiResponse(null, 402, 'user not found ');

            }
        }
        catch(\Throwable $throwable )
        {
            return $this->apiResponse(false, 401, $throwable -> getMessage());
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Request $request)
    {
        $articles = Article::find($request);
        if ($articles)
        {
            return $this->apiResponse($articles, 205, 'ok');
        }

        return $this->apiResponse(null, 402, 'article not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {


            $articles = Article::find($request->id);
            $articles->update([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'body'  => $request->body,
                'image'  => $request->image,
            ]);
            return $this->apiResponse($articles  , 202 , 'update successful');
        }
        catch(\Throwable $throwable )
        {
            return $this->apiResponse(false, 401, $throwable -> getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $articles = Article::find($request->id);
        if ($articles)
        {
            $articles->delete();
            return $this->apiResponse($articles , 204 , 'delete successful');
        }
        return $this->apiResponse($articles , 402 , 'article not found');
    }
}
