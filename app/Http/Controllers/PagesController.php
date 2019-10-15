<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cards;

class PagesController extends Controller
{

    public function index() {
      // return 'PagesController index()';
      $title = 'this title is in pagescontroller.php and exportet through return vie(..., compact("title")';
      return view('pages.index', compact('title'));
      // return view('pages.index')->with('title', $title); //second methode
    }

    public function cards() {
      $cards = Cards::all();
      
      
      return view('pages.cards', ['cards' => $cards]);

    }

    public function about() {
      return view('pages.about');
    }
}
