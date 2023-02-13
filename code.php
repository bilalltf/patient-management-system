<?php
session_start();
require 'dbcon.php';

if(isset($_GET['delete_patient']))
{
    $patient_id = mysqli_real_escape_string($con, $_GET['delete_patient']);

    $query = "DELETE FROM patient WHERE N_sejour='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Le patient a été supprimé avec succès";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "La suppression du patient a échoué";
        header("Location: index.php");
        exit(0);
    }
}


if(isset($_GET['delete_traitement']))
{
    $trait_id = mysqli_real_escape_string($con, $_GET['delete_traitement']);
    $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);

    $query = "DELETE FROM traitement WHERE nom_trait='$trait_id' AND N_sejour='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_affected_rows($con) > 0)
    {
        $_SESSION['message'] = "$trait_id et $patient_id Le traitement a été supprimé avec succès";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "La suppression du traitement a échoué";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
}

if (isset($_GET['delete_pbfa'])) {
    $id_pbfa = mysqli_real_escape_string($con, $_GET['delete_pbfa']);
    $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);

    $query = "DELETE FROM prelevement_biopsie_fmi_adnc WHERE id_prelevement_b_f_a='$id_pbfa' AND N_sejour='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_affected_rows($con) > 0)
    {
        $_SESSION['message'] = "Le prélèvement a été supprimé avec succès";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "La suppression du prélèvement a échoué";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
}




if(isset($_GET['delete_traitement_local']))
{
    $trait_local_id = mysqli_real_escape_string($con, $_GET['delete_traitement_local']);
    $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);

    $query = "DELETE FROM traitement_local WHERE nom_trait_local='$trait_local_id' AND N_sejour='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_affected_rows($con) > 0)
    {
        $_SESSION['message'] = "Le traitement local a été supprimé avec succès";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "La suppression du traitement local a échoué";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
}




if(isset($_GET['delete_evaluation']))
{
    $id_evaluation_traitement = mysqli_real_escape_string($con, $_GET['delete_evaluation']);
    $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_GET['nom_trait']);


    $query = "DELETE FROM evaluation_traitement WHERE id_evaluation_traitement='$id_evaluation_traitement' AND N_sejour='$patient_id' AND nom_trait='$nom_trait' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_affected_rows($con) > 0)
    {
        $_SESSION['message'] = "L'évaluation du traitement a été supprimée avec succès";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "La suppression de l'évaluation du traitement a échoué";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
}

if(isset($_GET['delete_toxicite']))
{
    $id_toxicite = mysqli_real_escape_string($con, $_GET['delete_toxicite']);
    $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_GET['nom_trait']);

    $query = "DELETE FROM toxicite_traitement WHERE id_toxicite_traitement='$id_toxicite' AND N_sejour='$patient_id' AND nom_trait='$nom_trait' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_affected_rows($con) > 0)
    {
        $_SESSION['message'] = "La toxicité a été supprimée avec succès";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "La suppression de la toxicité a échoué";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
}


if(isset($_GET['delete_reduction_dose']))
{
    $id_red_dose_traitement = mysqli_real_escape_string($con, $_GET['delete_reduction_dose']);
    $patient_id = mysqli_real_escape_string($con, $_GET['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_GET['nom_trait']);
        $query = "DELETE FROM reduction_dose_traitement WHERE id_red_dose_traitement='$id_red_dose_traitement' AND N_sejour='$patient_id' AND nom_trait='$nom_trait' ";
        $query_run = mysqli_query($con, $query);
    
        if(mysqli_affected_rows($con) > 0)
        {
            $_SESSION['message'] = "La réduction de dose a été supprimée avec succès";
            header("Location: view_patient.php?N_sejour=$patient_id");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = mysqli_error($con);
            header("Location: view_patient.php?N_sejour=$patient_id");
            exit(0);
        }
}



if(isset($_POST['update_patient']))
{
    $patient_id = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $date_naissance = mysqli_real_escape_string($con, $_POST['date_naissance']);
    $medcin_referent = mysqli_real_escape_string($con, $_POST['medecin_referent']);
    $type_histolog = mysqli_real_escape_string($con, $_POST['type_histolog']);
    $date_diagnostic = mysqli_real_escape_string($con, $_POST['date_diagnostic']);
    $biologie_moleculaire = mysqli_real_escape_string($con, $_POST['biologie_moleculaire']);
    $marqueur_ADN = mysqli_real_escape_string($con, $_POST['marqueur_ADN']);

    $query = "UPDATE patient SET nom='$nom', prenom='$prenom', age='$age', date_naissance='$date_naissance', medecin_referent='$medcin_referent', type_histolog='$type_histolog', date_diagnostic='$date_diagnostic', biologie_moleculaire='$biologie_moleculaire', marqueur_ADN='$marqueur_ADN' WHERE N_sejour='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "$patient_id Les modifications sont prises en compte!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Les modifications ne sont pas prises en compte!";
        header("Location: edit_patient.php?N_sejour=$patient_id");
        exit(0);
    }

}


if(isset($_POST['update_prelevement_biopsie_fmi_adnc']))
{
    $patient_id = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $id_prelevement_b_f_a = mysqli_real_escape_string($con, $_POST['id_prelevement_b_f_a']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $resultat = mysqli_real_escape_string($con, $_POST['resultat']);

    $query = "UPDATE prelevement_biopsie_fmi_adnc SET date='$date', type='$type', resultat='$resultat' WHERE id_prelevement_b_f_a='$id_prelevement_b_f_a' AND N_sejour='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Les modifications sont prises en compte!";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Les modifications ne sont pas prises en compte!";
        header("Location: edit_prelevement_biopsie_fmi_adnc.php?N_sejour=$patient_id&id_prelevement_b_f_a=$id_prelevement_b_f_a");
        exit(0);
    }

}


if(isset($_POST['update_traitement']))
{
    $patient_id = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $trait_id = mysqli_real_escape_string($con, $_POST['nom_trait']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $date_fin = !empty($_POST['date_fin']) ? "'".mysqli_real_escape_string($con, $_POST['date_fin'])."'" : "NULL";

    $query = "UPDATE traitement SET date_debut='$date_debut', date_fin=$date_fin WHERE nom_trait='$trait_id' AND N_sejour='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Les modifications sont prises en compte!";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Les modifications ne sont pas prises en compte!";
        header("Location: edit_traitement.php?N_sejour=$patient_id&nom_trait=$trait_id");
        exit(0);
    }
}



if(isset($_POST['update_traitement_local']))
{
    $patient_id = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait_local = mysqli_real_escape_string($con, $_POST['nom_trait_local']);
    $type_trait_loc = mysqli_real_escape_string($con, $_POST['type_trait_loc']);
    $type_radiotherapie = mysqli_real_escape_string($con, $_POST['type_radiotherapie']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $date_fin = !empty($_POST['date_fin']) ? "'".mysqli_real_escape_string($con, $_POST['date_fin'])."'" : "NULL";
    $site = mysqli_real_escape_string($con, $_POST['site']);

    $query = "UPDATE traitement_local SET type_trait_loc='$type_trait_loc', type_radiotherapie='$type_radiotherapie', date_debut='$date_debut', date_fin=$date_fin, site='$site' WHERE nom_trait_local='$nom_trait_local' AND N_sejour='$patient_id' ";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Les modifications sont prises en compte!";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Les modifications ne sont pas prises en compte!";
        header("Location: edit_traitement_local.php?N_sejour=$patient_id&nom_trait_local=$nom_trait_local");
        exit(0);
    }
    
}




if(isset($_POST['update_evaluation']))
{
    $patient_id = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_POST['nom_trait']);
    $id_evaluation_traitement = mysqli_real_escape_string($con, $_POST['id_evaluation_traitement']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $site = mysqli_real_escape_string($con, $_POST['site']);
    $type_e = mysqli_real_escape_string($con, $_POST['type_e']);
    $SETE = mysqli_real_escape_string($con, $_POST['SETE']);
    $type_iRECIST = mysqli_real_escape_string($con, $_POST['type_iRECIST']);
    $stop_obligoprogression = mysqli_real_escape_string($con, $_POST['stop_obligoprogression']);
    
    $date_fin = !empty($_POST['date_fin']) ? "'".mysqli_real_escape_string($con, $_POST['date_fin'])."'" : "NULL";

    if($date_fin != "NULL")
    {
        $query_update = "UPDATE traitement SET date_fin = $date_fin WHERE nom_trait = '$nom_trait' AND N_sejour = '$patient_id'";
        $query_run_update = mysqli_query($con, $query_update);

        $update_trait = '';

        if(mysqli_affected_rows($con) > 0)
        {
            $update_trait = " et la date de fin du traitement $nom_trait a été mise à jour avec succès!";
        }
        else
        {
            $update_trait = mysqli_error($con);
        }

    }

    $query = "UPDATE evaluation_traitement SET date_debut='$date_debut', date_fin=$date_fin, site='$site', type_e='$type_e', SETE='$SETE', type_iRECIST='$type_iRECIST', stop_obligoprogression='$stop_obligoprogression' WHERE id_evaluation_traitement='$id_evaluation_traitement' AND nom_trait='$nom_trait' AND N_sejour='$patient_id' ";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Les modifications sont prises en compte!" . $update_trait;
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = mysqli_error($con) . $update_trait;
        header("Location: edit_evaluation.php?N_sejour=$patient_id&nom_trait=$nom_trait&id_evaluation_traitement=$id_evaluation_traitement");
        exit(0);
    }
}


if(isset($_POST['update_toxicite']))
{
    $patient_id = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_POST['nom_trait']);
    $id_toxicite_traitement = mysqli_real_escape_string($con, $_POST['id_toxicite_traitement']);
    $type_t = mysqli_real_escape_string($con, $_POST['type_t']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $fin = mysqli_real_escape_string($con, $_POST['fin']);
    $date_fin = !empty($_POST['date_fin']) ? "'".mysqli_real_escape_string($con, $_POST['date_fin'])."'" : "NULL";

    $query = "UPDATE toxicite_traitement SET type_t='$type_t', grade='$grade', date_debut='$date_debut', fin='$fin', date_fin=$date_fin WHERE id_toxicite_traitement='$id_toxicite_traitement' AND nom_trait='$nom_trait' AND N_sejour='$patient_id' ";

    $query_run = mysqli_query($con, $query);

    if(mysqli_affected_rows($con) > 0)
    {
        $_SESSION['message'] = "Les modifications sont prises en compte!";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = mysqli_error($con);
        header("Location: edit_toxicite.php?N_sejour=$patient_id&nom_trait=$nom_trait&id_toxicite_traitement=$id_toxicite_traitement");
        exit(0);
    }
    
}


if(isset($_POST['update_reduction_dose_traitement']))
{

    $patient_id = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_POST['nom_trait']);
    $id_red_dose_traitement = mysqli_real_escape_string($con, $_POST['id_red_dose_traitement']);
    $reduction = mysqli_real_escape_string($con, $_POST['reduction']);
    $date = mysqli_real_escape_string($con, $_POST['date']);

    $query = "UPDATE reduction_dose_traitement SET reduction='$reduction', date='$date' WHERE id_red_dose_traitement='$id_red_dose_traitement' AND nom_trait='$nom_trait' AND N_sejour='$patient_id' ";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Les modifications sont prises en compte!";
        header("Location: view_patient.php?N_sejour=$patient_id");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Les modifications ne sont pas prises en compte!";
        header("Location: edit_reduction_dose_traitement.php?N_sejour=$patient_id&nom_trait=$nom_trait&id_red_dose_traitement=$id_red_dose_traitement");
        exit(0);
    }
}

if(isset($_POST['save_patient']))
{
    $N_sejour = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $date_naissance = mysqli_real_escape_string($con, $_POST['date_naissance']);
    $medcin_referent = mysqli_real_escape_string($con, $_POST['medecin_referent']);
    $type_histolog = mysqli_real_escape_string($con, $_POST['type_histolog']);
    $date_diagnostic = mysqli_real_escape_string($con, $_POST['date_diagnostic']);
    $biologie_moleculaire = mysqli_real_escape_string($con, $_POST['biologie_moleculaire']);
    $marqueur_ADN = mysqli_real_escape_string($con, $_POST['marqueur_ADN']);

    $query = "INSERT INTO patient (N_sejour, nom, prenom, age, date_naissance, medecin_referent, type_histolog, date_diagnostic, biologie_moleculaire, marqueur_ADN) VALUES ('$N_sejour', '$nom', '$prenom', '$age', '$date_naissance', '$medecin_referent', '$type_histolog', '$date_diagnostic', '$biologie_moleculaire', '$marqueur_ADN')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Le patient $N_sejour a été enregistré avec succès!";
        header("Location: create_patient.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "L'enregistrement du patient $N_sejour a échoué!";
        header("Location: create_patient.php");
        exit(0);
    }
}


if(isset($_POST['save_traitement_local']))
{
    $N_sejour = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait_local = mysqli_real_escape_string($con, $_POST['nom_trait_local']);
    $type_trait_loc = mysqli_real_escape_string($con, $_POST['type_trait_loc']);
    if($type_trait_loc == "Radiothérapie")
    {
        $type_radiotherapie = mysqli_real_escape_string($con, $_POST['type_radiotherapie']);
    }
    else
    {
        $type_radiotherapie = "";
    }
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $date_fin = !empty($_POST['date_fin']) ? "'".mysqli_real_escape_string($con, $_POST['date_fin'])."'" : "NULL";

    $query = "INSERT INTO traitement_local (N_sejour, nom_trait_local, type_trait_loc, type_radiotherapie, date_debut, date_fin) VALUES ('$N_sejour', '$nom_trait_local', '$type_trait_loc', '$type_radiotherapie', '$date_debut', $date_fin)";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Le traitement $nom_trait a été enregistré avec succès!";
        header("Location: create_traitement_local.php?N_sejour=$N_sejour");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "L'enregistrement du traitement $nom_trait a échoué!";
        header("Location: create_traitement_local.php?N_sejour=$N_sejour");
        exit(0);
    }
}


if(isset($_POST['save_prelevement_b_f_a']))
{
    $N_sejour = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $resultat = mysqli_real_escape_string($con, $_POST['resultat']);

    $query = "INSERT INTO prelevement_biopsie_fmi_adnc (N_sejour, date, type, resultat) VALUES ('$N_sejour', '$date', '$type', '$resultat')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Le prélèvement a été enregistré avec succès!";
        header("Location: create_prelevement_biopsie_fmi_adnc.php?N_sejour=$N_sejour");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = mysqli_error($con);
        header("Location: create_prelevement_biopsie_fmi_adnc.php?N_sejour=$N_sejour");
        exit(0);
    }
}


if(isset($_POST['save_traitement']))
{
    $N_sejour = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_POST['nom_trait']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $date_fin = !empty($_POST['date_fin']) ? "'".mysqli_real_escape_string($con, $_POST['date_fin'])."'" : "NULL";


    $query = "INSERT INTO traitement (N_sejour, nom_trait, date_debut, date_fin) VALUES ('$N_sejour', '$nom_trait', '$date_debut', $date_fin)";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Le traitement $nom_trait a été enregistré avec succès!";
        header("Location: create_traitement.php?N_sejour=$N_sejour");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = mysqli_error($con);
        header("Location: create_traitement.php?N_sejour=$N_sejour");
        exit(0);
    }
}


if(isset($_POST['save_evaluation']))
{
    $N_sejour = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_POST['nom_trait']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $site = mysqli_real_escape_string($con, $_POST['site']);
    $type_e = mysqli_real_escape_string($con, $_POST['type_e']);
    $SETE = mysqli_real_escape_string($con, $_POST['SETE']);
    $type_iRECIST = mysqli_real_escape_string($con, $_POST['type_iRECIST']);
    $stop_obligoprogression = mysqli_real_escape_string($con, $_POST['stop_obligoprogression']);
    
    $date_fin = !empty($_POST['date_fin']) ? "'".mysqli_real_escape_string($con, $_POST['date_fin'])."'" : "NULL";

    $query = "INSERT INTO evaluation_traitement (N_sejour, nom_trait, date_debut, date_fin, site, type_e, SETE, type_iRECIST, stop_obligoprogression) VALUES ('$N_sejour', '$nom_trait', '$date_debut', $date_fin, '$site', '$type_e', '$SETE', '$type_iRECIST', '$stop_obligoprogression')";

    $update_trait = "";
    if($date_fin != "NULL")
    {
        $query_update = "UPDATE traitement SET date_fin = $date_fin WHERE nom_trait = '$nom_trait' AND N_sejour = '$N_sejour'";
        $query_run_update = mysqli_query($con, $query_update);

        if(mysqli_affected_rows($con) > 0)
        {
            $update_trait = " et la date de fin du traitement $nom_trait a été mise à jour avec succès!";
        }
        else
        {
            $update_trait = mysqli_error($con);
        }

    }



    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "L'évaluation du traitement $nom_trait a été enregistrée avec succès!" . $update_trait;
        header("Location: create_evaluation.php?N_sejour=$N_sejour");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = mysqli_error($con) . $update_trait;
        header("Location: create_evaluation.php?N_sejour=$N_sejour");
        exit(0);
    }
}




if(isset($_POST['save_toxicite']))
{
    $N_sejour = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_POST['nom_trait']);
    $type_t = mysqli_real_escape_string($con, $_POST['type_t']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $fin = mysqli_real_escape_string($con, $_POST['fin']);
    $date_fin = !empty($_POST['date_fin']) ? "'".mysqli_real_escape_string($con, $_POST['date_fin'])."'" : "NULL";

    $query = "INSERT INTO toxicite_traitement (N_sejour, nom_trait, type_t, grade, date_debut, date_fin, fin) VALUES ('$N_sejour', '$nom_trait', '$type_t', '$grade', '$date_debut', $date_fin, '$fin')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "La toxicité $type_t a été enregistrée avec succès!";
        header("Location: create_toxicite.php?N_sejour=$N_sejour");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = mysqli_error($con) . "L'enregistrement de la toxicité $type_t a échoué!";
        header("Location: create_toxicite.php?N_sejour=$N_sejour");
        exit(0);
    }
}

if(isset($_POST['save_red_dose_traitement']))
{
    $N_sejour = mysqli_real_escape_string($con, $_POST['N_sejour']);
    $nom_trait = mysqli_real_escape_string($con, $_POST['nom_trait']);
    $reduction = mysqli_real_escape_string($con, $_POST['reduction']);
    $date = mysqli_real_escape_string($con, $_POST['date']);

    $query = "INSERT INTO reduction_dose_traitement (N_sejour, nom_trait, reduction, date) VALUES ('$N_sejour', '$nom_trait', '$reduction', '$date')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "La réduction de dose a été enregistrée avec succès!";
        header("Location: create_reduction_dose_traitement.php?N_sejour=$N_sejour");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "L'enregistrement de la réduction de dose a échoué!";
        header("Location: create_reduction_dose_traitement.php?N_sejour=$N_sejour");
        exit(0);
    }
}



?>