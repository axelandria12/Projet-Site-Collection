je fais un test maintenant

<li>Page of test:</li>

<?php
    include_once "../../Backend/data.php";
    print(AmountAccounts()[0]["Nombre de comptes"] . "<br>");
    register('Axel', 'kaiserlovekaiser@gluhgluh.gluh', 'le marchand de glace', "");
    print(isLoggedIn());
?>