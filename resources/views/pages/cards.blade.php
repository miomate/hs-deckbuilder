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
      {{ Form::text('search', '', ['class'=> 'form-control', 'placeholder' => 'Search']) }}
    </div>
    
    <div class="form-group">
      <button class="btn btn-outline-success" type="submit">Go</button>
    </div>

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
        <div class="input-group mb-3">
          <div class="form-group mr-2">
            <input class="form-control" type="text" placeholder="Deck name">
          </div>       
          <div class="form-group">
            <button class="btn btn-outline-success" type="submit">Create Deck</button>
          </div>
        </div>
        <div>
          @foreach ($tmpCards as $tmpCard)
          {{-- {{dd($tmpCard->currentCard)}} --}}
            <p>{{ $tmpCard->card_id }}</p>
            @isset ($tmpCard )
          
            @foreach($tmpCard->currentCard as $items)          
            <p>{{ $items->playerClass }}</p>

            @endforeach
            @endisset
            <p>{{ $tmpCard->playerClass }}</p>
          @endforeach

      
        </div>
    </div>
  </div><!--div row-->
</div><!--container-fluid-->

@endsection



