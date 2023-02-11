<?php
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-timeline-graph2d.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>patient View</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Détails du patient
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['N_sejour']))
                        {
                            $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
                            $query = "SELECT * FROM patient WHERE N_sejour='$patient_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $patient = mysqli_fetch_array($query_run);
                                ?>
                                
                                    <div class="mb-3">
                                        <label>N° Séjour</label>
                                        <p class="form-control">
                                            <?=$patient['N_sejour'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label> Nom</label>
                                        <p class="form-control">
                                            <?=$patient['nom'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Prénom</label>
                                        <p class="form-control">
                                            <?=$patient['prenom'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Age</label>
                                        <p class="form-control">
                                            <?=$patient['age'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date de naissance</label>
                                        <p class="form-control">
                                            <?=$patient['date_naissance'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Médecin référent</label>
                                        <p class="form-control">
                                            <?=$patient['medecin_referent'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Type histologique</label>
                                        <p class="form-control">
                                            <?=$patient['type_histolog'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date diagnostic</label>
                                        <p class="form-control">
                                            <?=$patient['date_diagnostic'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Biologie moléculaire</label>
                                        <p class="form-control">
                                            <?=$patient['biologie_moleculaire'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Marqueur/ADNc </label>
                                        <p class="form-control">
                                            <?=$patient['marqueur_ADN'];?>
                                        </p>
                                    </div>

                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Traitement local -->

    <div class="container mt-4">
    
    


    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des traitements locaux
                        <a href="create_traitement_local.php?N_sejour=<?= $patient_id; ?>" class="btn btn-primary float-end">Ajouter un traitement local</a>
                    </h4>
                </div>
                <div class="input-group">
                    <input type="serch" id="search_traitement_local" onkeyup="filter_traitement_local()" placeholder="Filtrer par nom du traitement local" class="form-control rounded">

                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped" id="traitement_local_table">
                        <thead>
                            <tr>
                                <th>Nom du traitement local</th>
                                <th>Type</th>
                                <th>Type radiothérapie</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Site</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                    
                                
                                $query = "SELECT * FROM traitement_local WHERE N_sejour='$patient_id'";
                                $query_run = mysqli_query($con, $query);



                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?=$row['nom_trait_local'];?></td>
                                            <td><?=$row['type_trait_loc'];?></td>
                                            <td><?=$row['type_radiotherapie'];?></td>
                                            <td><?=$row['date_debut'];?></td>
                                            <td><?=$row['date_fin'];?></td>
                                            <td><?=$row['site'];?></td>
                                            <td>
                                                <a href="edit_traitement_local.php?nom_trait_local=<?= $row['nom_trait_local']; ?>&N_sejour=<?= $patient_id; ?>" class="btn btn-success btn-sm">Modifier</a>
                                                <form action="code.php" method="POST" class="d-inline">
                                                <input type="hidden" name="N_sejour" value="<?=$patient_id;?>">
                                                <button type="submit" name="delete_traitement_local" value="<?=$row['nom_trait_local'];?>" class="btn btn-danger btn-sm">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<h4>Aucun traitement local trouvé</h4>";
                                }
                            ?>
                            
                        </tbody>
                    </table>
                    <script>
                        function filter_traitement_local() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = document.getElementById("search_traitement_local");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("traitement_local_table");
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
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Traitement -->
    <div class="container mt-4">
    
    


        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des traitements
                            <a href="create_traitement.php?N_sejour=<?= $patient_id; ?>" class="btn btn-primary float-end">Ajouter un traitement</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped" id="traitement_table">
                            <thead>
                                <tr>
                                    <th>Nom du traitement</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        
                                    
                                    $query = "SELECT * FROM traitement WHERE N_sejour='$patient_id'";
                                    $query_run = mysqli_query($con, $query);



                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $traitement)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $traitement['nom_trait']; ?></td>
                                                <td><?= $traitement['date_debut']; ?></td>
                                                <td><?= $traitement['date_fin']; ?></td>
                                                <td>
                                                    <a href="edit_traitement.php?nom_trait=<?= $traitement['nom_trait']; ?>&N_sejour=<?= $patient_id; ?>" class="btn btn-success btn-sm">Modifier</a>
                                                    
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="N_sejour" value="<?= $patient_id; ?>">
                                                        <button type="submit" name="delete_traitement" value="<?=$traitement['nom_trait'];?>" class="btn btn-danger btn-sm">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h4>Aucun traitement trouvé</h4>";
                                    }
                                    
                                ?>
                                
                            </tbody>
                        </table>
                        <script>
                            function filter_traitement() {
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("search_traitement");
                            filter = input.value.toUpperCase();

                            table1 = document.getElementById("traitement_table");
                            table2 = document.getElementById("evaluation_table");
                            table3 = document.getElementById("toxicite_table");
                            tables = [table1, table2, table3];
                            for (t = 0; t < tables.length; t++) { 
                                tr = tables[t].getElementsByTagName("tr");
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

                                


                            }
                        </script>

                        
                       





                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Evaluation traitement -->

    <div class="container mt-4">
    
    


        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des évaluations
                            <a href="create_evaluation.php?N_sejour=<?= $patient_id; ?>" class="btn btn-primary float-end">Ajouter une évaluation</a>
                        </h4>
                    </div>
                    <div class="input-group">
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped" id="evaluation_table">
                            <thead>
                                <tr>
                                    <th>Traitement</th>
                                    <th>Date début</th>
                                    <th>Site</th>
                                    <th>Type évaluation</th>
                                    <th>SETE</th>
                                    <th>Type iRECIST</th>
                                    <th>Date fin traitement</th>
                                    <th>Stop</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        
                                    
                                    $query = "SELECT * FROM evaluation_traitement WHERE N_sejour='$patient_id' ORDER BY date_debut DESC";
                                    $query_run = mysqli_query($con, $query);



                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $eval)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $eval['nom_trait']; ?></td>
                                                <td><?= $eval['date_debut']; ?></td>
                                                <td><?= $eval['site']; ?></td>
                                                <td><?= $eval['type_e']; ?></td>
                                                <td><?= $eval['SETE']; ?></td>
                                                <td><?= $eval['type_iRECIST']; ?></td>
                                                <td><?= $eval['date_fin']; ?></td>
                                                <td><?= $eval['stop_obligoprogression']; ?></td>
                                                <td>
                                                    <a href="edit_evaluation.php?id_evaluation_traitement=<?= $eval['id_evaluation_traitement']; ?>&nom_trait=<?= $eval['nom_trait']; ?>&N_sejour=<?= $patient_id; ?>" class="btn btn-success btn-sm">Modifier</a>
                                                    
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="N_sejour" value="<?= $patient_id; ?>">
                                                        <input type="hidden" name="nom_trait" value="<?= $eval['nom_trait']; ?>">
                                                        <button type="submit" name="delete_evaluation" value="<?=$eval['id_evaluation_traitement'];?>" class="btn btn-danger btn-sm">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h4>Aucune évaluation trouvé</h4>";
                                    }
                                    
                                ?>
                                
                            </tbody>
                        </table>
                

                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Liste des toxicité traitement -->

    <div class="container mt-4">
    
    


        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des toxicité traitement
                            <a href="create_toxicite.php?N_sejour=<?= $patient_id; ?>" class="btn btn-primary float-end">Ajouter une toxicité</a>
                        </h4>
                    </div>
                    <div class="input-group">
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped" id="toxicite_table">
                            <thead>
                                <tr>
                                    <th>Traitement</th>
                                    <th>Type toxicité</th>
                                    <th>Grade</th>
                                    <th>Date début</th>
                                    <th>Fin</th>
                                    <th>Date fin</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        
                                    
                                    $query = "SELECT * FROM toxicite_traitement WHERE N_sejour='$patient_id' ORDER BY date_debut DESC";
                                    $query_run = mysqli_query($con, $query);



                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $tox)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $tox['nom_trait']; ?></td>
                                                <td><?= $tox['type_t']; ?></td>
                                                <td><?= $tox['grade']; ?></td>
                                                <td><?= $tox['date_debut']; ?></td>
                                                <td><?= $tox['fin']; ?></td>
                                                <td><?= $tox['date_fin']; ?></td>
                                                <td>
                                                    <a href="edit_evaluation.php?id_toxicite_traitement=<?= $tox['id_toxicite_traitement']; ?>&nom_trait=<?= $tox['nom_trait']; ?>&N_sejour=<?= $patient_id; ?>" class="btn btn-success btn-sm">Modifier</a>
                                                    
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="N_sejour" value="<?= $patient_id; ?>">
                                                        <input type="hidden" name="nom_trait" value="<?= $tox['nom_trait']; ?>">
                                                        <button type="submit" name="delete_toxicite" value="<?=$tox['id_toxicite_traitement'];?>" class="btn btn-danger btn-sm">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h4>Aucune toxicité traitement trouvé</h4>";
                                    }
                                    
                                ?>
                                
                            </tbody>
                        </table>
                

                    </div>
                </div>
            </div>
        </div>
    </div>




<!-- Liste des reductions dose traitement -->

<div class="container mt-4">

  <?php include('message.php'); ?>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Liste des réductions de dose traitement
            <a href="create_reduction_dose_traitement.php?N_sejour=<?= $patient_id; ?>" class="btn btn-primary float-end">Ajouter une toxicité</a>
          </h4>
        </div>
        <div class="input-group">
        </div>
        <div class="card-body">

          <table class="table table-bordered table-striped" id="reduction_dose_table">
            <thead>
              <tr>
                <th>Traitement</th>
                <th>Reduction</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $query = "SELECT * FROM reduction_dose_traitement WHERE N_sejour='$patient_id' ORDER BY date DESC";
                $query_run = mysqli_query($con, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach($query_run as $red)
                    {
                      ?>
                        <tr>
                          <td><?= $red['nom_trait']; ?></td>
                          <td><?= $red['reduction']; ?></td>
                          <td><?= $red['date']; ?></td>
                          <td>
                            <a href="edit_reduction_dose_traitement.php?id_red_dose_traitement=<?= $red['id_red_dose_traitement']; ?>&nom_trait=<?= $red['nom_trait']; ?>&N_sejour=<?= $patient_id; ?>" class="btn btn-success btn-sm">Modifier</a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $red['id_red_dose_traitement']; ?>">Supprimer</button>
                            
                            <!-- Confirm Delete Modal -->
                            <div class="modal fade" id="deleteModal<?= $red['id_red_dose_traitement']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmer la suppression</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer cette réduction de dose de traitement?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <form action="code.php" method="POST" class="d-inline">
                                        <input type="hidden" name="N_sejour" value="<?= $patient_id; ?>">
                                        <input type="hidden" name="nom_trait" value="<?= $red['nom_trait']; ?>">
                                        
                                        <button type="submit" name="delete_reduction_dose" value="<?=$red['id_red_dose_traitement'];?>" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php
                    }
                  }
                  else
                  {
                    echo "<h4>Aucune réduction de dose de traitement trouvé</h4>";
                  }
                  
                  ?>
                  
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</div>

            










    <div class="container mt-4">
    
    


    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Visualisation</h4>
                </div>
                <div class="input-group">
                    <input type="search" id="search_traitement" onkeyup="filter_traitement()" placeholder="Filtrer par nom traitement" class="form-control rounded">

                </div>
                <div class="card-body">
                <div id="traitement-vis">
                    <h5>Traitements</h5>
                </div>

                <div id="traitement-timeline"></div>

                <div id="evaluation-vis">
                    <h5>évaluations</h5>
                </div>

                <div id="evaluation-timeline"></div>   
                
                <div id="toxicite-vis">
                    <h5>Toxicités traitement</h5>
                </div>

                


                <div id="toxicite-timeline"></div>


                <script>

                

                // create a new array to store the timeline items
                var items = [];

                // loop through each row in the traitement table
                var rows = document.getElementById("traitement_table").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
                for (var i = 0; i < rows.length; i++) {
                    var nom_trait = rows[i].getElementsByTagName("td")[0].textContent;
                    var date_debut = rows[i].getElementsByTagName("td")[1].textContent;
                    var date_fin = rows[i].getElementsByTagName("td")[2].textContent;

                    // add a new item to the timeline items array
                    items.push({
                        content: nom_trait,
                        start: date_debut,
                        end: date_fin
                    });
                }

                // create a new timeline using the items array
                var timeline = new vis.Timeline(document.getElementById("traitement-timeline"), items, {});

                // fill the timeline when the user type in the search box search_traitement

                var search_traitement = document.getElementById("search_traitement");
                search_traitement.addEventListener("keyup", function() {
                    var search_traitement_value = search_traitement.value;
                    var filtered_items = items.filter(function(item) {
                        return item.content.toLowerCase().includes(search_traitement_value.toLowerCase());
                    });
                    timeline.setItems(filtered_items);
                });      


                
                // create a new array to store the timeline items for evaluation
                var eval_items = [];
                var eval_container = document.getElementById("evaluation-timeline");

                // loop through each row in the evaluation table //
                var eval_rows = document.getElementById("evaluation_table").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
                for (var i = 0; i < eval_rows.length; i++) {
                    var nom_trait = eval_rows[i].getElementsByTagName("td")[0].textContent;
                    var type_e = eval_rows[i].getElementsByTagName("td")[3].textContent;
                    var SETE = eval_rows[i].getElementsByTagName("td")[4].textContent;
                    var type_iRECIST = eval_rows[i].getElementsByTagName("td")[5].textContent;
                    var date_debut = eval_rows[i].getElementsByTagName("td")[1].textContent;
                    var date_fin = eval_rows[i].getElementsByTagName("td")[6].textContent;
                    var stop_obligoprogression = eval_rows[i].getElementsByTagName("td")[7].textContent;

                    // add a new item to the timeline items array
                    eval_items.push({
                        content: nom_trait,
                        start: date_debut,
                        end: date_fin,
                        type_e: type_e,
                        sete : SETE,
                        type_i: type_iRECIST,
                        stop: stop_obligoprogression
                        

                    });
                }

                // add a function to options to show the evaluation type and SETE in a ticket above the item like in power bi when the user hover the mouse over the item
                var options = {

                        template: function(eval_items, element, data) {
                        var content = eval_items.content + "<br>" + 
                        "Type d'évaluation : " + eval_items.type_e + "<br>" +
                        "SETE : " + eval_items.sete + "<br>" ;
                        if (eval_items.type_i != "" && eval_items.type_i != null) {
                            content += "Type iRECIST : " + eval_items.type_i + "<br>" ;
                        }
                        if (eval_items.stop != "" && eval_items.stop != null) {
                            content += "Stop Traitement : " + eval_items.stop + "<br>" ;
                        }
            

                                        

                        return content;
                    },
        
                };        

                // create a new timeline using the items array
                

                var eval_timeline = new vis.Timeline(eval_container, eval_items, options);

                var search_evaluation = document.getElementById("search_traitement");
                search_evaluation.addEventListener("keyup", function() {
                    var search_traitement_value = search_traitement.value;
                    var filtered_items = eval_items.filter(function(item) {
                        return item.content.toLowerCase().includes(search_traitement_value.toLowerCase());
                    });
                    eval_timeline.setItems(filtered_items);
                });

                // create a new array to store the timeline items for toxicite
                var toxicite_items = [];
                var toxicite_container = document.getElementById("toxicite-timeline");

                // loop through each row in the toxicite table //
                var toxicite_rows = document.getElementById("toxicite_table").getElementsByTagName("tbody")[0].getElementsByTagName("tr");

                for (var i = 0; i < toxicite_rows.length; i++) {
                    var nom_trait = toxicite_rows[i].getElementsByTagName("td")[0].textContent;
                    var type_t = toxicite_rows[i].getElementsByTagName("td")[1].textContent;
                    var grade = toxicite_rows[i].getElementsByTagName("td")[2].textContent;
                    var date_debut = toxicite_rows[i].getElementsByTagName("td")[3].textContent;
                    var fin = toxicite_rows[i].getElementsByTagName("td")[4].textContent;
                    var date_fin = toxicite_rows[i].getElementsByTagName("td")[5].textContent;

                    // add a new item to the timeline items array
                    toxicite_items.push({
                        content: nom_trait,
                        start: date_debut,
                        end: date_fin,
                        type_t: type_t,
                        grade: grade,
                        fin: fin
                    });
                }

                // add a function to options to show the toxicite type and grade in a ticket above the item like in power bi when the user hover the mouse over the item
                var options = {

                        template: function(toxicite_items, element, data) {
                        var content = toxicite_items.content + "<br>" + 
                        "Type de toxicité : " + toxicite_items.type_t + "<br>" +
                        "Grade : " + toxicite_items.grade + "<br>" ;
                        if (toxicite_items.fin != "" && toxicite_items.fin != null) {
                            content += "Fin : " + toxicite_items.fin + "<br>" ;
                        }
                        return content;
                    },
        
                };

                // create a new timeline using the items array
                var toxicite_timeline = new vis.Timeline(toxicite_container, toxicite_items, options);

                search_traitement.addEventListener("keyup", function() {
                    var search_traitement_value = search_traitement.value;
                    var filtered_items = toxicite_items.filter(function(item) {
                        return item.content.toLowerCase().includes(search_traitement_value.toLowerCase());
                    });
                    toxicite_timeline.setItems(filtered_items);
                });

                // hide toxicite-vis if no toxicite in table toxicite_table
                var toxicite_table = document.getElementById("toxicite_table");
                if (toxicite_table.rows.length == 1) {
                    document.getElementById("toxicite-vis").style.display = "none";
                }

                // hide evaluation-vis if no evaluation in table eval_table
                var eval_table = document.getElementById("evaluation_table");
                if (eval_table.rows.length == 1) {
                    document.getElementById("evaluation-vis").style.display = "none";
                }

                // hide traitement-vis if no traitement in table traitement_table
                var traitement_table = document.getElementById("traitement_table");
                if (traitement_table.rows.length == 1) {
                    document.getElementById("traitement-vis").style.display = "none";
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