<?php
header("content-type: application/json; charset=UTF-8");
require $_SERVER['DOCUMENT_ROOT'].'/function.php';

require('_class/card.php');
require('_class/api.php');


$card = new Card;
$tools = new tools;

 if(isset($_POST['type']))
 {
    switch ($_POST['type']) 
    {
        case "dang-nhap":
          $username = str($_POST['username']);
          $password = str($_POST['password']);

          $User = $DB->get_row(" SELECT * FROM users WHERE username = '$username' ");
          $log = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");

          if (isset($log['username'])) 
          {
             die(msg(false,'Bạn đã đăng nhập'));
          }
          else if(empty($username) || empty($password))
          {
            die(msg(false,'Tài khoản hoặc mật khẩu không được bỏ trống'));
          }
          else if(!isset($User['id']))
          {
            die(msg(false,'Tài khoản không tồn tại'));
          }
          else if($User['status']==false)
          {
            die(msg(false,'Tài khoản này đã bị khóa không thể đăng nhập'));
          }
          else if(md5($password)!=$User['password'])
          {
            die(msg(false,'Mật khẩu không chính xác vui lòng thử lại'));
          }
          else
          {
            echo msg(true,'Đăng nhập thành công');
            // Lưu đăng nhập
            $_SESSION['token'] = $User['token'];
          }
        break;


        case "dang-ky":
          $username = str($_POST['username']);
          $password = str($_POST['password']);
          $confirm_password = str($_POST['confirm_password']);
          $token = "EAAA".md5(random_hash(2).$username);

          $save = [
            'username'=>$username,
            'password'=>md5($password),
            'email'=>null,
            'phone'=>null,
            'money'=>0,
            'referral'=>null,
            'level'=>0,
            'status'=>true,
            'token'=>$token,
            'date'=>gettime(),
            'ip'=>get_ip()
          ];

          $User = $DB->get_row(" SELECT * FROM users WHERE username = '$username' ");
          $log = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
         
          if (isset($log['username'])) 
          {
            die(msg(false,'Bạn đã đăng nhập'));
          }
          else if(empty($username) || empty($password) || empty($confirm_password))
          {
            die(msg(false,'Tài khoản hoặc mật khẩu không được bỏ trống'));
          }
          else if(isset($User['id']))
          {
            die(msg(false,'Tài khoản đã tồn tại'));
          }
          else if($password!=$confirm_password)
          {
            die(msg(false,'Mật khẩu không giống nhau vui lòng thử lại'));
          }
          else if($DB->insert('users', $save))
          {
            echo msg(true,'Đăng ký tài khoản thành công');
            // Lưu đăng nhập
            $_SESSION['token'] = $token;
          }
          else
          {
            die(msg(false,'Đăng ký tài khoản thất bại'));
          }
        break;

        case "change_info":
          $email = str($_POST['email']);
          $phone = str($_POST['phone']);

          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");

          $emailx = $DB->get_row(" SELECT * FROM users WHERE email = '$email' ");
          $phonex = $DB->get_row(" SELECT * FROM users WHERE phone = '$phone' ");

          $save =[
             'email'=>$email,
             'phone'=>$phone
          ];

          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($email))
          {
            die(msg(false,'Địa chỉ email không được bỏ trống'));
          }
          else if(empty($phone))
          {
            die(msg(false,'Số điện thoại không được bỏ trống'));
          }
          else if(isset($emailx['username']))
          {
            die(msg(false,'Địa chỉ email đã tồn tại'));
          }
          else if(isset($phonex['username']))
          {
            die(msg(false,'Số điện thoại đã tồn tại'));
          }
          else if($DB->update('users', $save,"`id`='".$users['id']."'"))
          {
            die(msg(true,'Cập nhập thông tin thành công'));
          }
          else
          {
            die(msg(false,'Cập nhập thông tin thất bại'));
          }
        break;



        case "change_password":
          $password = str($_POST['password']);
          $new_password = str($_POST['new_password']);
          $confirm_new_password = str($_POST['confirm_new_password']);

          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");

          $save =[
             'password'=>md5($new_password)
          ];

          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($password))
          {
            die(msg(false,'mật khẩu cũ không được bỏ trống'));
          }
          else if(empty($new_password))
          {
            die(msg(false,'mật khẩu mới không được bỏ trống'));
          }
          else if(empty($confirm_new_password))
          {
            die(msg(false,'Xác nhận mật khẩu mới không được bỏ trống'));
          }
          else if(md5($password) !=md5($users['password']))
          {
            die(msg(false,'Mật khẩu cũ không đúng'));
          }
          else if(md5($password) == md5($new_password))
          {
            die(msg(false,'Mật khẩu mới không được giống mật khẩu cũ'));
          }
          else if(md5($new_password) !=md5($confirm_new_password))
          {
            die(msg(false,'Xác nhận mật khẩu mới không đúng'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản này đã bị khóa không thể đổi mật khẩu'));
          }
          else if($DB->update('users', $save,"`id`='".$users['id']."'"))
          {
            die(msg(true,'Đổi mật khẩu thành công'));
          }
          else
          {
            die(msg(false,'Đổi mật khẩu thất bại'));
          }
        break;

        case "add_referral_code":
          $code = str(loc_cmt($_POST['code']));
          $loai = str($_POST['loai']);
          $check = $DB->get_row(" SELECT * FROM users WHERE referral = '".$code."' ");
          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");

          $save =[
             'referral'=>$code
          ];

          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($code))
          {
            die(msg(false,'Mã giới thiệu không được bỏ trống'));
          }
          else if($users['referral'] != '')
          {
            die(msg(false,'Bạn đã thêm 1 mã giới thiệu không được thêm nữa'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }

          if($loai==1){
            if(isset($check['referral']))
            {
             die(msg(false,'Mã giới thiệu đã tồn tại'));
            }
            else if($DB->update('users', $save,"`id`='".$users['id']."'"))
            {
             die(msg(true,'Thêm mã giới thiệu thành công'));
            }
            else
            {
             die(msg(false,'Thêm mã giới thiệu thất bại'));
            }
          }
          elseif(!isset($check['referral']))
          {
           die(msg(false,'Mã giới thiệu không tồn tại'));
          }
          else if($DB->update('users', $save,"`id`='".$users['id']."'"))
          {
            if($DB->cong('users','money',1,"`referral`='$code'"))
            {
                die(msg(true,'Thêm mã giới thiệu thành công'));
            }
            else
            {
              die(msg(false,'Không thể cộng tiền cho mã giới thiệu vui lòng liên hệ admin'));
            }
          }
          else
          {
            die(msg(false,'Thêm mã giới thiệu thất bại'));
          }
        break;


        case "active-site":
          $domain = str($_POST['domain']);

          $check = $DB->get_row(" SELECT * FROM daily WHERE domain = '".$domain."' ");
          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          $tong = $DB->tong(" SELECT * FROM daily WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          $save =[
            'username'=>$users['username'],
            'domain'=>$domain,
            'token'=>$users['token'],
            'date'=>gettime()
          ];

          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($domain))
          {
            die(msg(false,'Tên miền không được bỏ trống'));
          }
          else if($users['level'] < 1)
          {
            die(msg(false,'Cấp bậc của bạn không đủ để tạo đại lý'));
          }
          else if(isset($check['domain']))
          {
            die(msg(false,'Tên miền đã tồn tại trong hệ thống'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          elseif($tong > 2)
          {
            die(msg(false,'Bạn chỉ có thể thêm tối đa 3 tên miền'));
          }
          else if($DB->insert('daily', $save))
          {
            die(msg(true,'Thêm tên miền thành công '));
          }
          else
          {
            die(msg(false,'Thêm tên miền thất bại'));
          }
        break;

        case "active-site":
          $domain = str($_POST['domain']);

          $check = $DB->get_row(" SELECT * FROM daily WHERE domain = '".$domain."' ");
          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          $tong = $DB->tong(" SELECT * FROM daily WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          $save =[
            'username'=>$users['username'],
            'domain'=>$domain,
            'token'=>$users['token'],
            'date'=>gettime()
          ];

          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($domain))
          {
            die(msg(false,'Tên miền không được bỏ trống'));
          }
          else if($users['level'] < 1)
          {
            die(msg(false,'Cấp bậc của bạn không đủ để tạo đại lý'));
          }
          else if(isset($check['domain']))
          {
            die(msg(false,'Tên miền đã tồn tại trong hệ thống'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          elseif($tong > 2)
          {
            die(msg(false,'Bạn chỉ có thể thêm tối đa 3 tên miền'));
          }
          else if($DB->insert('daily', $save))
          {
            die(msg(true,'Thêm tên miền thành công '));
          }
          else
          {
            die(msg(false,'Thêm tên miền thất bại'));
          }
        break;


        case "add-the-cao":

          $telco = str($_POST['telco']);
          $pin = str($_POST['pin']);
          $serial = str($_POST['serial']);
          $amount = str($_POST['amount']);
          
          $partner_id = $DB->setting('partner_id');
          $partner_key = $DB->setting('partner_key');

          if($telco=='VIETTEL')
          {
            $money = $card->viettel($amount);
          }
          elseif($telco=='VINAPHONE')
          {
            $money = $card->vinaphone($amount);
          }
          elseif($telco=='MOBIFONE')
          {
            $money = $card->mobifone($amount);
          }
          elseif($telco=='VNMOBI')
          {
            $money = $card->vnmobi($amount);
          }
          elseif($telco=='ZING')
          {
            $money = $card->zing($amount);
          }
          elseif($telco=='GATE')
          {
            $money = $card->gate($amount);
          }
          else
          {
            $money = 0;
          }
          $request_id = random_code(6); 

          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          $check = $DB->get_row(" SELECT * FROM naptien WHERE `serial` = '".$serial."' ");
          $data = send_card($request_id, $telco, $pin, $serial, $amount ,$partner_key,$partner_id);

          $save =[
            'username'=>$users['username'],
            'telco'=>$telco,
            'pin'=>$pin,
            'serial'=>$serial,
            'amount'=>$amount,
            'request_id'=>$request_id,
            'content'=> $data->message,
            'thucnhan'=>$money,
            'status'=>0,
            'date'=>gettime()
          ];
          
          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($telco)||empty($pin)||empty($serial)||empty($amount))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          else if(isset($check['id']))
          {
            die(msg(false,'Thẻ này đã tồn tại trong hệ thống'));
          }
          else if($pin < 13)
          {
            die(msg(false,'Mã thẻ không chính xác'));
          }
          else if($serial < 11)
          {
            die(msg(false,'Serial thẻ không chính xác'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          else if($data->status == 'success')
          {
            if($DB->insert('naptien', $save))
            {
              die(msg(true,'Gửi thẻ lên hệ thống thành công '));
            }
            else
            {
              die(msg(false,'Gửi thẻ lên hệ thống thất bại'));
            }
          }
          else
          {
            die(msg(false,$data->message));
          }
        break;

        case "create-post":

          $content = str(loc_cmt($_POST['content']));

          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
         
          $save =[
            'username'=>$users['username'],
            'content'=>tagurl($content),
            'top'=>$users['level'],
            'date'=>gettime(),
            'ip'=>get_ip()
          ];
          
          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($users['level'] < 1)
          {
            die(msg(false,'Vui lòng nâng cấp bậc để đăng bài viết'));
          }
          else if(empty($content))
          {
            die(msg(false,'Nội dung bài viết không hợp lệ'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          elseif($DB->insert('post', $save))
          {
              die(msg(true,'Đăng bài viết lên hệ thống thành công '));
            
          }
          else
          {
            die(msg(false,'Đăng bài viết thất bại '));
          }
        break;
        
        case "like-post":

          $uid = str($_POST['uid']);

          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          // $love = $DB->get_row(" SELECT * FROM like WHERE `post` = '$like'  ");
          $username = $users['username'];

          $check = $DB->get_row(" SELECT * FROM post WHERE `id` = '$uid' ");
          $check2 = $DB->get_row(" SELECT * FROM like_post WHERE `username` = '$username'  AND `post` = '$uid'  ");
          $save =[
            'username'=>$users['username'],
            'post'=>$uid,
          ];
          
          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Bài viết không tồn tại'));
          }
          elseif(!isset($check2['id']))
          {
            if($DB->insert('like_post', $save))
            {
              $sl = $DB->tong(" SELECT * FROM like_post WHERE `post` = '$uid'  ");

                die(json_encode([
                  'status'=>'success',
                  'msg'=>'Bạn đã thả tim bài viết thành công',
                  'sl'=>$sl,
                ]));
            }
            else
            {
              die(msg(true,'Bạn thả tim bài viết thất bại'));
            }
          }
          elseif(isset($check2['id']))
          {
            if($DB->remove('like_post',"`post`='$uid' AND `username`='$username' "))
            {
              $sl = $DB->tong(" SELECT * FROM like_post WHERE `post` = '$uid' ORDER BY id DESC ");
                die(json_encode([
                  'status'=>'success',
                  'msg'=>'Bạn đã hủy tim bài viết thành công',
                  'sl'=>$sl,
                  ]));
            }
            else
            {
              die(msg(true,'Bạn hủy tim bài viết thất bại'));
            }
          }
          else
          {
            die(msg(false,'Tim bài viết thất bại '));
          }
        break;

        

        case "load-post":

          $uid = str($_POST['uid']);
       

          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          // $love = $DB->get_row(" SELECT * FROM like WHERE `post` = '$like'  ");
          $username = $users['username'];

          $check = $DB->get_row(" SELECT * FROM post WHERE `id` = '$uid' ");

          $list = $DB->get_list(" SELECT * FROM cmt WHERE `post` = '$uid' ORDER BY id DESC LIMIT 0, 4");

          
          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Bài viết không tồn tại'));
          }
          elseif(isset($check['id']))
          {
           foreach($list as $cmt)
          {
            header("content-type: application/html; charset=UTF-8");

              echo '
              
              <div class="d-flex mt-3">
                    <div class="avatar avatar-xl">
                      <img class="rounded-circlex" width="38" src="/assets/img/avatar/b1bbec499a0d66e5403480e8cda1bcbe.png" alt="">
                    </div>
                    <div class="flex-1 ms-2 fs--1 box-cmt">
                    <div class="d-inline-block align-self-center mb-1 pl-8">
				     	<div class="">'.$cmt['username'].'</div> 
                      </div>
                      <p class="mb-1 bg-200 rounded-3 p-2 pt-0">
                           '.$cmt['content'].'
                      </p>
                    </div>
                  </div>
              
              ';
           }
          }
          else
          {
            die(msg(false,'Tải bình luận bài viết thất bại '));
          }
        break;

        case "cmt-post":

          $uid = str($_POST['uid']);
          $content = str(loc_cmt($_POST['content']));

          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          $username = $users['username'];

          $check = $DB->get_row(" SELECT * FROM post WHERE `id` = '$uid' ");

          $save =[
            'username'=>$users['username'],
            'post'=>$uid,
            'content'=>tagurl($content),
          ];
          
          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($uid)|| empty($content))
          {
            die(msg(false,'Nội dung bình luận không hợp lệ'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Bài viết không tồn tại'));
          }
          elseif(isset($check['id']))
          {
            if($DB->insert('cmt', $save))
            {
              die(msg(true,'Bình luận bài viết thành công'));
            }
            else
            {
              die(msg(false,'Bình luận bài viết thất bại'));
            }
          }
          else
          {
            die(msg(false,'Bình luận bài viết thất bại '));
          }
        break;
        

        case "delete-post":

          $uid = str($_POST['uid']);

          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          $username = $users['username'];

          $check = $DB->get_row(" SELECT * FROM post WHERE `id` = '$uid' ");

          
          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          else if(empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Bài viết không tồn tại'));
          }
          elseif($check['username']==$username)
          {
            if($DB->remove('post',"`id`='$uid'") ||  $DB->remove('cmt',"`post`='$uid'") || $DB->remove('like_post',"`post`='$uid'"))
            {
              die(msg(true,'Xóa bài viết thành công '));
            }
            else
            {
              die(msg(false,'Xóa bài viết thất bại '));
            }
          }
          else
          {
            die(msg(false,'Xóa bài viết thất bại '));
          }
        break;
        
        case "mua-dich-vu":

          $uid = str($_POST['uid']);
          if(isset($_POST['server']))
          {
             $server = str($_POST['server']);
          }
          else
          {
            $server = "";
          }

          $note = str($_POST['content']);
          $quantity = str($_POST['quantity']);
          $loai = str($_POST['loai']);
          $type = str($_POST['code']);
          $bao_hanh = str($_POST['bao_hanh']);
          $users = $DB->get_row(" SELECT * FROM users WHERE token = '".$_SERVER['HTTP_AUTHORIZATION']."' ");
          $check = $DB->get_row(" SELECT * FROM dichvu WHERE type = '$type'");
          $check2 = $DB->get_row(" SELECT * FROM theloai WHERE loai = '$loai' ");
          $check3 = $DB->get_row(" SELECT * FROM server WHERE `loai` = '$loai' AND `type` = '$type'");


          if($users['level'] == 0)
          {
            $rate = $check3['rate'];                                            
          }
          elseif($users['level'] == 1)
          {
            $rate = $check3['rate2'];                                            
          }
          else
          {
            $rate = $check3['rate3'];                                            
          }



          if(isset($note))
          {
            $content = $check3['rate2'];                                            
          }
          else
          {
            $content = $check3['rate3'];                                            
          }

          $money = ($rate * $quantity) * $bao_hanh;


          $request = json_decode($tools->dichvu($loai,$type,$server,$uid,$quantity,"tungmmo"));

     
          $save = [
           'username'=>$users['username'],
           'uid'=>$uid,
           'content'=>$content,
           'quantity'=>$quantity,
           'baohanh'=>$bao_hanh,
           'money'=>$money,
           'loai'=>$loai,
           'type'=>$type,
           'server'=>$server,
           'status'=>$request->duyet,
           'date'=>gettime()
          ];

          if (!isset($users['username'])) 
          {
            die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif(empty($uid) || empty($server) || empty($quantity)|| empty($loai)|| empty($type)|| empty($server) || empty($bao_hanh))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Dịch vụ không tồn tại trong hệ thống'));
          }
          elseif(!isset($check2['id']))
          {
            die(msg(false,'Thể loại không tồn tại trong hệ thống'));
          }
          elseif(!isset($check3['id']))
          {
            die(msg(false,'Server không tồn tại trong hệ thống'));
          }
          elseif($money > $users['money'])
          {
            die(msg(false,'Bạn không đủ tiền để sử dụng dịch vụ này'));
          }
          elseif($quantity < 100)
          {
            die(msg(false,'Số lượng tối thiểu mức 100 trở lên'));
          }
          elseif($quantity > 1000000)
          {
            die(msg(false,'Số lượng quá cao hệ thống không đủ tài nguyên'));
          }
          else if($users['status']==false)
          {
            die(msg(false,'Tài khoản của bạn đã bị khóa'));
          }
          elseif($request->status==false)
          {
            die(msg(false,$request->msg));
          }
          elseif($DB->tru('users','money',$money, "`id`='".$users['id']."'"))
           {
            if($DB->insert('history', $save))
            {
               die(msg(true,'Mua dịch vụ thành công'));
            }
            else
            {
              die(msg(false,'Mua dịch vụ thất bại'));
            }
          }
          else
          {
            die(msg(false,'Mua dịch vụ thất bại'));
          }
        break;

        default:
            die(msg(false,'Sai cú đáp'));
    }
 }
 else
 {
  die(msg(false,'Không hỗ trợ phương thức GET'));
 }
