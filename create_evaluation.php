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

    <title>Ajouter une évaluation</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter une nouvelle évaluation
                            <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        if(isset($_GET['N_sejour']))
                        {
                            $N_sejour = $_GET['N_sejour'];
                            $query = "SELECT * FROM traitement WHERE N_sejour = '$N_sejour' AND date_fin IS NULL";
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
                                        <label>Date de début de l'évaluation</label>
                                        <input type="date" name="date_debut" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Site</label>
                                        <input type="text" name="site" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                <label>Type évaluation</label>
                                <select name="type_e" class="form-control">
                                    <option value=""></option>
                                    <option value="TDM">TDM</option>
                                    <option value="TEP">TEP</option>
                                    <option value="IRM">IRM</option>
                                    <option value="Scintigraphie os">Scintigraphie os</option>
                                    <option value="Marqueur">Marqueur</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Signe d'évaluation technique employée RECIST 1.1 ou iRECIST</label>
                                <select name="SETE" class="form-control" id="SETE">
                                    <option value=""></option>
                                    <option value="SD">SD</option>
                                    <option value="RP">RP</option>
                                    <option value="RC">RC</option>
                                    <option value="PD">PD</option>
                                    <option value="iRECIST">iRECIST</option>
                                    <option value="Oligoprogression">Oligoprogression</option>
                                </select>
                            </div>

                            <div class="mb-3" id="type_iRECIST_div">
                                <label>Type iRECIST</label>
                                <select name="type_iRECIST" class="form-control" id="type_iRECIST">
                                    <option value=""></option>
                                    <option value="iUPD">iUPD</option>
                                    <option value="iCPD">iCPD</option>
                                    <option value="iSD">iSD</option>
                                    <option value="iPR">iPR</option>
                                    <option value="iCR">iCR</option>
                                </select>
                            </div>
                            
                            <div class="mb-3" id="stop_obligoprogression_div">
                                <label>Stop traitement</label>
                                <select name="stop_obligoprogression" class="form-control" id="stop_obligoprogression">
                                    <option value=""></option>
                                    <option value="Non">Non</option>
                                    <option value="Oui">Oui</option>
                                </select>
                            </div>


                            <div class="mb-3" id="date_fin_div">
                                <label>Date de fin de traitement</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control" id="date_fin">
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="save_evaluation" id="save_evaluation" class="btn btn-primary">Enregistrer</button>
                            </div>

                        </form>
                        <?php
                    }
                    else
                    {
                        echo "Au moins un traitement doit être ajouté avant d'ajouter une évaluation";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>


                        


    <script>
      if (document.getElementById('SETE').value != "PD" && document.getElementById('stop_obligoprogression').value != "Oui" && document.getElementById('type_iRECIST').value != "iCPD") {
            document.getElementById('date_fin_div').style.display = 'none';

        } 
        if (document.getElementById('SETE').value != "Oligoprogression") {
            document.getElementById('stop_obligoprogression_div').style.display = 'none';
        }
        if (document.getElementById('SETE').value != "iRECIST") {
            document.getElementById('type_iRECIST_div').style.display = 'none';
        }

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

    document.getElementById('save_evaluation').addEventListener('click', function () {
        if (document.getElementById('SETE').value != "Oligoprogression") {
            document.getElementById('stop_obligoprogression').value = null;
        }
        if (document.getElementById('SETE').value != "iRECIST") {
            document.getElementById('type_iRECIST').value = null;
        }
        
        if (document.getElementById('SETE').value != "PD" && document.getElementById('stop_obligoprogression').value != "Oui" && document.getElementById('type_iRECIST').value != "iCPD") {
            document.getElementById('date_fin').value = null;
        }

    });

    </script>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
