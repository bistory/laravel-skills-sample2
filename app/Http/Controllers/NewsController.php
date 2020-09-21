<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return News::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @return \App\Models\News
     */
    public function store(NewsRequest $request): News
    {
        return News::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \App\Models\News
     */
    public function show(News $news): News
    {
        return $news;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \App\Models\News
     */
    public function update(NewsRequest $request, News $news): News
    {
        $news->update($request->all());

        return $news;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function destroy(News $news): void
    {
        $news->delete();
    }
}
