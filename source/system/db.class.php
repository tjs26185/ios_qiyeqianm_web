<?php
require_once 'config.inc.php';
if (!is_file(IN_ROOT . './data/install.lock')) {
    exit(header("location:install.php"));
}
class db_mysql
{
    protected $link_id;
    function __construct($dbhost, $dbuser, $dbpw, $dbname, $charset = IN_DBCHARSET)    {
        if (!($this->link_id = @mysql_connect($dbhost, $dbuser, $dbpw))) {
            die($this->mysql_error());
        }
        if (!@mysql_select_db($dbname, $this->link_id)) {
            die($this->mysql_error());
        }
        mysql_set_charset($charset, $this->link_id);
        mysql_query("SET NAMES {$charset}", $this->link_id);
    }
    public function escape_field($field)    {
        return mysql_real_escape_string($field);
    }
    public function fetch_row($res)    {
        return mysql_fetch_row($res);
    }
    public function fetch_array($query, $result_type = MYSQL_ASSOC)    {
        return mysql_fetch_array($query, $result_type);
    }
    public function query($sql)    {
        return mysql_query($sql, $this->link_id);
    }
    public function num_rows($query)    {
        $row = $this->fetch_array($query);
        return $row['count(*)'];
    }
    public function insert_id()    {
        return mysql_insert_id($this->link_id);
    }
    public function getone($sql, $limited = false)    {
        if ($limited == true) {
            $sql = trim("{$sql} LIMIT 1");
        }
        $res = $this->query($sql);
        if ($res !== false) {
            $row = $this->fetch_row($res);
            return $row[0];
        } else {
            return false;
        }
    }
    public function getrow($sql)    {
        $res = $this->query($sql);
        if ($res !== false) {
            return mysql_fetch_assoc($res);
        } else {
            return false;
        }
    }
    public function getall($sql)    {
        $res = $this->query($sql);
        if ($res !== false) {
            $arr = array();
            while ($row = mysql_fetch_assoc($res)) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return false;
        }
    }
    public function mysql_error()    {
        return mysql_error();
    }
    public function mysql_version()    {
        return mysql_get_server_info();
    }
}
class db_pdo
{
    protected $pdo;
    function __construct($dbhost, $dbuser, $dbpw, $dbname, $charset = IN_DBCHARSET)    {
        try {
            $this->pdo = new PDO("mysql:host={$dbhost};dbname={$dbname};charset={$charset}", $dbuser, $dbpw);
            $this->pdo->exec("SET NAMES {$charset}");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function escape_field($field)    {
        return str_replace(array("\n", "\r"), array('\\n', '\\r'), $field);
    }
    public function fetch_row($res)    {
        return $res->fetch(PDO::FETCH_NUM);
    }
    public function fetch_array($query)    {
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function query($sql)    {
        if (preg_match('/^(select|SHOW FULL COLUMNS FROM|SHOW TABLES FROM|SHOW CREATE TABLE)/i', $sql)) {
            return $this->pdo->query($sql);
        } else {
            return $this->pdo->exec($sql);
        }
    }
    public function num_rows($query)    {
        $row = $query->fetch(PDO::FETCH_BOTH);
        return $row[0];
    }
    public function insert_id()    {
        return $this->pdo->lastInsertId();
    }
    public function getone($sql, $limited = false)    {
        if ($limited == true) {
            $sql = trim("{$sql} LIMIT 1");
        }
        $res = $this->query($sql);
        if ($res !== false) {
            $row = $this->fetch_row($res);
            return $row[0];
        } else {
            return false;
        }
    }
    public function getrow($sql)    {
        $res = $this->query($sql);
        if ($res !== false) {
            return $this->fetch_array($res);
        } else {
            return false;
        }
    }
    public function getall($sql)    {
        $res = $this->query($sql);
        if ($res !== false) {
            $arr = array();
            while ($row = $this->fetch_array($res)) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return false;
        }
    }
    public function mysql_error()    {
        $info = $this->pdo->errorInfo();
        return $info[2];
    }
    public function mysql_version()    {
        return $this->pdo->getAttribute(constant('PDO::ATTR_SERVER_VERSION'));
    }
}
$db = extension_loaded('pdo_mysql') ? new db_pdo(IN_DBHOST, IN_DBUSER, IN_DBPW, IN_DBNAME) : new db_mysql(IN_DBHOST, IN_DBUSER, IN_DBPW, IN_DBNAME);
require_once 'function_common.php';
require_once 'han.php';
?>
