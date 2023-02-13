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

    <title>Modifier le prélèvement Biopsie/FMI/ADNc </title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier le prélèvement Biopsie/FMI/ADNc 
                       
                        <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end"> BACK</a>
                            
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id_prelevement_b_f_a']))
                        {
                            $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
                            
                            $id_prelevement_b_f_a = mysqli_real_escape_string($con, $_GET['id_prelevement_b_f_a']);
                            $query = "SELECT * FROM prelevement_biopsie_fmi_adnc WHERE id_prelevement_b_f_a='$id_prelevement_b_f_a' AND N_sejour='$patient_id'";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $prelevement_biopsie_fmi_adnc = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="id_prelevement_b_f_a" value="<?= $prelevement_biopsie_fmi_adnc['id_prelevement_b_f_a']; ?>">
                                    <input type="hidden" name="N_sejour" value="<?= $prelevement_biopsie_fmi_adnc['N_sejour']; ?>">

                                    <div class="mb-3">
                                        <label>Date</label>
                                        <input type="text" name="date" value="<?=$prelevement_biopsie_fmi_adnc['date'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Type</label>
                                        <input type="text" name="type" value="<?=$prelevement_biopsie_fmi_adnc['type'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Résultat</label>
                                        <input type="text" name="resultat" value="<?=$prelevement_biopsie_fmi_adnc['resultat'];?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                    <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger"> Annuler</a>
                                    <button type="submit" name="update_prelevement_biopsie_fmi_adnc" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "Aucun enregistrement trouvé";
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