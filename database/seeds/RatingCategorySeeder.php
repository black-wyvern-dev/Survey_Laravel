<?php

use Illuminate\Database\Seeder;

class RatingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rating_cat')->insert([
            'name' => 'Smiley',
        ]);
        DB::table('rating_cat')->insert([
            'name' => 'Text',
        ]);
        DB::table('rating_cat')->insert([
            'name' => 'Ladder',
        ]);
    }
}
