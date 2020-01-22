<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Decks;
use App\Cards;
use App\TmpDecks;
use DB;

class PagesController extends Controller {
  
  public function cards(Request $request) { 
    
    $cardId = $request->input('cardId');
    $removeCardId = $request->input('removeCardId');
    
    echo $removeCardId;
    $category = $request->input('category');
    $class = $request->input('class');
    $mana = $request->input('mana');
    $search = $request->input('search');
    $cardIds = TmpDecks::where('card_id', '=', $cardId)->get()->toArray();
    
    echo "card id_";
    echo $removeCardId;
    echo "_";

    // dd($removeCardId);
    // count($cardId);
    // gettype($cardId);
    
    
    $TmpDecks = new TmpDecks;
    if($cardId && count($cardIds) < 2) {
      $TmpDecks->card_id = $cardId;
      $TmpDecks->save();
    }
    
    if($removeCardId){
      echo "echo in einem if?";
      $TmpDecks->where('id', '=', $removeCardId)->delete();
    }

    $cards = Cards::when($mana, function($query, $mana) {
      return $query->where('cost', $mana); 
    }) 
    ->when( $class, function($query,  $class) {
      return $query->where('playerClass',  $class);
    })
    ->orderby('cost')
    ->limit(3)
    ->get();
   
    $request->flash();

    $tmpCards = TmpDecks::with(['currentCard'])
    ->limit(40)
    ->get()
    ->groupBy('card_id');
        

    return view('pages.cards', ['cards' => $cards, 'tmpCards' => $tmpCards]);
  }

  public function index() {
    return view('pages.index');
  }

  public function about() {
    return view('pages.about');
  }
}
