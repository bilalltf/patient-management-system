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

    <title>Ajouter une réduction</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter une nouvelle réduction de dose traitement
                            <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        if(isset($_GET['N_sejour']))
                        {
                            $N_sejour = $_GET['N_sejour'];
                            $query = "SELECT * FROM traitement WHERE N_sejour = '$N_sejour'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="N_sejour" value="<?=$_GET['N_sejour']; ?>">
                                    <div class="mb-3">
                                        <label>Nom traitement</label>
                                        <select name="nom_trait" class="form-control">
                                            <option value=""></option>
                                            <?php
                                            foreach($query_run as $row)
                                            {
                                                ?>
                                                <option value="<?= $row['nom_trait']; ?>"><?= $row['nom_trait']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Pourcentage de réduction</label>
                                        <input type="text" name="reduction" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Date</label>
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="save_red_dose_traitement" class="btn btn-success">Enregistrer</button>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "Au moins un traitement doit être ajouté avant de pouvoir ajouter une réduction de dose de traitement";
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
