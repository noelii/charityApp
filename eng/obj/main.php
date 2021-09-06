<?php 
namespace eng\obj;
use \model\{admin_model,donor_model,ngo_model,main_model,request_model};
require_once("../../autoload.php");

class main 
{
  private $requests;
  private $comments=array();

  public function __construct($id=null)
  {
  if($id==null)
  {
   $this->requests=(new main_model())->get_all_requests();
  }
  else
  {
    $this->requests=(new main_model($id))->get_all_requests();
    $this->comments=(new request_model($id))->get_all_comments();
  }
  }
 public function viewAll()
 {
   $returnall=array('img'=>array(),'name'=>array(),'title'=>array(),'budget'=>array(),'desc'=>array(),'ids'=>array(),'status'=>array(),'request_images'=>array());
   for($i=0;$i<count($this->requests);$i++)
   {
    $ngo=new ngo_model($this->requests[$i]->get_ngo_id());
    array_push($returnall['img'],$ngo->get_img());
    array_push($returnall['status'],$ngo->get_status());
    array_push($returnall['name'],$ngo->get_name());
    array_push($returnall['title'],$this->requests[$i]->get_title());
    array_push($returnall['budget'],$this->requests[$i]->get_budget());
    array_push($returnall['desc'],$this->requests[$i]->get_desc());
    array_push($returnall['ids'],$this->requests[$i]->get_id());
    array_push($returnall['request_images'],(new main_model())->getreqimage($this->requests[$i]->get_id()));

  }

   return $returnall;

 }

 public function viewcomments()
 {
   $commz=$this->comments;
   $returnall=array('img'=>array(),'fullname'=>array(),'date'=>array(),'time'=>array(),'thecomment'=>array());
   for($co=0;$co<count($commz);$co++)
   {
     $com=$commz[$co];
     $donor=new donor_model($com->get_donor());

     array_push($returnall['img'],$donor->get_img());
     array_push($returnall['fullname'],$donor->get_fname()."".$donor->get_lname());
     array_push($returnall['date'],$com->get_time());
     array_push($returnall['time'],$com->get_date());
     array_push($returnall['thecomment'],$com->get_comment());
    

   }

  return $returnall;
 }



}





?>
