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

    <title>Modifier le traitement local</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier le traitement local
                       
                        <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end"> BACK</a>
                            
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['nom_trait_local']))
                        {
                            $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
                            $trait_id = mysqli_real_escape_string($con, $_GET['nom_trait_local']);
                            $query = "SELECT * FROM traitement_local WHERE nom_trait_local='$trait_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $traitement_local = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="nom_trait_local" value="<?= $traitement_local['nom_trait_local']; ?>">
                                    <input type="hidden" name="N_sejour" value="<?= $traitement_local['N_sejour']; ?>">

                                    <div class="mb-3">
                                        <label>Nom du traitement local</label>
                                        <input type="text" name="nom_trait_local" value="<?=$traitement_local['nom_trait_local'];?>" class="form-control">

                                    </div>

                                    <div class="mb-3">
                                        <label>Type du traitement local</label>
                                        <select name="type_trait_loc" class="form-control" id="type_trait_loc">
                                            <option value="Radiothérapie" <?php if($traitement_local['type_trait_loc'] == 'Radiothérapie') echo 'selected'; ?>>Radiothérapie</option>
                                            <option value="Radiologie interventionnelle" <?php if($traitement_local['type_trait_loc'] == 'Radiologie interventionnelle') echo 'selected'; ?>>Radiologie interventionnelle</option>
                                            <option value="Chirurgie" <?php if($traitement_local['type_trait_loc'] == 'Chirurgie') echo 'selected'; ?>>Chirurgie</option>
                                        </select>
                                    </div>

                                    <div class="mb-3" id="type_radiotherapie_div">
                                        <label>Type radiothérapie</label>
                                        <select name="type_radiotherapie" class="form-control" id="type_radiotherapie">
                                            <option value="Gammaknife" <?php if($traitement_local['type_radiotherapie'] == 'Gammaknife') echo 'selected'; ?>>Gammaknife</option>
                                            <option value="Stéréotaxique" <?php if($traitement_local['type_radiotherapie'] == 'Stéréotaxique') echo 'selected'; ?>>Stéréotaxique</option>
                                            <option value="Conformationnelle" <?php if($traitement_local['type_radiotherapie'] == 'Conformationnelle') echo 'selected'; ?>>Conformationnelle</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Date de début</label>
                                        <input type="date" name="date_debut" value="<?=$traitement_local['date_debut'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Date de fin</label>
                                        <input type="date" name="date_fin" value="<?=$traitement_local['date_fin'];?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Site</label>
                                        <input type="text" name="site" value="<?=$traitement_local['site'];?>" class="form-control">
                                    </div>


                                    <div class="mb-3">
                                    <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger">Annuler</a>
                                        <button type="submit" name="update_traitement_local" class="btn btn-primary">
                                            Enregistrer
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "Aucun traitement local trouvé";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script>

        if (document.getElementById('type_trait_loc').value != "Radiothérapie") {
        document.getElementById('type_radiotherapie_div').style.display = 'none';
        }
        document.getElementById('type_trait_loc').addEventListener('change', function () {
        var style = this.value == "Radiothérapie" ? 'block' : 'none';
        if (style == 'none') {
            document.getElementById('type_radiotherapie').value = null;
        }
        document.getElementById('type_radiotherapie_div').style.display = style;
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>