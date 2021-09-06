<?php

namespace model;
require_once("../../autoload.php");

abstract class charity_db
{
  private $db_name="charity_db";
  private $db_user="root";
  private $db_server="localhost";
  private $db_pwd="";
  public $conn=null;

  private $entity;
  private $actor;

  public function __construct()
  {
    $this->conn=mysqli_connect($this->db_server,$this->db_user,$this->db_pwd);
    mysqli_select_db($this->conn,$this->db_name);
  }
  public function fetch_data($sql)
  {
    if($sql!="" && $sql!=null)
    {
      $data=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
      if(mysqli_num_rows($data)>0){return $data;}else{return null;}
    }
  }
  //getting all data by specific entity
  public function fetch_all($id=null)
  {
    print $this->entity; 
    if($id==null && $this->entity!=null)
    {
   
    $sql="select * from ".$this->entity;
    $data=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
    if(mysqli_num_rows($data)>0){return $data;}else{return 1;}
    }
    else{
      //checking which actor is this
    $actor_id;
    $sql;
    switch($this->actor)
    {
      case "ngo":
      $actor_id="ngo_id";
      break;
      case "donor":
      $actor_id="donor_id";
      break;
      case "admin":
      $actor_id="adminid";
      case "requests":
      $actor_id="req_id";
      case "shares":
        $actor_id="share_id";
      default:
      $actor_id=null;
    }
   //constructing the selection

   if($actor_id!=null)
   {
     $sql="select * from {$this->entity} where {$actor_id}={$id}";
     $data=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
     if(mysqli_num_rows($data)>0){return $data;}else{return 1;}
   }

    }
  }
  
  //fetch all data by specific condition (complex selections)

  public function fetch_all_by_cond($cond)
  {
    $sql="select * from {$this->entity} where {$cond}";
    $data=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
    if(mysqli_num_rows($data)>0){return $data;}else{return 1;}

  }

  public function insert_data($sql)
  {
      if(mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn))){return true;}else{return false;}
  }
  public function update_data($sql)
  {
      if(mysqli_query($this->conn,$sql)){return true;}else{return false;}
  }
  public function delete_data($sql)
  {
    if(mysqli_query($this->conn,$sql)){return true;}else{return false;} 
  }
  public function dbclose()
  {
      mysqli_close($this->conn);
  }

}
?>