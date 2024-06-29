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

    public function save($type) {
        global $conn;
    
        $nomUtilisateur = $this->nomUtilisateur;
        $prenomUtilisateur = $this->prenomUtilisateur;
        $email = $this->email;
        $tel = $this->tel;
        $motDePasse = $this->motDePasse;
    
        // Insertion dans la table Utilisateur
        $sql = "INSERT INTO Utilisateur (NomUtilisateur, PrenomUtilisateur, Email, Tel, MotDePasse) 
                VALUES ('$nomUtilisateur', '$prenomUtilisateur', '$email', '$tel', '$motDePasse')";
        $conn->query($sql);
        
        // Récupération de l'ID de l'utilisateur nouvellement inséré
        $idUtilisateur = $conn->insert_id;
    
        // Insertion dans la table appropriée en fonction du type d'utilisateur
        switch ($type) {
            case 'client':
                $sqlClient = "INSERT INTO Client (IdUtilisateur, EtatClient) VALUES ('$idUtilisateur', 'actif')";
                $conn->query($sqlClient);
                break;
            case 'agent':
                $sqlAgent = "INSERT INTO AgentRéparation (IdUtilisateur, EtatAgent) VALUES ('$idUtilisateur', 'actif')";
                $conn->query($sqlAgent);
                break;
            case 'admin':
                $sqlAdmin = "INSERT INTO Administrateur (IdUtilisateur, DateDernConnex) VALUES ('$idUtilisateur',NOW())";
                $conn->query($sqlAdmin);
                break;
            default:
                // Type d'utilisateur non reconnu
                break;
        }
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
    
        // Suppression dans la table Client
        $sqlClient = "DELETE FROM Client WHERE IdUtilisateur = '$idUtilisateur'";
        $conn->query($sqlClient);
    
        // Suppression dans la table AgentRéparation
        $sqlAgent = "DELETE FROM AgentRéparation WHERE IdUtilisateur = '$idUtilisateur'";
        $conn->query($sqlAgent);
    
        // Suppression dans la table Administrateur
        $sqlAdmin = "DELETE FROM Administrateur WHERE IdUtilisateur = '$idUtilisateur'";
        $conn->query($sqlAdmin);
    
        // Suppression dans la table Utilisateur
        $sqlUser = "DELETE FROM Utilisateur WHERE IdUtilisateur = '$idUtilisateur'";
        return $conn->query($sqlUser);
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

    public static function login($email, $password) {
        global $conn;
    
        // Vérification de l'utilisateur dans la table Utilisateur
        $sql = "SELECT * FROM Utilisateur WHERE Email = '$email'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Vérification du mot de passe
            if ($password === $user['MotDePasse']) {
                // Vérification du type d'utilisateur
                $idUtilisateur = $user['IdUtilisateur'];
                $clientResult = $conn->query("SELECT * FROM Client WHERE IdUtilisateur = '$idUtilisateur'");
                $adminResult = $conn->query("SELECT * FROM Administrateur WHERE IdUtilisateur = '$idUtilisateur'");
                $agentResult = $conn->query("SELECT * FROM AgentRéparation WHERE IdUtilisateur = '$idUtilisateur'");
    
                if ($clientResult->num_rows > 0) {
                    // Utilisateur est un client
                    $conn->query("UPDATE Client SET EtatClient = 'actif' WHERE IdUtilisateur = '$idUtilisateur'");
                    return array('type' => 'client', 'id' => $idUtilisateur);
                } elseif ($adminResult->num_rows > 0) {
                    // Utilisateur est un administrateur
                    $conn->query("UPDATE Administrateur SET DateDernConnex = NOW() WHERE IdUtilisateur = '$idUtilisateur'");
                    return array('type' => 'admin', 'id' => $idUtilisateur);
                } elseif ($agentResult->num_rows > 0) {
                    // Utilisateur est un agent de réparation
                    $conn->query("UPDATE AgentRéparation SET EtatAgent = 'actif' WHERE IdUtilisateur = '$idUtilisateur'");
                    return array('type' => 'agent', 'id' => $idUtilisateur);
                } else {
                    // Erreur: type d'utilisateur non reconnu
                    return array('error' => 'Type d\'utilisateur non reconnu');
                }
            } else {
                // Erreur: mot de passe incorrect
                return array('error' => 'Mot de passe incorrect');
            }
        } else {
            // Erreur: email non trouvé dans la base de données
            return array('error' => 'Email non trouvé');
        }
    }
    public  function isActive() {
        global $conn;
    
        // Vérifier si l'utilisateur est un agent
        $agentQuery = "SELECT * FROM AgentRéparation WHERE IdUtilisateur = '$this->idUtilisateur'";
        $agentResult = $conn->query($agentQuery);
    
        if ($agentResult && $agentResult->num_rows > 0) {
            // L'utilisateur est un agent, vérifier s'il est actif
            // Par exemple, supposons qu'il existe un champ `EtatAgent` dans la table `AgentRéparation`
            $agentRow = $agentResult->fetch_assoc();
            $agentStatus = $agentRow['EtatAgent'];
            return $agentStatus === 'actif';
        } else {
            // L'utilisateur n'est pas un agent, vérifier s'il est client
            $clientQuery = "SELECT * FROM Client WHERE IdUtilisateur = '$this->idUtilisateur'";
            $clientResult = $conn->query($clientQuery);
    
            if ($clientResult && $clientResult->num_rows > 0) {
                // L'utilisateur est un client, vérifier s'il est actif
                // Par exemple, supposons qu'il existe un champ `EtatClient` dans la table `Client`
                $clientRow = $clientResult->fetch_assoc();
                $clientStatus = $clientRow['EtatClient'];
                return $clientStatus === 'actif';
            } else {
                // L'utilisateur n'est ni un agent ni un client
                // Vous pouvez ajouter d'autres vérifications si nécessaire
                return false;
            }
        }
    }

    public static function getAllClients() {
        global $conn;

        $sql = "SELECT u.* FROM Utilisateur u 
                INNER JOIN Client c ON u.IdUtilisateur = c.IdUtilisateur";
        $result = $conn->query($sql);

        $clients = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $client = new User($row['NomUtilisateur'], $row['PrenomUtilisateur'], $row['Email'], $row['Tel'], $row['MotDePasse']);
                $client->setIdUtilisateur($row['IdUtilisateur']);
                $clients[] = $client;
            }
        }

        return $clients;
    }

    // Récupération de tous les agents de réparation
    public static function getAllAgents() {
        global $conn;

        $sql = "SELECT u.* FROM Utilisateur u 
                INNER JOIN AgentRéparation a ON u.IdUtilisateur = a.IdUtilisateur";
        $result = $conn->query($sql);

        $agents = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $agent = new User($row['NomUtilisateur'], $row['PrenomUtilisateur'], $row['Email'], $row['Tel'], $row['MotDePasse']);
                $agent->setIdUtilisateur($row['IdUtilisateur']);
                $agents[] = $agent;
            }
        }

        return $agents;
    }

    // Récupération de tous les administrateurs
    public static function getAllAdmins() {
        global $conn;

        $sql = "SELECT u.* FROM Utilisateur u 
                INNER JOIN Administrateur a ON u.IdUtilisateur = a.IdUtilisateur";
        $result = $conn->query($sql);

        $admins = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $admin = new User($row['NomUtilisateur'], $row['PrenomUtilisateur'], $row['Email'], $row['Tel'], $row['MotDePasse']);
                $admin->setIdUtilisateur($row['IdUtilisateur']);
                $admins[] = $admin;
            }
        }

        return $admins;
    }
    
    public static function getUserByEmail($email) {
        global $conn;

        $sql = "SELECT * FROM Utilisateur WHERE Email = '$email'";
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
    
}

?>
