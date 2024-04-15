<?php 
     $title = 'Bảng giá dịch vụ';
     require( '../head.php'); 
     require( '../menu.php');

	 // Tiện ích cấu trúc	 
	 $list = $DB->get_list("SELECT * FROM `users`  WHERE `referral` = '".$DB->users('referral')."' ORDER BY money DESC ");    
?>
<!-- Nội dung -->
<div class="content">

<div class="card tp mb-4">
			<!-- Body -->
			<div class="card-body">
			<div class="card-box">
				<h2 class="card-title h4 title-pages">
               <img src="/assets/img/icon/5207154.png" width="45" > 
              <div class="fs-30">Thông tin cá nhân</div>
            </h2>
         </div>

				<!-- Form -->
				<form method="POST" id="change_info" action="/v1/api">

                <input type="hidden" name="type" value="change_info" />

					<div class="form-group">
						<label>Tài khoản :</label>
						<input type="text" placeholder="Nhập tài khoản" value="<?=$DB->users('username');?>" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label>Số điện thoại :</label>
						<input type="number" placeholder="Nhập số điện thoại mới"  value="<?=$DB->users('phone');?>"  name="phone" class="form-control"> 
					</div>
					<div class="form-group">
						<label>Địa chỉ email :</label>
						<input type="email" placeholder="Nhập địa chỉ email mới" value="<?=$DB->users('email');?>" name="email" class="form-control">
					</div>
					<button class="btn btn-primary  button-ck w-100 mt-4 mb-4">Cập nhật thông tin</button>
				</form>
			</div>
		</div>



<div class="card tp mb-4">
			<!-- Body -->
			<div class="card-body">
			<div class="card-box">
				<h2 class="card-title h4 title-pages">
               <img src="/assets/img/icon/6768878.png" width="45" > 
              <div class="fs-30">Đổi mật khẩu</div>
            </h2>
         </div>

				<!-- Form -->
				<form method="POST" id="change_password" action="/v1/api">

                <input type="hidden" name="type" value="change_password" />

					<div class="form-group">
						<label>Mật khẩu cũ :</label>
						<input type="password" placeholder="Nhập mật khẩu cũ"  name="password" class="form-control">
					</div>
					<div class="form-group">
						<label>Mật khẩu mới :</label>
						<input type="password" placeholder="Nhập mật khẩu mới"  name="new_password" class="form-control"> 
					</div>
					<div class="form-group">
						<label>Nhập lại mật khẩu mới :</label>
						<input type="password" placeholder="Nhập lại mật khẩu mới" name="confirm_new_password" class="form-control">
					</div>
					<button class="btn btn-primary  button-ck w-100 mt-4 mb-4">Đổi mật khẩu</button>
				</form>
			</div>
		</div>



		<div class="card card tp mb-4">
        <div class="card-body">
        <div class="card-box">
				<h2 class="card-title h4 title-pages mb-3">
               <img src="/assets/img/icon/5207757.png" width="45"> 
              <div class="fs-30">Giới thiệu kiếm coin</div>
            </h2>
         </div>

	                                  
        <?php 
		   $code =$DB->users('referral');
		   $username =$DB->users('username');
           if($code=="")
		   {	
		?>
		    <div class="d-flex flex-column px-9">
              <div class="pt-10 pb-0">
               <h1 class="text-tim text-center fw-bolder fs-3rem">NO YET</h3>
                <div class="text-center text-gray-500 pt-1 mb-2 fs-19">Thêm mã giới thiệu để có thể kiếm tiền ngay</div>
                 <div class="text-center px-4">
                    <img alt="image" width="178" src="/assets/img/icon/7438816.png" />
                  </div>
                  <div class="text-center mt-3 mb-4">
                    <a href="#" class="btn btn-sm btn-primary px-6 btn-add" data-bs-toggle="modal" data-bs-target="#them_ma_gioi_thieu">Thêm mã giới thiệu</a>
                  </div>
                 </div>
               </div> 
			   <div class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" id="them_ma_gioi_thieu"tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<form class="modal-dialog" id="add_referral_code" action="/v1/api" method="POST">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title card-title h4 title-pages" id="them_ma_gioi_thieu">
                                 <img src="/assets/img/icon/5207757.png" width="45"> 
                                  <div class="fs-30">Giới thiệu kiếm coin</div>
								</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body mb-4 mt-0">
							<div class="card-box">
							<div class="form-group">
						    <label>Mã giới thiệu (vd: tung0355): </label>
							 <input type="hidden" name="type" value="add_referral_code" />
						     <input type="text" name="code" class="form-control" placeholder="Nhập mã giới thiệu">
					        </div>
							<div class="form-group">
								<label>Phương thức :</label>
								<select required="required" class="form-control" name="loai">
									<option value="1">Tạo mã giới thiệu mới</option>
									<option value="2">Dùng mã giới thiệu chung</option>
								</select>
							</div>
							</div>
						    </div>
						
							
							<div class="modal-footer">
								<button type="button" class="btn btn-cam br-9" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary font-weight-bold br-9" >Thêm mã giới thiệu</button>
							</div>
						</div>
		             </form>
				</div>

				<script>
                  $("#add_referral_code").submit(function(e) {
                     e.preventDefault(); 

                     const  form = $(this);
                     const url = form.attr('action');
                     const method = form.attr('method');

                     curl(url,method,form.serialize());

                   });    
				</script>
				<?php
				   }
				   else
				   {
				?>	
              <div class="form-group">
					<div class="input-group">
						<input type="text" id="mgt" placeholder="Mã giới thiệu của bạn" readonly="readonly" value="<?=$code;?>" required="required" class="form-control bg-white m-0 br">
						<button type="submit" onclick="copy('mgt')" class="btn btn btn-primary btn-hight ">Copy</button>
					</div>
				</div>
				<div class="form-group">
                <table class="table table-cen">
						<thead>
							<tr>
								<th scope="col"><a href="#">#</a></th>
								<th scope="col">username</th>
								<th scope="col">số dư</th>
								<th scope="col">cấp bậc</th>
								<th scope="col">Trạng thái</th>
								
							</tr>
						</thead>
						<tbody>
							
                        <?php
						 $i= 1; 
						 foreach($list as $MGT)
						 { 
						?>
							<tr>
							    <td><?=$i++;?></td>
								<td><?=compare($username,$MGT['username']);?></td>
								<td><span class="badge bg-cam"><?=format($MGT['money']);?> VNĐ</span></td>
								<td><span class="badge bg-prim"><?=level($MGT['level']);?></span></td>
                                <td><?=status($MGT['status']);?></td>
							</tr> 
					    <?php }?>
					</table>
				</div>
				<?php
				   }
				?>
			</div>
		</div>
    <!-- End Nội dung -->
</div>
<script type="text/javascript">
  // Datatable 
  $(document)
    .ready(function () {
       $('.table')
          .DataTable({
              paging: true,
              filter: true
          });
  });

  // Request api 
  $("#change_password").submit(function(e) {
  e.preventDefault(); 

  const  form = $(this);
  const url = form.attr('action');
  const method = form.attr('method');

  curl(url,method,form.serialize());
	
  });    

  // Request api 
  $("#change_info").submit(function(e) {
  e.preventDefault(); 

  const  form = $(this);
  const url = form.attr('action');
  const method = form.attr('method');

  curl(url,method,form.serialize());
	
  });    
</script>
<?php require( '../end.php');?>
