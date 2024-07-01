<?php
include_once 'config.php';
include_once '../User/User.php';
class Administrateur {
    private $idAdministrateur;
    private $idUtilisateur;
    private $dateDernConnex; 

    public function __construct($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdAdministrateur() {
        return $this->idAdministrateur;
    }


    public function setIdAdministrateur($idAdministrateur) {
        $this->idAdministrateur = $idAdministrateur;
    }
    public function getDateDernConnex() {
        return $this->dateDernConnex;
    }

    public function setDateDernConnex($dateDernConnex) {
        $this->dateDernConnex = $dateDernConnex;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function save() {
        global $conn;

        $idUtilisateur = $this->idUtilisateur;

        $sql = "INSERT INTO Administrateur (IdUtilisateur) VALUES ('$idUtilisateur')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idAdministrateur = $this->idAdministrateur;
        $idUtilisateur = $this->idUtilisateur;

        $sql = "UPDATE Administrateur SET IdUtilisateur = '$idUtilisateur' WHERE IdAdministrateur = '$idAdministrateur'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idAdministrateur = $this->idAdministrateur;

        $sql = "DELETE FROM Administrateur WHERE IdAdministrateur = '$idAdministrateur'";
        return $conn->query($sql);
    }

    public static function getAllAdministrateurs() {
        global $conn;

        $sql = "SELECT * FROM Administrateur";
        $result = $conn->query($sql);

        $administrateurs = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $administrateur = new Administrateur($row['IdUtilisateur']);
                $administrateur->setIdAdministrateur($row['IdAdministrateur']);

                $administrateurs[] = $administrateur;
            }
        }

        return $administrateurs;
    }
    public static function getAllAdmins() {
        global $conn;
    
        $sql = "SELECT u.*, a.dateDernConnex FROM Utilisateur u 
                INNER JOIN Administrateur a ON u.IdUtilisateur = a.IdUtilisateur";
        $result = $conn->query($sql);
    
        $admins = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $admin = new User(
                    $row['IdUtilisateur'],
                    $row['NomUtilisateur'],
                    $row['PrenomUtilisateur'],
                    $row['Email'],
                    $row['Tel'],
                    $row['MotDePasse'],
                    $row['dateDernConnex']
                );
                $admins[] = $admin;
            }
        }
    
        return $admins;
    }
    

    public static function getAdministrateurById($idAdministrateur) {
        global $conn;

        $sql = "SELECT * FROM Administrateur WHERE IdAdministrateur = '$idAdministrateur'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $administrateur = new Administrateur($row['IdUtilisateur']);
            $administrateur->setIdAdministrateur($row['IdAdministrateur']);
            return $administrateur;
        } else {
            return null;
        }
    }

    public static function searchAdministrateurs($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Administrateur WHERE IdUtilisateur LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $administrateurs = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $administrateur = new Administrateur($row['IdUtilisateur']);
                $administrateur->setIdAdministrateur($row['IdAdministrateur']);
                $administrateurs[] = $administrateur;
            }
        }

        return $administrateurs;
    }

    public function getUserInfo() {
        return User::getUserById($this->idUtilisateur);
    }
}
?>
