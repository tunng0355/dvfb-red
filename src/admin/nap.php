<?php 
     $title = 'Yêu cầu nạp thẻ';
     require( '../head.php'); 
	 require( '../admin.php'); 
     require( '../menu.php');
     // Tiện ích cấu trúc
	 $list = $DB->get_list("SELECT * FROM `naptien` ORDER BY id DESC ");    
?><!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
	<div class="card-body">
		<div class="row">
		  <h5 class="card-title fs-30 h4 title-pages">
			<img src="/assets/img/icon/4151856.png" width="45"> Yêu cầu nạp thẻ
		  </h5> 
		</div>
		
		<div class="form-group mt-3">
		<table class="table table-cen">
						<thead>
							<tr>
                                <th scope="col"><a href="#">#id</a></th>
                                <th scope="col">mã giao dịch</th>
								<th scope="col">username</th>
                                <th scope="col">loại thẻ</th>
								<th scope="col">mã thẻ</th>
								<th scope="col">serial thẻ</th>
								<th scope="col">thành tiền</th> 
                                <th scope="col">thực nhận</th>                               
								<th scope="col">trạng thái</th>
                                <th scope="col">thời gian</th>
                                <th scope="col">tiện ích</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        $i = 1;
                        foreach ($list as $card) { ?>
						
							<tr>
                                <td><?=$i++;?></td>
								<td><?=$card['request_id'];?></td>
								<td><?=$card['username'];?></td>
                                <td><?=$card['telco'];?></td>
                                <td><?=$card['pin'];?></td>
                                <td><?=$card['serial'];?></td>
                                <td><span class="badge bg-cam"><?=format($card['amount']);?> VNĐ</span></td>
                                <td><span class="badge bg-cam"><?=format($card['thucnhan']);?> COIN</span></td>
                                <td><?=status3($card['status']);?></td>
								<td><?=$card['date'];?></td>
								<td><button type="button" class="btn btn-edit text-white"data-bs-toggle="modal" data-bs-target="#check_<?=$card['id'];?>">xem chi tiết</button></td>
							</tr>

							
							<div class="modal fade" id="check_<?=$card['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
							<form method="POST"  action="/v1/adn" class="form-x3">
						    <div class="modal-content">
						    <div class="modal-header">

							<h5 class="modal-title" id="staticBackdropLabel">Chi tiết thẻ cào</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">	   
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">

							 <div class="form-group">
						       <label>trạng thái: </label>
							   <select name="status_<?=$card['id'];?>" class="form-control">
									<option value="<?=$card['status'];?>">Chọn trạng thái</option>
                                    <option value="0">chờ duyệt</option>
									<option value="1">thành công</option>
									<option value="2">thất bại</option>
								</select>
							 </div>
                             <div class="form-group">
						       <label>Thực nhận: </label>
						        <input type="number"  name="money_<?=$card['id'];?>" placeholder="Điền thực nhận"  value="<?=$card['thucnhan'];?>" class="form-control">
				         	</div>

					
						    </div>
						   </div>	
						 </div>

							<div class="modal-footer">
							   <button type="button"  id="detele_card_<?=$card['id'];?>" class="btn btn-cam font-weight-bold br-9 w-100 mb-3">Xóa card này</button>
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
						  $("#check_<?=$card['id'];?> div form").submit(function(e) {
                            e.preventDefault(); 
							   const  form = $(this);
                               const url = form.attr('action');
                               const method = form.attr('method');

                               curl(url,method,{
								   'type':'edit-card',
								   'uid':'<?=$card['id'];?>',
                                   'thucnhan':$('input[name="money_<?=$card['id'];?>"]').val(),
								   'status':$('select[name="status_<?=$card['id'];?>"]').val()
								});

                            });  
		
						  $("#detele_card_<?=$card['id'] ?>").click(function(){
							    curl('/v1/adn','POST',{
								   'type':'xoa-card',
								   'uid':'<?=$card['id'];?>'
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