<?php
ini_set('display_errors', 0);
class tools
{        

    private  $cookie = "";
    private  $apikey_dichvuonline = "yDNTKoUvOm39jRxftQBXlSWur";
    private  $apikey_trum24h = "1f62c1e1a062a784aaa062d26c8d9ea3";
    private  $apikey_baostar = "OTM2NDNub3cyMDk0NWZjY2UwYmUwMjRkMWZhMmI4OWZh";
    private  $apikey_subgiare = "eyJpdiI6IkhZT05zWDlPV3lZaHdreU5VM28xelE9PSIsInZhbHVlIjoiN0lTb2NnREVNeG9MRzVtNnpoSjNWaDNiMUtCUDAxZFlBYUhEK2NWL3BBWWhlMGtxamxHckpkaUtjeG5BNHc1MSIsIm1hYyI6ImZhOGMzZjE3NDk1YTRjYzAxMGJjZWM5NDBmZTQ0NTk1YzU4MGU3OTU4NjYyMDI0OGI3YTdjYjE2YWJjNjhiNTEiLCJ0YWciOiIifQ==";
    private  $apikey_autofb = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NjA5NywidXNlcm5hbWUiOiJ0dW5nMDM1NSIsIm1vbmV5IjowLCJ0eXBlIjowLCJjcmVhdGVfYXQiOiIxNjI0MzYzMDk4IiwiZW1haWwiOiJ0aGFuaHR1bmdrdGZha28xQGdtYWlsLmNvbSIsImZhY2Vib29rX2lkIjoiNCIsInBob25lIjoiMDM1NTE3MzgwNSIsIm5hbWUiOiJ1c2VyIiwicGVyY2VudCI6MCwibm90ZXMiOiLEkGHMo2kgTHnMgSIsInVwZGF0ZV9hdCI6bnVsbCwidGllbl9uYXAiOjAsImlhdCI6MTY1MTM3NDI4MiwiZXhwIjoxNjgyOTMxMjA4fQ.a7ESaZbQRNVHtaKVbOcXnazpufVVQLcD9cSFe0E1gbw";


    public function curl($url,$data,$header)
    {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      $result = curl_exec($ch);
      curl_close($ch);
      return json_decode($result);
    }

    public function curl2($url, $cookie)
    {
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $head[] = "Connection: keep-alive";
        $head[] = "Keep-Alive: 300";
        $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $head[] = "Accept-Language: en-us,en;q=0.5";
        curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Expect:'
        ));
        $page = curl_exec($ch);
        curl_close($ch);
        return $page;
    }

    public function getuid($link)
    {
        $cookie = $this->cookie;
        $return = ['error' => 0];
        $url  = $this->curl2($link, $cookie);
        
        if (preg_match('#name="target" value="(.+?)"#is', $url, $getuid)) 
        {
            $userId = $getuid[1];
        }
        if (preg_match('#<title>(.+?)</title>#is', $url, $getuid)) 
        {
            $fullName = $getuid[1];
        }
        if (isset($fullName) && isset($userId))
         {
          return [
            'status'=>true,
            'uid'=>$userId,
            'name' => $fullName,
            'msg'=> 'get uid thành công'
          ];
        }
        else
        {
          return ['status'=>false,
          'msg'=> 'Không get được vui lòng thử lại hoặc nhập ID Facebook.'
        ];
        }
    }



    public function dichvu($loai,$type,$server,$uid,$amount,$note)
    {
      switch ($loai) 
      {
         case "facebook": 
         
            if($type == "follow" )
            {


              if($server ==1)
              {
                // Sv1 [Tốc độ cực nhanh, gần như lên ngay sau 5s - 1h, max không giới hạn, không chạy cho pro5]

                    $url ="https://thuycute.hoangvanlinh.vn/api/service/facebook/sub-vip/order";

                    $data = [
                     'idfb'=> $uid,
                     'server_order'=> 'sv4',
                     'amount'=> $amount,
                     'note'=> $note
                    ];

                    $request = $this->curl($url,$data,
                    [  
                      'api-token:'.$this->apikey_subgiare
                    ]);

                    return json_encode([
                      'msg'=>$request->message,
                      'status'=>$request->status,
                      'duyet'=>1
                    ]);

              }

              else

              
              if($server ==2)
              {
                // S3 Follow VIP sale [ Lên ngay hoặc trong vài h - Max 250k/1id]
                    $url ="https://dichvu.baostar.pro/api/facebook-follow/buy";

                    $data = [
                     'object_id' => $uid,
                     'package_name' => 'facebook_follow_sv16', // server 1,2,3.. server nào được bật sẽ hiện ở trang mua sub (tương ứng SV1, SV2, SV3...)
                     'quantity' => $amount
                    ];

                    $request = $this->curl($url,$data,[
                        "api-key"=> $this->apikey_baostar,
                        "Content-Type"=> "application/json" 
                      
                    ]);
                    
                    return json_encode([
                      'msg'=>$request->message,
                      'status'=>$request->success,
                      'duyet'=>1
                    ]);
              }

              else


              if($server ==3)
              {

                //Sv5 (Clone nuôi, max 8m sub, sub khuyến mại) 3 coin / 1 sub
                
                $url ="https://thuycute.hoangvanlinh.vn/api/service/facebook/sub-sale/order";
 
                $data = [
                  'idfb'=> $uid,
                  'server_order'=> 'sv5',
                  'amount'=> $amount,
                  'note'=> $note
                 ];

                 $request = $this->curl($url,$data,
                 [  
                   'api-token:'.$this->apikey_subgiare
                 ]);

                 return json_encode([
                   'msg'=>$request->message,
                   'status'=>$request->status,
                   'duyet'=>1
                 ]);

              }

              else


              if($server ==4)
              {
                    $url ="https://trum24h.pro/api/services/subspeed/create";

                    $data = [
                     'key' => $this->apikey_trum24h,
                     'object_id' => $uid,
                     'service_id' => '1', // server 1,2,3.. server nào được bật sẽ hiện ở trang mua sub (tương ứng SV1, SV2, SV3...)
                     'quantity' => $amount,
                     'notes' => $note,
                    ];

                    $request = $this->curl($url,$data,true);

                    return json_encode([
                      'msg'=>$request->msg,
                      'status'=>$request->success,
                      'duyet'=>1
                    ]);

              }

              /// end server
            }
            else
            if($type == "like" )
            {
              if($server ==5)
              {
                $url ="https://thuycute.hoangvanlinh.vn/api/service/facebook/like-post-speed/order";

                $data = [
                 'idpost' => $uid,
                 'server_order' => 'sv11', // server 1,2,3.. server nào được bật sẽ hiện ở trang mua sub (tương ứng SV1, SV2, SV3...)
                 'reaction' => 'like',
                 'speed'=> 'fast',
                 'amount'=>$amount,
                 'note' => $note,
                ];

                $request = $this->curl($url,$data,
                [  
                  'api-token:'.$this->apikey_subgiare
                ]
              );

                return json_encode([
                  'msg'=>$request->message,
                  'status'=>$request->status,
                  'duyet'=>1
                ]);
              }
              elseif($server ==6)
              {
                $url ="https://thuycute.hoangvanlinh.vn/api/service/facebook/like-post-speed/order";

                $data = [
                 'idpost' => $uid,
                 'server_order' => 'sv8', // server 1,2,3.. server nào được bật sẽ hiện ở trang mua sub (tương ứng SV1, SV2, SV3...)
                 'reaction' => 'like',
                 'speed'=> 'fast',
                 'amount'=>$amount,
                 'note' => $note,
                ];

                $request = $this->curl($url,$data,
                [  
                  'api-token:'.$this->apikey_subgiare
                ]
              );

                return json_encode([
                  'msg'=>$request->message,
                  'status'=>$request->status,
                  'duyet'=>1
                ]);
              }
              elseif($server ==7)
              {
                   // Like siêu rẻ [ Sale Chậm - Max 10k /1 id ]
                   $url ="https://dichvu.baostar.pro/api/facebook-like-gia-re/buy";

                   $data = [
                    'object_id' => $uid,
                    'package_name' => 'facebook_like_v14', // server 1,2,3.. server nào được bật sẽ hiện ở trang mua sub (tương ứng SV1, SV2, SV3...)
                    'quantity' => $amount,
                    'object_type'=>'like'
                   ];
            
                   $request = $this->curl($url,$data,[
                    "api-key"=> $this->apikey_baostar,
                    "Content-Type"=> "application/json" 
                   ]);
                   
                   return json_encode([
                     'msg'=>$request->message,
                     'status'=>$request->success,
                     'duyet'=>1
                   ]);
              }
              elseif($server ==8)
              {
                   // Like siêu rẻ [ Sale Chậm - Max 10k /1 id ]
                   $url ="https://dichvu.baostar.pro/api/facebook-like-gia-re/buy";

                   $data = [
                    'object_id' => $uid,
                    'package_name' => 'facebook_like_v8', // server 1,2,3.. server nào được bật sẽ hiện ở trang mua sub (tương ứng SV1, SV2, SV3...)
                    'quantity' => $amount,
                    'object_type'=>'like'
                   ];
            
                   $request = $this->curl($url,$data,[
                    "api-key"=> $this->apikey_baostar,
                    "Content-Type"=> "application/json" 
                   ]);
                   
                   return json_encode([
                     'msg'=>$request->message,
                     'status'=>$request->success,
                     'duyet'=>1
                   ]);
              }
              elseif($server ==9)
              {
                   // Like siêu rẻ [ Sale Chậm - Max 10k /1 id ]
                   $url ="https://dichvu.baostar.pro/api/facebook-like-gia-re/buy";

                   $data = [
                    'object_id' => $uid,
                    'package_name' => 'facebook_like_v10', // server 1,2,3.. server nào được bật sẽ hiện ở trang mua sub (tương ứng SV1, SV2, SV3...)
                    'quantity' => $amount,
                    'object_type'=>'like'
                   ];
            
                   $request = $this->curl($url,$data,[
                    "api-key"=> $this->apikey_baostar,
                    "Content-Type"=> "application/json" 
                   ]);
                   
                   return json_encode([
                     'msg'=>$request->message,
                     'status'=>$request->success,
                     'duyet'=>1
                   ]);
              }


              else
              
              if($server ==10)
              {
                   // Tăng Like Bài Viết V10 (Like Việt Lên từ từ (max 2K) ) 1.9 coin (Đang mở)
                   $url ="https://autofb.pro/api/facebook_buff/create";
                   $data ='{
                     "dataform":
                      {
                        "locnangcao":0,
                        "locnangcao_gt":0,
                        "locnangcao_dotuoi_start":0,
                        "locnangcao_dotuoi_end":13,
                        "locnangcao_banbe_start":0,
                        "locnangcao_banbe_end":100,
                        "profile_user":'.$uid.',
                        "loaiseeding":"like_v10",
                        "baohanh":0,
                        "sltang":'.$amount.',
                        "giatien":1.9,
                        "ghichu":"'.$note.'",
                        "startDatebh":"2022-05-27T12:15:33.277Z",
                        "EndDatebh":"2022-06-03T12:15:33.277Z",
                        "type":"",
                        "list_messages":[],
                        "tocdolike":0}
                        ,
                        "type_api":"buff_likecommentshare"
                      }';
            
                   $request = $this->curl($url,$data,[  
                    'ht-token:'.$this->apikey_autofb
                  ]);
                   if($request->status==400)
                   {
                      $status = false;
                   }
                   else
                   {
                      $status = true;
                   }

                   return json_encode([
                     'msg'=>$request->msg,
                     'status'=>$status,
                     'duyet'=>1
                   ]);
              }

              else

              
              if($server ==11)
              {
                   return json_encode([
                     'msg'=>'mua đơn này thành công',
                     'status'=>true,
                     'duyet'=>0,
                   ]);
              }

              else
              {
                return json_encode([
                  'msg'=>'mua đơn này thành công',
                  'status'=>true,
                  'duyet'=>0,
                ]);
              }
            }
            else
            {
              return json_encode([
                'msg'=>'mua đơn này thành công',
                'status'=>true,
                'duyet'=>0,
              ]);
            }

          /// end dịch vụ
         break;
       }
       /// end switch
    }
}




//  $data = new tools;
//  echo $data->dichvu('facebook','like',10,'4',10000,'ưdfsđfd');
