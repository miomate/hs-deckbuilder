@extends('layouts.app')
@section('content')

<div class="container-fluid">

  {{ Form::open(['action' => 'PagesController@filter', 'method' => 'POST', 'class'=> 'form-inline mb-5']) }} 
    <div class="form-group  mr-sm-2">
      {{Form::select('category', ['standard' => 'Standard'], null, ['class'=> 'browser-default custom-select', 'onchange' => 'this.form.submit()'])}}
    </div>

    <div class="form-group  mr-sm-2">
      {{-- <label class="my-1 mr-2" for="class"> --}}
        {{-- Class
      </label> --}}
      {{Form::select('class', [
        'all' => 'All', 
        'druid' => 'Druid', 
        'hunter' => 'Hunter', 
        'mage' => 'Mage', 
        'paladin' => 'Paladin', 
        'priest' => 'Priest', 
        'rogue' => 'Rogue', 
        'shaman' => 'Shaman', 
        'warlock' => 'Warlock', 
        'warrior' => 'Warrior'],
        null, ['class'=> 'browser-default custom-select', 'placeholder' => 'Pick Class', 'onchange' => 'this.form.submit()'])}}
      {{-- <select name="class" class="browser-default custom-select" id="class" onchange="this.form.submit()">
        <option value="all">All</option>
        <option value="druid">Druid</option>
        <option value="hunter">Hunter</option>
        <option value="mage">Mage</option>
        <option value="paladin">Paladin</option>
        <option value="priest">Priest</option>
        <option value="rogue">Rogue</option>
        <option value="shaman">Shaman</option>
        <option value="warlock">Warlock</option>
        <option value="warrior">Warrior</option>
      </select> --}}
    </div>

    <div name="mana" class="form-group mr-sm-2">
      {{Form::label('Mana', '',['class'=> 'my-1 mr-2'])}} 
      
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">0</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">1</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">2</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">3</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">4</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">5</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">6</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">7</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">8</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">9</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">10</button>
      <button class="btn btn-outline-success  manaBtn" aria-pressed="true" type="submit">10+</button>
 
    </div>

    <div class="form-group mr-sm-2">
      {{-- <input name="search" class="form-control" type="text" placeholder="Search" aria-label="Search"> --}}
      {{-- {{Form::label('search', 'Search')}} --}}
      {{Form::text('search', '', ['class'=> 'form-control', 'placeholder' => 'Search'])}}
    </div>
    
    <div class="form-group">
      <button class="btn btn-outline-success mr-2" type="submit">Go</button>
    </div>

  {{ Form::close() }}

  {{ Form::open(['action' => 'PagesController@filter', 'method' => 'POST']) }} 
  <div class="form-group ">
    {{Form::label('title', 'Title of Input field')}}
    {{Form::text('title', '', ['class'=> 'form-control', 'placeholder' => 'Title'])}}

    {{Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Pick a size...'])}}
    {{Form::submit('Click Me!', ['class'=> 'btn btn-primary'])}}
  </div> 
  {{ Form::close() }}

  <h1>Cards</h1>

  <div class="row">
    <div class="col-sm-8">
      @foreach ($cards->take(76)->chunk(3) as $chunk)

      <div class="card-deck">
        @foreach($chunk as $card)
        <div class="card">
          <div class="card-body" id="card-body">
            <h5 class="card-title" id="h5">{!! $card->name !!}</h5>
            <p class="card-text" id="p">{!! $card->text !!}</p>
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