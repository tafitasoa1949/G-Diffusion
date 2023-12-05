<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societe;
use App\Models\Client;
use App\Models\Diffusion;

class ClientController extends Controller
{
    //
    public function index(){
        $listdiffusionSociete = Diffusion::getListDiffusionSociete();
        $listdiffusionClient = Diffusion::getListDiffusionClient();
        return view('index',[
            'listdiffusionSociete' => $listdiffusionSociete,
            'listdiffusionClient' => $listdiffusionClient
        ]);
    }
    public function voirListeSociete(){
        $listSociete = Societe::getList();
        return view('societe.list',[
            'listSociete' => $listSociete
        ]);
    }
    public function ajouterSociete(){
        return view('societe.ajouter');
    }
    public function insertSociete(Request $request){
        $dataSociete = array(
            'doit' => $request->input('doit'),
            'nif' => $request->input('nif'),
            'stat' => $request->input('stat'),
            'email' => $request->input('email'),
            'adresse' => $request->input('adresse'),
            'contact' => $request->input('contact'),
            'responsable' => $request->input('responsable')
        );
        try {
            Societe::insert($dataSociete);
            return redirect()->route('list_societe');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    public function voirListeClient(){
        $listClient = Client::getList();
        return view('client_particulier.list',[
            'listClient' => $listClient
        ]);
    }
    public function ajouterClient(){
        return view('client_particulier.ajouter');
    }
    public function insertClient(Request $request){
        $dataClient = array(
            'nom' => $request->input('nom'),
            'prenoms' => $request->input('prenoms'),
            'email' => $request->input('email'),
            'adresse' => $request->input('adresse'),
            'contact' => $request->input('contact'),
        );
        try {
            Client::insert($dataClient);
            return redirect()->route('list_client');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    public function deleteClient($id){
        try{
            Client::supprimer($id);
            return redirect()->route('list_client');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    public function deleteSociete($id){
        try{
            Societe::supprimer($id);
            return redirect()->route('list_client');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
