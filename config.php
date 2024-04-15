<?php
ini_set('display_errors', 0);
session_start();
  class TUNGMMO 
    {
      private $ketnoi;
     function connect()
      {
          if (!$this->ketnoi)
          {
              $this->ketnoi = mysqli_connect(
                  'localhost', 
                  'localhost', 
                  'localhost', 
                  'localhost'
                  ) or 
              die('Hệ thống đang bảo trì, xin lỗi cơ sở dữ liệuác bạn vì sự bất tiện này');
              mysqli_query($this->ketnoi, "set names 'utf8'");
          }
      }
    
    
     function dis_connect()
      {
          if ($this->ketnoi){
              mysqli_close($this->ketnoi);
          }
      }
        
     function insert($table, $data)
      {
          $this->connect();
          $field_list = '';
          $value_list = '';
          foreach ($data as $key => $value)
          {
              $field_list .= ",$key";
              $value_list .= ",'".mysqli_real_escape_string($this->ketnoi, $value)."'";
          }
          $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
    
          return mysqli_query($this->ketnoi, $sql);
      }
     function update_one($table, $data)
      {
          $this->connect();
          $sql = '';
          foreach ($data as $key => $value)
          {
              $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
          }
          $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',');
          return mysqli_query($this->ketnoi, $sql);
      }
     function update($table, $data, $where)
      {
          $this->connect();
          $sql = '';
          foreach ($data as $key => $value)
          {
              $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
          }
          $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
          return mysqli_query($this->ketnoi, $sql);
      }
    
    
     function update_value($table, $data, $where, $value1)
      {
          $this->connect();
          $sql = '';
          foreach ($data as $key => $value){
              $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
          }
          $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where.' LIMIT '.$value1;
          return mysqli_query($this->ketnoi, $sql);
      }
    
    
     function remove($table, $where)
      {
          $this->connect();
          $sql = "DELETE FROM $table WHERE $where";
          return mysqli_query($this->ketnoi, $sql);
      }
    
    
     function cong($table, $data, $sotien, $where)
      {
       $this->connect();
       $sql = "UPDATE  `$table` SET `$data` = `$data` + '$sotien' WHERE $where ";
       return mysqli_query($this->ketnoi, $sql);
      }
      function tru($table, $data, $sotien, $where)
      {
      $this->connect();
      $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` - '$sotien' WHERE $where ");
      return $row;
     }
     function get_list($sql)
      {
          $this->connect();
          $result = mysqli_query($this->ketnoi, $sql);
          if (!$result)
          {
              die ('Lỗi kết nối cơ sở dữ liệu');
          }
          $return = array();
          while ($row = mysqli_fetch_assoc($result))
          {
              $return[] = $row;
          }
          mysqli_free_result($result);
          return $return;
      }
     function tong($sql)
      {   
         $i=0;
          $this->connect();
          $result = mysqli_query($this->ketnoi, $sql);
          while($row = mysqli_fetch_assoc($result)){
            $i ++;
           }
          return $i;
      }
    
     function get_row($sql)
      {
          $this->connect();
          $result = mysqli_query($this->ketnoi, $sql);
          if (!$result)
          {
              die ('Lỗi kết nối cơ sở dữ liệu');
          }
          $row = mysqli_fetch_assoc($result);
          mysqli_free_result($result);
          if ($row)
          {
              return $row;
          }
          return false;
      }
     function num_rows($sql)
      {
          $this->connect();
          $result = mysqli_query($this->ketnoi, $sql);
          if (!$result)
          {
              die ('Lỗi kết nối cơ sở dữ liệu');
          }
          $row = mysqli_num_rows($result);
          mysqli_free_result($result);
          if ($row)
          {
              return $row;
          }
          return false;
      }
      function users($data)
      {
          $this->connect();
          $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `token` = '".$_SESSION['token']."' ")->fetch_array();
          return $row[$data];
      }
      function setting($value)
      {
          $this->connect();
          $row = $this->ketnoi->query("SELECT * FROM `setting`WHERE `id`='1' ")->fetch_array();
          return $row[$value];
      }
      function theloai($where)
      {
          $this->connect();
          $row = $this->ketnoi->query("SELECT * FROM `theloai` WHERE `loai` = '$where' ")->fetch_array();
          return $row['name'];
      }
      function dichvu($where)
      {
          $this->connect();
          $row = $this->ketnoi->query("SELECT * FROM `dichvu` WHERE `type` = '$where' ")->fetch_array();
          return $row['name'];
      }
      function server($where)
      {
          $this->connect();
          $row = $this->ketnoi->query("SELECT * FROM `server` WHERE `id` = '$where' ")->fetch_array();
          return $row['name'];
      }
     function auth()
      {
         $this->connect();
         if(isset($_SESSION['token']))
         {
            $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `token` = '".$_SESSION['token']."' ")->fetch_array();
    
            if(!isset($row["id"]))
            {
               unset($_SESSION["users"]);
            }else{
                header('location: /trang-chu');
            }
         }
      }
     function log($data)
      {
          
         $this->connect();
         if(isset($_SESSION['token']))
         {
            $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `token` = '".$_SESSION['token']."' ")->fetch_array();
    
            if(!isset($row["id"]))
            {
               unset($_SESSION["users"]);
               header('location: /dang-nhap');
            }
            elseif($row["status"]==false)
            {
               unset($_SESSION["users"]);
               header('location: /dang-nhap');
            }
         }
         else
         {
            header('location: /dang-nhap');
         }
      }
  
    function manage()
    {
        if($this->users('level') < 3)
        {
              unset($_SESSION["users"]);
              header('location: /dang-nhap');
        }
    }
}
   
 ?>
    