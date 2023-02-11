<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Enregistrer un patient</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Enregistrer un nouveau patient
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                        <div class="mb-3">
                                <label>N° Séjour</label>
                                <input type="text" name="N_sejour" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Nom</label>
                                <input type="text" name="nom" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Prénom</label>
                                <input type="prenom" name="prenom" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Age</label>
                                <input type="text" name="age" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Date de naissance</label>
                                <input type="date" name="date_naissance" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Médecin référent</label>
                                <input type="text" name="medecin_referent" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Type histologique</label>
                                <input type="text" name="type_histolog" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Date diagnostic </label>
                                <input type="date" name="date_diagnostic" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Biologie moléculaire</label>
                                <input type="text" name="biologie_moleculaire" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Marqueur/ADNc</label>
                                <input type="text" name="marqueur_ADN" class="form-control">
                            </div>


                            <div class="mb-3">
                                <button type="submit" name="save_patient" class="btn btn-primary">Enregistrer</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
