<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallengeList extends Model
{
    use SoftDeletes;

    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'challengelist';
}