<?php
namespace Database\Databases\Ntblog;

class ArticlesRow
{
  public $triton_articles_id = null,  $id = null,$title = null,$content = null,$created = null,$permalink = null,$updated = null,$user = null,$deleted = null,$category_id = null,$likes = null;
  public function all()
  {
    $array = [];if(is_array($this->id)) foreach ($this->id as $key => $value) { $array[$key]['id'] = $value; }; 
        if(is_array($this->title)) foreach ($this->title as $key => $value) { $array[$key]['title'] = $value; }; 
        if(is_array($this->content)) foreach ($this->content as $key => $value) { $array[$key]['content'] = $value; }; 
        if(is_array($this->created)) foreach ($this->created as $key => $value) { $array[$key]['created'] = $value; }; 
        if(is_array($this->permalink)) foreach ($this->permalink as $key => $value) { $array[$key]['permalink'] = $value; }; 
        if(is_array($this->updated)) foreach ($this->updated as $key => $value) { $array[$key]['updated'] = $value; }; 
        if(is_array($this->user)) foreach ($this->user as $key => $value) { $array[$key]['user'] = $value; }; 
        if(is_array($this->deleted)) foreach ($this->deleted as $key => $value) { $array[$key]['deleted'] = $value; }; 
        if(is_array($this->category_id)) foreach ($this->category_id as $key => $value) { $array[$key]['category_id'] = $value; }; 
        if(is_array($this->likes)) foreach ($this->likes as $key => $value) { $array[$key]['likes'] = $value; }; 
        
    return $array;
  }
    
    
    public function select($index) 
    {      
        $classRow = new articlesRow();
        $classRow->triton_articles_id = $this->triton_articles_id;
$classRow->id = $this->id[$index]; 
        $classRow->title = $this->title[$index]; 
        $classRow->content = $this->content[$index]; 
        $classRow->created = $this->created[$index]; 
        $classRow->permalink = $this->permalink[$index]; 
        $classRow->updated = $this->updated[$index]; 
        $classRow->user = $this->user[$index]; 
        $classRow->deleted = $this->deleted[$index]; 
        $classRow->category_id = $this->category_id[$index]; 
        $classRow->likes = $this->likes[$index]; 
        return $classRow;      
    }        
            
    public function first() 
    {   
        if(is_array($this->id)) 
        {        
            $rowClass = new ArticlesRow();       
            $rowClass->triton_articles_id = $this->triton_articles_id;
            $rowClass->id =  $this->id[0]; 
            $rowClass->title =  $this->title[0]; 
            $rowClass->content =  $this->content[0]; 
            $rowClass->created =  $this->created[0]; 
            $rowClass->permalink =  $this->permalink[0]; 
            $rowClass->updated =  $this->updated[0]; 
            $rowClass->user =  $this->user[0]; 
            $rowClass->deleted =  $this->deleted[0]; 
            $rowClass->category_id =  $this->category_id[0]; 
            $rowClass->likes =  $this->likes[0]; 
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
            if(empty($this->triton_articles_id)) 
            {                
                $insertQueryString = "INSERT INTO " . $table . " SET ";    
                $insertValueArray = [];                 
                $args = [];
                $args['id'] =  $this->id;
                $args['title'] =  $this->title;
                $args['content'] =  $this->content;
                $args['created'] =  $this->created;
                $args['permalink'] =  $this->permalink;
                $args['updated'] =  $this->updated;
                $args['user'] =  $this->user;
                $args['deleted'] =  $this->deleted;
                $args['category_id'] =  $this->category_id;
                $args['likes'] =  $this->likes;
                
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
                $args['title'] =  $this->title; 
                $args['content'] =  $this->content; 
                $args['created'] =  $this->created; 
                $args['permalink'] =  $this->permalink; 
                $args['updated'] =  $this->updated; 
                $args['user'] =  $this->user; 
                $args['deleted'] =  $this->deleted; 
                $args['category_id'] =  $this->category_id; 
                $args['likes'] =  $this->likes; 
                        
                foreach($args as $funcArgKey => $funcArgValue) 
                {
                    if(!empty($funcArgValue) || $funcArgValue == '0') 
                    {
                        $insertQueryString .= " " . $funcArgKey . "= ?,";
                        $insertValueArray[] = $funcArgValue;
                    }
                }
    
                $insertQueryString = rtrim($insertQueryString, ",");
                $insertQueryString .= ' WHERE ' . $this->triton_articles_id[1] . ' = ' . $this->triton_articles_id[0];                
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
        $deleteQueryString = 'DELETE FROM  articles ';
        $deleteQueryString .= ' WHERE ' . $this->triton_articles_id[1] . ' = ' . $this->triton_articles_id[0];                
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