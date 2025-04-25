je fais un test maintenant

<li>est ce que ca marche ?</li>

<?php
    include_once "../../Backend/data.php";
    $Comptes = getComptes();
    foreach ($Comptes as $Account) {
        echo $Account."<br>";
    }
?>