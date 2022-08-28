<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Models\ModelHelperTesting;
use Tests\TestCase;

class UserTest extends TestCase
{
    use ModelHelperTesting;

    protected function model(): Model
    {
        return new User();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleRelationShipWithUser()
    {
       $article = Article::factory()->for(User::factory())->create();

       $this->assertTrue(isset($article->user->id));
       $this->assertTrue($article->user instanceof User);

    }


}
