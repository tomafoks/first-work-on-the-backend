<?php
class Catalog
{
    const DB_NAME = "db/database.db";
    public $_db = null;

    function getProducts($c)
    {
        $this->_db = new SQLite3(self::DB_NAME);
        if (filesize(self::DB_NAME) == 0)
            return false;
        $sql = $this->filterProduct($c);
        $result = $this->_db->query($sql);
        if (!$result) return false;
        $arr = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $arr[] = $row;
        }
        unset($this->_db);
        return $arr;
    }

    function filterProduct($c)
    {
        switch ($c) {
            case NULL:
                $sql = "SELECT
                            name,
                            category,
                            description,
                            quantity,
                            price,
                            img_name,
                            id
                        FROM Shop";
                return $sql;
                break;
            default:
                $sql = "SELECT
                            name,
                            category,
                            description,
                            quantity,
                            price,
                            img_name,
                            id
                        FROM Shop
                        WHERE category=$c";
                return $sql;
                break;
        }
    }
}
