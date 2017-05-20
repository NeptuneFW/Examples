<?php

namespace Database\Databases\Ntblog;
use \Triton\Triton as Triton;

/**
* Created by Neptune Framework.
* User: Triton
*/ 

class LanguagesTable
{

    protected static $table_id_column = 'id'; // The name of the column that has the table ID number
    private $where = [];
    
    public function table($table) 
    {
            
        $columnId = \Triton::TableColumn("id");
            $columnId->null("NOT NULL");
            $columnId->extra("auto_increment");
            $table->int($columnId,11);
            
        $columnDeleted = \Triton::TableColumn("deleted");
            $columnDeleted->null("NULL");
            $table->int($columnDeleted,11);
            
        $columnIcon_url = \Triton::TableColumn("icon_url");
            $columnIcon_url->null("NULL");
            $table->varchar($columnIcon_url,1000);
            
        $columnTitle = \Triton::TableColumn("title");
            $columnTitle->null("NULL");
            $table->varchar($columnTitle,250);
            
        $columnCode = \Triton::TableColumn("code");
            $columnCode->null("NULL");
            $table->varchar($columnCode,50);
    
        return $table;
    } 
    public static function all($columns = null, $type = 'object') 
    {
        $pdoConnection = $GLOBALS['Databases']['Ntblog'];
        if(!empty($columns)) {
            if(is_array($columns)) 
            {
                $columnString = "";
                foreach ($columns as $column) 
                {
                    $columnString .= $column . ", ";
                }
                $columnString = rtrim($columnString, ", ");
            }
            else 
            {
                $columnString = $columns;
            }
        }
        else 
        {
            $columnString = '*';
        }
        $selectWhere = $pdoConnection->query('SELECT ' . $columnString . ' FROM languages ')->fetchAll();
        if($type == 'array') 
        {
            return $selectWhere;
        }
        if(count($selectWhere) > 1) 
        {
            $classRow = new LanguagesRow();
            foreach ($selectWhere as $itKey => $itValue) 
            {
                foreach ($itValue as $itemKey => $itemValue) 
                {
                    if (!is_int($itemKey)) 
                    {
                        $classRow->$itemKey[] = $itemValue;
                    }
                }
            }
            return $classRow;
        } 
        else if (count($selectWhere) == 1) 
        {
            $classRow = new LanguagesRow();
            foreach ($selectWhere[0] as $itemKey => $itemValue) 
            {
                if (!is_int($itemKey)) 
                {
                    $classRow->$itemKey[] = $itemValue;
                }
            }
            return $classRow;
        } 
        else 
        {
            return false;
        }
    }
    public function where($column, $operator, $value) 
    {
        $this->where["first"] = array($column, $operator, $value);
        return $this;
    }

    public function orWhere($column, $operator, $value) 
    {
        $this->where["orWhere"][]= array($column, $operator, $value);
        return $this;
    }

    public function andWhere($column, $operator, $value) {
        $this->where["andWhere"][]= array($column, $operator, $value);
        return $this;
    }

    public function execute() {
        $pdoConnection = $GLOBALS['Databases']['Ntblog'];
        $bind = [];
        $selectQuery = "SELECT * FROM languages WHERE " . $this->where['first'][0] . " " . $this->where['first'][1] . ":first ";
        $bind['first'] = $this->where['first'][2];
        $i = 0;
        if(isset($this->where['orWhere'])) 
        {      
            foreach($this->where['orWhere'] as $itemValue)
            {
                $selectQuery .= "OR " . $itemValue[0] . " " . $itemValue[1] . " :bind_" . $i . " ";
                $bind['bind_' . $i] = $itemValue[2]; 
                $i++;
            }
        }
        if(isset($this->where['andWhere'])) 
        {
            foreach ($this->where['andWhere'] as $itemValue) 
            {
                $selectQuery .= "AND " . $itemValue[0] . " " . $itemValue[1] . " :bind_" . $i . " ";
                $bind['bind_' . $i] = $itemValue[2];
                $i++;
            }
        }      
        $selectWhere = $pdoConnection->prepare($selectQuery);
        $selectWhere->execute($bind);
        
        if($selectWhere != false )
        {
            $selectWhere = $selectWhere->fetchAll();
        }
        else
        {
            return false;
        }
        if(count($selectWhere) > 1) 
        {
            $classRow = new languagesRow();
            foreach ($selectWhere as $itKey => $itValue) 
            {
                foreach ($itValue as $itemKey => $itemValue) 
                {
                    if($itemKey == self::$table_id_column)
                    {
                        $classRow->triton_languages_id = [$itemValue, self::$table_id_column];
                    }
                    if (!is_int($itemKey)) {
                        $classRow->$itemKey[] = $itemValue;
                    }
                }
            }          
            return $classRow;
        } 
        else if (count($selectWhere) == 1) 
        {
            $classRow = new languagesRow();
            foreach ($selectWhere[0] as $itemKey => $itemValue) 
            {
                if($itemKey == self::$table_id_column)
                {
                    $classRow->triton_languages_id = [$itemValue, self::$table_id_column];
                }
                if (!is_int($itemKey)) {
                    $classRow->$itemKey[] = $itemValue;
                }
            }
            return $classRow;
        } 
        else 
        {
            return false;
        }
    }

    
        
    public static function count($where = null)
    {   
        $pdoConnection = $GLOBALS['Databases']['Ntblog'];
        if(empty($where))
        {
            $count = $pdoConnection->query("SELECT COUNT(id) FROM languages")->fetchAll();
            return $count[0][0];
        }
        else 
        {
            $count = $pdoConnection->query("SELECT COUNT(id) FROM languages WHERE " . $where .  " ")->fetchAll();
            return $count[0][0];
        }           
    }
    public static function orderBy($type, $limit = null, $where = null, $return = "object")
    {    
        $database = explode(DIRECTORY_SEPARATOR , __DIR__);
        $database = end($database);
        $table = explode(DIRECTORY_SEPARATOR, explode("Table" , __CLASS__)[0]);
        $table = end($table);    
        $pdoConnection = $GLOBALS['Databases'][ucfirst($database)];        
        if(!empty($where)) 
        {            
            $where = "WHERE " . $where;         
        }       
        $orderBy = $pdoConnection->prepare("SELECT * FROM " . $table . " " . $where . " ORDER BY " . " " . self::$table_id_column . " "  . $type . (empty($limit) ? "" : " LIMIT " . $limit));
        $orderBy->execute();
        $selectOrderBy = $orderBy->fetchAll();  
        if($return == "array")
        {
            return $selectOrderBy;
        }
        if(count($selectOrderBy) > 1) 
        {    
            $classRow = new languagesRow();
            foreach ($selectOrderBy as $itKey => $itValue) 
            {    
                foreach ($itValue as $itemKey => $itemValue) 
                {
                    if (!is_int($itemKey)) 
                    {
                        $classRow->$itemKey[] = $itemValue;
                    }
                }
            }
            return $classRow;
        } 
        else if (count($selectOrderBy) == 1) 
        {
            $classRow = new languagesRow();
            foreach ($selectOrderBy[0] as $itemKey => $itemValue) 
            {
                if (!is_int($itemKey)) {
                    $classRow->$itemKey[] = $itemValue;
                }
            }
            return $classRow;
        } 
        else 
        {
            return false;
        }
    }    
        
    public static function add($id = null,$deleted = null,$icon_url = null,$title = null,$code = null)
    {
        $database = explode(DIRECTORY_SEPARATOR , __DIR__);
        $database = end($database);
        $table = explode(DIRECTORY_SEPARATOR, explode("Table" , __CLASS__)[0]);
        $table = end($table);
        $pdoConnection = $GLOBALS['Databases'][ucfirst($database)];
        if(!is_array(func_get_arg(0))) 
        {
            $insertQueryString = "INSERT INTO " . $table  . " SET";
            $insertValueArray = [];
            $args = self::funcGetNamedParams();
            foreach($args as $funcArgKey => $funcArgValue) 
            {
                if(!empty($funcArgValue) || $funcArgValue === "0" || $funcArgValue === 0) 
                {
                    $insertQueryString .= " " . $funcArgKey . "= ?,";
                    $insertValueArray[] = $funcArgValue;
                }
            }
            $insertQueryString = rtrim($insertQueryString, ",");
            $insertQuery = $pdoConnection->prepare($insertQueryString);
            $insert = $insertQuery->execute($insertValueArray);
            if($insert === true) 
            {
                return array(true, $pdoConnection->lastInsertId());
            } else 
            {
                return array(false);
            }
        } 
        else 
        {
            $insertQueryString = "INSERT INTO " . $table  . " SET";
            $insertValueArray = [];
            $args = func_get_arg(0);
            foreach($args as $funcArgKey => $funcArgValue) 
            {
                if(!empty($funcArgValue)) {
                    $insertQueryString .= " " . $funcArgKey . "= ?,";
                    $insertValueArray[] = $funcArgValue;
                }
            }
            $insertQueryString = rtrim($insertQueryString, ",");
            $insertQuery = $pdoConnection->prepare($insertQueryString);
            $insert = $insertQuery->execute($insertValueArray);
            if($insert === true) 
            {
                return array(true, $pdoConnection->lastInsertId());
            } 
            else 
            {
                return array(false);
            }
        }
    }
    
    public static function find($id, $columns = null) 
    {
        $tableID = self::$table_id_column;
        $database = explode(DIRECTORY_SEPARATOR , __DIR__);
        $database = end($database);
        $table = explode(DIRECTORY_SEPARATOR, explode("Table" , __CLASS__)[0]);
        $table = end($table);
        $pdoConnection = $GLOBALS['Databases'][ucfirst($database)];
        $columnString = "*";
        if(!empty($columns)) 
        {
            if(is_array($columns)) 
            {
                $columnString = "";
                foreach ($columns as $column) 
                {
                    $columnString .= $column . ", ";
                }
                $columnString = rtrim($columnString, ", ");
            }
            else 
            {
                $columnString = $columns;
            }
        }
        $selectRow = $pdoConnection->prepare("SELECT " . $columnString . " FROM " . $table . " WHERE " . $tableID . "=:id");
        $selectRow->execute(['id' => $id]);
        $languagesRow = new languagesRow();
        $i = 0;       
        $languagesRow->triton_languages_id = array($id, $tableID);        
        $selectedRows = $selectRow->fetch(\PDO::FETCH_ASSOC);
        if($selectedRows != false) 
        {
            foreach ($selectedRows as $columnKey => $columnValue) 
            {
                $languagesRow->$columnKey = $columnValue;
                $i++;
            }
            return $languagesRow;
        }
        else 
        {
            return false;
        }
    }

    private static function funcGetNamedParams() 
    {
        $func = debug_backtrace()[1]['function'];
        $args = debug_backtrace()[1]['args'];
        $reflector = new \ReflectionClass(__CLASS__);
        $params = [];
        foreach($reflector->getMethod($func)->getParameters() as $k => $parameter)
        {
            $params[$parameter->name] = isset($args[$k]) ? $args[$k] : $parameter->getDefaultValue();
        }
        return $params;
    }
}        
