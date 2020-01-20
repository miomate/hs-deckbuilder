<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpDecks extends Model
{
   protected $fillable = ['card_id', 'id'];

  public function currentCard() {

    return $this->hasMany('App\Cards', 'id', 'card_id' );
   }
}
