@extends('layouts.app')
@section('content')

<div class="container-fluid">

  {{ Form::open(['action' => 'PagesController@filter', 'method' => 'POST', 'class'=> 'form-inline mb-5']) }} 
    <div class="form-group  mr-sm-2">
      {{Form::select('category', ['standard' => 'Standard', 'wild' => 'Wild',], null, ['class'=> 'browser-default custom-select', 'onchange' => 'this.form.submit()'])}}
    </div>

    <div class="form-group  mr-sm-2">
      {{Form::select('class', [ 
        'DRUID' => 'Druid', 
        'HUNTER' => 'Hunter', 
        'MAGE' => 'Mage', 
        'PALADIN' => 'Paladin', 
        'PRIEST' => 'Priest', 
        'ROGUE' => 'Rogue', 
        'SHAMAN' => 'Shaman', 
        'WARLOCK' => 'Warlock', 
        'WARRIOR' => 'Warrior'],
        null, ['class'=> 'browser-default custom-select', 'placeholder' => 'All Classes', 'onchange' => 'this.form.submit()'])}}
    </div>

    <div class="form-group  mr-sm-2">
        {{Form::select('mana', [
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
          null, ['class'=> 'browser-default custom-select', 'placeholder' => 'All', 'onchange' => 'this.form.submit()'])}}
      </div>


    <div class="form-group mr-sm-2">
      {{Form::text('search', '', ['class'=> 'form-control', 'placeholder' => 'Search'])}}
    </div>
    
    <div class="form-group">
      {{-- {{Form::submit('Click Me!','xxx','',['class'=> 'btn btn-outline-success mr-2','onchange' => 'this.form.submit()'])}} --}}
      <button class="btn btn-outline-success mr-2" type="submit">Go</button>
    </div>
  {{ Form::close() }}
  <h1>Cards</h1>

  <div class="row">
    <div class="col-sm-8">
      @foreach ($cards->chunk(3) as $chunk)

      <div class="card-deck">
        @foreach($chunk as $card)
        <div class="card">
          <div class="card-body" id="card-body">
            <h5 class="card-title" id="h5">{!! $card->name !!}</h5>
            <p class="card-text" id="p">{!! $card->text !!}</p>
            <p class="card-cost" id="p">{!! $card->cost !!}</p>
            <p class="card-cost" id="p">{!! $card->playerClass !!}</p>
            <a href="#" class="stretched-link"></a>
          </div>
        </div></b></b></b> <!-- because SQL db data has some open b tags but missing some closing b tags-->
        @endforeach
      </div>
      @endforeach
    </div>
    <div class="col-sm-4">show selected cards</div>
  </div>

</div>
<!--container-fluid-->

<script>
  function getID(event) {
    //onclick="getID(event)" on a tag
    //onclick="getID(this)" on a tag
    // var x = event.target
    // var x = event.target.id;
    // var x = event.target.parentNode.parentNode.id;
    var x = event.target.id;
    // var x = event.target.getAttribute('data-card-id')
    if (x === 'p' || x === 'h5') {
      console.log('ppp')
      var x = event.target.parentNode.parentNode.id;
    } else if (x === 'card-body') {
      console.log('card-body')
    }



    console.log(x)
  }
</script>

@endsection