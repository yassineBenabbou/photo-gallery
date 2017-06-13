<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'body' => 'nice pic!',
            'user_id' => 1,
            'photo_id' => 1,
            'created_at' =>date('Y-m-d G:i:s'),
            'updated_at' =>date('Y-m-d G:i:s')
        ]);   

        DB::table('comments')->insert([
            'body' => 'I really like this one, I didnt see you at the wedding ! See you this summer :).',
            'user_id' => 1,
            'photo_id' => 1,
            'created_at' =>date('Y-m-d G:i:s'),
            'updated_at' =>date('Y-m-d G:i:s')
        ]);    

        DB::table('comments')->insert([
            'body' => 'This is a dummy comment in here :D!',
            'user_id' => 1,
            'photo_id' => 2,
            'created_at' =>date('Y-m-d G:i:s'),
            'updated_at' =>date('Y-m-d G:i:s')
        ]);

        DB::table('comments')->insert([
            'body' => 'Congrats to all !',
            'user_id' => 1,
            'photo_id' => 2,
            'created_at' =>date('Y-m-d G:i:s'),
            'updated_at' =>date('Y-m-d G:i:s')
        ]);     

    }
}
