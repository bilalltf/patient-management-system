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

    <title>Ajouter un traitement</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter un nouveau traitement
                            <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <input type="hidden" name="N_sejour" value="<?=$_GET['N_sejour']; ?>">

                            <div class="mb-3">
                                <label>Nom</label>
                                <input type="text" name="nom_trait" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Date de début du traitement</label>
                                <input type="date" name="date_debut" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Date de fin du traitement</label>
                                <input type="date" name="date_fin" class="form-control">
                            </div>


                            <div class="mb-3">
                                <button type="submit" name="save_traitement" class="btn btn-primary">Enregistrer</button>
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
