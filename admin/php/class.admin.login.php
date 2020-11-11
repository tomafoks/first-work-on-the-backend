<?php
class LoginUser
{
    const DB_NAME = "./db/datauseregistation.db";
    private $_dbUser = null;

    function __construct()
    {
        session_start();
        $this->_dbUser = new SQLite3(self::DB_NAME);
    }

    function __destruct()
    {
        $this->_dbUser->close();
        unset($this->_dbUser);
    }

    function getUserName($email, $pw)
    {
        $sql = "SELECT email, password
                FROM User
                WHERE email = '$email'";
        $result = $this->_dbUser->query($sql);
        if ($row = $result->fetchArray()) {
            try {
                if ($this->getPass($pw, $row['password'])) {
                    $_SESSION['email'] = $email;
                    header("Refresh: 1;url=http://localhost");
                    echo "Вошли как $email";
                } else {
                    return "Неверный пароль или логин";
                }
            } catch (Exception $e) {
                echo $e->getLine();
                echo "</br>";
                echo $e->getMessage();
            }
        } else {
            return "Неверный пароль или логин";
        }
    }

    private function getPass($pw, $hash)
    {
        session_start();
        return password_verify($pw, $hash);
    }

    function logout()
    {
        $_SESSION[] = [];
        unset($_COOKIE[session_name()]);
        session_destroy();
        $this->clearSession();
        header("Refresh: 1;url=http://localhost");
    }

    function clearSession()
    {
        setcookie("basket", "", time() - 3600);
        setcookie("PHPSESSID", "", time() - 3600);
    }
}
