<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if table users is empty
        if(DB::table('posts')->get()->count() == 0){

            DB::table('posts')->insert([

                [
                    'user_id' => '1',
                    'is_visible' => '0',
                    'title' => 'Тестовый пост',
                    'post_body' => 'Lorem ipsum dollor is amet',
                    'likes_cnt' => '0',
                    'comments_cnt' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => '1',
                    'is_visible' => '1',
                    'title' => 'Тестовый пост #2',
                    'post_body' => 'Lorem ipsum dollor is amet',
                    'likes_cnt' => '0',
                    'comments_cnt' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => '1',
                    'is_visible' => '2',
                    'title' => 'Тестовый пост #3',
                    'post_body' => 'Lorem ipsum dollor is amet',
                    'likes_cnt' => '0',
                    'comments_cnt' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => '2',
                    'is_visible' => '0',
                    'title' => 'Тестовый пост',
                    'post_body' => 'Lorem ipsum dollor is amet',
                    'likes_cnt' => '0',
                    'comments_cnt' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
