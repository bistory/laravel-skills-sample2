<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\News;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::find(1)->comments()->createMany([
            [
                'body' => 'i like this news',
                'created_at' => '2016-11-30 14:21:23',
            ],
            [
                'body' => 'i have no opinion about that',
                'created_at' => '2016-11-30 14:24:08',
            ],
            [
                'body' => 'are you kidding me ?',
                'created_at' => '2016-11-30 14:28:06',
            ]
        ]);

        News::find(2)->comments()->createMany([
            [
                'body' => 'this is so true',
                'created_at' => '2016-11-30 17:21:23',
            ],
            [
                'body' => 'trolololo',
                'created_at' => '2016-11-30 17:39:25',
            ]
        ]);

        News::find(2)->comments()->create([
            'body' => 'luke i am your father',
            'created_at' => '2016-11-30 14:34:06',
        ]);
    }
}
