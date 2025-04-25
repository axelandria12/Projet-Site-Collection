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
?>