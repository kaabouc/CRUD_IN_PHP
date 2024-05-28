<?php
include_once '../config.php';
include_once '../User/User.php';  // Assurez-vous d'inclure la classe Utilisateur

class AgentRéparation {
    private $idAgentRéparation;
    private $idUtilisateur;
    private $etatAgent;

    public function __construct($idUtilisateur, $etatAgent) {
        $this->idUtilisateur = $idUtilisateur;
        $this->etatAgent = $etatAgent;
    }

    public function getIdAgentRéparation() {
        return $this->idAgentRéparation;
    }

    public function setIdAgentRéparation($idAgentRéparation) {
        $this->idAgentRéparation = $idAgentRéparation;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getEtatAgent() {
        return $this->etatAgent;
    }

    public function save() {
        global $conn;

        $idUtilisateur = $this->idUtilisateur;
        $etatAgent = $this->etatAgent;

        $sql = "INSERT INTO AgentRéparation (IdUtilisateur, EtatAgent) VALUES ('$idUtilisateur', '$etatAgent')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idAgentRéparation = $this->idAgentRéparation;
        $idUtilisateur = $this->idUtilisateur;
        $etatAgent = $this->etatAgent;

        $sql = "UPDATE AgentRéparation SET IdUtilisateur = '$idUtilisateur', EtatAgent = '$etatAgent' WHERE IdAgentRéparation = '$idAgentRéparation'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idAgentRéparation = $this->idAgentRéparation;

        $sql = "DELETE FROM AgentRéparation WHERE IdAgentRéparation = '$idAgentRéparation'";
        return $conn->query($sql);
    }

    public static function getAllAgentsRéparation() {
        global $conn;

        $sql = "SELECT * FROM AgentRéparation";
        $result = $conn->query($sql);

        $agentsRéparation = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $agentRéparation = new AgentRéparation($row['IdUtilisateur'], $row['EtatAgent']);
                $agentRéparation->setIdAgentRéparation($row['IdAgentRéparation']);
                $agentsRéparation[] = $agentRéparation;
            }
        }

        return $agentsRéparation;
    }

    public static function getAgentRéparationById($idAgentRéparation) {
        global $conn;

        $sql = "SELECT * FROM AgentRéparation WHERE IdAgentRéparation = '$idAgentRéparation'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $agentRéparation = new AgentRéparation($row['IdUtilisateur'], $row['EtatAgent']);
            $agentRéparation->setIdAgentRéparation($row['IdAgentRéparation']);
            return $agentRéparation;
        } else {
            return null;
        }
    }

    public static function searchAgentsRéparation($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM AgentRéparation WHERE EtatAgent LIKE '%$searchTerm%' ";
        $result = $conn->query($sql);

        $agentsRéparation = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $agentRéparation = new AgentRéparation($row['IdUtilisateur'], $row['EtatAgent']);
                $agentRéparation->setIdAgentRéparation($row['IdAgentRéparation']);
                $agentsRéparation[] = $agentRéparation;
            }
        }

        return $agentsRéparation;
    }public function getUserInfo() {
        return User::getUserById($this->idUtilisateur);  // Changez idAgentRéparation à idUtilisateur
    }
}
?>
