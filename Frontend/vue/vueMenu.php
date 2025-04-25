je fais un test maintenant

<li>est ce que ca marche ?</li>

<?php
    include_once "../../Backend/data.php";
    $Account = getCompteById(12234);
    if (empty($Account)) {
        echo "<li>Pas de compte trouvé</li>";
    } else {
        foreach ($Account[0] as $key => $value) {
            echo "<li>$key : $value</li>";
        }
    }
?>