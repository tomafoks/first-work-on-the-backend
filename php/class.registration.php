<?php
class RegistartionUser
{
    const DB_NAME = "./db/datauseregistation.db";
    private $_dbUser = null;

    function __construct()
    {
        $this->_dbUser = new SQLite3(self::DB_NAME);
        if (filesize(self::DB_NAME) == 0) {
            try {
                $sql = "CREATE TABLE User 
                    (
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        first_name TEXT,
                        last_name TEXT,
                        email TEXT,
                        phone INTEGER,
                        password TEXT,
                        datetime INTEGER,
                        status TEXT
                    )";
                if (!$result = $this->_dbUser->exec($sql))
                    throw new Exception("Ошибка в создании базы данных", 1);
            } catch (Exception $e) {
                echo $e->getLine();
                echo "</br>";
                echo $e->getMessage();
            }
        }
    }

    function __destruct()
    {
        $this->_dbUser->close();
        unset($this->_dbUser);
    }

    function hashPass($pass)
    {
        $res = password_hash($pass, PASSWORD_BCRYPT);
        return $res;
    }

    function addNewUser()
    {
        $time = time();
        $pass = $this->hashPass($_POST['Password']);
        $f = $_POST['FirstName'];
        $l = $_POST['LastName'];
        $e = $_POST['Email'];
        $p = $_POST['Phone'];
        if ($f == '' or $l == '' or $e == '' or $p == '')
            return false;
        if ($this->checkUser($e) != NULL){
            return false;
        }
        $sql = "INSERT INTO User (
                    first_name,
                    last_name,
                    email,
                    phone,
                    password,
                    datetime,
                    status
                ) VALUES ('$f', '$l', '$e', $p, '$pass', $time, 'Действующий')";
        $this->_dbUser->exec($sql);
        return true;
    }

    function checkUser($email)
    {
        $sql = "SELECT email 
                FROM User
                WHERE email='$email'";
        $row = $this->_dbUser->query($sql);
        $res = $row->fetchArray();
        return $res;
    }
}
