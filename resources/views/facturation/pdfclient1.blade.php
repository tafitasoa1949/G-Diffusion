<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture</title>
    <style>
        .left{
            float: left;
        }
        .right{
            float: right;
        }
        .clear {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: lightgray;
        }
    </style>
</head>
<body>
    <div style="text-align: center">
        <h5>REPOBLIKAN'I MAGADAGISAKARA</h5>
        <h5>Fitiavana-Tanidrazana-Fandrosoana</h5>
    </div>
    <div>
        <div class="left">
            <img src="{{ public_path('assets/images/mcc.png') }}" alt="">
            <h5>OFFICE DE LA RADIO ET TELEVISION</h5>
            <h5>PUBLIQUE DE MADAGASCAR</h5>
            <h5>IMMEUBLE RNM ANOSY</h5>
            <H5>SERVICE MARKETING ET COMMERCIAL</H5>
        </div>
        <div class="right">
            <h5>Antananrivo, le {{ $dateMada }}</h5>
            <h4>Type : {{ $typefacture->type }}</h4>
            <h4>Status(Mode) : {{ $status->nom }}</h4>
            <h4>N° facture : 15N/AGCORTM/{{ $diffusion->id }}</h4>
        </div>
        <div class="clear"></div>
        <div class="container">
            <p>Nom : {{ $client->nom }}</p>
            <p>Prenoms : {{ $client->prenoms }}</p>
            <p>Email : {{ $client->email }}</p>
            <p>Adresse : {{ $client->adresse }}</p>
            <p>Contact : {{ $client->contact }}</p>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Quantité</th>
                            <th>P U(Ar)</th>
                            <th>Montant(Ar)</th>
                            <th>Taxe(Ar)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $diffusion->description }}</td>
                            <td>{{ $diffusion->quantite}}</td>
                            <td>{{ $diffusion->prix_unitaire }}</td>
                            <td>{{ $montant_ht }}</td>
                            <td>{{ $tva }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Net à payer </td>
                            <td>{{ $montant_total }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Bonus</td>
                            <td>1</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <p>Arretée la présente du facture à la somme de {{ $montant_lettre }} ariary</p>
                <h4><u>Modalité de payement</u></h4>
                <div class="virement">
                    <p>Chèque certifié au nom de l'ORTM</p>
                    <p>Virement titulaire : BNI</p>
                    <p>MOTIF : RGLT FACTURE N°: 222</p>
                    <p>Domicilation: BCM Antananarivo</p>
                    <p>Code Banque : 0099,Code Agence : 00140</p>
                    <p>Numero de compte : {{ $numero_compte }}</p>
                    <p>Clé RIB : 86</p>
                    <p>Contact : 034 04 557 ORTM</p>
                </div>
            </div>
        </div>
        <div class="left" style="margin-left: 50px;">
            <p>Entreprise</p>
        </div>
        <div class="right" style="margin-right: 50px;">
            <p>Client(s)</p>
        </div>
    </div>
</body>
</html>
