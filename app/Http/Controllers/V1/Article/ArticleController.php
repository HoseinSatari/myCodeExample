<?php

namespace App\Http\Controllers\V1\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::query();


        if (\request()->asc == 1) {
            $articles = $articles->orderBy('created_at', 'asc');
        }

        if ($keyword = \request()->search) {
            $articles = $articles->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%")
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })->orWhereHas('categories', function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%{$keyword}%");
                });
        }

        $articles = $articles->latest()->paginate(20);

        $articles->appends(\request()->query())->links();

        return new ArticleCollection($articles);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required',
            'poster' => 'required',
            'categories' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response([
                'data' => $validator->errors(),
                'status' => 'error',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $article = auth()->user()->articles()->create([
            'title' => $request->title,
            'body' => $request->body,
            'poster' => $request->poster
        ]);

        $article->categories()->sync($request->categories);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required',
            'poster' => 'required',
            'categories' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response([
                'data' => $validator->errors(),
                'status' => 'error',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'poster' => $request->poster
        ]);

        $article->categories()->sync($request->categories);

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return \response()->json([
            'data' => ['message' => 'delete success'],
            'status' => true,
        ]);
    }
}
