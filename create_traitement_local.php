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

    <title>Ajouter un traitement local</title>
    <script>
        $(document).ready(function(){
            $('#type_radiotherapie').hide();
            $('#type_trait_loc').change(function(){
                if($('#type_trait_loc').val() == 'Radiothérapie'){
                    $('#type_radiotherapie').show();
                }else{
                    $('#type_radiotherapie').hide();
                }
            });
        });
    </script>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter un nouveau traitement local
                            <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <input type="hidden" name="N_sejour" value="<?=$_GET['N_sejour']; ?>">

                            <div class="mb-3">
                                <label>Nom du traitement local</label>
                                <input type="text" name="nom_trait_local" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Type du traitement local</label>
                                <select name="type_trait_loc" class="form-control" id="type_trait_loc">
                                <option value=""></option>
                                    <option value="Radiothérapie">Radiothérapie</option>
                                    <option value="Radiologie interventionnelle">Radiologie interventionnelle</option>
                                    <option value="Chirurgie">Chirurgie</option>
                                </select>

                            </div>
                            <div class="mb-3" id="type_radiotherapie_div">
                                <label>Type de radiothérapie</label>
                                <select name="type_radiotherapie" class="form-control" id ="type_radiotherapie">
                                    <option value=""></option>
                                    <option value="Conformationnelle">Conformationnelle</option>
                                    <option value="Stéréotaxique">Stéréotaxique</option>
                                    <option value="Gammaknife">Gammaknife</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Date de début de traitement local</label>
                                <input type="date" name="date_debut" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Date de fin du traitement local</label>
                                <input type="date" name="date_fin" class="form-control">
                            </div>


                            <div class="mb-3">
                                <button type="submit" name="save_traitement_local" class="btn btn-primary">Enregistrer</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>

        document.getElementById('type_radiotherapie_div').style.display = 'none';
        document.getElementById('type_trait_loc').addEventListener('change', function () {
        var style = this.value == "Radiothérapie" ? 'block' : 'none';
        if (style == 'none') {
            document.getElementById('type_radiotherapie').value = '';
        }
        document.getElementById('type_radiotherapie_div').style.display = style;
    });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
