<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'title' => 'First Section',
            'slug' => 'first-section',
            'created_at' =>date('Y-m-d G:i:s'),
            'updated_at' =>date('Y-m-d G:i:s')
        ]);

        DB::table('sections')->insert([
            'title' => 'Second Section',
            'slug' => 'second-section',
            'created_at' =>date('Y-m-d G:i:s'),
            'updated_at' =>date('Y-m-d G:i:s')
        ]);

        DB::table('sections')->insert([
            'title' => 'Third Section',
            'slug' => 'third-section',
            'created_at' =>date('Y-m-d G:i:s'),
            'updated_at' =>date('Y-m-d G:i:s')
        ]);              
    }
}
