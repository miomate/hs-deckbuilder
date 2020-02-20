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
    $result = '';
    $cardIds = TmpDecks::where('card_id', '=', $cardId)->get()->toArray();
    

    // if search term avaible->search, if not load all cards and sort them
    if($search !='') {
      echo "true";
      $cards = Cards::where('name', 'LIKE', $search)
      ->get();
      //dd($result);
    } else {
      $cards = Cards::when($mana, function($query, $mana) {
        return $query->where('cost', $mana); 
      }) 
      ->when( $class, function($query,  $class) {
        return $query->where('playerClass',  $class);
      })
      ->orderby('cost')
      ->limit(10)
      ->get();
    }
    
    // display user selected cards, from tmpdeck table
    $tmpCards = TmpDecks::with(['currentCard'])
    ->get()
    ->groupBy('card_id');
    
    // saves tmpcards in tmp deck, max size of cards in deck is 5, counts how often card in deck, max same card limited to 2
    $countTmpDeckCards = TmpDecks::count();
    $TmpDecks = new TmpDecks;
    
    if($cardId && count($cardIds) < 2 && $countTmpDeckCards < 5) {
      $card = TmpDecks::where('card_id', $cardId)->first();
      if ($card && $card->count < 2 ) {
        $card->count++;
        $card->save();
        return redirect()->back();
       } else if (!TmpDecks::where('card_id', $cardId)->first()) {
         
         $TmpDecks->card_id = $cardId;
         $TmpDecks->save();
        }
      }
      
      //user clicks on create deck
      if($createDeck){
        $deck = new Decks;
        $deck->deck_name = $createDeck;
        $deck->save();
        // get all the cards from TmpDeck
        $allTmpCards = TmpDecks::all();
        // Creates count column, needed of decks table
        $allTmpCards->each(function ($card) use ($deck) {
            $deck->cards()->attach($card->card_id, ['count' => $card->count]);
            $card->delete();
        });
        // ddd($deck->cards);
        // create a new deck
        // go through all the card in TmpDeck and attach them to the new deck, and delete the card after attaching it
    }
 
    //in tmpcards, + and -, adds same typ card to deck,
    if($removeCardId){
      $TmpDecks->where('id', '=', $removeCardId)->delete();
    }
    if($addCardId){
      $TmpDeck = \App\TmpDecks::find($addCardId);
      $TmpDeck->replicate()->save();
  
    }
 
    
    $request->flash();
 
        
    $tmpCards = TmpDecks::with(['currentCard'])
    ->get()
    ->groupBy('card_id');

    $decks = Decks::all();

    return view('pages.cards', ['cards' => $cards, 'tmpCards' => $tmpCards, 'countTmpDeckCards' => $countTmpDeckCards, 'decks' => $decks]);
    // return view('pages.cards', ['cards' => $cards, 'tmpCards' => $tmpCards, 'countTmpDeckCards' => $countTmpDeckCards]);
  }
 
  public function index() {
    return view('pages.index');
  }
 
  public function about() {
    return view('pages.about');
  }
  //{deck} in web.php
  public function showDeck(Decks $deck) {
   // $deck = Decks::find($deck) - done by Type hinting
   TmpDecks::truncate();
   foreach($deck->cards as $card) {
     $tmpDeckCard = new TmpDecks;
     $tmpDeckCard->card_id = $card->id;
     $tmpDeckCard->count = $card->pivot->count;
     $tmpDeckCard->save();
   }

    $cards = Cards::all();
    $tmpCards = TmpDecks::with(['currentCard'])
      ->get()
      ->groupBy('card_id');
    $countTmpDeckCards = TmpDecks::count();
    $decks = Decks::all();

   return view('pages.cards', ['cards' => $cards, 'tmpCards' => $tmpCards, 'countTmpDeckCards' => $countTmpDeckCards, 'decks' => $decks]);
  }
}
 //show newset deck at the top
 
// public function mySearch(Request $request), check latest()

// {
 
//   if($request->has('search')){
 
//     $users = User::search($request->get('search'))->get(); 
 
//   }else{
 
//     $users = User::get();
 
//   }
 
 
//   return view('my-search', compact('users'));
 
// }

