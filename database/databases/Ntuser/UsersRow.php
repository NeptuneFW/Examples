<?php
namespace Database\Databases\Ntuser;

class UsersRow
{
  public $triton_users_id = null,  $id = null,$name = null,$surname = null,$banned = null,$email = null,$rank = null,$created_time = null,$about = null,$password = null,$picture = null;
  public function all()
  {
    $array = [];if(is_array($this->id)) foreach ($this->id as $key => $value) { $array[$key]['id'] = $value; }; 
        if(is_array($this->name)) foreach ($this->name as $key => $value) { $array[$key]['name'] = $value; }; 
        if(is_array($this->surname)) foreach ($this->surname as $key => $value) { $array[$key]['surname'] = $value; }; 
        if(is_array($this->banned)) foreach ($this->banned as $key => $value) { $array[$key]['banned'] = $value; }; 
        if(is_array($this->email)) foreach ($this->email as $key => $value) { $array[$key]['email'] = $value; }; 
        if(is_array($this->rank)) foreach ($this->rank as $key => $value) { $array[$key]['rank'] = $value; }; 
        if(is_array($this->created_time)) foreach ($this->created_time as $key => $value) { $array[$key]['created_time'] = $value; }; 
        if(is_array($this->about)) foreach ($this->about as $key => $value) { $array[$key]['about'] = $value; }; 
        if(is_array($this->password)) foreach ($this->password as $key => $value) { $array[$key]['password'] = $value; }; 
        if(is_array($this->picture)) foreach ($this->picture as $key => $value) { $array[$key]['picture'] = $value; }; 
        
    return $array;
  }
    
    
    public function select($index) 
    {      
        $classRow = new usersRow();
        $classRow->triton_users_id = $this->triton_users_id;
$classRow->id = $this->id[$index]; 
        $classRow->name = $this->name[$index]; 
        $classRow->surname = $this->surname[$index]; 
        $classRow->banned = $this->banned[$index]; 
        $classRow->email = $this->email[$index]; 
        $classRow->rank = $this->rank[$index]; 
        $classRow->created_time = $this->created_time[$index]; 
        $classRow->about = $this->about[$index]; 
        $classRow->password = $this->password[$index]; 
        $classRow->picture = $this->picture[$index]; 
        return $classRow;      
    }        
            
    public function first() 
    {   
        if(is_array($this->id)) 
        {        
            $rowClass = new UsersRow();       
            $rowClass->triton_users_id = $this->triton_users_id;
            $rowClass->id =  $this->id[0]; 
            $rowClass->name =  $this->name[0]; 
            $rowClass->surname =  $this->surname[0]; 
            $rowClass->banned =  $this->banned[0]; 
            $rowClass->email =  $this->email[0]; 
            $rowClass->rank =  $this->rank[0]; 
            $rowClass->created_time =  $this->created_time[0]; 
            $rowClass->about =  $this->about[0]; 
            $rowClass->password =  $this->password[0]; 
            $rowClass->picture =  $this->picture[0]; 
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
            if(empty($this->triton_users_id)) 
            {                
                $insertQueryString = "INSERT INTO " . $table . " SET ";    
                $insertValueArray = [];                 
                $args = [];
                $args['id'] =  $this->id;
                $args['name'] =  $this->name;
                $args['surname'] =  $this->surname;
                $args['banned'] =  $this->banned;
                $args['email'] =  $this->email;
                $args['rank'] =  $this->rank;
                $args['created_time'] =  $this->created_time;
                $args['about'] =  $this->about;
                $args['password'] =  $this->password;
                $args['picture'] =  $this->picture;
                
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
                $args['surname'] =  $this->surname; 
                $args['banned'] =  $this->banned; 
                $args['email'] =  $this->email; 
                $args['rank'] =  $this->rank; 
                $args['created_time'] =  $this->created_time; 
                $args['about'] =  $this->about; 
                $args['password'] =  $this->password; 
                $args['picture'] =  $this->picture; 
                        
                foreach($args as $funcArgKey => $funcArgValue) 
                {
                    if(!empty($funcArgValue) || $funcArgValue == '0') 
                    {
                        $insertQueryString .= " " . $funcArgKey . "= ?,";
                        $insertValueArray[] = $funcArgValue;
                    }
                }
    
                $insertQueryString = rtrim($insertQueryString, ",");
                $insertQueryString .= ' WHERE ' . $this->triton_users_id[1] . ' = ' . $this->triton_users_id[0];                
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
        $deleteQueryString = 'DELETE FROM  users ';
        $deleteQueryString .= ' WHERE ' . $this->triton_users_id[1] . ' = ' . $this->triton_users_id[0];                
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