<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardList extends Model
{
    public function cards() {
        return $this->hasMany('App\Card', 'card_list_id');
    }

    public function board() {
        return $this->belongsTo('App\Board', 'board_id');
    }

}
