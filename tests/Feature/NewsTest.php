<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\News;

class NewsTest extends TestCase
{
    /**
     * Test listing comments.
     *
     * @return void
     */
    public function testListing()
    {
        $response = $this->getJson(route('news.index'));

        $response->assertSuccessful()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'body',
                    ]
                ]
            ]);
    }

    /**
     * Test creating news.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->withoutExceptionHandling();
        $response = $this->postJson(route('news.store'), [
            'title' => 'My test title',
            'body' => 'My test body',
        ]);

        $news = News::orderBy('id', 'desc')->first();

        $response->assertSuccessful()
            ->assertJson($news->toArray());
    }

    /**
     * Test updating news.
     *
     * @return void
     */
    public function testUpdate()
    {
        $news = News::create([
            'title' => 'My test news',
            'body' => 'My test body',
        ]);

        $response = $this->putJson(route('news.update', [
            'news' => $news->id,
        ]), [
            'title' => 'My modified test news',
            'body' => 'My modified test body',
        ]);

        $response->assertSuccessful()
            ->assertJsonFragment([
                'title' => 'My modified test news',
                'body' => 'My modified test body',
            ]);
    }

    /**
     * Test deleting news.
     *
     * @return void
     */
    public function testDelete()
    {
        $news = News::create([
            'title' => 'First test news',
            'body' => 'Test comment to delete',
        ]);

        $response = $this->deleteJson(route('news.destroy', [
            'news' => $news->id,
        ]));

        $response->assertSuccessful();

        $this->assertDeleted(app(News::class)->getTable(), $news->only([
            'id',
        ]));
    }
}
