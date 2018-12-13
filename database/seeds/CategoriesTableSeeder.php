<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = ['title' => 'Laravel', 'slug' => str_slug('Laravel')];
        $category2 = ['title' => 'Vuejs', 'slug' => str_slug('Vuejs')];
        $category3 = ['title' => 'Javascript', 'slug' => str_slug('Javascript')];
        $category4 = ['title' => 'CSS3', 'slug' => str_slug('CSS3')];
        $category5 = ['title' => 'PHP Testing', 'slug' => str_slug('PHP Testing')];
        $category6 = ['title' => 'Spark', 'slug' => str_slug('Spark')];
        $category7 = ['title' => 'Lumen', 'slug' => str_slug('Lumen')];
        $category8 = ['title' => 'Forge', 'slug' => str_slug('Forge')];

        Category::create($category1);
        Category::create($category2);
        Category::create($category3);
        Category::create($category4);
        Category::create($category5);
        Category::create($category6);
        Category::create($category7);
        Category::create($category8);
    }
}
