<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Diffusion;
use App\Models\Societe;
use App\Models\Client;
use App\Models\TypeFacture;
use App\Models\Status;
use App\Models\ModePaiement;
use Illuminate\Support\Carbon;

class FactureController extends Controller
{
    //
    public function voir_page_facture($id){
        $diffusion = Diffusion::getById($id);
        $societe = Societe::getById($diffusion->idproprietaire);
        $typefacture = TypeFacture::getList();
        $liststatus = Status::getList();
        $listModePaiement = ModePaiement::getList();
        if(!empty($societe)){
            return view('facturation.facture',[
                'societe' => $societe,
                'diffusion' => $diffusion,
                'typefacture' => $typefacture,
                'liststatus' => $liststatus,
                'listModePaiement' => $listModePaiement
            ]);
        }else{
            $client = Client::getById($diffusion->idproprietaire);
            return view('facturation.facture_particulier',[
                'client' => $client,
                'diffusion' => $diffusion,
                'typefacture' => $typefacture,
                'liststatus' => $liststatus,
                'listModePaiement' => $listModePaiement
            ]);
        }

    }
    public function nombreEnLettres($nombre){
        $chiffres = [
            0 => 'zéro',
            1 => 'un',
            2 => 'deux',
            3 => 'trois',
            4 => 'quatre',
            5 => 'cinq',
            6 => 'six',
            7 => 'sept',
            8 => 'huit',
            9 => 'neuf',
            10 => 'dix',
            11 => 'onze',
            12 => 'douze',
            13 => 'treize',
            14 => 'quatorze',
            15 => 'quinze',
            16 => 'seize',
            20 => 'vingt',
            30 => 'trente',
            40 => 'quarante',
            50 => 'cinquante',
            60 => 'soixante',
            70 => 'soixante-dix',
            80 => 'quatre-vingt',
            90 => 'quatre-vingt-dix'
        ];

        if ($nombre < 17) {
            return $chiffres[$nombre];
        }

        if ($nombre < 20) {
            return 'dix-' . $chiffres[$nombre % 10];
        }

        if ($nombre < 100) {
            if ($nombre % 10 === 0) {
                return $chiffres[$nombre];
            } elseif ($nombre < 70 || ($nombre >= 80 && $nombre < 90)) {
                return $chiffres[$nombre - $nombre % 10] . '-' . $chiffres[$nombre % 10];
            } elseif ($nombre >= 70 && $nombre < 80) {
                return 'soixante-' . $chiffres[10 + ($nombre % 10)];
            } elseif ($nombre >= 90) {
                return $chiffres[80] . '-' . $chiffres[$nombre % 10];
            }
        }

        if ($nombre < 1000) {
            $centaines = floor($nombre / 100);
            $reste = $nombre % 100;

            $prefixe = ($centaines === 1) ? '' : $this->nombreEnLettres($centaines) . ' cents ';
            $suffixe = ($reste === 0) ? '' : ' ' . $this->nombreEnLettres($reste);

            return $prefixe . 'cent' . $suffixe;
        }

        if ($nombre < 1000000) {
            $milliers = floor($nombre / 1000);
            $reste = $nombre % 1000;

            $prefixe = ($milliers === 1) ? '' : $this->nombreEnLettres($milliers) . ' mille ';
            $suffixe = ($reste === 0) ? '' : ' ' . $this->nombreEnLettres($reste);

            return $prefixe . $suffixe;
        }

        if ($nombre < 1000000000) {
            $millions = floor($nombre / 1000000);
            $reste = $nombre % 1000000;

            $prefixe = ($millions === 1) ? '' : $this->nombreEnLettres($millions) . ' millions ';
            $suffixe = ($reste === 0) ? '' : ' ' . $this->nombreEnLettres($reste);

            return $prefixe . $suffixe;
        }

        return $nombre;
    }
    public function PDF_facture(Request $request){
        $idsociete = $request->input('idsociete');
        $iddiffusion = $request->input('iddiffusion');
        $diffusion = Diffusion::getById($iddiffusion);
        $montant_total = $diffusion->quantite * $diffusion->prix_unitaire;
        $taux_tva = 0.20;
        $tva = $montant_total * $taux_tva;
        $montant_ht = $montant_total / (1 + $taux_tva);
        //
        $societe = Societe::getById($idsociete);
        $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
        $dateMada = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
        //
        $idtypefacture = $request->input('typeFacture');
        $typefacture = TypeFacture::getById($idtypefacture);
        $idstatus = $request->input('status');
        $status = Status::getById($idstatus);
        $idModepaiement = $request->input('modepaiement');
        $Modepaiement = ModePaiement::getById($idModepaiement);
        //lettre
        $montant_lettre = $this->nombreEnLettres($montant_total);
        //paiment banque
        if($idModepaiement == 2){
            $numero_compte = $request->input('numero_compte');
            $data = [
                'societe' => $societe,
                'dateMada' => $dateMada,
                'status' => $status,
                'typefacture' => $typefacture,
                'Modepaiement' => $Modepaiement,
                'diffusion' => $diffusion,
                'montant_total' => $montant_total,
                'tva' => $tva,
                'montant_ht' => $montant_ht,
                'montant_lettre' => $montant_lettre,
                'numero_compte'=> $numero_compte
            ];
            $pdf = PDF::loadView('facturation.pdf1', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('Facture_TVM_'.$iddiffusion.'.pdf');
        }else{
            $data = [
                'societe' => $societe,
                'dateMada' => $dateMada,
                'status' => $status,
                'typefacture' => $typefacture,
                'Modepaiement' => $Modepaiement,
                'diffusion' => $diffusion,
                'montant_total' => $montant_total,
                'tva' => $tva,
                'montant_ht' => $montant_ht,
                'montant_lettre' => $montant_lettre
            ];

            $pdf = PDF::loadView('facturation.pdf', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('Facture_TVM_'.$iddiffusion.'.pdf');
        }

    }
    public function PDF_facture_particulier(Request $request){
        $idclient = $request->input('idclient');
        $iddiffusion = $request->input('iddiffusion');
        $diffusion = Diffusion::getById($iddiffusion);
        $montant_total = $diffusion->quantite * $diffusion->prix_unitaire;
        $taux_tva = 0.20;
        $tva = $montant_total * $taux_tva;
        $montant_ht = $montant_total / (1 + $taux_tva);
        //
        $client = Client::getById($idclient);
        $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
        $dateMada = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
        //
        $idtypefacture = $request->input('typeFacture');
        $typefacture = TypeFacture::getById($idtypefacture);
        $idstatus = $request->input('status');
        $status = Status::getById($idstatus);
        $idModepaiement = $request->input('modepaiement');
        $Modepaiement = ModePaiement::getById($idModepaiement);
        //lettre
        $montant_lettre = $this->nombreEnLettres($montant_total);
        //paiment banque
        if($idModepaiement == 2){
            $numero_compte = $request->input('numero_compte');
            $data = [
                'client' => $client,
                'dateMada' => $dateMada,
                'status' => $status,
                'typefacture' => $typefacture,
                'Modepaiement' => $Modepaiement,
                'diffusion' => $diffusion,
                'montant_total' => $montant_total,
                'tva' => $tva,
                'montant_ht' => $montant_ht,
                'montant_lettre' => $montant_lettre,
                'numero_compte'=> $numero_compte
            ];
            $pdf = PDF::loadView('facturation.pdfclient1', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('Facture_TVM_'.$iddiffusion.'.pdf');
        }else{
            $data = [
                'client' => $client,
                'dateMada' => $dateMada,
                'status' => $status,
                'typefacture' => $typefacture,
                'Modepaiement' => $Modepaiement,
                'diffusion' => $diffusion,
                'montant_total' => $montant_total,
                'tva' => $tva,
                'montant_ht' => $montant_ht,
                'montant_lettre' => $montant_lettre
            ];

            $pdf = PDF::loadView('facturation.pdfclient', $data);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('Facture_TVM_'.$iddiffusion.'.pdf');
        }
    }
}
