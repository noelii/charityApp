<?php
namespace model;
require_once("../../autoload.php");

class main_model extends charity_db
{
  private $request;
  private $allrequests=array();


  public function __construct($id=null)
  {
    parent::__construct();
    if($id==null)
    {
    $sql="select * from requests where status='open' order by req_id desc";
    $all=parent::fetch_data($sql);
    if($all!=null)
    {
    while($req=mysqli_fetch_assoc($all))
    {
    $this->request=new request_model($req['req_id']);
    array_push($this->allrequests,$this->request);
    }

    }

  }
  else{

    $sql="select * from requests where status='open' && req_id=".$id;
    $all=parent::fetch_data($sql);
    if($all!=null)
    {
    while($req=mysqli_fetch_assoc($all))
    {
    $this->request=new request_model($req['req_id']);
    array_push($this->allrequests,$this->request);
    }

    }

  }
}

  public function get_all_requests(){return $this->allrequests;}

  public function getreqimage($reqid)
  {
    $images=[];
    $sql="select * from request_images where requestID=".$reqid;
    $all=parent::fetch_data($sql);
    if($all!=null)
    {
    while($req=mysqli_fetch_assoc($all))
    {
    array_push($images,$req['imageURL']);
    }

    }

   return $images;

  }

}



?>