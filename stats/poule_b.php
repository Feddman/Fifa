<?php 
require '../config/connect.php';
//
//$data = $con->query("SELECT * FROM teams WHERE poule = 'a'");

$sql = "SELECT naam, punten FROM teams WHERE poule = 'B' ORDER BY punten DESC";
$query = mysqli_query($con, $sql);

    $i = 1;
    while ($row = mysqli_fetch_assoc($query)){
       echo '<tr>';
       echo "<td> $i </td>";
       echo "<td>" . $row['naam'] . "</td>";
       echo "<td>" . $row['punten'] . "</td>";
       echo '</tr>';
       $i++;
    }
    
    mysqli_close($con);
?>
    
    
				