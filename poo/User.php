<?php
include_once 'config.php';

class User {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function save() {
        global $conn;

        $name = $this->name;
        $email = $this->email;
        $password = $this->password;

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $this->id = $conn->insert_id;
            return true;
        } else {
            return false;
        }
    }

    public static function getUserById($id) {
        global $conn;

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User($row['name'], $row['email'], $row['password']);
            $user->setId($row['id']);
            return $user;
        } else {
            return null;
        }
    }

    public function update() {
        global $conn;

        $id = $this->id;
        $name = $this->name;
        $email = $this->email;
        $password = $this->password;

        $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $id = $this->id;

        $sql = "DELETE FROM users WHERE id = '$id'";
        return $conn->query($sql);
    }

    public static function getAllUsers() {
        global $conn;

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        $users = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user = new User($row['name'], $row['email'], $row['password']);
                $user->setId($row['id']);
                $users[] = $user;
            }
        }

        return $users;
    }
}
?>
