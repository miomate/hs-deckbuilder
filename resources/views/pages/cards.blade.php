@extends('layouts.app')
@section('content')

<div class="container-fluid">

  {{ Form::open(['action' => 'PagesController@filter', 'method' => 'POST', 'class'=> 'form-inline mb-5']) }} 
    <div class="form-group  mr-sm-2">
      {{ Form::select('category', ['standard' => 'Standard', 'wild' => 'Wild',], null, ['class'=> 'browser-default custom-select', 'placeholder' => 'All Categories', 'onchange' => 'this.form.submit()']) }}
    </div>

    <div class="form-group  mr-sm-2">
      {{ Form::select('class', [ 
        'DRUID' => 'Druid', 
        'HUNTER' => 'Hunter', 
        'MAGE' => 'Mage', 
        'PALADIN' => 'Paladin', 
        'PRIEST' => 'Priest', 
        'ROGUE' => 'Rogue', 
        'SHAMAN' => 'Shaman', 
        'WARLOCK' => 'Warlock', 
        'WARRIOR' => 'Warrior'],
        null, ['class'=> 'browser-default custom-select', 'placeholder' => 'All Classes', 'onchange' => 'this.form.submit()']) }}
    </div>

    <div class="form-group  mr-sm-2">
        {{ Form::select('mana', [
          'All' => 'All',
          '0' => '0',
          '1' => '1', 
          '2' => '2', 
          '3' => '3', 
          '4' => '4', 
          '5' => '5', 
          '6' => '6', 
          '7' => '7', 
          '8' => '8', 
          '9' => '9', 
          '10' => '10',
          '50' => '50',
          '11' => '+11'],
          null, ['class'=> 'browser-default custom-select', 'onchange' => 'this.form.submit()']) }}
      </div>


    <div class="form-group mr-sm-2">
      {{ Form::open(['action' => 'PagesController@filter', 'method' => 'POST', 'class'=> 'form-inline mb-5']) }} 
      {{ Form::text('search', '', ['class'=> 'form-control', 'placeholder' => 'Search']) }}
    </div>
    
    <div class="form-group">
      <button class="btn btn-outline-success" type="submit">Go</button>
    </div>
  {{ Form::close() }}

  <h1>Cards</h1>
  <div class="row">
    <div class="col-sm-8">
      @foreach ($cards->chunk(3) as $chunk)

      <div class="card-deck">
        @foreach($chunk as $card)
        <div class="card">
          <div class="card-body" id="card-body" > 
            <?php  
            $linkStart='https://art.hearthstonejson.com/v1/render/latest/enUS/512x/';
            $finalLink = $linkStart . $card->card_id . '.png'
            ?>
            <img class="cardPng" src="{{$finalLink}}" loading="lazy" alt="">
          <a href="#" id="{!! $card->card_id !!}" class="stretched-link"></a> 
          </div>
        </div></b></b></b> 
        @endforeach
      </div>
      @endforeach
    </div>

    <div class="col-sm-4">
        <div class="input-group mb-3">
          <div class="form-group mr-2">
            <input class="form-control" type="text" placeholder="Deck name">
          </div>       
          <div class="form-group">
            <button class="btn btn-outline-success" type="submit">Create Deck</button>
          </div>
        </div>
        <div style="widht:max; height:100px; background-color:red;"></div>
    </div>
  </div>
</div>
<!--container-fluid-->
@endsection



