<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>patient Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier un patient 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['N_sejour']))
                        {
                            $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
                            $query = "SELECT * FROM patient WHERE N_sejour='$patient_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $patient = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="N_sejour" value="<?= $patient['N_sejour']; ?>">

                                    <div class="mb-3">
                                        <label>Nom</label>
                                        <input type="text" name="nom" value="<?=$patient['nom'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Prénom</label>
                                        <input type="text" name="prenom" value="<?=$patient['prenom'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Age</label>
                                        <input type="text" name="age" value="<?=$patient['age'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Date de naissance</label>
                                        <input type="date" name="date_naissance" value="<?=$patient['date_naissance'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Médecin référent</label>
                                        <input type="text" name="medecin_referent" value="<?=$patient['medecin_referent'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Type histologique</label>
                                        <input type="text" name="type_histolog" value="<?=$patient['type_histolog'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Date diagnostic </label>
                                        <input type="date" name="date_diagnostic" value="<?=$patient['date_diagnostic'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Biologie moléculaire</label>
                                        <input type="text" name="biologie_moleculaire" value="<?=$patient['biologie_moleculaire'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Marqueur/ADNc</label>
                                        <input type="text" name="marqueur_ADN" value="<?=$patient['marqueur_ADN'];?>" class="form-control">
                                    </div>


                                    <div class="mb-3">
                                    <a href="index.php" class="btn btn-danger">Annuler</a>
                                        <button type="submit" name="update_patient" class="btn btn-primary">
                                            Enregistrer
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>