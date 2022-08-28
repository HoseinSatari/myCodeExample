<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

trait ModelHelperTesting
{
    use RefreshDatabase;

    abstract protected function model() : Model;

    public function testInsertData()
    {
        $model = $this->model();
        $table = $model->getTable();

        $data = $model::factory()->make()->toarray();
        if ($model instanceof User){
            $data['password'] = Hash::make('12341234');
        }

        $model::create($data);

        $this->assertDatabaseHas($table, $data);
    }


}
