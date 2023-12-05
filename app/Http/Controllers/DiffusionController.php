<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diffusion;
use App\Models\Societe;
use App\Models\Client;
use Illuminate\Support\Carbon;

class DiffusionController extends Controller
{
    //
    public function index(){
        $listdiffusionSociete = Diffusion::getListDiffusionSociete();
        $listdiffusionClient = Diffusion::getListDiffusionClient();
        return view('diffusion.list',[
            'listdiffusionSociete' => $listdiffusionSociete,
            'listdiffusionClient' => $listdiffusionClient
        ]);
    }
    public function ajouterClient(){
        $listSociete = Societe::getList();
        $listClient = Client::getList();
        return view('diffusion.ajouter',[
            'listSociete' => $listSociete,
            'listClient' => $listClient
        ]);
    }
    public function insertDiffusion(Request $request){
        $proprietaire_societe = $request->input('proprietaire_societe');
        $proprietaire_client = $request->input('proprietaire_client');
        $description = $request->input('description');
        $quantite = $request->input('quantite');
        $prix_unitaire = $request->input('prix_unitaire');
        //
        $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
        $dateMada = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
        if(empty($proprietaire_societe)) {
            if(!empty($proprietaire_client)){
                $dataClient = array(
                    'idproprietaire' => $proprietaire_client,
                    'description' => $description,
                    'quantite' => $quantite,
                    'prix_unitaire' => $prix_unitaire,
                    'date' => $dateMada
                );
                Diffusion::insert($dataClient);
                return redirect()->route('diffusion');
            }
            else{
                $message = "Le propriétaire est vide pour les deux types de propriétaires.";
                return redirect()->back()->withErrors(['error' => $message])->withInput();
            }
        } else {
            $dataSociete = array(
                'idproprietaire' => $proprietaire_societe,
                'description' => $description,
                'quantite' => $quantite,
                'prix_unitaire' => $prix_unitaire,
                'date' => $dateMada
            );
            Diffusion::insert($dataSociete);
            return redirect()->route('diffusion');
        }
    }
}
