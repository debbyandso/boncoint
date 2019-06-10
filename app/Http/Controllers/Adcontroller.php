<?php

namespace App\Http\Controllers;
use App\Ad;
// on doit importer notre model au dessus! Ad
use App\User;
// on a iporté user
use Illuminate\Http\Request;
// on importe le request adstore
use App\Http\Requests\AdStore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

 
class Adcontroller extends Controller
{
    use RegistersUsers;
    //connection new utilisateurs qui vient de s'inscrire pour creer ad
    // il faut importer use
    public function index(){
        //on recupere nos annonce qu'on insere dans la variables
        //ads et on apelle la DBet recupere la table ads et created at ordre decroissant
        // pas oublier d'importer la facade DB
        $ads = DB::table('ads')->orderBy('created_at', 'DESC')->paginate(1);
        // on recupere sur 5 ads par page/ 1 pour l'exemple
        //pagination se lit avec une ligne dans le blade!
        return view('ads', compact('ads'));
        //le nom de la view= ads et on utilise la function compact pour envoyer
        // la variable ads à l'intereiru de la view
    }
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
   
    
    $ad= new Ad();
        // on doit importer notre model au dessus!

    $ad->title = $validated['title'];
    $ad->description = $validated['description'];
    $ad->localisation = $validated['localisation'];
    $ad->price = $validated['price'];
    // ca permet d'asocier l'annonce avec utilisateur grace a l'utilisateur id!
    $ad->save();
    //save permet de sauvagarder informations et les persister dans la base de données
    return redirect()->route('welcome')->with('success','Bien joué, votre annonce a été deposée');
    // ce return est la pour le cas où il y a une rreur, ca va retourner sur la page d'accueil welcome.
    // pour aficher le sucess, on va sur la page welcome


    //= tu vas remplacer le title par le title soumis par le client!
    }
public function search(Request $request){
// ici, le search fonctionne +axios
// on abesoin de la requete du truc axios
$word=$request->word;
// ca stocke les mots de la recherche de l'utilisatuer
$ads= DB::table('ads')
->where('title','LIKE','%word%')
// pour recupere les add dans le titres
->orWhere('description', 'LIKE', '%word%')
// pour recupere les add dans le description
->orderBy('created_at', 'DESC')
//poste par ordre decroissant
->get();

return response()->json(['success'=> true,'ads'=> $ads]);
//c'est du javascript, on veut envoyer une reponse en json
// on recuepere l annonce avec ads
// dans ma console, je suis censée voir sata

    }
}
