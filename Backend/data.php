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
    
?>