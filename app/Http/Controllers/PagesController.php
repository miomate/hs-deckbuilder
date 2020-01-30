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
    $addCardId = $request->input('addCardId');
    $createDeck = $request->input('createDeck');
    $category = $request->input('category');
    $class = $request->input('class');
    $mana = $request->input('mana');
    $search = $request->input('search');
    $cardIds = TmpDecks::where('card_id', '=', $cardId)->get()->toArray();
    
    // echo $request;
    // echo $mana;
    echo $search;
    echo $removeCardId;
    echo $createDeck;

    // dd($);
    // count($cardId);
    // gettype($cardId);


    
    $countTmpDeckCards = TmpDecks::count();

    $decks = new Decks;

    $TmpDecks = new TmpDecks;
    if($cardId && count($cardIds) < 2 && $countTmpDeckCards < 5) {
      $TmpDecks->card_id = $cardId;
      $TmpDecks->save();
    }

    if($createDeck){
      $deckArray = array();
      $decks->deck_name = $createDeck;
      $decks->save();
    }

    if($removeCardId){
      $TmpDecks->where('id', '=', $removeCardId)->delete();
    }
  

    if($addCardId){
    // $TmpDecks = new TmpDecks;
      
      $TmpDeck = \App\TmpDecks::find($addCardId);
      $TmpDeck->replicate()->save();
  
    }

    



    // $abc = $search;
    $search = Cards::when($search, function($query, $search) {
      return $query->where('name', 'LIKE', $search); 
    }) 
    ->get();
    // "%{$search}%"
    // ->toSql();
    // dd($search);

    $cards = Cards::when($mana, function($query, $mana) {
      return $query->where('cost', $mana); 
    }) 
    ->when( $class, function($query,  $class) {
      return $query->where('playerClass',  $class);
    })
    ->orderby('cost')
    ->limit(10)
    ->get();

    $request->flash();

    $tmpCards = TmpDecks::with(['currentCard'])
    ->limit(40)
    ->get()
    ->groupBy('card_id');
        

    return view('pages.cards', ['cards' => $cards, 'tmpCards' => $tmpCards, 'countTmpDeckCards' => $countTmpDeckCards,  'search'  => $search]);
  }

  public function index() {
    return view('pages.index');
  }

  public function about() {
    return view('pages.about');
  }
}
