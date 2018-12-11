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
        $category1 = ['title' => 'Laravel'];
        $category2 = ['title' => 'Vuejs'];
        $category3 = ['title' => 'CSS3'];
        $category4 = ['title' => 'Javascript'];
        $category5 = ['title' => 'PHP Testing'];
        $category6 = ['title' => 'Spark'];
        $category7 = ['title' => 'Lumen'];
        $category8 = ['title' => 'Forge'];

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
