<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Decks;
use App\Cards;
use App\TmpDecks;

class PagesController extends Controller {

  public function cards(Request $request) {

    $cards = Cards::limit(10)->get();
    $tmpCards = TmpDecks::with(['currentCard'])
    ->limit(10)
    ->get();
    return view('pages.cards', ['cards' => $cards, 'tmpCards' => $tmpCards]);
  }  
  
  public function filter(Request $request) { 
    
    $tmpCard = $request->input('cardInput');
    $category = $request->input('category');
    $class = $request->input('class');
    $mana = $request->input('mana');
    $search = $request->input('search');
    
    if($tmpCard) {
      $TmpDecks = new TmpDecks;
      $TmpDecks->card_id = $tmpCard;
      $TmpDecks->save();
    }
    
    $cards = Cards::when($mana, function($query, $mana) {
      return $query->where('cost', $mana); 
    }) 

    ->when( $class, function($query,  $class) {
      return $query->where('playerClass',  $class);
    })
    ->orderby('cost')
    ->get();
    $request->flash();

    $tmpCards = TmpDecks::all();
        
    return view('pages.cards', ['cards' => $cards, 'tmpCards' => $tmpCards]);
  }

  public function index() {
    return view('pages.index');
  }

  public function about() {
    return view('pages.about');
  }
}
