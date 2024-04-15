<?php 
     $title = 'Trang Chủ';
     require( '../head.php');
     require( '../menu.php'); 
     $list = $DB->get_list("SELECT * FROM `post` ORDER BY id DESC LIMIT 0, 7 "); 



     $tongnap = $DB->get_list("SELECT * FROM `naptien`  WHERE `username` = '".$DB->users('username')."' AND `status` = '1'");
     $payment = $DB->get_list("SELECT * FROM `payment`  WHERE `username` = '".$DB->users('username')."' ");

     foreach ($payment as $keyx ) {
     $sumx += $keyx['money'];
     }
     
     foreach ($tongnap as $key ) {
     $sum += $key['thucnhan'];
     }

     $money = $sum + $sumx;
     
?> 
<!-- Nội dung -->
<div class="content">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="card mb-4">
                    <div class="card-body card-dash d-flex flex-column text-center gap-2">
                        <div class="display-7">
                        <img src="/assets/img/icon/5180782.png" width="70">
                        </div>
                        <div class="lead">Số dư <b class="text-tungmmo"><?=format($DB->users('money'));?></b> coin</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card mb-4">
                    <div class="card-body card-dash d-flex flex-column text-center gap-2">
                        <div class="display-7">
                            <img src="/assets/img/icon/5180696.png" width="70">
                        </div>
                        <div class="lead">Đã nạp <b class="text-tungmmo"><?=format($money);?></b> coin</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card mb-4">
                    <div class="card-body card-dash d-flex flex-column text-center gap-2">
                        <div class="display-7">
                            <img src="/assets/img/icon/5180855.png" width="70">
                        </div>
                        <div class="lead">Nạp tháng <b class="text-tungmmo"><?=format($money);?></b> coin</div>
                    </div>
                </div>
            </div>
        </div>
 <div class="row">


	<div class="col-md-8 col-12 thanh-cuon">

		<div class="card mb-3">
			<form class="card-body" method="POST" action="/v1/api" id="create-post">
				<div class="d-flex mb-3">
					<div class="d-flex">
						<div class="d-inline-block align-self-center">
							<div class="create-post">
                            <img src="/assets/img/icon/5638821.png" width="40">
                                Tạo bài viết mới:
                            </div>
                      </div>
					</div>
				</div>
                <input type="hidden" name="type" value="create-post" />
				<textarea class="post-text" name="content" rows="2" placeholder="Hãy nêu cảm xúc cho bài viết của bạn .." ></textarea>
				<div class="row g-0 justify-content-between mt-3 px-card pb-3">
                      <div class="col"></div>
                      <div class="col-auto">
                        <button class="btn btn-primary " type="submit">
                          Đăng bài viết
                        </button>
                      </div>
                 </div>
            </form>
		</div>




    <?php 
       foreach($list as $post)
       {
    ?>
        <div class="card mb-3" id="ps_<?=$post['id']?>" uid="<?=$post['id']?>">
			<div class="card-body">
				<div class="d-flex mb-3">
					<div class="d-flex w-100">
						<figure class="avatar me-3 mb-0"> <img src="/assets/img/avatar/b1bbec499a0d66e5403480e8cda1bcbe.png" width="45" class="rounded-circle" alt="..."> </figure>
						<div class="d-inline-block align-self-center">
							<div><?=$post['username']?></div> <small class="text-muted"><?=timeago($post['date']);?></small> 
                        </div>
					</div>   
                <?php
                if($post['username'] == $DB->users('username'))
                {
                ?>
                <?php
                if($post['username'] == $DB->users('username'))
                {
                ?>
                  <div class="col-auto d-flex">
                     <i class="fa-regular fa-circle-trash delete-post " id="delete_<?=$post['id']?>" ></i>
                  </div>
                <?php
                }
                ?>
                <?php
                }
                ?>
				</div>
				<p><?=$post['content']?></p>
				<div class="d-flex gap-1 mt-4">
                    <?php 
                    $username = $DB->users('username');
                    $uid = $post['id'];
                    $checkx = $DB->get_row(" SELECT * FROM like_post WHERE `username` = '$username'  AND `post` = '$uid'  ");
                    $tong = $DB->tong(" SELECT * FROM like_post WHERE `post` = '$uid'  ");
                    if($checkx > 0)
                    {
                     $active = "active";
                    }
                    else
                    {
                     $active = "";
                    }
                    ?>
					<button class="btn btn-white likeme likeme_<?=$post['id']?> <?=$active;?>" type="submit"  > 
                    <i class="fa-solid fa-heart"></i><font id="sl"><?=$tong;?></font>
                    </a>
					<button class="btn btn-white" >
                    <i class="fa-regular fa-comment-dots"></i>
                    </button>
					<a class="btn btn-white"><i class="fa-regular fa-share-from-square"></i></a>
				</div>

                <div class="pt-0">
                  
                  
                  <div class="d-flex align-items-center border-top border-200 pt-3">
                     <input id="cmt_<?=$post['id']?>" class="form-controls ms-2 fs--1 mt-0 w-38px ml-0 " type="text" placeholder="Write a comment...">
                     <span  id="send_<?=$post['id']?>"class="fa-solid fa-paper-plane-top send-cmt"></span>
                 </div>
                 <p class="error-noti" id="noti_<?=$post['id']?>"></p>
         <?php     
          $listx = $DB->get_list("SELECT * FROM `cmt` WHERE `post` = '$uid' ORDER BY id DESC LIMIT 0, 1 "); 
          foreach($listx as $cmt)
          {
            $tongx = $DB->tong(" SELECT * FROM cmt WHERE `post` = '$uid'  ");

         ?>
             <div id="listcmt_<?=$post['id']?>">
                  <div class="d-flex mt-3">
                    <div class="avatar avatar-xl">
                      <img class="rounded-circlex" width="38" src="/assets/img/avatar/b1bbec499a0d66e5403480e8cda1bcbe.png" alt="">
                    </div>
                    <div class="flex-1 ms-2 fs--1 box-cmt">
                    <div class="d-inline-block align-self-center mb-1 pl-8">
				     	<div class=""><?=$cmt['username'];?></div> 
                      </div>
                      <p class="mb-1 bg-200 rounded-3 p-2 pt-0">
                            <?=$cmt['content'];?>
                      </p>
                    </div>
                  </div>
            <?php }?>
           <?php if($tongx > 0)
           {
            ?>
                  <a class="fs--1 text-700 d-inline-block mt-2" href="#!" id="taithem_<?=$post['id']?>">tải thêm bình luận</a>   
            <?php 
           }
           ?>      
             </div>

                </div>

			</div>
        <script>
        $(".likeme_<?=$post['id']?>").click(function(){
        var api_token = $('meta[name="api-token"]').attr("content");
        let like = document.querySelector('.likeme_<?=$post['id']?>');
   
        $.ajax({
            type: "POST",
            url: "/v1/api",
            data: { 
                uid: $('#ps_<?=$post['id']?>').attr('uid'),
                type: "like-post"
            }, 
            headers:{
                'api-token':api_token
            },
            dataType: "json",
            success: function(data)
            {
			
                if(data.status=='success')
                {
                    let sl = $('.likeme_<?=$post['id']?> #sl');
                    like.classList.toggle("active");
                    sl.html(data.sl);
                }
                

            }
        });        
        });   
      

        $("#taithem_<?=$post['id']?>").click(function(){
        var api_token = $('meta[name="api-token"]').attr("content");

        $.ajax({
            type: "POST",
            url: "/v1/api",
            data: { 
                uid: $('#ps_<?=$post['id']?>').attr('uid'),
                type: "load-post"
            }, 
            headers:{
                'api-token':api_token
            },
            success: function(data)
            {
               $('#listcmt_<?=$post['id']?>').html(data);
            }
        });        
        });

        $("#send_<?=$post['id']?>").click(function(){
        var api_token = $('meta[name="api-token"]').attr("content");

        $.ajax({
            type: "POST",
            url: "/v1/api",
            data: { 
                uid: $('#ps_<?=$post['id']?>').attr('uid'),
                content : $('#cmt_<?=$post['id']?>').val(),
                type: "cmt-post"
            },
            headers:{
                'api-token':api_token
            },
            dataType: "json",
            success: function(data)
            {
			    var content = $('#cmt_<?=$post['id']?>').val();
                var username = "<?=$DB->users('username');?>";
                var res = '<div class="d-flex mt-3"><div class="avatar avatar-xl"><img class="rounded-circlex" width="38" src="/assets/img/avatar/b1bbec499a0d66e5403480e8cda1bcbe.png" alt=""></div><div class="flex-1 ms-2 fs--1 box-cmt"><div class="d-inline-block align-self-center mb-1 pl-8"><div class="">'+username+'</div> </div><p class="mb-1 bg-200 rounded-3 p-2 pt-0">'+content+'</p></div>';
                if(data.status=='success')
                {
                var x = $("#taithem_<?=$post['id']?>").click();
                   if(x)
                   {       
                    $('#noti_<?=$post['id']?>').html("");        
                    $('#listcmt_<?=$post['id']?>').append(res);
                    var content = $('#cmt_<?=$post['id']?>').val("");

                   }
                }
                else
                {
                    $('#noti_<?=$post['id']?>').html(data.msg);
                }
            }
        });        
        });
        

        $("#delete_<?=$post['id']?>").click(function(){
        var api_token = $('meta[name="api-token"]').attr("content");

        $.ajax({
            type: "POST",
            url: "/v1/api",
            data: { 
                uid: $('#ps_<?=$post['id']?>').attr('uid'),
                type: "delete-post"
            }, 
            headers:{
                'api-token':api_token
            },
            dataType: "json",
            success: function(data)
            {
			
                if(data.status=='success')
                {
                    $("#ps_<?=$post['id']?>").hide();
                }
            }
        });        
        });
        </script>
    <?php
       }
    ?>


	</div>
    
	</div>
	<div class="col-md-4 col-12">
		<div class="card">
			<div class="card-body">
				<center><img src="/assets/img/icon/5638652.png" alt="" width="80" height="80"> </center>
				<div class="text-center mb-3">
					<h5>
                    Đăng ký kênh
                    </h5>
					<p class="text-soft">Hãy đăng ký kênh mình , có thể trong tháng tới mình share nhiều source siêu vip cho  mọi người </p>
				</div>
				<div class="d-grid gap-2 col-6 mx-auto"> <a href="https://www.youtube.com/channel/UCmH3jtZydp7ERhiuLcG_5dA" class="btn btn-warning">Đăng ký</a> </div>
			</div>
		</div>
	</div>
    <!-- End Nội dung -->
</div>
<script>
  // Request api 
  $("#create-post").submit(function(e) {
  e.preventDefault(); 

  const form = $(this);
  const url = form.attr('action');
  const method = form.attr('method');

  curl(url,method,form.serialize());
	
  });    

</script> 
<?php require( '../end.php');?>
