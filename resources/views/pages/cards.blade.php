@extends('layouts.app')
@section('content')
<style>
  body {
    background-image: url('https://d2vkoy1na2a6o6.cloudfront.net/images/ui/parchment-f5126a8249a32eb235b139078b4cc13b5fb9d2c29b0e825569312681123d721a1f2e1addb4bad78f979933e561361e2ee2c5f5881ab4fef5385c66c6276c3b44.jpg');
    
  }
  .tmp-deck-cards {
    width: 100%;
    height: 50px;
    background-position-y: -180px;
    display: flex;
    align-items: center;
  }

  .tmp-cards-info {
    display: flex;
    color: white;
  }

  .tmp-cards-info p {
    margin: 0;
  }
</style>
<div class="ui">
  {{ Form::open(['action' => 'PagesController@cards', 'method' => 'POST', 'class'=> 'form-inline mb-5']) }}

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
  </div> <!-- ui -->

  <div class="form-group mr-sm-2 ">
    {{ Form::text('search', '', ['class'=> 'form-control', 'placeholder' => 'Search']) }}
  </div>

  <div class="form-group">
    <button class="btn btn-outline-success" type="submit">Go</button>
  </div>
</div>

<div class="container-fluid">

  <div class="row">
    <!--cards, left'n right side of screen-->

    <div class="col-sm-8">
      @foreach ($cards->chunk(3) as $chunk)
      <div class="card-deck">
        @foreach($chunk as $card)
        <div class="card">
          <div class="card-body" id="card-body">
            <?php  
            $linkStart='https://art.hearthstonejson.com/v1/render/latest/enUS/512x/';
            $finalLink = $linkStart . $card->card_id . '.png';
            $linkTmpDeck = $linkStart . $card->card_id . '.png'

            ?>
            <img class="cardPng" src="{{$finalLink}}" loading="lazy" alt="">
            <button style="display: block; width:100%" type="submit" name="cardInput" value="{!! $card->id !!}">
              Add
            </button>
          </div>
        </div></b></b></b>
        @endforeach
      </div>
      @endforeach
    </div>
    {{ Form::close() }}

    <div class="col-sm-4">
      <!--Form create deck-->
      <div class="col-sm">
        <div class="input-group  d-flex justify-content-center">
          <div class="form-group mr-2">
            <input class="form-control" type="text" placeholder="Deck name">
          </div>
          <div class="form-group">
            <button class="btn btn-outline-success" style="background-color:white" type="submit">Create Deck</button>
          </div>
        </div>

        @foreach ($tmpCards as $group)
        <?php            
          $linkTmpDeck = $linkStart . $group[0]->currentCard[0]->card_id . '.png';

          ?>
        <div class="tmp-deck-cards"
          style="background-image: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(0,0,9,0.85) 50%, rgba(249,252,252,0) 100%), url('{{$linkTmpDeck}}')">
          <div class="tmp-cards-info">
            <p class="ml-2 mr-2">{{ $group[0]->currentCard[0]->cost }}</p>
            <p>{{ $group[0]->currentCard[0]->name }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>

  </div>
  <!--row-->
</div>
<!--container-fluid-->

@endsection