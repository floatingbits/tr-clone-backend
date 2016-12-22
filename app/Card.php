<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function cardList() {
        return $this->belongsTo('App\CardList', 'card_list_id');
    }
}
