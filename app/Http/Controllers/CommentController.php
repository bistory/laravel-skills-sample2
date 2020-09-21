<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(News $news)
    {
        return $news->comments()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Models\News  $news
     * @return \App\Models\Comment
     */
    public function store(CommentRequest $request, News $news): Comment
    {
        return $news->comments()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @param  \App\Models\Comment  $comment
     * @return \App\Models\Comment
     */
    public function show(News $news, Comment $comment): Comment
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Models\News  $news
     * @param  \App\Models\Comment  $comment
     * @return \App\Models\Comment
     */
    public function update(CommentRequest $request, News $news, Comment $comment): Comment
    {
        $comment->update($request->all());

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function destroy(News $news, Comment $comment): void
    {
        $comment->delete();
    }
}
