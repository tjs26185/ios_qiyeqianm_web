<?php

/**
 * 基于 Mysqli 的数据库操作类库
 * author Lee.
 * Last modify $Date: 2012-11-30 $
 */
class  M
{
    public $db;
    public $rs;

    public function __construct()
    {   //应用构造函数对类体中的属性进行初始化
        $this->db = MysqliDb::getDB();
    }


    public function cache_obj($cache)
    {
        $this->cache = $cache;
    }

    public function prepare($sql) //绑定sql
    {
        return $this->db->prepare($sql);
    }

    /**
     * @param $sql SQL语句
     * @param $params 参数数组
     * @param $isBool 是否返回布尔 默认返回数组
     * @return 查询成功则返回结果否则false
     */
    public function getOne($sql, $params, $isBool)
    {
        $result = $this->execSQL($sql, $params, $isBool);
        if ($result && count($result) > 0) {
            return $result[0];
        } else {
            return false;
        }
    }

    /**
     *
     * @param $sql SQL语句
     * @param $params 参数数组
     * @param $isBool 是否返回布尔 默认返回数组
     * @return array|int 返回数组 或者 0|1
     */
    public function execSQL($sql, $params, $isBool=false)
    {
        $mysqli = $this->db;
        $stmt = $mysqli->prepare($sql) or die ('编译SQL发生了错误' . defined('DEBUG') && DEBUG ? $sql."|".$mysqli->error : '');
        call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
        $stmt->execute();
        if ($isBool) { //指定只需要返回是否删除 修改 增加成功
            $result = $mysqli->affected_rows;
        } else if (substr(trim(strtolower($sql)), 0, 6) == 'select') { //返回查询结果

            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            $results = array();
            call_user_func_array(array($stmt, 'bind_result'), $this->refValues($parameters));
            while ($stmt->fetch()) {
                $x = array();
                foreach ($row as $key => $val) {
                    $x[$key] = $val;
                }
                $results[] = $x;
            }
            $result = $results;
        } else {//否则返回的$stmt 自行处理
            return array("stmt" => $stmt, "mysqli" => $mysqli);
        }
        if (defined('DEBUG') && DEBUG && $stmt->error != '') { //捕获错误
            print_r($stmt->error);
        }
        mysqli_stmt_close($stmt); //关闭上次的预编译
        return $result;
    }

    public function refValues($arr)
    {
        if (strnatcmp(phpversion(), '5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach ($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }

    //析构函数：主要用来释放结果集和关闭数据库连接
    public function __destruct()
    {
        try {
            $this->close();
            $this->my_free();
        } catch (Exception $e) {
//            print $e;
        }

    }

    //释放结果集所占资源
    protected function my_free()
    {
//        @$this->rs->free();
        $this->rs = null;
    }

    //关闭数据库连接
    protected function close()
    {
        $this->db->close();
    }


    /**
     * 检查数据是否存在
     * @param string $tName 表名 || SQL 语句
     * @param string $condition 条件
     * @return bool 有返回 true,没有返回 false
     */
    public function IsExists($tName, $condition)
    {
        if (!is_string($tName) || !is_string($condition)) exit($this->getError(__FUNCTION__, __LINE__));
        if ($this->Total($tName, $condition)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 执行单条 SQL 语句
     * @param string $sql SQL语句
     * @return bool
     */
    public function runSql($sql)
    {
        if (!is_string($sql)) exit($this->getError(__FUNCTION__, __LINE__));
        $bool = $this->db->query($sql);
//        $this->printSQLError($this->db);
        return $bool;

    }

    /**
     * 打印可能出现的 SQL 错误
     * @param Object $db 数据库对象句柄
     */

    private function printSQLError($db)
    {
        if ($db->errno) {
            echo("警告：SQL语句有误<br />错误代码：<font color='red'>{$db->errno}</font>；<br /> 错误信息：<font color='red'>{$db->error}</font>");
        }
    }

    /**
     * 事物回滚
     */
    public function rollback()
    {
        try {
            $this->db->rollback();
            $this->db->autocommit(true);
        } catch (Exception $e) {

        }

    }


    /**
     * 错误提示
     * @param string $fun
     * @return string
     */
    private function getError($fun, $line, $other = "")
    {
        return __CLASS__ . '->' . $fun . '() line<font color="red">' . $line . '</font> ERROR! ' . $other;
    }
}

?>