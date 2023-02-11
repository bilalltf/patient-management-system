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

    <title>Modifier le traitement</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier le traitement 
                       
                        <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end"> BACK</a>
                            
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['nom_trait']))
                        {
                            $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
                            $trait_id = mysqli_real_escape_string($con, $_GET['nom_trait']);
                            $query = "SELECT * FROM traitement WHERE nom_trait='$trait_id' AND N_sejour='$patient_id'";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $traitement = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="nom_trait" value="<?= $traitement['nom_trait']; ?>">
                                    <input type="hidden" name="N_sejour" value="<?= $traitement['N_sejour']; ?>">

                                    <div class="mb-3">
                                        <label>Date début</label>
                                        <input type="text" name="date_debut" value="<?=$traitement['date_debut'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Date fin</label>
                                        <input type="text" name="date_fin" value="<?=$traitement['date_fin'];?>" class="form-control">
                                    </div>


                                    <div class="mb-3">
                                    <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger">Annuler</a>
                                        <button type="submit" name="update_traitement" class="btn btn-primary">
                                            Enregistrer
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>Aucun traitement trouvé</h4>";
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