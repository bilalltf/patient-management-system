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

    <title>Modifier la réduction</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier la réduction de dose du traitement
                       
                        <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end"> BACK</a>
                            
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id_red_dose_traitement']))
                        {
                            $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
                            $trait_id = mysqli_real_escape_string($con, $_GET['nom_trait']);
                            $red_id = mysqli_real_escape_string($con, $_GET['id_red_dose_traitement']);


                            $query = "SELECT * FROM reduction_dose_traitement WHERE id_red_dose_traitement='$red_id' AND N_sejour='$patient_id' AND nom_trait='$trait_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $red = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="id_red_dose_traitement" value="<?= $red['id_red_dose_traitement']; ?>">
                                    <input type="hidden" name="nom_trait" value="<?= $red['nom_trait']; ?>">
                                    <input type="hidden" name="N_sejour" value="<?= $red['N_sejour']; ?>">

                                    <div class="mb-3">
                                        <label for="reduction">Pourcentage de réduction</label>
                                        <input type="text" name="reduction" value="<?= $red['reduction']; ?>" class="form-control" placeholder="Entrer le pourcentage de réduction">
                                    </div>
                                    <div class="mb-3">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" value="<?= $red['date']; ?>" class="form-control" placeholder="Entrer la date">
                                    </div>
                                    <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger">Annuler</a>
                                    <button type="submit" name="update_reduction_dose_traitement" class="btn btn-primary">Modifier</button>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "Aucune réduction trouvée";
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>



                            

          