<?php
namespace Database\Databases\Ntblog;

class UserRow
{
  public $triton_user_id = null,  $id = null,$rank = null,$deleted = null,$name = null,$surname = null,$created_time = null;
  public function all()
  {
    $array = [];if(is_array($this->id)) foreach ($this->id as $key => $value) { $array[$key]['id'] = $value; }; 
        if(is_array($this->rank)) foreach ($this->rank as $key => $value) { $array[$key]['rank'] = $value; }; 
        if(is_array($this->deleted)) foreach ($this->deleted as $key => $value) { $array[$key]['deleted'] = $value; }; 
        if(is_array($this->name)) foreach ($this->name as $key => $value) { $array[$key]['name'] = $value; }; 
        if(is_array($this->surname)) foreach ($this->surname as $key => $value) { $array[$key]['surname'] = $value; }; 
        if(is_array($this->created_time)) foreach ($this->created_time as $key => $value) { $array[$key]['created_time'] = $value; }; 
        
    return $array;
  }
    
    
    public function select($index) 
    {      
        $classRow = new userRow();
        $classRow->triton_user_id = $this->triton_user_id;
$classRow->id = $this->id[$index]; 
        $classRow->rank = $this->rank[$index]; 
        $classRow->deleted = $this->deleted[$index]; 
        $classRow->name = $this->name[$index]; 
        $classRow->surname = $this->surname[$index]; 
        $classRow->created_time = $this->created_time[$index]; 
        return $classRow;      
    }        
            
    public function first() 
    {   
        if(is_array($this->id)) 
        {        
            $rowClass = new UserRow();       
            $rowClass->triton_user_id = $this->triton_user_id;
            $rowClass->id =  $this->id[0]; 
            $rowClass->rank =  $this->rank[0]; 
            $rowClass->deleted =  $this->deleted[0]; 
            $rowClass->name =  $this->name[0]; 
            $rowClass->surname =  $this->surname[0]; 
            $rowClass->created_time =  $this->created_time[0]; 
            return $rowClass;   
        } 
        else 
        {
            return $this;
        }    
    }
            
    public function save() 
    {        
        $database = explode(DIRECTORY_SEPARATOR , __DIR__);
        $database = end($database);
        $table = explode(DIRECTORY_SEPARATOR, explode("Row" , __CLASS__)[0]);
        $table = end($table);
        $pdoConnection = $GLOBALS['Databases'][ucfirst($database)];        
        if(debug_backtrace()[0]['type'] == '->') 
        {             
            if(empty($this->triton_user_id)) 
            {                
                $insertQueryString = "INSERT INTO " . $table . " SET ";    
                $insertValueArray = [];                 
                $args = [];
                $args['id'] =  $this->id;
                $args['rank'] =  $this->rank;
                $args['deleted'] =  $this->deleted;
                $args['name'] =  $this->name;
                $args['surname'] =  $this->surname;
                $args['created_time'] =  $this->created_time;
                
                foreach($args as $funcArgKey => $funcArgValue) 
                {
                    if(!empty($funcArgValue) || $funcArgValue == '0') 
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
                } 
                else 
                {
                    return array(false);
                }            
            } 
            else 
            {                          
                $insertQueryString = "UPDATE " . $table  . " SET";
                $insertValueArray = [];             
                $args = [];
                $args['id'] =  $this->id; 
                $args['rank'] =  $this->rank; 
                $args['deleted'] =  $this->deleted; 
                $args['name'] =  $this->name; 
                $args['surname'] =  $this->surname; 
                $args['created_time'] =  $this->created_time; 
                        
                foreach($args as $funcArgKey => $funcArgValue) 
                {
                    if(!empty($funcArgValue) || $funcArgValue == '0') 
                    {
                        $insertQueryString .= " " . $funcArgKey . "= ?,";
                        $insertValueArray[] = $funcArgValue;
                    }
                }
    
                $insertQueryString = rtrim($insertQueryString, ",");
                $insertQueryString .= ' WHERE ' . $this->triton_user_id[1] . ' = ' . $this->triton_user_id[0];                
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
    }
    
    public function delete() 
    {
        $database = explode(DIRECTORY_SEPARATOR , __DIR__);
        $database = end($database);
        $table = explode(DIRECTORY_SEPARATOR, explode("Row" , __CLASS__)[0]);
        $table = end($table);
        $pdoConnection = $GLOBALS['Databases'][ucfirst($database)];        
        $deleteQueryString = 'DELETE FROM  user ';
        $deleteQueryString .= ' WHERE ' . $this->triton_user_id[1] . ' = ' . $this->triton_user_id[0];                
        $deleteQuery = $pdoConnection->prepare($deleteQueryString);
        $delete = $deleteQuery->execute();
        if($delete === true) {
            return array(true);
        } 
        else 
        {
            return array(false);
        }   
    }    
}