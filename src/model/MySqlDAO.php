<?php


class MySqlDAO
{

    private static $connection;

    private static function getConnection(){

        if(empty(self::$connection)){
            self::$connection = new mysqli('mysql', 'root', '', 'supermercado_online');
            self::$connection->set_charset('utf8');
        }

        return self::$connection;
    }

    public static function getResult($query, $params = null)
    {
        $stmt = self::getConnection()->prepare($query);

        if(!empty($params)) {
            $types = null;
            foreach ($params as $param) {
                $types .= $param === null ? 's' : substr(gettype($param), 0,1);
            }
            $types = str_replace('b', 'i', $types);

            $params = array_merge(array($types), $params);

            call_user_func_array(array($stmt, 'bind_param'), self::refParams($params));
        }

        if($stmt->execute()) {
            return $stmt->get_result();
        }
        return false;
    }

    private static function refParams($params)
    {
        $ref = array();
        foreach ($params as $key => $value) {
            $ref[$key] = &$params[$key];
        }

        return $ref;
    }

    public static function executeQuery($query, $params)
    {
        $stmt = self::getConnection()->prepare($query);

        $types = null;
        foreach ($params as $param) {
            $types .= $param === null ? 's' : substr(gettype($param), 0,1);
        }
        $types = str_replace('b', 'i', $types);

        $params = array_merge(array($types), $params);

        call_user_func_array(array($stmt, 'bind_param'), self::refParams($params));

        if($stmt->execute()) {
            if($stmt->insert_id != 0) {
                return $stmt->insert_id;
            }
            return true;
        }
        return false;
    }

    public static function closeConnection()
    {
        if(self::getConnection() != null) {
            self::getConnection()->close();

            return true;
        }

        return false;
    }

    public function __destruct()
    {
        if(self::getConnection() instanceof mysqli)
            self::getConnection()->close();
    }

}