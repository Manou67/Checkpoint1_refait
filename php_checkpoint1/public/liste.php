<?php

echo'<h2>Bribes list</h2>';

$requete = "SELECT * FROM bribe";

$allBribes = $pdo->query($requete)->fetchAll();

?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Payment</th>

    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($allBribes as $key=>$value){
        echo'<tr>';
        echo'<td>'.$value['id'].'</td>';
        echo'<td>'.$value['name'].'</td>';
        echo'<td>'.$value['payment'].'</td>';
        echo'</tr>';
    }
    ?>
    </tbody>
</table>