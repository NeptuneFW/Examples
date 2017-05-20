<?php
namespace Database\Databases\Ntblog;

class CategoriesRow
{
  public $triton_categories_id = null,  $id = null,$name = null,$description = null,$deleted = null,$permalink = null;
  public function all()
  {
    $array = [];if(is_array($this->id)) foreach ($this->id as $key => $value) { $array[$key]['id'] = $value; }; 
        if(is_array($this->name)) foreach ($this->name as $key => $value) { $array[$key]['name'] = $value; }; 
        if(is_array($this->description)) foreach ($this->description as $key => $value) { $array[$key]['description'] = $value; }; 
        if(is_array($this->deleted)) foreach ($this->deleted as $key => $value) { $array[$key]['deleted'] = $value; }; 
        if(is_array($this->permalink)) foreach ($this->permalink as $key => $value) { $array[$key]['permalink'] = $value; }; 
        
    return $array;
  }
    
    
    public function select($index) 
    {      
        $classRow = new categoriesRow();
        $classRow->triton_categories_id = $this->triton_categories_id;
$classRow->id = $this->id[$index]; 
        $classRow->name = $this->name[$index]; 
        $classRow->description = $this->description[$index]; 
        $classRow->deleted = $this->deleted[$index]; 
        $classRow->permalink = $this->permalink[$index]; 
        return $classRow;      
    }        
            
    public function first() 
    {   
        if(is_array($this->id)) 
        {        
            $rowClass = new CategoriesRow();       
            $rowClass->triton_categories_id = $this->triton_categories_id;
            $rowClass->id =  $this->id[0]; 
            $rowClass->name =  $this->name[0]; 
            $rowClass->description =  $this->description[0]; 
            $rowClass->deleted =  $this->deleted[0]; 
            $rowClass->permalink =  $this->permalink[0]; 
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
            if(empty($this->triton_categories_id)) 
            {                
                $insertQueryString = "INSERT INTO " . $table . " SET ";    
                $insertValueArray = [];                 
                $args = [];
                $args['id'] =  $this->id;
                $args['name'] =  $this->name;
                $args['description'] =  $this->description;
                $args['deleted'] =  $this->deleted;
                $args['permalink'] =  $this->permalink;
                
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
                $args['name'] =  $this->name; 
                $args['description'] =  $this->description; 
                $args['deleted'] =  $this->deleted; 
                $args['permalink'] =  $this->permalink; 
                        
                foreach($args as $funcArgKey => $funcArgValue) 
                {
                    if(!empty($funcArgValue) || $funcArgValue == '0') 
                    {
                        $insertQueryString .= " " . $funcArgKey . "= ?,";
                        $insertValueArray[] = $funcArgValue;
                    }
                }
    
                $insertQueryString = rtrim($insertQueryString, ",");
                $insertQueryString .= ' WHERE ' . $this->triton_categories_id[1] . ' = ' . $this->triton_categories_id[0];                
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
        $deleteQueryString = 'DELETE FROM  categories ';
        $deleteQueryString .= ' WHERE ' . $this->triton_categories_id[1] . ' = ' . $this->triton_categories_id[0];                
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