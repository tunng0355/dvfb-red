<?php 
     $title = 'Nạp tiền tài khoản';
     require( '../head.php'); 
     require( '../menu.php'); 
	 $list = $DB->get_list("SELECT * FROM `naptien`  WHERE `username` = '".$DB->users('username')."' ORDER BY id DESC ");    
?>
<!-- Nội dung -->
<div class="content">
<div class="card tp p4-36 mb-4">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
					<div class="media-mb">
						<h5 class="card-title fs-30 h4 title-pages"><img src="/assets/img/icon/4151893.png" width="45"> Nạp tiền tài khoản </h5> </div>
					</div>
					<div class="col-lg-6">
						<div class="item-end">
							<a href="/chuyen-khoan" class="btn  btn-get font-weight-bolder font-size-sm ml-5"> <i class="fa-solid fa-building-columns"></i> Chuyển khoản </a>
						</div>
					</div>
				</div>
				<div class="alert text-pre-wrap alert-danger-light mt-3 border-dashed">
					<p>- Nạp thẻ mệnh giá càng cao thì chiết khấu càng thấp! </p>
					<p> - Tự động duyệt thẻ và cộng tiền từ 5 - 15 phút, đúng sẽ được cộng tiền và ngược lại! </p>
					<p>- Vui lòng chọn đúng mệnh giá thẻ và nhà mạng giúp mình nhé, sai có thể sẽ mất thẻ và không được cộng hoặc hoàn tiền!</p>
				</div>
				<ul role="tablist" style="margin-top: 28px;
                margin-bottom: 28px;" class="nav nav-pills nav-justified flex-column flex-sm-row">
					<li class="nav-item tab-item" role="presentation">
						<a class="nav-link active" data-bs-toggle="tab" href="#card" role="tab" aria-selected="true"> <i class="fa fa-plus-circle"></i> Nạp qua thẻ cào </a>
					</li>
					<li class="nav-item tab-item" role="presentation">
						<a class="nav-link" data-bs-toggle="tab" href="#bank" role="tab" aria-selected="true"> <i class="fa fa-list"></i> Lịch sử nạp </a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="card" role="tabpanel" aria-labelledby="card">
						<!-- Body -->
						<div class="card-body">
							<!-- Form -->
							<form id="add_the_cao" action="/v1/api" method="POST">
								<div class="form-group">
									<label>Nhà mạng :</label>
									<select  name="telco" class="form-control">
										<option value="VIETTEL">Thẻ VIETTEL ( 19% )</option>
										<option value="VINAPHONE">Thẻ VINAPHONE ( 17% )</option>
										<option value="MOBIFONE">Thẻ MOBIFONE ( 19% )</option>
										<option value="GATE">Thẻ GATE ( 30% )</option>
										<option value="ZING">Thẻ ZING ( 18% )</option>
										<option value="VNMOBI">Thẻ VNMOBI ( 17% )</option>
									</select>
								</div>
								<div class="form-group">
									<label>Mệnh giá :</label>
									<select  name="amount" class="form-control">
										<option value="10000">10,000 VND - Chiết khấu 19%</option>
										<option value="20000">20,000 VND - Chiết khấu 19%</option>
										<option value="30000">30,000 VND - Chiết khấu 19%</option>
										<option value="50000">50,000 VND - Chiết khấu 15%</option>
										<option value="100000">100,000 VND - Chiết khấu 15%</option>
										<option value="200000">200,000 VND - Chiết khấu 16%</option>
										<option value="300000">300,000 VND - Chiết khấu 16%</option>
										<option value="500000">500,000 VND - Chiết khấu 18%</option>
										<option value="1000000">1,000,000 VND - Chiết khấu 20%</option>
									</select>
								</div>
								<div class="form-group">
									<label>Mã Serial :</label>
									<input type="text" name="serial" placeholder="Nhập mã Serial ở hàng đầu tiên của thẻ cào"  class="form-control"> 
								</div>
								<div class="form-group">
									<label>Mã Thẻ :</label>
									<input type="text" name="pin" placeholder="Nhập mã thẻ cào sau lớp bạc mỏng"  class="form-control"> 
								</div>
								<input type="hidden" name="type" value="add-the-cao" />
								<button class="btn btn-primary  button-ck w-100 mt-4 mb-4" id="send"type="submit">Gửi thẻ</button>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank">
						<div class="card-box" style="padding-top: 0px;">
							<div class="form-group">
						<table class="table table-cen">
						<thead>
							<tr>
								<th scope="col" ><a href="#">#</a></th>
								<th scope="col" >Mã giao dịch</th>
								<th scope="col" >PIN</th>
								<th scope="col" >Serial</th>
								<th scope="col" >Ghi chú</th>
								<th scope="col" >Trạng thái</th>
								<th scope="col" >Thời gian</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$i =1;
						  foreach($list as $card)
						  {
						?>
							<tr>
								<td><?=$i++;?></td>
								<td><?=$card['request_id'];?></td>
								<td><?=$card['pin'];?></td>
								<td><?=$card['serial'];?></td>
								<td><?=$card['content'];?></td>
								<td><?=card($web['status']);?></td>
								<td><?=timeago($web['date']);?></td>
							</tr>
						<?php
						  }
						?>
							</tr>
					</table>
							</div>
						</div>
					</div>
					<!-- End Body -->
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
</script>
<?php require( '../end.php');?>