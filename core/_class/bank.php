<?php
class Bank
{
    public function Curl($url,$data,$header)
    {
        $curl = curl_init();
        curl_setopt_array($curl,[
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$data,
        CURLOPT_HTTPHEADER => $header,
      ]);

       $response = curl_exec($curl);
       curl_close($curl);
       return $response;
    }
    public function MBANK()
    {
        return $this->Curl('https://servicevn.com/api/service/api/mbbank/history',
        '{
            "accountName": "số điện thoại",
            "day": "30",
            "accountNo": "số tài khoản"
        }',[
            'X-Requested-With: XMLHttpRequest',
            'Authorization: Bearer 7wxMg0ymu678vFhIwsPxCiX6V60V61RyNLekLQrAE94g16qbCeu81XtiGM',
            'Content-Type: application/json'
        ]
       );
    }
}



//  $data = new Bank;
//  echo $data->MBANK();
?>