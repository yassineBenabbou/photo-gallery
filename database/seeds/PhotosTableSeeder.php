<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'src' => '14924872804e6509969b04f5fa62e95835cef68bc1.jpg',
            'description' => 'This is the first photo in the first section.',
            'section_id' => 1,
            'created_at' => date('Y-m-d G:i:s'),
            'updated_at' => date('Y-m-d G:i:s')
        ]);

        DB::table('photos')->insert([
            'src' => '1492487342aeddf7958479912cae79408bf8ac8587.jpg',
            'description' => 'This is the second photo in the first section.',
            'section_id' => 1,
            'created_at' => date('Y-m-d G:i:s'),
            'updated_at' => date('Y-m-d G:i:s')
        ]);

    }
}
