<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'English',
            'code' => 'us',
            'flag' => '1'
        ]);
        DB::table('languages')->insert([
            'name' => 'Chinese',
            'code' => 'cn',
            'flag' => '2'
        ]);
        DB::table('languages')->insert([
            'name' => 'Russian',
            'code' => 'ru',
            'flag' => '3'
        ]);
        DB::table('languages')->insert([
            'name' => 'Franch',
            'code' => 'fr',
            'flag' => '4'
        ]);
    }
}
