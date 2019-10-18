
@extends('layouts.app')
@section('content')

<div class="container-fluid">

        
  <form class="form-inline">
    <div class="form-group">

      <div class="standard-wild">
        <button class="btn btn-outline-success  standard">Standard</button>
        <button class="btn btn-outline-success  wild">Wild</button>  
      </div>

      <div class="dropdown">
        <span class="h5">Class</span>
        <select class="browser-default custom-select">
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
      </div><!--dropdown-->

      <div class="mana-cost">
        <span class="h5">Mana</span>
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
      </div><!--mana-cost-->
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success  " type="submit">Search</button>
    </div><!--filter-->
  </form>

    <h1>Cards</h1>

    <div class="row">
      <div class="col-sm-8">
        @foreach ($cards->take(76)->chunk(3) as $chunk)

        <div class="card-deck">
          @foreach($chunk as $card)
        <a href="#" class="card"  onclick="f()" data-card-id="{{$card->card_id}}">
              <div class="card-body">
                <h5 class="card-title">{{$card->name}}</h5>
                <p class="card-text">{{$card->text}}</p>
              </div>
          </a>
          @endforeach 

        </div><!--card-deck-->
        @endforeach
      </div><!--card col-sm-8-->
      <div class="col-sm-4">show selected cards</div>
    </div><!--row-->

</div><!--container-fluid--> 

<script>
  console.log("script")
  function f() {
  var t = getElementsByTagName('p')[0].innerHTML;
  console.log(t)
  }
</script>

@endsection
