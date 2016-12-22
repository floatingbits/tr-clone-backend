<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function cardLists() {
        return $this->hasMany('App\CardList', 'board_id');
    }
}
