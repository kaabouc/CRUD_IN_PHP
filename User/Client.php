<?php
include_once '../config.php';
include_once 'User.php';  // Assurez-vous d'inclure la classe Utilisateur

class Client {
    private $idClient;
    private $idUtilisateur;
    private $etatClient;

    public function __construct($idUtilisateur, $etatClient) {
        $this->idUtilisateur = $idUtilisateur;
        $this->etatClient = $etatClient;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getEtatClient() {
        return $this->etatClient;
    }

    public function save() {
        global $conn;

        $idUtilisateur = $this->idUtilisateur;
        $etatClient = $this->etatClient;

        $sql = "INSERT INTO Client (IdUtilisateur, EtatClient) VALUES ('$idUtilisateur', '$etatClient')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idClient = $this->idClient;
        $idUtilisateur = $this->idUtilisateur;
        $etatClient = $this->etatClient;

        $sql = "UPDATE Client SET IdUtilisateur = '$idUtilisateur', EtatClient = '$etatClient' WHERE IdClient = '$idClient'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idClient = $this->idClient;

        $sql = "DELETE FROM Client WHERE IdClient = '$idClient'";
        return $conn->query($sql);
    }

    public static function getAllClients() {
        global $conn;

        $sql = "SELECT * FROM Client";
        $result = $conn->query($sql);

        $clients = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $client = new Client($row['IdUtilisateur'], $row['EtatClient']);
                $client->setIdClient($row['IdClient']);
                $clients[] = $client;
            }
        }

        return $clients;
    }

    public static function getClientById($idClient) {
        global $conn;

        $sql = "SELECT * FROM Client WHERE IdClient = '$idClient'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $client = new Client($row['IdUtilisateur'], $row['EtatClient']);
            $client->setIdClient($row['IdClient']);
            return $client;
        } else {
            return null;
        }
    }

    public static function searchClients($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Client WHERE EtatClient LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $clients = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $client = new Client($row['IdUtilisateur'], $row['EtatClient']);
                $client->setIdClient($row['IdClient']);
                $clients[] = $client;
            }
        }

        return $clients;
    }

    public function getUserInfo() {
        return User::getUserById($this->idUtilisateur);
    }
}
?>
