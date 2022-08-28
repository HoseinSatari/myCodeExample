<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use ModelHelperTesting;
    protected function model(): Model
    {
        return new Category();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleRelationShipWithCategory()
    {
        $count = rand(1,5);
       $article = Article::factory()->hascategories($count)->create();

       $this->assertCount($count , $article->categories );

       $this->assertTrue($article->categories()->first() instanceof Category);
    }


}
