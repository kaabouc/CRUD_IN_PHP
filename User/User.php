<?php
include_once 'config.php';

class User {
    private $idUtilisateur;
    private $nomUtilisateur;
    private $prenomUtilisateur;
    private $email;
    private $tel;
    private $motDePasse;

    public function __construct($nomUtilisateur, $prenomUtilisateur, $email, $tel, $motDePasse) {
        $this->nomUtilisateur = $nomUtilisateur;
        $this->prenomUtilisateur = $prenomUtilisateur;
        $this->email = $email;
        $this->tel = $tel;
        $this->motDePasse = $motDePasse;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }
    public function getIdUtilisateur() {
       return $this->idUtilisateur ;
    }

    // Getter et Setter pour le nom de l'utilisateur
    public function getNomUtilisateur() {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur($nomUtilisateur) {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    // Getter et Setter pour le prénom de l'utilisateur
    public function getPrenomUtilisateur() {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur($prenomUtilisateur) {
        $this->prenomUtilisateur = $prenomUtilisateur;
    }

    // Getter et Setter pour l'email de l'utilisateur
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // Getter et Setter pour le téléphone de l'utilisateur
    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    // Getter et Setter pour le mot de passe de l'utilisateur
    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    // Les autres getters et setters pour les autres attributs

    public function save() {
        global $conn;

        $nomUtilisateur = $this->nomUtilisateur;
        $prenomUtilisateur = $this->prenomUtilisateur;
        $email = $this->email;
        $tel = $this->tel;
        $motDePasse = $this->motDePasse;

        $sql = "INSERT INTO Utilisateur (NomUtilisateur, PrenomUtilisateur, Email, Tel, MotDePasse) 
                VALUES ('$nomUtilisateur', '$prenomUtilisateur', '$email', '$tel', '$motDePasse')";
        return $conn->query($sql);
    }

    public static function getUserById($idUtilisateur) {
        global $conn;

        $sql = "SELECT * FROM Utilisateur WHERE IdUtilisateur = '$idUtilisateur'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User($row['NomUtilisateur'], $row['PrenomUtilisateur'], $row['Email'], $row['Tel'], $row['MotDePasse']);
            $user->setIdUtilisateur($row['IdUtilisateur']);
            return $user;
        } else {
            return null;
        }
    }

    // Méthode pour mettre à jour un utilisateur

    public function delete() {
        global $conn;
    
        $idUtilisateur = $this->idUtilisateur;
    
        $sql = "DELETE FROM Utilisateur WHERE IdUtilisateur = '$idUtilisateur'";
        return $conn->query($sql);
    }
    
    
    public function update() {
        global $conn;
    
        $idUtilisateur = $this->idUtilisateur;
        $nomUtilisateur = $this->nomUtilisateur;
        $prenomUtilisateur = $this->prenomUtilisateur;
        $email = $this->email;
        $tel = $this->tel;
        $motDePasse = $this->motDePasse;
    
        $sql = "UPDATE Utilisateur SET NomUtilisateur = '$nomUtilisateur', PrenomUtilisateur = '$prenomUtilisateur', 
                Email = '$email', Tel = '$tel', MotDePasse = '$motDePasse' WHERE IdUtilisateur = '$idUtilisateur'";
        return $conn->query($sql);
    }
    
    // Méthode pour supprimer un utilisateur

    public static function getAllUsers() {
        global $conn;

        $sql = "SELECT * FROM Utilisateur";
        $result = $conn->query($sql);

        $users = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user = new User($row['NomUtilisateur'], $row['PrenomUtilisateur'], $row['Email'], $row['Tel'], $row['MotDePasse']);
                $user->setIdUtilisateur($row['IdUtilisateur']);
                $users[] = $user;
            }
        }

        return $users;
    }

    public static function searchUsers($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Utilisateur WHERE NomUtilisateur LIKE '%$searchTerm%' OR PrenomUtilisateur LIKE '%$searchTerm%' OR Email LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $users = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user = new User($row['NomUtilisateur'], $row['PrenomUtilisateur'], $row['Email'], $row['Tel'], $row['MotDePasse']);
                $user->setIdUtilisateur($row['IdUtilisateur']);
                $users[] = $user;
            }
        }

        return $users;
    }
}
?>
