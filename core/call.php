<?php
require $_SERVER['DOCUMENT_ROOT'].'/function.php';

    if(isset($_GET['status']) && isset($_GET['request_id'])) 
    {
        $status = $_GET['status'];
        $request_id = $_GET['request_id'];

        $Card = $DB->get_row(" SELECT * FROM `naptien` WHERE `request_id` = '$body->request_id' ");
        $users = $DB->get_row(" SELECT * FROM `naptien` WHERE `request_id` = '".$Card['username']."' ");


        $telco = $_GET['telco']; // NHÀ MẠNG
        $pin = $_GET['pin']; // MÃ THẺ
        $serial = $_GET['serial']; // SERIAL
        $amount = intval($_GET['amount']); // MỆNH GIÁ GỬI
        $amount_real = intval($_GET['amount_real']); // MỆNH GIÁ THỰC
        $amount_recieve = intval($_GET['amount_recieve']); // SỐ TIỀN NHẬN ĐƯỢC

        if(!isset($users['username']))
        {
            // Tài khoản không tồn tại
        }
        if(!isset($Card['request_id'])) 
        {
            // Thẻ này không tồn tại

        } 
        else if($Card['status'] != 0) 
        {
            // Thẻ này đã được duyệt

        }
         else if($status == 'success') 
        {
            // Thành công
           $save = [
               'status'=>1,
               'content'=> 'nạp thành công'
           ];
           $DB->update('naptien', $save, "`request_id`=$body->request_id");
           $DB->cong('users', 'money', $Card['thucnhan'],"`username`='".$users['username']."'");

        }
         else if($status == 'wrong_amount')
          {
            // Sai mệnh giá
            $save = [
                'status'=>2,
                'content'=> 'nạp sai mệnh giá'
            ];
            $DB->update('naptien', $save, "`request_id`=$body->request_id");
            $DB->cong('users', 'money', $Card['thucnhan'] / 2, "`username`='".$users['username']."'");
        }
         else if($status == 'fail') 
         {
            // Thẻ sai
            $save = [
                'status'=>3,
                'content'=> 'nạp thất bại'
            ];
            $DB->update('naptien', $save, "`request_id`=$body->request_id");
        }
    }
