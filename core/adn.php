<?php
require $_SERVER['DOCUMENT_ROOT'].'/function.php';
header("content-type: application/json; charset=UTF-8");

 if(isset($_POST['type']))
 {
    switch ($_POST['type']) 
    {
        case "edit-thanh-vien":
          
          $money = str($_POST['money']);
          $level = str($_POST['level']);
          $status = str($_POST['status']);
          $username = str($_POST['username']);
          $phone = str($_POST['phone']);
          $email = str($_POST['email']);
          $users = $DB->get_row(" SELECT * FROM users WHERE username = '".$username."' ");

          $check = $DB->get_row(" SELECT * FROM users WHERE phone = '".$phone."' ");
          $check2 = $DB->get_row(" SELECT * FROM users WHERE email = '".$email."' ");

          if(str($_POST['password'])=="")
          {
            $password = $users['password'];
          }
          else
          {
            $password = str($_POST['password']);
          }

          $save = [
            'password'=>$password,
            'phone'=>$phone,
            'email'=>$email,
            'money'=>$money,
            'level'=>$level,
            'status'=>$status
          ];


          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif($money=="" || empty($password) || $level=="" || empty($status) || empty($username))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif($level < 0 || $level > 4)
          {
            die(msg(false,'Cấp bậc không hợp lệ'));
          }
          elseif(!isset($users['id']))
          {
            die(msg(false,'Tài khoản không tồn tại'));
          }
          elseif($phone !=""||$email !="")
          {
            if($check['username'] != $username)
            {
              die(msg(false,'Số điện thoại đã tồn tại'));
            }
            elseif($check2['username'] != $username)
            {
              die(msg(false,'Địa chỉ email đã tồn tại'));
            }
            elseif($DB->update('users', $save,"`username`='$username'"))
            {
              die(msg(true,'Thay đổi thông tin thành công'));
            }
            else
            {
              die(msg(false,'Thay đổi thông tin thất bại'));
            }
          }
          elseif($DB->update('users', $save,"`username`='$username'"))
          {
            die(msg(true,'Thay đổi thông tin thành công'));
          }
          else
          {
            die(msg(false,'Thay đổi thông tin thất bại'));
          }
        break;

        case "edit-order":
          $status = str($_POST['status']);
          $uid = str($_POST['uid']);

          $save = [
            'status'=>$status
          ];

          $check = $DB->get_row("SELECT * FROM history WHERE id = '".$uid."' ");
          $username = $check['username'];
          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif($status=="" || empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'dữ liệu không còn tồn tại trong hệ thống'));
          }
          elseif($check['status'] != 0)
          {
            die(msg(false,'Đơn hàng này đã được duyệt'));
          }
          elseif($DB->update('history', $save,"`id`='$uid'"))
          {
            if($status==2)
            {
                if($DB->cong('users','money',$check['money'],"`username`='$username'"))
                {
                  die(msg(true,'Cập nhập thông tin thành công'));
                }
                else
                {
                  die(msg(false,'Cập nhập thông tin thất bại'));
                }
            }
            else
            {
              die(msg(true,'Cập nhập thông tin thành công'));
            }
          }
          else
          {
              die(msg(false,'Cập nhập thông tin thất bại'));
          }
        break;

        case "edit-card":
          $status = str($_POST['status']);
          $thucnhan = str($_POST['thucnhan']);
          $uid = str($_POST['uid']);

          $save = [
            'thucnhan'=>$thucnhan,
            'status'=>$status
          ];

          $check = $DB->get_row("SELECT * FROM naptien WHERE id = '".$uid."' ");

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif($status=="" || empty($thucnhan) || empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'dữ liệu không còn tồn tại trong hệ thống'));
          }
          elseif($check['status'] != 0)
          {
            die(msg(false,'Thẻ này đã được duyệt không thể cập nhập'));
          }
          elseif($DB->update('naptien', $save,"`id`='$uid'"))
          {
            if($status==1)
            {
               if($DB->cong('users','money',$thucnhan,"`id`='$uid'"))
               {
                 die(msg(true,'Cập nhập thẻ thành công'));;
               }
               else
               {
                 die(msg(false,'Cập nhập thẻ thất bại'));
               }
            }
            else
            {
              die(msg(true,'Cập nhập thẻ thành công'));;
            }
          }
          else
          {
              die(msg(false,'Cập nhập thẻ thất bại'));
          }
        break;
        
        case "edit_website":
          $title = str($_POST['title']);
          $description = str($_POST['description']);
          $keyword = str($_POST['keyword']);
          $partner_id = str($_POST['partner_id']);
          $partner_key = str($_POST['partner_key']);
          $head = $_POST['head'];
          $footer = $_POST['footer'];
          $status = $_POST['status'];
 
          $save = [
            'title'=>$title,
            'description'=>$description,
            'keyword'=>$keyword,
            'partner_id'=>$partner_id,
            'partner_key'=>$partner_key,
            'head'=>$head,
            'footer'=>$footer,
            'status'=>$status
          ];

      
          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif($status=="" || empty($title) || empty($keyword) ||empty($description)||  empty($partner_id)|| empty($partner_key)|| empty($status))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif($DB->update('setting', $save,"`id`='1'"))
          {
              die(msg(true,'Cập nhập thông tin thành công'));
          }
          else
          {
              die(msg(false,'Cập nhập thông tin thất bại'));
          }
        break;


        case "edit-site":
          $status = str($_POST['status']);
          $domain = str($_POST['domain']);
          $uid = str($_POST['uid']);

          $save = [
            'domain'=>$domain,
            'status'=>$status
          ];

          $domain = $DB->get_row(" SELECT * FROM daily WHERE domain = '".$domain."' ");
          $check = $DB->get_row("SELECT * FROM daily WHERE id = '".$uid."' ");

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif($status=="" || empty($domain) || empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'dữ liệu không còn tồn tại trong hệ thống'));
          }
          elseif(isset($domain['id']))
          {
            if($domain['domain'] != $check['domain'])
            {
              die(msg(false,'tên miền đã tồn tại trong hệ thống'));
            }
            elseif($DB->update('daily', $save,"`id`='$uid'"))
            {
              die(msg(true,'Thay đổi thông tin thành công'));
            }
            else
            {
              die(msg(false,'Thay đổi thông tin thất bại'));
            }
          }
          elseif($DB->update('daily', $save,"`id`='$uid'"))
          {
              die(msg(true,'Thay đổi thông tin thành công'));
          }
          else
          {
              die(msg(false,'Thay đổi thông tin thất bại'));
          }
        break;

        case "xoa-card":
          $uid = str($_POST['uid']);

          $check = $DB->get_row("SELECT * FROM naptien WHERE id = '".$uid."' ");

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'dữ liệu không còn tồn tại trong hệ thống'));
          }
          elseif($DB->remove('naptien',"`id`='$uid'"))
          {
              die(msg(true,'Xóa thẻ thành công'));
          }
          else
          {
              die(msg(false,'Xóa thẻ thất bại'));
          }
        break;

        case "xoa-site":

          $uid = str($_POST['uid']);
          $check = $DB->get_row("SELECT * FROM daily WHERE id = '".$uid."' ");

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Dữ liệu không còn tồn tại trong hệ thống'));
          }
          elseif($DB->remove('daily',"`id`='$uid'"))
          {
              die(msg(true,'Xóa site thành công'));
          }
          else
          {
              die(msg(false,'Xóa site thất bại'));
          }
        break;

        case "xoa-order":

          $uid = str($_POST['uid']);
          $check = $DB->get_row("SELECT * FROM history WHERE id = '".$uid."' ");

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Dữ liệu không còn tồn tại trong hệ thống'));
          }
          elseif($DB->remove('history',"`id`='$uid'"))
          {
              die(msg(true,'Xóa đơn hàng thành công'));
          }
          else
          {
              die(msg(false,'Xóa đơn hàng thất bại'));
          }
        break;

        case "edit-the-loai":
          $id = str($_POST['id']);
          $name = str($_POST['name']);
          $loai = str($_POST['loai']);
          $img =$_POST['img'];

          $check = $DB->get_row(" SELECT * FROM theloai WHERE id = '$id' ");
          $check2 = $DB->get_row(" SELECT * FROM theloai WHERE loai = '$loai' ");

          $save = [
           'name'=>$name,
           'img'=>$img,
           'loai'=>$loai
          ];

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif( empty($loai) || empty($name) || empty($img)|| empty($id))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Thể loại không tồn tại trong hệ thống'));
          }
          elseif($check['loai'] != $loai)
          {
            if(isset($check2['loai']))
            {
              die(msg(false,'Mã thể loại đã tồn tại trong hệ thống'));
            }
            elseif($DB->update('theloai', $save,"`id`='$id'"))
            {
              die(msg(true,'Cập nhập thông tin thành công'));
            }
            else
            {
              die(msg(false,'Cập nhập thông tin thất bại'));
            }
          }
          elseif($DB->update('theloai', $save,"`id`='$id'"))
          {
            die(msg(true,'Cập nhập thông tin thành công'));
          }
          else
          {
            die(msg(false,'Cập nhập thông tin thất bại'));
          }
        break;

        case "xoa-the-loai":

          $id = str($_POST['id']);
          $check = $DB->get_row(" SELECT * FROM theloai WHERE id = '$id' ");


          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($loai))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Thể loại không tồn tại trong hệ thống'));
          }
          elseif($DB->remove('theloai',"`id`='$id'"))
          {
            die(msg(true,'Xóa thể loại thành công'));
          }
          else
          {
            die(msg(false,'Xóa thể loại thất bại'));
          }
        break;

        case "xoa-thanh-vien":
          $username = str($_POST['username']);

          $users = $DB->get_row(" SELECT * FROM users WHERE username = '".$username."' ");

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($username))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($users['id']))
          {
            die(msg(false,'Tài khoản không tồn tại'));
          }
          elseif($DB->remove('users',"`username`='$username'"))
          {
            die(msg(true,'Xóa người dùng thành công'));
          }
          else
          {
            die(msg(false,'Xóa người dùng thất bại'));
          }
        break;
        
        case "edit-dich-vu":
          $uid = str($_POST['uid']);
          $name = str($_POST['name']);
          $img = $_POST['img'];
          $loai = str($_POST['loai']);
          $type = str($_POST['code']);
          $content = str($_POST['content']);

          $check = $DB->get_row(" SELECT * FROM dichvu WHERE loai = '$loai'");
          $check2 = $DB->get_row(" SELECT * FROM theloai WHERE loai = '$loai' ");
          $check3 = $DB->get_row(" SELECT * FROM dichvu WHERE id = '$uid'");
          $save = [
           'name'=>$name,
           'img'=>$img,
           'content'=>$content,
           'type'=>$type,
           'loai'=>$loai
          ];

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($loai) || empty($name) || empty($img)|| empty($content) || empty($type) || empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check2['id']))
          {
            die(msg(false,'Mã thể loại không tồn tại trong hệ thống'));
          }
          elseif(isset($check2['id']))
          {
            if($check['type'] != $check3['type'])
            {
              die(msg(false,'Mã dịch vụ đã tồn tại trong hệ thống'));
            }
            elseif($DB->update('dichvu', $save,"`id`='$uid'"))
            {
              die(msg(true,'Cập nhập dịch vụ thành công'));
            }
            else
            {
              die(msg(true,'Cập nhập dịch vụ thất bại'));
            }
          }
          elseif($DB->update('dichvu', $save,"`id`='$uid'"))
          {
            die(msg(true,'Cập nhập dịch vụ thất bại'));
          }
          else
          {
            die(msg(false,'Thêm dịch vụ thất bại'));
          }
        break;

        case "xoa-dich-vu":
          $id = str($_POST['id']);

          $check = $DB->get_row(" SELECT * FROM dichvu WHERE id = '$id' ");


          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($id))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Dịch vụ không tồn tại trong hệ thống'));
          }
          elseif($DB->remove('Dichvu',"`id`='$id'"))
          {
            die(msg(true,'Xóa dịch vụ thành công'));
          }
          else
          {
            die(msg(false,'Xóa dịch vụ thất bại'));
          }
        break;
        

        case "xoa-server":
          $id = str($_POST['id']);

          $check = $DB->get_row(" SELECT * FROM server WHERE id = '$id' ");


          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($id))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Server không tồn tại trong hệ thống'));
          }
          elseif($DB->remove('server',"`id`='$id'"))
          {
            die(msg(true,'Xóa server thành công'));
          }
          else
          {
            die(msg(false,'Xóa dịch vụ thất bại'));
          }
        break;

        case "them-the-loai":
          $name = str($_POST['name']);
          $img = $_POST['img'];
          $loai = str($_POST['loai']);

          $check = $DB->get_row(" SELECT * FROM theloai WHERE loai = '$loai' ");

          $save = [
           'name'=>$name,
           'img'=>$img,
           'loai'=>$loai
          ];

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($loai) || empty($name) || empty($img))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(isset($check['id']))
          {
            die(msg(false,'Mã thể loại đã tồn tại trong hệ thống'));
          }
          elseif($DB->insert('theloai', $save))
          {
            die(msg(true,'Thêm thể loại thành công'));
          }
          else
          {
            die(msg(false,'Thêm thể loại thất bại'));
          }
        break;

        case "them-dich-vu":
          $name = str($_POST['name']);
          $img = $_POST['img'];
          $loai = str($_POST['loai']);
          $type = str($_POST['code']);
          $content = str($_POST['content']);

          $check = $DB->get_row(" SELECT * FROM dichvu WHERE loai = '$loai' AND type = '$type'");
          $check2 = $DB->get_row(" SELECT * FROM theloai WHERE loai = '$loai' ");

          $save = [
           'name'=>$name,
           'img'=>$img,
           'content'=>$content,
           'type'=>$type,
           'loai'=>$loai
          ];

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($loai) || empty($name) || empty($img)|| empty($content) || empty($type))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(isset($check['id']))
          {
            die(msg(false,'Mã dịch vụ đã tồn tại trong hệ thống'));
          }
          elseif(!isset($check2['id']))
          {
            die(msg(false,'Mã thể loại không tồn tại trong hệ thống'));
          }
          elseif($DB->insert('dichvu', $save))
          {
            die(msg(true,'Thêm dịch vụ thành công'));
          }
          else
          {
            die(msg(false,'Thêm dịch vụ thất bại'));
          }
        break;

        case "them-server":
          $name = str($_POST['name']);
          $rate = str($_POST['rate']);
          $rate2 = str($_POST['rate2']);
          $rate3 = str($_POST['rate3']);
          $loai = str($_POST['loai']);
          $type = str($_POST['code']);

          $check = $DB->get_row(" SELECT * FROM dichvu WHERE type = '$type'");
          $check2 = $DB->get_row(" SELECT * FROM theloai WHERE loai = '$loai' ");

          $save = [
           'name'=>$name,
           'rate'=>$rate,
           'rate2'=>$rate2,
           'rate3'=>$rate3,
           'loai'=>$loai,
           'type'=>$type,
          ];

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($loai) || empty($name) || $rate==""|| $rate2==""|| $rate3==""|| $type=="")
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
          elseif($DB->insert('server', $save))
          {
            die(msg(true,'Thêm server thành công'));
          }
          else
          {
            die(msg(false,'Thêm server thất bại'));
          }
        break;

        case "edit-server":
          $id = str($_POST['id']);
          $name = str($_POST['name']);
          $rate = str($_POST['rate']);
          $rate2 = str($_POST['rate2']);
          $rate3 = str($_POST['rate3']);
          $loai = str($_POST['loai']);
          $type = str($_POST['code']);

          $check = $DB->get_row(" SELECT * FROM dichvu WHERE type = '$type'");
          $check2 = $DB->get_row(" SELECT * FROM theloai WHERE loai = '$loai' ");
          $check3 = $DB->get_row(" SELECT * FROM theloai WHERE loai = '$loai' ");

          $save = [
           'name'=>$name,
           'rate'=>$rate,
           'rate2'=>$rate2,
           'rate3'=>$rate3,
           'loai'=>$loai,
           'type'=>$type,
          ];

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($loai) || empty($name) || empty($rate)|| empty($rate2)|| empty($rate3)|| empty($type)|| empty($id) )
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
          elseif(!isset($check2['id']))
          {
            die(msg(false,'Server không tồn tại trong hệ thống'));
          }
          elseif($DB->update('server', $save,"`id`='$id'"))
          {
            die(msg(true,'Cập nhập thông tin thành công'));
          }
          else
          {
            die(msg(false,'Cập nhập thông tin thất bại'));
          }
        break;

        
        case "xoa-ngan-hang":
          $uid = str($_POST['id']);
          
          $check = $DB->get_row(" SELECT * FROM bank WHERE id = '$uid'");

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($uid))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Ngân hàng này không còn tồn tại trong hệ thống'));
          }
          elseif($DB->remove('bank',"`id`='$uid'"))
          {
            die(msg(true,'Xóa ngân hàng thành công'));
          }
          else
          {
            die(msg(false,'Xóa ngân hàng thất bại'));
          }
        break;

        case "edit-ngan-hang":
          $uid = str($_POST['id']);
          $name = str($_POST['name']);
          $img = $_POST['img'];
          $stk = str($_POST['stk']);
          $min = str($_POST['min']);
          $content = str($_POST['content']);
          $check = $DB->get_row(" SELECT * FROM bank WHERE id = '$uid'");
          $save = [
            'name'=>$name,
            'img'=>$img,
            'stk'=>$stk,
            'min'=>$min,
            'content'=>$content,
           ];
          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($uid)||empty($name) || empty($img) || empty($stk)|| empty($min)|| empty($content))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif(!isset($check['id']))
          {
            die(msg(false,'Ngân hàng này không còn tồn tại trong hệ thống'));
          }
          elseif($DB->update('bank',$save,"`id`='$uid'"))
          {
            die(msg(true,'Sửa ngân hàng thành công'));
          }
          else
          {
            die(msg(false,'Sửa ngân hàng thất bại'));
          }
        break;


        case "them-ngan-hang":
          $name = str($_POST['name']);
          $img = $_POST['img'];
          $stk = str($_POST['stk']);
          $min = str($_POST['min']);
          $content = str($_POST['content']);
          $save = [
           'name'=>$name,
           'img'=>$img,
           'stk'=>$stk,
           'min'=>$min,
           'content'=>$content,
          ];

          if (!isset($_SESSION['token'])) 
          {
             die(msg(false,'Bạn chưa đăng nhập'));
          }
          elseif($DB->users('level') < 3)
          {
            die(msg(false,'Bạn không phải kiểm duyệt viên hay quản trị viên'));
          }
          elseif(empty($name) || empty($img) || empty($stk)|| empty($min)|| empty($content))
          {
            die(msg(false,'Thiếu thông tin quan trọng'));
          }
          elseif($DB->insert('bank', $save))
          {
            die(msg(true,'Thêm ngân hàng thành công'));
          }
          else
          {
            die(msg(false,'Thêm ngân hàng thất bại'));
          }
        break;

        default:
            die(msg(false,'sai cú đáp'));
    }
 }
