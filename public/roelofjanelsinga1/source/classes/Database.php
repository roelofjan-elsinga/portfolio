<?php
/**
 * This is the basic PDO connection to the MySQL database
 *
 * @author Roelof
 */
class Database {

    private $connection;
    private $host = 'localhost';
    private $dbname = 'deb80702_project';
    private $username = 'deb80702';
    private $password = 'south1234';

    public function __construct() {
        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function login($email, $pass) {
        $s = $this->getConnection()->query("SELECT * FROM `user` WHERE `email`=" . $email)->fetch(PDO::FETCH_ASSOC);
        if (empty($s['email'])) {
            return false;
        } else {
            if (password_needs_rehash($s['password'], PASSWORD_BCRYPT) && sha1($pass) === $s['password']) {
                $password = password_hash($pass, PASSWORD_BCRYPT);
                $update = $this->getConnection()->prepare("UPDATE users SET password=? WHERE id=?")->execute(array($password, $s['id']));

                $_SESSION['id'] = $s['id'];
                return true;
            } else {
                if (password_verify($pass, $s['password'])) {
                    $_SESSION['id'] = $s['id'];
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function logout() {
        unset($_SESSION['id']);
        session_destroy();
    }

}
