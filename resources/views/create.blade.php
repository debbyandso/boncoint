@extends('layouts.app')
@section('content')
<div class="container">
<h1>deposez une annonce</h1>
<hr>
<form method="POST" action="{{route('ad.store')}}">
    @csrf
    <div class="form-group">
      <label for="title">Titre de l'annonce</label>
      {{-- errors, ce qui est entre parenthese, c'est le name!! pour recupere database --}}
      <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid':''}}" id="title" aria-describedby="title" name="title">
    @if ($errors->has('title'))
    <div class="span invalid-feedback">Veuillez inserer un titre</div>
    @endif
    </div>
    <div class="form-group">
      <label for="description" >description de l'annonce</label>
    <textarea name='description' id="description" class="form-control {{$errors->has('description')? 'is-invalid': ''}}" cols="30" rows="10" ></textarea>
    
    @if ($errors->has('description'))

    <div class="span invalid-feedback"> Veuillez inserer une description d'annonce</div>
    @endif

</div>
    <div class="form-group">
        <label for="localisation">localisation</label>
    <input type="text" class="form-control {{$errors->has('localisation')? 'is-invalid': ''}}" id="localisation" name="localisation">
    @if ($errors->has('localisation'))
    <div class="span invalid-feedback"> {{$errors ->first('localisation') }} </div>
    @endif
   
</div>
      <div class="form-group">
        <label for="price"  >prix</label>
<input type="text" class="form-control {{$errors->has('price')? 'is-invalid': ''}}" id="price" name="price">
@if ($errors->has('price'))
<div class="span invalid-feedback"> {{$errors ->first('price') }}</div>
@endif 
</div>

  
    <button type="submit" class="btn btn-primary">Soumettre notre annonce</button>
  </form>
</div>
@endsection