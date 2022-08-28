<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use ModelHelperTesting;

    protected function model(): Model
    {
        return new Article();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserRelationShipWithArticle()
    {
        $user = User::factory()->has(Article::factory() , 'articles')->create();

        $this->assertTrue(isset($user->articles()->first()->id));
        $this->assertTrue($user->articles()->first() instanceof Article);
    }

    public function testCategoryRelationShipWithArticle()
    {
        $category = Category::factory()->has(Article::factory() , 'articles')->create();

        $this->assertTrue(isset($category->articles()->first()->id));
        $this->assertTrue($category->articles()->first() instanceof Article);
    }


}
