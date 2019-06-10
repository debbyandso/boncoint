<?php

namespace App\Http\Controllers;
use App\Ad;
// on doit importer notre model au dessus! Ad
use App\User;
// on a iporté user
use Illuminate\Http\Request;
// on importe le request adstore
use App\Http\Requests\AdStore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

 
class Adcontroller extends Controller
{
    use RegistersUsers;
    //connection new utilisateurs qui vient de s'inscrire pour creer ad
    // il faut importer use
    public function create(){
        return view('create');
        //create.blade.php
    }
    // pas oublier d'ajouter le USE pour REQUEST
    public function store(AdStore $request){
        //adsStore represente notre request

        // store prend la requete en parametre
        //ca permet de mettre des regles pour chaqu elemnts
        // php artisan make:request nomStore

        $validated = $request->validated();
        //cette variable permet de recuperer tous les données qque les utilisateurs ont mis dans le form
    //si je fais un dd($validated), je peux voir toutes les données tapees dans le form
    // deuxiemement, on a va utiliser notre model Add= $add= new Ad()
    if(!Auth::check()){
        // ici on fait la condition pour quand on est pas connecté, on
        //ait un truc qui apparait et dans ce cas, on va dans creae.blade
        // pour mettre ce message
        $request-> validate([
            //objet request et fonction validate où on fait passer
            //voir doc validation
            // on la fait comme ca pour nous montrer qu'on peut le faire ici ou soit
            //sur le model
            'name' =>'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' =>'required|confirmed',
            'password_confirmation' =>'required',

        ]);
        // nous sommes dans la cas où le new utilisateur a rempli la fiche
        // donc, on le crée maintenant
       $user= User::create([
           //on stocke dans une variable user car quand ce sera créer, ca va nous renvoyer
           //un user
            //on importe user
            'name' =>$request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            // on fait passser une facade Hash pour que quand on aille dns la base de donnes
            // on voit pas le mot de pase, c'est cripté
            //on importe hash
        ]);
       //derniere fonction: connecté l'utilisateur fraichement créer grace a id
       // va dans regirster controller de AUth et cherche function
    //    public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();/ valide les infos

    //     $this->guard()->login($this->create($request->all()));/connecte le user

    //     return redirect($this->redirectPath());
    // }
    $this->guard()->login($this->create($request->all()));
// dans ma clase, je dois rajoute le use RegisterUsers;
    }
    
    $ad= new Ad();
        // on doit importer notre model au dessus!

    $ad->title = $validated['title'];
    $ad->description = $validated['description'];
    $ad->localisation = $validated['localisation'];
    $ad->price = $validated['price'];
    $ad->user_id = auth()->user()->id;
    // ca permet d'asocier l'annonce avec utilisateur grace a l'utilisateur id!
    $ad->save();
    //save permet de sauvagarder informations et les persister dans la base de données
    return redirect()->route('welcome')->with('success','Bien joué, votre annonce a été deposée');
    // ce return est la pour le cas où il y a une rreur, ca va retourner sur la page d'accueil welcome.
    // pour aficher le sucess, on va sur la page welcome


    //= tu vas remplacer le title par le title soumis par le client!
    }
}
