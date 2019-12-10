<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cards;

class PagesController extends Controller {

  public function index() {
    return view('pages.index');
  }
         
  public function cards(Request $request) {
    $cards = Cards::all();
    return view('pages.cards', ['cards' => $cards]);
  }  

  public function filter(Request $request) {
    $category = $request->input('category');
    $class = $request->input('class');
    $mana = $request->input('mana');
    $search = $request->input('search');

    $cards = Cards::when($mana, function($query, $mana) {
      return $query->where('cost', $mana);
    }) 
    ->when( $class, function($query,  $class) {
      return $query->where('playerClass',  $class);
    })
    ->orderby('cost')
    ->get();
    $request->flash();
    return view('pages.cards', ['cards' => $cards]);
  }

    
  public function about() {
    return view('pages.about');
  }
}
