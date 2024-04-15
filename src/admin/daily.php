<?php 
     $title = 'Quản lý đại lý';
     require( '../head.php'); 
	 require( '../admin.php'); 
     require( '../menu.php');
     // Tiện ích cấu trúc
	 $list = $DB->get_list("SELECT * FROM `users` WHERE level = 2 ORDER BY money DESC ");    
?>
<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
	<div class="card-body">
		<div class="card-box">
		  <h5 class="card-title fs-30 h4 title-pages">
			<img src="/assets/img/icon/6936650.png" width="45" > Quản lý đại lý
		  </h5> 
		</div>
		<div class="form-group mt-3">
		<table class="table table-cen">
						<thead>
							<tr>
                                <th scope="col"><a href="#">#id</a></th>
								<th scope="col">username</th>
								<th scope="col">password</th>
								<th scope="col">mã giới thiệu</th>
								<th scope="col">money</th>
								<th scope="col">cấp bậc</th>
                                <th scope="col">trạng thái</th>
								<th scope="col">Thời gian tạo</th>
								<th scope="col">Địa chỉ tạo</th>
                                <th scope="col">tiện ích</th>
							</tr>
						</thead>
						<tbody>
                        <?php
						 $i= 1; 
						 foreach($list as $users)
						 { 
						?>
							<tr>
                                <td><?=$i++;?></td>
								<td><?=compare($DB->users('username'),$users['username']);?></td>
								<td><?=$users['password'];?></td>
								<td><?=$users['referral'];?></td>
								<td><span class="badge bg-cam"><?=format($users['money']);?> VNĐ</span></td>
								<td><span class="badge bg-prim"><?=level($users['level']);?></span></td>
                                <td><?=status($users['status']);?></td>
								<td><?=$users['date'];?></td>
								<td><?=$users['ip'];?></td>
								<td><button type="button" class="btn btn-edit text-white"data-bs-toggle="modal" data-bs-target="#check_<?=$users['id'];?>">xem chi tiết</button></td>
							</tr>

							
							<div class="modal fade" id="check_<?=$users['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
							<form method="POST"  action="/v1/adn" class="form-x3">
						    <div class="modal-content">
						    <div class="modal-header">

							<h5 class="modal-title" id="staticBackdropLabel">Chi tiết thành viên</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">	   
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">

						     <div class="form-group">
						       <label>username: </label>
						       <input type="text" name="username_<?=$users['id'];?>" value="<?=$users['username'];?>" class="form-control" placeholder="Nhập tài khoản" readonly="readonly">
					         </div>

							 <div class="form-group">
						       <label>password: </label>
						       <input type="password" name="password_<?=$users['id'];?>" value="" class="form-control" placeholder="Nhập mật khẩu">
					         </div>

						
							 <div class="form-group">
						       <label>mã giới thiệu: </label>
							 <div class="input-group">
						        <input type="text" id="mgt_<?=$users['id'];?>" placeholder="Mã giới thiệu của bạn" readonly="readonly" value="<?=$users['referral'];?>" required="required" class="form-control bg-white m-0 br">
					         	<button type="button" onclick="copy('mgt_<?=$users['id'];?>')" class="btn btn btn-primary btn-hight ">Copy</button>
				         	</div>
                            </div> 

							<div class="form-group">
						       <label>token: </label>
							   <div class="input-group">
						       <input type="text" id="token_<?=$users['id'];?>" value="<?=$users['token'];?>" class="form-control br bg-white " readonly="readonly">
							   <button type="button" onclick="copy('token_<?=$users['id'];?>')" class="btn btn btn-primary btn-hight ">Copy</button>
							   </div>
					         </div>


							 <div class="form-group">
						       <label>money: </label>
						       <input type="number" name="money_<?=$users['id'];?>" value="<?=$users['money'];?>" class="form-control" placeholder="Nhập số tiền">
					         </div>

							 <div class="form-group">
						       <label>cấp bậc: </label>
							   <select name="level_<?=$users['id'];?>" class="form-control">
									<option value="<?=$users['level'];?>">Chọn cấp bậc</option>
                                    <option value="0">thành viên</option>
									<option value="1">cộng tác viên</option>
									<option value="2">đại lý</option>
									<option value="3">kiểm duyệt viên</option>
									<option value="4">quản trị viên</option>
								</select>
							 </div>
							
							 <div class="form-group">
						       <label>trạng thái: </label>
							    <div class="form-check form-switch">
                                  <input name="status_<?=$users['id'];?>"class="form-check-input check-input" type="checkbox" role="switch"  <?=checked($users['level']);?>>
                                </div>
					         </div>

						    </div>
						   </div>	
						 </div>

							<div class="modal-footer">
							   <button type="button"  id="detele_users_<?=$users['id'];?>" class="btn btn-cam font-weight-bold br-9 w-100 mb-3">Xóa người dùng này</button>
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
						  $("#check_<?=$users['id'];?> div form").submit(function(e) {
                            e.preventDefault(); 
							   const  form = $(this);
                               const url = form.attr('action');
                               const method = form.attr('method');

                               curl(url,method,{
								   'type':'edit-thanh-vien',
								   'username':$('input[name="username_<?=$users['id'];?>"]').val(),
								   'password':$('input[name="password_<?=$users['id'];?>"]').val(),
								   'money':$('input[name="money_<?=$users['id'];?>"]').val(),
								   'level':$('select[name="level_<?=$users['id'];?>"]').val(),
								   'status':$('input[name="status_<?=$users['id'];?>"]').is(':checked')
								});

                            });  
		
						  $("#detele_users_<?=$users['id'];?>").click(function(){
							    curl('/v1/adn','POST',{
								   'type':'xoa-thanh-vien',
								   'username':$('input[name="username_<?=$users['id'];?>"]').val()
								});
						  });
						                        
						</script>
						<?php
                         }
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
