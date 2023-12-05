<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <title>G-Facturation</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        @include('content.navbar')
        <!-- ============================================================== -->
        @include('content.sidebar')
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Facturation</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Facture</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">ajouter un facture</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h3 class="card-header">Facturer un diffusion</h3>
                                    <div class="card-body">
                                        <form action="{{ url('/facturation_particulier') }}">
                                            <input type="hidden" name="iddiffusion" value="{{ $diffusion->id }}">
                                            <input type="hidden" name="idclient" value="{{ $client->id }}">
                                            <div class="form-group">
                                                <p style="color: black; ">Nom : {{ $client->nom }}</p>
                                                <p style="color: black; ">Prenoms : {{ $client->prenoms }}</p>
                                                <p style="color: black; ">Email : {{ $client->email }}</p>
                                                <p style="color: black; ">Adresse : {{ $client->adresse }}</p>
                                                <p style="color: black; ">Contact : {{ $client->contact }}</p>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="nom">Diffusion</label>
                                                    <p style="color: black; font-size: 20px;">N° : 15N/AGCORTM/{{ $diffusion->id }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="prenoms">Type de facture</label>
                                                    <select class="form-control" id="typeFacture" name="typeFacture">
                                                        @foreach ($typefacture as $type)
                                                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="email">Status</label>
                                                    <select class="form-control" id="status" name="status">
                                                        @foreach ($liststatus as $status)
                                                            <option value="{{ $status->id }}">{{ $status->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="modePaiement">Mode de paiement</label>
                                                    <select class="form-control" id="modePaiement" name="modepaiement">
                                                        @foreach ($listModePaiement as $modepaiement)
                                                            <option value="{{ $modepaiement->id }}">{{ $modepaiement->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-group row" id="numeroCompteField" style="display: none;">
                                                        <div class="col-md-12">
                                                            <label for="numeroCompte">Numéro de compte</label>
                                                            <input type="text" class="form-control" id="numeroCompte" name="numero_compte" placeholder="Entrez le numéro de compte">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-5">
                                                <button type="submit" class="btn btn-success btn-lg mb-2">Facturer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- slimscroll js -->
    <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
    <!-- chart chartist js -->
    <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
    <!-- sparkline js -->
    <script src="{{ asset('assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
    <!-- morris js -->
    <script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
    <!-- chart c3 js -->
    <script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
    <script src="{{ asset('assets/libs/js/dashboard-ecommerce.js') }}"></script>
    <script>
        function handleModePaiementChange() {
            var selectedOption = document.getElementById('modePaiement').value;
            var numeroCompteField = document.getElementById('numeroCompteField');

            if (selectedOption === '2') {
                numeroCompteField.style.display = 'block'; // Afficher le champ pour le numéro de compte
            } else {
                numeroCompteField.style.display = 'none'; // Masquer le champ pour le numéro de compte
            }
        }

        document.getElementById('modePaiement').onchange = handleModePaiementChange;
    </script>
</body>

</html>
