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

    <title>Modifier l'évaluation</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier l'évaluation
                       
                        <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end"> BACK</a>
                            
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id_evaluation_traitement']))
                        {
                            $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
                            $trait_id = mysqli_real_escape_string($con, $_GET['nom_trait']);
                            $eval_id = mysqli_real_escape_string($con, $_GET['id_evaluation_traitement']);
                            


                            $query = "SELECT * FROM evaluation_traitement WHERE id_evaluation_traitement='$eval_id' AND N_sejour='$patient_id' AND nom_trait='$trait_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $eval = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="id_evaluation_traitement" value="<?= $eval['id_evaluation_traitement']; ?>">
                                    <input type="hidden" name="nom_trait" value="<?= $eval['nom_trait']; ?>">
                                    <input type="hidden" name="N_sejour" value="<?= $eval['N_sejour']; ?>">

                                    <div class="mb-3">
                                <label>Date de début de l'évaluation</label>
                                <input type="date" name="date_debut" class="form-control" value="<?= $eval['date_debut']; ?>">
                            </div>
                            <div class="mb-3">
                                <label>Site</label>
                                <input type="text" name="site" class="form-control" value="<?= $eval['site']; ?>">
                            </div>


                            <div class="mb-3">
                                <label>Type évaluation</label>
                                <select name="type_e" class="form-control">
                                    <option value="" <?php if($eval['type_e'] == '') echo 'selected'; ?>></option>
                                    <option value="TDM" <?php if($eval['type_e'] == 'TDM') echo 'selected'; ?>>TDM</option>
                                    <option value="IRM" <?php if($eval['type_e'] == 'IRM') echo 'selected'; ?>>IRM</option>
                                    <option value="PET-CT" <?php if($eval['type_e'] == 'PET-CT') echo 'selected'; ?>>PET-CT</option>
                                    <option value="Autre" <?php if($eval['type_e'] == 'Autre') echo 'selected'; ?>>Autre</option>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Signe d'évaluation technique employée RECIST 1.1 ou iRECIST</label>
                                <select name="SETE" class="form-control" id="SETE">
                                    <option value="" <?php if($eval['SETE'] == '') echo 'selected'; ?>></option>
                                    <option value="SD" <?php if($eval['SETE'] == 'SD') echo 'selected'; ?>>SD</option>
                                    <option value="RP" <?php if($eval['SETE'] == 'RP') echo 'selected'; ?>>RP</option>
                                    <option value="RC" <?php if($eval['SETE'] == 'RC') echo 'selected'; ?>>RC</option>
                                    <option value="PD" <?php if($eval['SETE'] == 'PD') echo 'selected'; ?>>PD</option>
                                    <option value="iRECIST" <?php if($eval['SETE'] == 'iRECIST') echo 'selected'; ?>>iRECIST</option>
                                    <option value="Oligoprogression" <?php if($eval['SETE'] == 'Oligoprogression') echo 'selected'; ?>>Oligoprogression</option>
                                </select>
                            </div>

                            <div class="mb-3" id="type_iRECIST_div">
                                <label>Type iRECIST</label>
                                <select name="type_iRECIST" class="form-control" id="type_iRECIST">
                                    <option value="" <?php if($eval['type_iRECIST'] == '') echo 'selected'; ?>></option>
                                    <option value="iUPD" <?php if($eval['type_iRECIST'] == 'iUPD') echo 'selected'; ?>>iUPD</option>
                                    <option value="iCPD" <?php if($eval['type_iRECIST'] == 'iCPD') echo 'selected'; ?>>iCPD</option>
                                    <option value="iSD" <?php if($eval['type_iRECIST'] == 'iSD') echo 'selected'; ?>>iSD</option>
                                    <option value="iPR" <?php if($eval['type_iRECIST'] == 'iPR') echo 'selected'; ?>>iPR</option>
                                    <option value="iCR" <?php if($eval['type_iRECIST'] == 'iCR') echo 'selected'; ?>>iCR</option>
                                </select>
                            </div>
                            
                            <div class="mb-3" id="stop_obligoprogression_div">
                                <label>Stop traitement</label>
                                <select name="stop_obligoprogression" class="form-control" id="stop_obligoprogression">
                                    <option value="" <?php if($eval['stop_obligoprogression'] == '') echo 'selected'; ?>></option>
                                    <option value="Non" <?php if($eval['stop_obligoprogression'] == 'Non') echo 'selected'; ?>>Non</option>
                                    <option value="Oui" <?php if($eval['stop_obligoprogression'] == 'Oui') echo 'selected'; ?>>Oui</option>
                                </select>
                            </div>


                            <div class="mb-3" id="date_fin_div">
                                <label>Date de fin de traitement</label>
                                <input type="date" name="date_fin" value="<?= $eval['date_fin']; ?>" class="form-control">
                            </div>


                                    <div class="mb-3">
                                    <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger">Annuler</a>
                                        <button type="submit" name="update_evaluation" class="btn btn-primary">
                                            Enregistrer
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "Aucune évaluation trouvé";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('date_fin_div').style.display = 'none';
        document.getElementById('type_iRECIST_div').style.display = 'none';
        document.getElementById('stop_obligoprogression_div').style.display = 'none';
        document.getElementById('SETE').addEventListener('change', function () {
        var style = this.value == "PD" ? 'block' : 'none';
        document.getElementById('date_fin_div').style.display = style;
        
        
    });

    document.getElementById('SETE').addEventListener('change', function () {
        var style = this.value == "Oligoprogression" ? 'block' : 'none';
        document.getElementById('stop_obligoprogression_div').style.display = style;
        
    });
    document.getElementById('stop_obligoprogression').addEventListener('change', function () {
        var style = this.value == "Oui" ? 'block' : 'none';
        document.getElementById('date_fin_div').style.display = style;
    });

    document.getElementById('SETE').addEventListener('change', function () {
        var style = this.value == "iRECIST" ? 'block' : 'none';
        document.getElementById('type_iRECIST_div').style.display = style;
    });
    document.getElementById('type_iRECIST').addEventListener('change', function () {
        var style = this.value == "iCPD" ? 'block' : 'none';
        document.getElementById('date_fin_div').style.display = style;
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>