<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpDecks extends Model
{
   protected $fillable = ['card_id', 'id'];
  //protected $primaryKey = 'card_id'; //from docs Primary Keys

  public function currentCard() {

    return $this->hasMany('App\Cards', 'id', 'card_id');
   }
}
