@extends('layouts.app')
@section('content')

<div class="container-fluid">


  <form name="cards-filter" method="POST" action="{{ Request::url() }}" id="" class="form-inline mb-5">
    <div class="form-group  mr-sm-2">
      <select name="" class="browser-default custom-select">
        <option value="standard">Standard</option>
        <option value="wild">Wild</option>
      </select>
    </div>

    <div class="form-group  mr-sm-2">
      <label class="my-1 mr-2" for="class">
        Class
      </label>

      <select class="browser-default custom-select" id="class">
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
      </select>
    </div>

    <div class="form-group  mr-sm-2">
      <label class="my-1 mr-2 " for="mana">
        Mana
      </label>
      <button class="btn btn-outline-success  manaBtn" type="submit">0</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">1</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">2</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">3</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">4</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">5</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">6</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">7</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">8</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">9</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">10</button>
      <button class="btn btn-outline-success  manaBtn" type="submit">10+</button>
    </div>

    <div class="form-group  mr-sm-2 col-xs-2">
      <input class="form-control" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success " type="submit">Filter</button>
    </div>
  </form>

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
        </div>
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