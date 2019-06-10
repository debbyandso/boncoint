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

 {{-- b:guest , ca permet de creer un endroit où on peut mettre html, ici, mettre 
    le form pour que les gens se connectent, pour les guest! c'est propre a laravel --}}
    @guest

    <h1>Vos informations</h1>
    <hr> 
    <div class="form-group">
            <label for="name"  >Votre nom</label>
    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid':''}} " id="name" name="name ">
    @if ($errors->has('name'))
    <div class="span invalid-feedback"> {{$errors ->first('name') }} </div>
    @endif 
    </div> 
   
    <div class="form-group">
            <label for="email"  >Votre Email</label>
    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid':''}} " id="email" name="email ">
    @if ($errors->has('email'))
    <div class="span invalid-feedback"> Veuillez inserer votre mail</div>
    @endif 
    </div> 
    <div class="form-group">
            <label for="password"  >Mot de passe</label>
    <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid':''}} " id="password" name="password ">
    @if ($errors->has('password'))
    <div class="span invalid-feedback"> Veuillez inserer un mot de passe</div>
    @endif 
    </div> 
{{-- les messages errors sont toujours dans la classe --}}
<div class="form-group">
        <label for="password_confirmation"  >Confirmer votre Mot de passe</label>
<input type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid':''}} " id="password_confirmation" name="password_confirmation ">
@if ($errors->has('password_confirmation'))
<div class="span invalid-feedback"> Veuillez confirmer votre mot de passe</div>
@endif 
</div> 
   
  @endguest
  
    <button type="submit" class="btn btn-primary">Soumettre notre annonce</button>
  </form>
</div>
@endsection