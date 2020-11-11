<?php
class Card
{
    const DB_NAME = "db/database.db";
    public $_db = null;

    function __construct()
    {
        $this->_db = new SQLite3(self::DB_NAME);
    }

    function __destruct()
    {
        $this->_db->close();
        unset($this->_db);
    }

    function getCard($id)
    {
        if (filesize(self::DB_NAME) == 0)
            return false;
        $sql = "SELECT *
                FROM Shop
                WHERE id=$id";
        $res = $this->_db->query($sql);
        if (!$res) return false;
        $arr = [];
        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
            $arr[] = $row;
        }
        return $arr;
    }
}
