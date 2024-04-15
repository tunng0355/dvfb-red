<?php 
     $title = 'Dịch vụ';
     require( '../head.php'); 

     if(isset($_GET['type']) || ($_GET['loai']))
     {
     $type=$_GET['type'];
     $loai =$_GET['loai'];
     $service= $DB->get_row("SELECT * FROM `dichvu` WHERE `type` = '$type' AND `loai` = '$loai' ");
     $server= $DB->get_list("SELECT * FROM `server` WHERE `type` = '$type' AND `loai` = '$loai' "); 
     $category= $DB->get_row("SELECT * FROM `theloai` WHERE `loai` = '".$service['loai']."' "); 
     $history= $DB->get_list("SELECT * FROM `history` WHERE  `type` = '$type' AND `loai` = '$loai' AND `username` = '".$DB->users('username')."'"); 
     $history2= $DB->get_list("SELECT * FROM `history` WHERE  `type` = '$type' AND `loai` = '$loai'  ORDER BY money DESC LIMIT 0, 5"); 

     if(!$service)
     {
          header('location: /');
     } 

     require( '../menu.php'); 
?>

<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
			<!-- Body -->
			<div class="card-body mt-2">

            <div class="row">
					<div class="col-lg-6">
					<div class="media-mb ">
							<h5 class="card-title fs-30 h4 title-pages img-dv">
                            <?=$service['img'];?>
                            <?=$service['name'];?> </h5>
                     </div>
					</div>
					<div class="col-lg-6">
						<div class="item-end">
                        <button class="btn btn-light-t2 font-weight-bolder font-size-sm ml-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fa-solid fa-trophy-star"></i> Bảng xếp hạng </button>
						</div>
					</div>
				</div>




                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="topbxh">
                                    <img src="/assets/img/icon/4152029.png" width="45">
                                    BẢNG XẾP HẠNG:
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="form-group">
                                <table class="table table-cen " id="table-top">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="th-red">TOP</th>
                                            <th scope="col" class="th-red">username</th>
                                            <th scope="col" class="th-red">số  tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($history2 as $lichsu2)
                                    {
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$lichsu2['username'];?></td>
                                            <td><?=format($lichsu2['quantity']);?></td>
                                            <td><?=$DB->server($lichsu2['server']);?></td>
                                            <td><span class="badge bg-cam"><?=format($lichsu['money']);?> COIN</span></td>
                                            <td><?=status2($lichsu2['status']);?></td>
                                            <td><?=timeago($lichsu2['date']);?></td>
                                        </tr>
                                    <?php 
                                   }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="alert text-pre-wrap alert-danger-light">
                    <p>- Vui lòng nhập đúng uid ! </p>
                    <p> -Hãy bật chế độ công khai để hệ thống thực hiện tăng ! </p>
                    <p>- Vui lòng chọn đúng server cần buff tránh mất tiền oan!</p>
                </div>
                <ul role="tablist" style="margin-top: 28px;
                        margin-bottom: 28px;" class="nav nav-pills nav-justified flex-column flex-sm-row">
                    <li class="nav-item tab-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#card" role="tab" aria-selected="true"> <i class="fa fa-plus-circle"></i> Mua dịch vụ </a>
                    </li>
                    <li class="nav-item tab-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#bank" role="tab" aria-selected="true"> <i class="fa fa-list"></i> Lịch sử mua </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="card" role="tabpanel" aria-labelledby="card">
                        <div class="alert alert-warning br-10 text-pre-wrap ">Giá dịch vụ của bạn thuộc loại <?=level($DB->users('level'));?> <a href="/bang-gia" class="au">Xem bảng giá dịch vụ và nâng cấp!</a> </div>
                        <!-- Body -->
                        <div class="card-body">
                            <!-- Form -->
                            <form method="POST" action="/v1/api" oninput="tungmmo()" id="muadichvu">
                                <div class="form-group2">
                                    <label class="mb-2">ID  :</label>
                                    <input type="text" placeholder="Nhập ID " name="uid" class="form-control"> </div>
                                <div class="form-group2">
                                    <label class="mb-2">Ghi chú :</label>
                                    <textarea rows="2" name="content" placeholder="Nhập ghi chú hoặc bỏ trống" class="form-control"></textarea>
                                </div>
                                <div class="form-group2">
                                    <label class="mb-2">Chọn Server <i class="fa fa-sort"></i> :</label>
 		
                                <?php
                                $i =1;
						        foreach($server as $sv)
						          { 
                                    $id = $i++;
					            	?>
                                    <div class="form-check mb-2">
                                        <input type="radio" value="<?=$sv['id'];?>" name="server" class="form-check-input mr-11" >
                                        <label class="form-check-label m-0"><span class="badge bg-danger badge-br">SV<?=$id;?></span> 
                                        <span class="badge bg-info badge-br">
                                            <?php 
                                            if($DB->users('level') == 0)
                                                $rate = $sv['rate'];                                            
                                            elseif($DB->users('level') == 1)                
                                                $rate = $sv['rate2'];                                            
                                            else                                             
                                                $rate = $sv['rate3'];                                             
                                            echo $rate;
                                            ?>
                                            COIN
                                        </span>
                                         <?=$sv['name'];?> </label>
                                    </div>
                                <?php 
                                   }
                                ?>
                                </div>
                                <!---->
                                <!---->
                                <!---->
                                <!---->
                                <div class="form-group2">
                                    <label>Số lượng chạy trong 1 ngày:</label>
                                    <select class="form-control">
                                        <option value="null">Đang bảo trì</option>
                                    </select>
                                </div>
                                <div class="form-group2">
                                    <label class="mb-2">Số lượng cần tăng ( 100 ~ 1,000 ) :</label>
                                    <input  placeholder="Nhập số lượng cần tăng" value="100" id="quantity" name="quantity"  type="number" class="form-control"> 
                                </div>
                                <div class="form-group2">
                                    <label>Thời hạn :</label>
                                    <select class="form-control" id="bao_hanh" name="bao_hanh">
                                        <option value="1">không bảo hành</option>
                                        <option value="30">30 ngày</option>
                                        <option value="60">60 ngày</option>
                                        <option value="90">90 ngày</option>
                                    </select>
                                </div>
                                <div class="form-group2">
                                <div class="alert alert-danger"> <?=$service['content'];?> </div>
                                </div>
                                <div class="form-group2">
                                    <div class="box-price">
                                        <div class="text">Tổng thanh toán:</div>
                                        <div class="total-money"><span><font id="total">0</font> COIN</span></div>
                                        <div>Bạn sẽ tăng <span class="note-service" id="slmua">50,000</span> với giá là
                                         <span class="note-service" id="total2">0</span> COIN </div>
                                    </div>
                                </div>

                                <input type="hidden" name="code" value="<?=$type;?>" />
                                <input type="hidden" name="loai" value="<?=$loai;?>" />
                     		    <input type="hidden" name="type" value="mua-dich-vu" />
                                <button id="send" type="submit" class="btn btn-primary button-ck w-100 ">Thanh toán dịch vụ</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank">
                        <div class="card-box" style="padding-top: 0px;">
                            <div class="form-group">
                                <table class="table table-cen" id="table-mua">
                                    <thead>
                                        <tr>
                                            <th scope="col"><a href="#">#</a> </th>
                                            <th scope="col">uid</th>
                                            <th scope="col">số lượng</th>
                                            <th scope="col">giá thành</th>
                                            <th scope="col">trạng thái</th>
                                            <th scope="col">thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($history as $lichsu)
                                    {
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$lichsu['uid'];?></td>
                                            <td><?=format($lichsu['quantity']);?></td>
                                            <td><span class="badge bg-cam"><?=format($lichsu['money']);?> COIN</span></td>
                                            <td><?=status2($lichsu['status']);?></td>
                                            <td><?=timeago($lichsu['date']);?></td>
                                        </tr>
                                    <?php 
                                   }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Body -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
<script type="text/javascript">
  $(document)
    .ready(function () {
       $('#table-mua')
          .DataTable({
              paging: true,
              filter: true
          });
  });
  $(document)
    .ready(function () {
       $('#table-top')
          .DataTable({
              paging: true,
              filter: true
          });
  });
function tungmmo(){
let sl = document.getElementById('quantity').value;
let bao_hanh =$('#bao_hanh').val();
let sv = document.querySelector('input[name="server"]:checked').value;
let idus = document.querySelector('input[name="uid"]').value;


<?php foreach($server as $sv){ ?>
    if(sv == '<?=$sv['id'];?>'){
      var gia = '<?php 
                if($DB->users('level') == 0)
                    $rate = $sv['rate'];                                            
                elseif($DB->users('level') == 1)                
                    $rate = $sv['rate2'];                                            
                else                                             
                    $rate = $sv['rate3'];                                             
                echo $rate;
                ?>';
    } 
<?php }?>

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})


if(sl == ''){ 
   Toast.fire({
    icon: 'error',
    title: 'Số lượng không được bỏ trống'
  });
} 


var tien = (sl*gia) * bao_hanh;
var tung = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
var dz = sl.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

document.getElementById("total").innerHTML = tung;
document.getElementById("slmua").innerHTML = dz;
document.getElementById("total2").innerHTML = tung;

}



// Request api 
$("#add_the_cao").submit(function(e) {
$("#send").html("Đang tải...");
e.preventDefault(); 
  const  form = $(this);
  const url = form.attr('action');
  const method = form.attr('method');
  const data = form.serialize();
	var api_token = $('meta[name="api-token"]').attr("content");
        $.ajax({
            type: method,
            url: url,
            data: data, 
            headers:{
                'api-token':api_token
            },
            dataType: "json",
            success: function(data)
            {
				$("#send").html("Gửi thẻ");

                if(data.status=='error')
                {
                   var title = "Thất Bại!";
                   var button = "Thử lại";
                }
                else
                {
                    var title = "Thành Công!";
                    var button = "Đồng ý";
                }
    
                Swal.fire({
                    title: title,
                    text: data.msg,
                    icon: data.status,
                    confirmButtonText: button
                  });
            }
    });



  });    


// Request api 
$("#muadichvu").submit(function(e) {
$("#send").html("Đang tải...");
e.preventDefault(); 
  const  form = $(this);
  const url = form.attr('action');
  const method = form.attr('method');
  const data = form.serialize();
  var api_token = $('meta[name="api-token"]').attr("content");
        $.ajax({
            type: method,
            url: url,
            data: data, 
            headers:{
                'api-token':api_token
            },
            dataType: "json",
            success: function(data)
            {
				$("#send").html("Thanh toán dịch vụ");

                if(data.status=='error')
                {
                   var title = "Thất Bại!";
                   var button = "Thử lại";
                }
                else
                {
                    var title = "Thành Công!";
                    var button = "Đồng ý";
                }
    
                Swal.fire({
                    title: title,
                    text: data.msg,
                    icon: data.status,
                    confirmButtonText: button
                  });
            }
    });



  });    
</script>              

</script>
<?php 
}
require( '../end.php');
?>