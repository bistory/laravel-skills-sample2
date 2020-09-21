<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\News;
use App\Models\Comment;

class CommentTest extends TestCase
{
    /**
     * Test listing comments.
     *
     * @return void
     */
    public function testListing()
    {
        $response = $this->getJson(route('news.comments.index', [
            'news' => 1,
        ]));

        $response->assertSuccessful()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'body',
                    ]
                ]
            ]);
    }

    /**
     * Test creating comments.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->postJson(route('news.comments.store', [
            'news' => 1,
        ]), [
            'body' => 'My test comment',
        ]);

        $comment = Comment::orderBy('id', 'desc')->first();

        $response->assertSuccessful()
            ->assertJson($comment->toArray());
    }

    /**
     * Test updating comments.
     *
     * @return void
     */
    public function testUpdate()
    {
        $comment = News::find(1)->comments()->create([
            'body' => 'My test comment',
        ]);

        $response = $this->putJson(route('news.comments.update', [
            'news' => 1,
            'comment' => $comment->id,
        ]), [
            'body' => 'My modified test comment',
        ]);

        $response->assertSuccessful()
            ->assertJsonFragment([
                'body' => 'My modified test comment',
            ]);
    }

    /**
     * Test deleting comments.
     *
     * @return void
     */
    public function testDelete()
    {
        $comment = News::find(1)->comments()->create([
            'body' => 'Test comment to delete',
        ]);

        $response = $this->deleteJson(route('news.comments.destroy', [
            'news' => 1,
            'comment' => $comment->id,
        ]));

        $response->assertSuccessful();

        $this->assertDeleted(app(Comment::class)->getTable(), $comment->only([
            'id',
        ]));
    }
}
