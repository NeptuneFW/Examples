<?php
namespace Database\Databases\Ntblog;

class LanguagesRow
{
  public $triton_languages_id = null,  $id = null,$deleted = null,$icon_url = null,$title = null,$code = null;
  public function all()
  {
    $array = [];if(is_array($this->id)) foreach ($this->id as $key => $value) { $array[$key]['id'] = $value; }; 
        if(is_array($this->deleted)) foreach ($this->deleted as $key => $value) { $array[$key]['deleted'] = $value; }; 
        if(is_array($this->icon_url)) foreach ($this->icon_url as $key => $value) { $array[$key]['icon_url'] = $value; }; 
        if(is_array($this->title)) foreach ($this->title as $key => $value) { $array[$key]['title'] = $value; }; 
        if(is_array($this->code)) foreach ($this->code as $key => $value) { $array[$key]['code'] = $value; }; 
        
    return $array;
  }
    
    
    public function select($index) 
    {      
        $classRow = new languagesRow();
        $classRow->triton_languages_id = $this->triton_languages_id;
$classRow->id = $this->id[$index]; 
        $classRow->deleted = $this->deleted[$index]; 
        $classRow->icon_url = $this->icon_url[$index]; 
        $classRow->title = $this->title[$index]; 
        $classRow->code = $this->code[$index]; 
        return $classRow;      
    }        
            
    public function first() 
    {   
        if(is_array($this->id)) 
        {        
            $rowClass = new LanguagesRow();       
            $rowClass->triton_languages_id = $this->triton_languages_id;
            $rowClass->id =  $this->id[0]; 
            $rowClass->deleted =  $this->deleted[0]; 
            $rowClass->icon_url =  $this->icon_url[0]; 
            $rowClass->title =  $this->title[0]; 
            $rowClass->code =  $this->code[0]; 
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
            if(empty($this->triton_languages_id)) 
            {                
                $insertQueryString = "INSERT INTO " . $table . " SET ";    
                $insertValueArray = [];                 
                $args = [];
                $args['id'] =  $this->id;
                $args['deleted'] =  $this->deleted;
                $args['icon_url'] =  $this->icon_url;
                $args['title'] =  $this->title;
                $args['code'] =  $this->code;
                
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
                $args['deleted'] =  $this->deleted; 
                $args['icon_url'] =  $this->icon_url; 
                $args['title'] =  $this->title; 
                $args['code'] =  $this->code; 
                        
                foreach($args as $funcArgKey => $funcArgValue) 
                {
                    if(!empty($funcArgValue) || $funcArgValue == '0') 
                    {
                        $insertQueryString .= " " . $funcArgKey . "= ?,";
                        $insertValueArray[] = $funcArgValue;
                    }
                }
    
                $insertQueryString = rtrim($insertQueryString, ",");
                $insertQueryString .= ' WHERE ' . $this->triton_languages_id[1] . ' = ' . $this->triton_languages_id[0];                
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
        $deleteQueryString = 'DELETE FROM  languages ';
        $deleteQueryString .= ' WHERE ' . $this->triton_languages_id[1] . ' = ' . $this->triton_languages_id[0];                
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