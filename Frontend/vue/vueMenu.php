je fais un test maintenant

<li>est ce que ca marche ?</li>

<?php
    include_once "../../Backend/data.php";
    login('test@test.fr', 'test12');
    print(isloggedIn());
?>