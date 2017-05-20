<?php
namespace Database\Databases\Ntblog;

class CommentsRow
{
  public $triton_comments_id = null,  $id = null,$post_id = null,$user_id = null,$text = null,$created = null,$deleted = null;
  public function all()
  {
    $array = [];if(is_array($this->id)) foreach ($this->id as $key => $value) { $array[$key]['id'] = $value; }; 
        if(is_array($this->post_id)) foreach ($this->post_id as $key => $value) { $array[$key]['post_id'] = $value; }; 
        if(is_array($this->user_id)) foreach ($this->user_id as $key => $value) { $array[$key]['user_id'] = $value; }; 
        if(is_array($this->text)) foreach ($this->text as $key => $value) { $array[$key]['text'] = $value; }; 
        if(is_array($this->created)) foreach ($this->created as $key => $value) { $array[$key]['created'] = $value; }; 
        if(is_array($this->deleted)) foreach ($this->deleted as $key => $value) { $array[$key]['deleted'] = $value; }; 
        
    return $array;
  }
    
    
    public function select($index) 
    {      
        $classRow = new commentsRow();
        $classRow->triton_comments_id = $this->triton_comments_id;
$classRow->id = $this->id[$index]; 
        $classRow->post_id = $this->post_id[$index]; 
        $classRow->user_id = $this->user_id[$index]; 
        $classRow->text = $this->text[$index]; 
        $classRow->created = $this->created[$index]; 
        $classRow->deleted = $this->deleted[$index]; 
        return $classRow;      
    }        
            
    public function first() 
    {   
        if(is_array($this->id)) 
        {        
            $rowClass = new CommentsRow();       
            $rowClass->triton_comments_id = $this->triton_comments_id;
            $rowClass->id =  $this->id[0]; 
            $rowClass->post_id =  $this->post_id[0]; 
            $rowClass->user_id =  $this->user_id[0]; 
            $rowClass->text =  $this->text[0]; 
            $rowClass->created =  $this->created[0]; 
            $rowClass->deleted =  $this->deleted[0]; 
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
            if(empty($this->triton_comments_id)) 
            {                
                $insertQueryString = "INSERT INTO " . $table . " SET ";    
                $insertValueArray = [];                 
                $args = [];
                $args['id'] =  $this->id;
                $args['post_id'] =  $this->post_id;
                $args['user_id'] =  $this->user_id;
                $args['text'] =  $this->text;
                $args['created'] =  $this->created;
                $args['deleted'] =  $this->deleted;
                
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
                $args['post_id'] =  $this->post_id; 
                $args['user_id'] =  $this->user_id; 
                $args['text'] =  $this->text; 
                $args['created'] =  $this->created; 
                $args['deleted'] =  $this->deleted; 
                        
                foreach($args as $funcArgKey => $funcArgValue) 
                {
                    if(!empty($funcArgValue) || $funcArgValue == '0') 
                    {
                        $insertQueryString .= " " . $funcArgKey . "= ?,";
                        $insertValueArray[] = $funcArgValue;
                    }
                }
    
                $insertQueryString = rtrim($insertQueryString, ",");
                $insertQueryString .= ' WHERE ' . $this->triton_comments_id[1] . ' = ' . $this->triton_comments_id[0];                
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
        $deleteQueryString = 'DELETE FROM  comments ';
        $deleteQueryString .= ' WHERE ' . $this->triton_comments_id[1] . ' = ' . $this->triton_comments_id[0];                
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