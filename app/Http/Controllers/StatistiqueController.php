<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diffusion;
class StatistiqueController extends Controller
{
    //
    public function home(){
        $montant_total = 0;
        $listdiffusionSociete = Diffusion::getListDiffusionSociete();
        $listdiffusionClient = Diffusion::getListDiffusionClient();
        foreach($listdiffusionSociete as $societe){
            $montant_total = $montant_total + ($societe->quantite * $societe->prix_unitaire);
        }
        foreach($listdiffusionClient as $client){
            $montant_total = $montant_total + ($client->quantite * $client->prix_unitaire);
        }
        return view('statistique.home',[
            'montant_total' => $montant_total
        ]);
    }
}
