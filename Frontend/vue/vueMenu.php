je fais un test maintenant

<li>est ce que ca marche ?</li>

<?php
    include_once "../../Backend/data.php";
    $Comptes = getComptes();
    foreach ($Comptes as $Account) {
        foreach ($Account as $key => $value) {
            echo "<li>$key : $value</li>";
        }
    }
?>