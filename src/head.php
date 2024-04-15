<!DOCTYPE html>
<html>
<?php 
   require $_SERVER['DOCUMENT_ROOT'].'/function.php';
   $categorys = $DB->get_list("SELECT * FROM `dichvu` "); 
   if($DB->setting('status')==false):
      die("bao tri");
   endif;
?>
<head>
   <meta charset='utf-8'>
   <meta name="keywords" content="<?=$DB->setting('keyword');?>">
   <meta name='api-token' content="<?=token();?>">
   <meta http-equiv='X-UA-Compatible' content='IE=edge'>
   <meta name='viewport' content='width=device-width, initial-scale=1'>
   <meta property="og:description" content="<?=$DB->setting('description');?>">
  
   <!-- STYLES -->
   <link  media="all" type="text/css" rel="stylesheet" href="/assets/css/style.min.css?v=<?=load();?>">

   <script type="text/javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@11?v=<?=load();?>" ></script>

   <script type="text/javascript" src="/assets/js/jquery.min.js?v=<?=load();?>" ></script>
   <script type="text/javascript" src="/assets/js/table.min.js?v=<?=load();?>" ></script>
   <script type="text/javascript" src="/assets/js/function.js?v=<?=load();?>" ></script>

   <link rel="prefetch" href="/v1/api" as="document" />
   <?=prefetch();?>

   <link rel="prefetch" href="/trang-chu" as="document" />
   <link rel="prefetch" href="/lich-su" as="document" />
   <link rel="prefetch" href="/nap-tien" as="document" />
   <link rel="prefetch" href="/chuyen-khoan" as="document" />
   <link rel="prefetch" href="/bang-gia" as="document" />
   <link rel="prefetch" href="/doi-thuong" as="document" />
   <link rel="prefetch" href="/tai-khoan" as="document" />
   <link rel="prefetch" href="/nhiem-vu" as="document" />
   <link rel="prefetch" href="/tao-web" as="document" />

   <?php foreach($categorys as $cate){ ?>

   <link rel="prefetch" href="/service/<?=$cate['loai'];?>/<?=$cate['type'];?>" as="document" />

   <?php } ?>

   <?=$DB->setting('head');?>

   <title><?=$title;?> | <?=$DB->setting('title');?></title>
</head>
<?=body();?>


