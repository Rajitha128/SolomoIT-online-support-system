<?php

namespace App\Repositories;


use App\Models\Reply;
use App\Interfaces\ReplyRepositoryInterface;

class ReplyRepository extends BaseEloquentRepository implements ReplyRepositoryInterface
{
    public function __construct(Reply $model)
    {
        $this->model = $model;
    }
}
