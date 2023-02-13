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

    <title>Patients MS</title>
</head>
<body>
    <h1 class="display-1" style="text-align: center;">Système de gestion des patients</h1>
    




  
    <div class="container mt-4">
    
    


        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des patients
                            <a href="create_patient.php" class="btn btn-primary float-end">Ajouter un patient</a>
                        </h4>
                    </div>
                    <div class="input-group">
                        <input type="serch" id="myInput" onkeyup="myFunction()" placeholder="Filtrer par N° Séjour" class="form-control rounded">

                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th>N° Séjour</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Date de naissance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        
                                    
                                    $query = "SELECT * FROM patient";
                                    $query_run = mysqli_query($con, $query);



                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $patient)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $patient['N_sejour']; ?></td>
                                                <td><?= $patient['nom']; ?></td>
                                                <td><?= $patient['prenom']; ?></td>
                                                <td><?= $patient['date_naissance']; ?></td>
                                                <td>
                                                    <a href="view_patient.php?N_sejour=<?= $patient['N_sejour']; ?>" class="btn btn-info btn-sm">Afficher</a>
                                                    <a href="edit_patient.php?N_sejour=<?= $patient['N_sejour']; ?>" class="btn btn-success btn-sm">Modifier</a>
                                                    
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletePatient(<?= $patient['N_sejour']; ?>)">Supprimer</button>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                    
                                ?>
                                
                            </tbody>
                        </table>
                        <script>
                            function myFunction() {
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("myTable");
                            tr = table.getElementsByTagName("tr");
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[0];
                                if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                                }       
                            }
                            }

                            function confirmDeletePatient(N_sejour) {
                                if (confirm("Voulez-vous vraiment supprimer ce patient ?")) {
                                    window.location.href = "code.php?delete_patient=" + N_sejour;
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>