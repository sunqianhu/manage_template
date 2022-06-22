<?php
/**
 * 数据库助手类
 */
namespace library\service;

use library\service\ConfigService;

class DbService extends \PDO{
    
    static public $pdo = null;

    /**
     * 构造函数
     */
    static function getInstance(){
        $dsn = '';    
        $config = array();
        
        if(self::$pdo != null){
            return self::$pdo;
        }
    
        $config = ConfigService::getAll('db');
        if(
            empty($config) || 
            empty($config['db_type']) ||
            empty($config['db_host']) ||
            empty($config['db_port']) ||
            empty($config['db_database']) ||
            empty($config['db_charset']) ||
            empty($config['db_username']) ||
            empty($config['db_password'])
        ){
            throw new \Exception('数据库配置错误');
        }
        
        $dsn = $config['db_type'].
        ':host='.$config['db_host'].
        ';port='.$config['db_port'].
        ';dbname='.$config['db_database'].
        ';charset='.$config['db_charset'];
        self::$pdo = new \PDO($dsn, $config['db_username'], $config['db_password']);
        
        return self::$pdo;
    }

    /**
     * 得到pdo错误描述
     * @param PDO $pdo pdo对象
     * @return string 错误描述
     */
    static function getPdoError($pdo){
        $errors = array();
        $error = '';

        $errors = $pdo->errorInfo();
        if(!empty($errors[0])){
            $error .= 'SQLSTATE['.$errors[0].']';
        }
        if(!empty($errors[1])){
            $error .= '，驱动错误码：'.$errors[1];
        }
        if(!empty($errors[2])){
            $error .= '，驱动错误信息：'.$errors[2];
        }

        return $error;
    }
    
    /**
     * 得到预处理结果对象错误描述
     * @param PDOStatement $pdoStatement 结果集对象
     * @return string 错误描述
     */
    static function getStatementError($pdoStatement){
        $errors = array();
        $error = '';

        if(!$pdoStatement){
            $error = 'pdostatement对象为false';
            return $error;
        }

        $errors = $pdoStatement->errorInfo();
        if(!empty($errors[0])){
            $error .= 'SQLSTATE['.$errors[0].']';
        }
        if(!empty($errors[1])){
            $error .= '，驱动错误码：'.$errors[1];
        }
        if(!empty($errors[2])){
            $error .= '，驱动错误信息：'.$errors[2];
        }

        return $error;
    }
}