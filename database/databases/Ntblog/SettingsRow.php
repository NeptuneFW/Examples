<?php
namespace Database\Databases\Ntblog;

class SettingsRow
{
  public $triton_settings_id = null,  $site_title = null,$site_url = null,$site_keyw = null,$site_desc = null;
  public function all()
  {
    $array = [];if(is_array($this->site_title)) foreach ($this->site_title as $key => $value) { $array[$key]['site_title'] = $value; }; 
        if(is_array($this->site_url)) foreach ($this->site_url as $key => $value) { $array[$key]['site_url'] = $value; }; 
        if(is_array($this->site_keyw)) foreach ($this->site_keyw as $key => $value) { $array[$key]['site_keyw'] = $value; }; 
        if(is_array($this->site_desc)) foreach ($this->site_desc as $key => $value) { $array[$key]['site_desc'] = $value; }; 
        
    return $array;
  }
    
    
    public function select($index) 
    {      
        $classRow = new settingsRow();
        $classRow->triton_settings_id = $this->triton_settings_id;
$classRow->site_title = $this->site_title[$index]; 
        $classRow->site_url = $this->site_url[$index]; 
        $classRow->site_keyw = $this->site_keyw[$index]; 
        $classRow->site_desc = $this->site_desc[$index]; 
        return $classRow;      
    }        
            
    public function first() 
    {   
        if(is_array($this->site_title)) 
        {        
            $rowClass = new SettingsRow();       
            $rowClass->triton_settings_id = $this->triton_settings_id;
            $rowClass->site_title =  $this->site_title[0]; 
            $rowClass->site_url =  $this->site_url[0]; 
            $rowClass->site_keyw =  $this->site_keyw[0]; 
            $rowClass->site_desc =  $this->site_desc[0]; 
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
            if(empty($this->triton_settings_id)) 
            {                
                $insertQueryString = "INSERT INTO " . $table . " SET ";    
                $insertValueArray = [];                 
                $args = [];
                $args['site_title'] =  $this->site_title;
                $args['site_url'] =  $this->site_url;
                $args['site_keyw'] =  $this->site_keyw;
                $args['site_desc'] =  $this->site_desc;
                
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
                $args['site_title'] =  $this->site_title; 
                $args['site_url'] =  $this->site_url; 
                $args['site_keyw'] =  $this->site_keyw; 
                $args['site_desc'] =  $this->site_desc; 
                        
                foreach($args as $funcArgKey => $funcArgValue) 
                {
                    if(!empty($funcArgValue) || $funcArgValue == '0') 
                    {
                        $insertQueryString .= " " . $funcArgKey . "= ?,";
                        $insertValueArray[] = $funcArgValue;
                    }
                }
    
                $insertQueryString = rtrim($insertQueryString, ",");
                $insertQueryString .= ' WHERE ' . $this->triton_settings_id[1] . ' = ' . $this->triton_settings_id[0];                
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
        $deleteQueryString = 'DELETE FROM  settings ';
        $deleteQueryString .= ' WHERE ' . $this->triton_settings_id[1] . ' = ' . $this->triton_settings_id[0];                
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