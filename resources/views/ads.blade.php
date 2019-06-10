@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-8">
            <form action={{route('ad.search')}} method="POST" id='searchForm' onsubmit='search(event)'>
                {{-- //on fait passer un evenment en parametre, lorsque je clique sur recherche, on apelle
                cette fonction search-on va dans le script--}}
                @csrf

                {{-- mettre dans adcontroller/ si on met pas le token crsf, ca va pas fonction 419 error --}}
                <div class="form-group">

                    <input type="text" id='word' class="form-control">
                    {{-- //id pour recupere les mots chercher de l'utilsateurs --}}
                    {{-- pour la recherche on utilise axios library, js
                        dans le ad.blade.php, avant la fin de la balise body, on rajoute un yield
                        yiel content --}}
                    <button type="submit" class="btn btn-danger mt-3 text-center">Rechercher</button>
                </div>
                </form>
    <div id="result">
        @foreach($ads as $ad)
        <div class="card mb-3" style="width: 100%;">     
            <div class="card-body">
            <h5 class="card-title">{{$ad->title}}</h5>
            <p class="card-text">{{$ad->description}}</p>
            <p class="card-text text-info">{{$ad->localisation}}</p>
            {{-- ici on utilise librairie carbone pour dire quand c'est posté
            obligation de mettre parse pour string
            on veut que ce soit en francais, on va dans provider appprovider --}}
           <p> <small>{{ Carbon\Carbon::parse($ad->created_at)->diffForHumans()}}</small></p>

            <a href="{{route('ad.create')}}" class="btn btn-primary">voir l'annonce</a>
            </div>
          </div>
        @endforeach
 
        {{-- pour rajouter une pagination.
            afficher la fonction ads et la dessus on a fonction links --}}
        {{$ads->links()}}
    </div>
            </div>
            </div>
    </div>
@endsection
{{-- on va ecrire notre js ici --}}
{{-- // dans notre recherche, on av passer des choses en post --}}
@section('extra-js')
<script>
function search(event){
    event.preventDefault();
    //pour que ca rafraichit pas la page
    const word= document.querySelector('#word').value 
    // on veut faire passer la valeur dans une requete ajax(axios)
    //laravel vient directement avec axios
    //console.log(word)
    //on recupere le id du form pr le mettre dans const url
    // c'est pour pas avoir d'erreur si on change le nom search par autre chose dans les routes

    const url=document.querySelector('#searchForm').getAttribute('action')
    //on a fait ca pour que ce soit dynamique
    axios.post(`${url}`, {
    word: word,
    // ca va ramener vers le controller sans avoir rafraichi la page!
    //mesrecherche/words= nom quelquonque de variable
    //word = nom de la variable word id =word pour recuperer input
   
  })
  .then(function (response) {
    console.log(response.data);
    const ads= response.data.ads
    //on recuepere les reponses du adcontroller
    // c'est le chemin de reponse avec la console log
    let result= document.querySelector('#result')
    // on recupere la div ou il y a notre foreach aevc l'ads au dessus
    result.innerHTML=''
    for(let i=0; i<ads.length; i++){
        // on veut boucler sur chaque ad
        // on recrée une card avec js, ca depend de mon style
        let card= document.createElement('div')
        cardBody.classList.add('card-body')

        let cardBody= document.createElement('div')
        card.classList.add('card, mb-3')
        let title= document.createElement('h5')
        title.classList.add('card-title')
        title.innerHTML= ads[i].title
        let description= document.createElement('p')
        description.classList.add=('card-text')
        description.innerHTML=ads[i].description
        cardBody.appendChild(title)
        cardBody.appendChild(description)
        card.appendChild(cardBody)
        result.appendChild(card)
        // parce que dans la div il y a la balise h5 titre et p description

    }
  })
  .catch(function (error) {
    console.log(error);
  });
}

</script>
@endsection