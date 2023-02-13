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

    <title>Modifier la toxicité</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier la toxicité 
                       
                        <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end"> BACK</a>
                            
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['nom_trait']))
                        {
                            $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
                            $trait_id = mysqli_real_escape_string($con, $_GET['nom_trait']);
                            $id_toxicite_traitement = mysqli_real_escape_string($con, $_GET['id_toxicite_traitement']);
                            
                            $query = "SELECT * FROM toxicite_traitement WHERE nom_trait='$trait_id' AND N_sejour='$patient_id' AND id_toxicite_traitement='$id_toxicite_traitement'";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $toxicite = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="nom_trait" value="<?= $toxicite['nom_trait']; ?>">
                                    <input type="hidden" name="N_sejour" value="<?= $toxicite['N_sejour']; ?>">
                                    <input type="hidden" name="id_toxicite_traitement" value="<?= $toxicite['id_toxicite_traitement']; ?>">

                                    <div class="mb-3">
                                        <label>Type</label>
                                        <input type="text" name="type_t" value="<?=$toxicite['type_t'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Grade</label>
                                        <select name="grade" id="grade" class="form-control">
                                            <option value="" <?php if($toxicite['grade'] == '') echo 'selected'; ?>></option>
                                            <option value="0" <?php if($toxicite['grade'] == '0') echo 'selected'; ?>>0</option>
                                            <option value="1" <?php if($toxicite['grade'] == '1') echo 'selected'; ?>>1</option>
                                            <option value="2" <?php if($toxicite['grade'] == '2') echo 'selected'; ?>>2</option>
                                            <option value="3" <?php if($toxicite['grade'] == '3') echo 'selected'; ?>>3</option>
                                            <option value="4" <?php if($toxicite['grade'] == '4') echo 'selected'; ?>>4</option>
                                            <option value="5" <?php if($toxicite['grade'] == '5') echo 'selected'; ?>>5</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date de début</label>
                                        <input type="date" name="date_debut" value="<?=$toxicite['date_debut'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Fin</label>
                                        <select name="fin" id="fin" class="form-control">
                                            <option value="" <?php if($toxicite['fin'] == '') echo 'selected'; ?>></option>
                                            <option value="Non" <?php if($toxicite['fin'] == 'non') echo 'selected'; ?>>Non</option>
                                            <option value="Oui" <?php if($toxicite['fin'] == 'oui') echo 'selected'; ?>>Oui</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" id="date_fin_div">
                                        <label>Date de fin</label>
                                        <input type="date" name="date_fin" id="date_fin" value="<?=$toxicite['date_fin'];?>" class="form-control">
                                    </div>

                                    <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger"> Annuler</a>
                                    <button type="submit" name="update_toxicite" id="update_toxicite" class="btn btn-primary"> Enregistrer</button>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "Aucune toxicité trouvée";
                            }
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
                            

    </div>

    <script>
    
    if (document.getElementById('fin').value != "Oui") {
        document.getElementById('date_fin_div').style.display = 'none';
    }
       
    document.getElementById('fin').addEventListener('change', function () {
        var style = this.value == "Oui" ? 'block' : 'none';
        if (style == 'none') {
            document.getElementById('date_fin').value = null;
        }
        document.getElementById('date_fin_div').style.display = style;
    });

    // when submit chekc if fin != Oui then date_fin = null
    document.getElementById('update_toxicite').addEventListener('submit', function () {
        if (document.getElementById('fin').value != "Oui") {
            document.getElementById('date_fin').value = null;
        }
    });
    </script>