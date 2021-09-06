<?php

namespace eng\controllers;
use \eng\obj\{ngo,main};
require_once("../../autoload.php");
session_start();
//ngo name
if(isset($_GET['request']))
{
    switch($_GET['request'])
    {
      case "allrequests":
      
      $main=new main();
      $all=$main->viewAll();
      
     
        print json_encode($all);
     
        break;

        case "onereq":
          $main1=new main($_GET['reqid']);
          $all1=$main1->viewAll();
          
          print json_encode($all1);
          break;

          case "allcom":
           
          $commobj=new main($_GET['reqid']);

          print json_encode($commobj->viewcomments());

          break;
      

      
    }
}

  

?>