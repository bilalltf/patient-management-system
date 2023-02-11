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

    <title>Ajouter une évaluation</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter une nouvelle toxicité
                            <a href="view_patient.php?N_sejour=<?=$_GET['N_sejour']; ?>" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                            <input type="hidden" name="N_sejour" value="<?=$_GET['N_sejour']; ?>">


                            <div class="mb-3">
                                <label>Nom traitement</label>
                                <input type="text" name="nom_trait" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Type toxicité</label>
                                <input type="text" name="type_t" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Grade</label>
                                <select name="grade" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Date début</label>
                                <input type="date" name="date_debut" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Fin</label>
                                <select name="fin" class="form-control" id="fin">
                                    <option value=""></option>
                                    <option value="Non">Non</option>
                                    <option value="Oui">Oui</option>
                                </select>
                            </div>

                            <div class="mb-3" id="date_fin">
                                <label>Date fin</label>
                                <input type="text" name="date_fin" class="form-control">
                            </div>

                    

                            


                            <div class="mb-3">
                                <button type="submit" name="save_toxicite" class="btn btn-primary">Enregistrer</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('date_fin').style.display = 'none';
       
    document.getElementById('fin').addEventListener('change', function () {
        var style = this.value == "Oui" ? 'block' : 'none';
        document.getElementById('date_fin').style.display = style;
    });
    </script>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
