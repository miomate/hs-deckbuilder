<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cards;

class Decks extends Model
{

  
  public function cards () {
    return $this->belongsToMany(Cards::class, 'cards_decks', 'deck_id', 'card_id')->withPivot('count');
    // App\Cards
    // above in use



    //names models singular
    //create folder for models
  }
}
