<?php 
 //function to check iteam in datebase 
    //function accept parameter
    //$select=the item to select
    //$from =the tabel to select from 
    //$value=the value of select
    function checkitem($select,$from,$value){
        global $con;
        $statment=$con->prepare("SELECT $select FROM $from WHERE $select=? ");
        $statment->execute(array($value));
        $count=$statment->rowCount();
        return $count;
      }

// #####################################################################################
      //  function v2.0
//  redirect function this function accept parameter 
//  $themsg = echo the message[error |succses | waring] 
//  $seconds=second before redirect
//  $url=the link you eant to redirect to   
  function redirecthome($themsg ,$url=null,$second=3){
    if($url===null){
      $url='index.php';
      $link='homepage';
    }else{
      $url=isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']!==''?$_SERVER['HTTP_REFERER']:'index.php';
      $link='previous page ';
      // if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']!==''){
        
      //   $url = $_SERVER['HTTP_REFERER']; 
      // }else{
      //   $url='index.php';
      // }
    }
    echo $themsg;
    echo "<div class='alert alert-info '>You will be redireted to $link after $second seconds </div>";

      header("refresh:$second; url=$url");
      exit();
    }