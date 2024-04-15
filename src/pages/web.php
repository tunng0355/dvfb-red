<?php 
     $title = 'Tạo website cộng tác viên';
     require( '../head.php'); 
     require( '../menu.php'); 
	 $site= $DB->get_list("SELECT * FROM `daily` WHERE `username` = '".$DB->users('username')."'"); 
?>
<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-6">
				<div>
					<h5 class="card-title fs-30 h4 title-pages">
						<img src="/assets/img/icon/743860.png" width="45"> Tạo Website CTV 
					</h5> 
				</div>
			</div>
			<div class="col-lg-6">
				<div class="item-end">
					<button class="btn btn-get font-weight-bolder font-size-sm ml-5" data-bs-toggle="modal" data-bs-target="#get_token"> Get Token </button>
				</div>
			</div>
		</div>
		<div class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" id="get_token"tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog" >
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title card-title h4 title-pages" id="them_ma_gioi_thieu">
                                 <img src="/assets/img/icon/5207757.png" width="45"> 
                                  <div class="fs-30">GET TOKEN</div>
								</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body mb-4 mt-0">
							<div class="card-box">
							<div class="form-group">
						    <label>Token API: </label>
							 <div class="input-group">
						        <input type="text" id="token" placeholder="Token của bạn" readonly="readonly" value="<?=$DB->users('token');?>" required="required" class="form-control bg-white m-0 br">
					         	<button type="submit" onclick="copy('token')" class="btn btn btn-primary btn-hight ">Copy</button>
				         	</div>
					        </div>
							</div>
						    </div>
						
							
							<div class="modal-footer">
								<button type="button" class="btn btn-cam br-9" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
                </div>
		</div>
		<div class="alert text-pre-wrap alert-danger-light mt-3">
			<p>+ Chỉ cần mua tên miền, không cần đăng ký Hosting</p> 
			<p>+ Không đăng ký tên miền chứa các từ khóa như : facebook, instagram, tiktok, youtube, fb, ins,... các từ khóa liên quan đến mạng xã hội hoặc tổ chức nào đó!</p>  
			<p>+ Tài khoản của bạn phải mua ít nhất gói Cộng Tác Viên / Đại Lý mới khởi tạo được hệ thống!</p> 

			</div>
		<form id="add_domain" method="POST" action="/v1/api">
		<input type="hidden" name="type" value="active-site" />
			<div class="form-group">
				<label>Thêm tên miền :</label>
				<div class="input-group">
					<input type="text" name="domain" placeholder="Nhập tên miền để hệ thống kích hoạt..." class="form-control m-0 br">
					<button type="submit" class="btn btn-primary btn-hight ">Kích hoạt</button>
				</div>
			</div>
			<div class="form-group">
				<label>IP trỏ miền :</label>
				<div class="input-group">
					<input type="text" id="ip" placeholder="IP trỏ miền..." value="172.96.185.197" class="form-control bg-white m-0 br" readonly="readonly" required="required">
					<button type="button" onclick="copy('ip')"  class="btn btn-primary btn-hight ">Sao chép</button>
				</div>
			</div>
			<!---->
		</form>
		<div class="form-group mt-3">
		<table class="table table-cen">
						<thead>
							<tr>
								<th scope="col"><a href="#">#</a></th>
								<th scope="col">Tên miền</th>
								<th scope="col">Trạng thái</th>
								<th scope="col">Thời gian</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$i =1;
						  foreach($site as $web)
						  {
						?>
							<tr>
								<td><?=$i++;?></td>
								<td><?=$web['domain'];?></td>
								<td><?=status3($web['status']);?></td>
								<td><?=timeago($web['date']);?></td>
							</tr>
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
  $("#add_domain").submit(function(e) {
    e.preventDefault(); 

    const  form = $(this);
    const url = form.attr('action');
    const method = form.attr('method');

    curl(url,method,form.serialize());

   });    
</script>
<?php require( '../end.php');?>
