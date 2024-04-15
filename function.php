<?php
require('config.php');
$DB = new TUNGMMO;

function body()
{
    if(!isset($_SESSION['token']))
        return '<body class="bg-white" style="height: 100%;overflow: auto;" >'; 
    else 
        return '<body onload="menu()" >';
}

function token()
{
    if(!isset($_SESSION['token']))
        return 'NULL'; 
    else 
        return $_SESSION['token'];
}
function status($data)
{
    if($data==false)
        return '<span class="badge bg-danger">Bị khóa</span>'; 
    else 
        return '<span class="badge bg-success">Hoạt động</span>'; 
}

function status2($data)
{
    if($data==2)
        return '<span class="badge bg-danger">Thất bại</span>'; 
    else if($data==1)
        return '<span class="badge bg-success">Thành công</span>'; 
    else
        return '<span class="badge bg-warning">Đang chạy</span>'; 

}

function card($data)
{
    if($data==1) 
        return '<span class="badge bg-success">Thành công</span>'; 
    else if($data==2)
        return '<span class="badge bg-danger">Thẻ sai</span>'; 
    else if($data==0)
        return '<span class="badge bg-warning">Chờ duyệt</span>'; 

}
function status3($data)
{
    if($data==1) 
        return '<span class="badge bg-success">Thành công</span>'; 
    else if($data==2)
        return '<span class="badge bg-danger">Thất bại</span>'; 
    else if($data==0)
        return '<span class="badge bg-warning">Chờ duyệt</span>'; 

}
function checked($data)
{
    if($data==false)
    return ''; 
    else 
    return 'checked="checked"'; 
}
function msg($code,$msg)
{
    if($code==false)
        $status = 'error'; 
    else 
        $status = "success";

    return json_encode([
       'status'=>$status,
       'msg'=>$msg
    ],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
}
function tagurl($text)
{
    $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
    $string = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $text);
    return $string;
}

function get_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    elseif (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    elseif (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    elseif (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    elseif (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    elseif (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else 
        $ipaddress = 'UNKNOWN';
    
    return $ipaddress;
}
function prefetch()
{
    global $DB;

    if(!isset($_SESSION['token']))
        
    return '
    <link rel="prefetch" href="/" as="document" />
    <link rel="prefetch" href="/dang-nhap" as="document" />
    <link rel="prefetch" href="/dang-ky" as="document" />
    ';
 
    else if($DB->users('level') > 2)
     
   return '
   <link rel="prefetch" href="/quan-ly/thanh-vien" as="document" />
   <link rel="prefetch" href="/quan-ly/dai-ly" as="document" />
   <link rel="prefetch" href="/quan-ly/the-loai" as="document" />
   <link rel="prefetch" href="/quan-ly/dich-vu" as="document" />
   <link rel="prefetch" href="/quan-ly/server" as="document" />
   <link rel="prefetch" href="/quan-ly/order" as="document" />

   ';
}
function xoa_dau($str){
    $unicode = [
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'y|ý|ỳ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Y|Ý|Ỳ|Ỵ'
    ];
    
   foreach($unicode as $nonUnicode=>$uni)
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
   return $str;
}


function loc_cmt($str){
    $unicode = [
        ''=> 'dcm|tùng|đkm|trẩu|trẻ|tre|trau|đm|dm|đkm|dkm|địp|dip|con|lợn|chó|lồn|cu|chim|bố|mày|tao|mẹ|bố|tổ|sư|cha|buồi|du|đù|má|đụ|chịch|hiếp|dâm|dê|tùng|lỏ|coder|non|gà|n o n|đ k m|đ.l.m|n.o.n|đ.k.m|ĐM|Lỏ|l ỏ|l.ỏ|XXS|script|hack|h.a.c.k|bug|b.u.g|quang|q.u.a.n.g|like|scam|lừa|đảo|sub|đểu|lâu|chậm|vl|vc|vcl|v',
    ];
   foreach($unicode as $nonUnicode=>$uni)
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
   return $str;
}

function gettime()
{
    return date('d-m-Y H:i:s', time());
}



function str($data)
{
    return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));;
}

function load()
{
    return date('His', time());
}

function compare($value1,$value2)
{
   if($value1 == $value2)
      return '<span class="badge bg-primary">'.$value1.'</span>';
   else
      return $value2;
}

function timeago($date) {
    $timestamp = strtotime($date);	
    
    $strTime = ["giây", "phút", "giờ", "ngày", "tháng", "năm"];
    $length = ["60","60","24","30","12","10"];

    $currentTime = time();
    if($currentTime >= $timestamp) {
         $diff     = time()- $timestamp;
         for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
         $diff = $diff / $length[$i];
         }

         $diff = round($diff);
         return $diff . " " . $strTime[$i] . " trước";
    }
 }

function format($price)
{
    return str_replace(",", ".", number_format($price)); 
}

function random_code($code)
{
    return substr(str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNM1234567890'), 0, $code);
}

function months($time_ago)
{
    $time_ago   = date("Y-m-d H:i:s", $time_ago);
    $time_ago   = strtotime($time_ago);
    $months     = round($time_ago / 2600640 );
    return $months;
}

function send_card($request_id, $telco, $pin, $serial, $amount ,$key,$id) {

    $domain = "https://gachthevip.net"; // THAY THÀNH WEBSITE CẦN ĐẤU

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $domain.'/api/send-card?request_id='.$request_id.'&telco='.$telco.'&pin='.$pin.'&serial='.$serial.'&amount='.$amount,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            "partner_id: $id",
            "partner_key: $key"
        ],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);

}

function MA_GD($code)
{
    return substr(str_shuffle($code),4);
}

function random_hash($code)
{
    return substr(str_shuffle('6DD0CF9B80hgsdwejuluwdcjyu54BE5F0A91DA6F@$%'), 0, $code);
}

function level($data)
{
  switch ($data) 
   {
    case "0":
      return "Thành viên";
    case "1":
      return "Cộng tác viên";
    case "2":
      return "Đại lý";
    break;
    case "3":
        return "Kiểm duyệt viên";
    break;
    case "4":
        return "Quản trị viên";
    break;
    default:
       return "không có cấp bậc";
    }
}



?>
