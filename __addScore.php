<?php

require 'config/connect.php';


if ( isset($_POST['addScore']) && (!empty($_POST['winnaar']) OR !empty($_POST['gelijk'])) && isset($_POST['submit']) ) {
        
        $score_slot_1 = mysqli_real_escape_string($con, trim($_POST['score1']));
        $score_slot_2 = mysqli_real_escape_string($con, trim($_POST['score2']));
        $winnaar = mysqli_real_escape_string($con, trim($_POST['winnaar']));
       
        
        if (empty($_POST['gelijk'])) {
            $gelijk = '0';
        } else {
            $gelijk = '1';    
        }
        
        $wedstrijdnr = stripslashes($_GET['id']);
        
        $sql = "UPDATE poulewedstrijden SET goals_slot_1='$score_slot_1', goals_slot_2='$score_slot_2', winnaar = '$winnaar', gelijk = '$gelijk' WHERE wedstrijdnr = '$wedstrijdnr'" or die(mysqli_error());
        
        if ( !mysqli_query($con, $sql) ) {
            echo 'score niet toegevoegd aan database';
        }

        
        // zet kolommen in team gelijk aan de resultaten uit de wedstrijdpoule
        $sql = "UPDATE teams SET gewonnen = (SELECT count(winnaar) FROM poulewedstrijden WHERE winnaar = teams.naam)";
        $query = mysqli_query($con, $sql) or die(mysqli_error($con));



        // zet score gelijk aan aantal gewonnen wedstrijden * 3
        $sql = "SELECT id, gewonnen, gelijk, punten FROM teams";
        $query = mysqli_query($con, $sql);

        while ( $row = mysqli_fetch_assoc($query) )
        {
            $id = $row['id'];
            $sql = "UPDATE teams SET punten = (gewonnen * 3)";
        }
        $query = mysqli_query($con, $sql);
        
        // zet totaal_punten gelijk aan gelijk + punten
        



        mysqli_close($con);       

        $message = urlencode('score succesvol toegevoegd');
        header('location: selectwedstrijd.php?msg=' . $message );

} else {
    echo 'Gegevens niet goed ingevoerd...';
}

?>