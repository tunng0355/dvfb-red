<?php
header("content-type: application/json; charset=UTF-8");

require $_SERVER['DOCUMENT_ROOT'].'/function.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/_class/bank.php';

$data = new Bank;
$history = json_decode($data->MBANK(),true)['result']['transactionHistoryList'];

if (isset($_SESSION['token'])) 
{

// MB BANK
 foreach ($history as $value)
 {   
  $type = $value['io'];
  $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SESSION['token']."' ");
  $username = $users['username'];
  $stk = $value['accountNo'];
  $tranid = str($value['tranId']);
  $noidung = $value['content'];
  $money = $value['creditAmount'];
  $date = $value['transactionDate'];
  $check = $username." nap";
  preg_match('/'.$check.'/', $value['content'], $matches);
  if($type == 1)
  {
   foreach ($matches as $t)
   {    
      $check = $DB->get_row(" SELECT * FROM payment WHERE `tranid` = '$tranid' ");      
      $x = explode(" nap",$t);
      if($check['tranid'] != $tranid)
      {
        if($x[0]==$username)
        {
         $DB->insert('payment',[
          'username'=> $username,
          'stk'=> $stk,
          'tranid' => $tranid,
          'money'=>$money,
          'content'=>$t,
          'date'=>$date
         ]); 
         $DB->cong('users', 'money',$money,"`username`='$username'");
         die(msg(true,'Bạn đã nạp '.$money.' thành công qua MBANK'));
        }
     }
    }
   }
  }
// END MB BANK

}
