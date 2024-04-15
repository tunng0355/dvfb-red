<?php 
     $title = 'Yêu cầu mua hàng';
     require( '../head.php'); 
	 require( '../admin.php'); 
     require( '../menu.php');
     // Tiện ích cấu trúc
	 $list = $DB->get_list("SELECT * FROM `history` ORDER BY id DESC ");    
?><!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
	<div class="card-body">
		<div class="row">
		  <h5 class="card-title fs-30 h4 title-pages">
			<img src="/assets/img/icon/4151700.png" width="45"> Yêu cầu mua hàng
		  </h5> 
		</div>
		
		<div class="form-group mt-3">
		<table class="table table-cen">
						<thead>
							<tr>
                                <th scope="col"><a href="#">#id</a></th>
								<th scope="col">username</th>
								<th scope="col">uid</th>
								<th scope="col">ghi chú</th>
                                <th scope="col">số lượng</th>
								<th scope="col">thành tiền</th>
                                <th scope="col">thể loại</th>
                                <th scope="col">dịch vụ</th>
								<th scope="col">Bảo Hành</th>
								<th scope="col">trạng thái</th>
                                <th scope="col">thời gian</th>
                                <th scope="col">tiện ích</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        $i = 1;
                        foreach ($list as $order) { ?>
						
							<tr>
                                <td><?=$i++;?></td>
								<td><?=$order['username'];?></td>
								<td><?=$order['uid'];?></td>
								<td><?=$order['content'];?></td>
                                <td><?=format($order['quantity']);?></td>
                                <td><span class="badge bg-cam"><?=format($order['money']);?> COIN</span></td>
                                <td><?=$DB->theloai($order['loai']);?></td>
                                <td><?=$DB->dichvu($order['type']);?></td>
								<td><?=$order['baohanh'];?> Day</td>
                                <td><?=status3($order['status']);?></td>
								<td><?=$order['date'];?></td>
								<td><button type="button" class="btn btn-edit text-white"data-bs-toggle="modal" data-bs-target="#check_<?=$order['id'];?>">xem chi tiết</button></td>
							</tr>

							
							<div class="modal fade" id="check_<?=$order['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
							<form method="POST"  action="/v1/adn" class="form-x3">
						    <div class="modal-content">
						    <div class="modal-header">

							<h5 class="modal-title" id="staticBackdropLabel">Chi tiết đơn hàng</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">	   
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">

							 <div class="form-group">
						       <label>trạng thái: </label>
							   <select name="status_<?=$order['id'];?>" class="form-control">
									<option value="<?=$order['status'];?>">Chọn trạng thái</option>
                                    <option value="0">đang chờ</option>
									<option value="1">thành công</option>
									<option value="2">thất bại</option>
								</select>
							 </div>
							
					
						    </div>
						   </div>	
						 </div>

							<div class="modal-footer">
							   <button type="button"  id="detele_order_<?=$order['id'];?>" class="btn btn-cam font-weight-bold br-9 w-100 mb-3">Xóa order này</button>
							   <button type="submit" class="btn btn-primary font-weight-bold br-9 w-100">Thay đổi thông tin</button>
							</div>
						 </div>
						 </div>
						 </div>
						 </div>
						 </form>
						 </div>
						 </div>

						  <script>
						  $("#check_<?=$order['id'];?> div form").submit(function(e) {
                            e.preventDefault(); 
							   const  form = $(this);
                               const url = form.attr('action');
                               const method = form.attr('method');

                               curl(url,method,{
								   'type':'edit-order',
								   'uid':'<?=$order['id'];?>',
								   'status':$('select[name="status_<?=$order['id'];?>"]').val(),
								});

                            });  
		
						  $("#detele_order_<?=$order['id'] ?>").click(function(){
							    curl('/v1/adn','POST',{
								   'type':'xoa-order',
								   'uid':'<?=$order['id'];?>'
								});
						  });
						                        
						</script>
						<?php }
                        ?>

			  </table>
		</div>
	</div>
</div>

    <!-- End Nội dung -->
</div>
<script type="text/javascript">
  $(document)
    .ready(function () {
       $('.table')
          .DataTable({
              paging: true,
              filter: true
          });
  });

</script>
<?php require( '../end.php');?>