<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\articleResource;

use App\Http\Trait\apiResponseTrait;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return $this->apiResponse(articleResource::collection($articles),  205 , 'These are all the articles');
    }


    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'body' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                // $errors = $validator->errors();
                return $this->apiResponse(null, 402, $validator->errors());

            }
            if ($request->hasFile('image')) {
                $file_extension = $request->image->getClientOriginalExtension();
                $file_name = time() . '.' . $file_extension;  //10/2/2020/101:15.png
                $path = 'images';
                $request->image->move($path, $file_name);

                $articles = Article::insert([
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'body' => $request->body,
                    'image' => $file_name,
                ]);
                return $this->apiResponse($articles, 201, 'create success');
            }
            $articles = Article::insert([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'body' => $request->body,
                'image' => null,
            ]);
            return $this->apiResponse($articles, 201, 'create success');

        }
        return $this->apiResponse(null, 404, 'User Not Found');

    }

    /**
     * Display the specified resource.
     */

    public function show(Request $request)
    {

      $article = Article::find($request->id);
        if ($article)
        {
            return $this->apiResponse(new articleResource($article), 205, 'ok');

        }

        return $this->apiResponse(null, 402, 'article not found');
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

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
// mmmm
