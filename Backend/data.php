<?php

    function getBase($login, $mdp, $bd, $server) {
        try {
            $result = new PDO("mysql:host=$server;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
            $result->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $result;
        } catch (PDOException $e) {
            print "Erreur de connexion PDO ";
            die();
        }
    }

    function getComptes() {
        $result = [];

        try {
            $base = getBase("root", "", "site_collection", "");
            $request = $base->prepare("select * from compte");
            $request->execute();
            $Account = $request->fetch(PDO::FETCH_ASSOC);
            while ($Account) {
                $result[] = $Account;
                $Account = $request->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $result;
    }

    function getCompteById($id) {
        $result = [];

        try {
            $base = getBase("root", "", "site_collection", "");
            $request = $base->prepare("select * from compte where n°compte = $id");
            $request->execute();
            $Account = $request->fetch(PDO::FETCH_ASSOC);
            while ($Account) {
                $result[] = $Account;
                $Account = $request->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $result;
    }

    function getCompteByMail($mail) {
        $result = [];

        try {
            $base = getBase("root", "", "site_collection", "");
            $request = $base->prepare("select * from compte where mail = :mail");
            $request->bindParam(':mail', $mail, PDO::PARAM_STR);
            $request->execute();
            $Account = $request->fetch(PDO::FETCH_ASSOC);
            while ($Account) {
                $result[] = $Account;
                $Account = $request->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $result;
    }

    function login($mail, $mdp) {
        $result = [];

        if (!isset($_SESSION)) {
            session_start();
        }
        
        $Accounts = getCompteByMail($mail);
        $Account = $Accounts[0];
        if (isset($Accounts) and $Account['mdp'] == $mdp) {
            $_SESSION['Id'] = $Account['n°compte'];
            $_SESSION['Mdp'] = $Account['mdp'];
        }

        return $result;
    }

    function logout() {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['Id'])) {
            unset($_SESSION['Id']);
            unset($_SESSION['Mdp']);
        }
    }

    function isLoggedIn() {
        if (isset($_SESSION['Id'])) {
            return true;
        } else {
            return false;
        }
    }

    function AmountAccounts() {
        $result = [];

        try {
            $base = getBase("root", "", "site_collection", "");
            $request = $base->prepare("select count(*) as 'Nombre de comptes' from compte");
            $request->execute();
            $Account = $request->fetch(PDO::FETCH_ASSOC);
            while ($Account) {
                $result[] = $Account;
                $Account = $request->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $result;
    }

    function register($pseudo, $mail, $mdp, $image) {
        try {
            $calcule =  AmountAccounts()[0]["Nombre de comptes"]+1;
            $base = getBase("root", "", "site_collection", "");
            $request = $base->prepare("insert into compte (n°compte, pseudo, mail, mdp, image) values (:id, :pseudo, :mail, :mdp, :image)");
            $request->bindParam(':image', $image, PDO::PARAM_INT);
            $request->bindParam(':id', $calcule, PDO::PARAM_INT);
            $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $request->bindParam(':mail', $mail, PDO::PARAM_STR);
            $request->bindParam(':mdp', $mdp, PDO::PARAM_STR);
            $request->execute();
            login($mail, $mdp);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    function GetAccountImage($id) {
        $result = [];

        try {
            $base = getBase("root", "", "site_collection", "");
            $request = $base->prepare("select image from compte where n°compte = :id");
            $request->bindParam(':id', $id, PDO::PARAM_INT);
            $request->execute();
            $Account = $request->fetch(PDO::FETCH_ASSOC);
            while ($Account) {
                $result[] = $Account;
                $Account = $request->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $result;
    }

?>