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

    <title>Ajouter un prélèvement Biopsie/FMI/ADNc </title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter un prélèvement Biopsie/FMI/ADNc
                            <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <input type="hidden" name="N_sejour" value="<?=$_GET['N_sejour']; ?>">
                            <!-- "CREATE TABLE IF NOT EXISTS prelevement_biopsie_fmi_adnc ( \
    id_prelevement_b_f_a INT AUTO_INCREMENT NOT NULL, \
    N_sejour VARCHAR(255) NOT NULL, \
    date DATE, \
    type SET('Biopsie', 'FMI', 'ADNc'), \
    resultat VARCHAR(255), \
    PRIMARY KEY (id_prelevement_b_f_a), \
    FOREIGN KEY (N_sejour) REFERENCES patient(N_sejour) ON DELETE CASCADE)" -->

                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Type</label>
                                <input type="text" name="type" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Résultat</label>
                                <input type="text" name="resultat" class="form-control">
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="save_prelevement_b_f_a" class="btn btn-primary">Enregistrer</button>
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