<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Design']);
        Tag::create(['name' => 'Development']);
        Tag::create(['name' => 'SEO']);
        Tag::create(['name' => 'Marketing']);
        Tag::create(['name' => 'Writting']);
        Tag::create(['name' => 'Consulting']);

    }
}
