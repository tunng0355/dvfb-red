<?php 
     $title = 'Đổi mã nhận thưởng';
     require( '../head.php'); 
     require( '../menu.php'); 
?>
<!-- Nội dung -->
<div class="content">
<div class="card tp p4-36 mb-4">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
					<div class="media-mb">
							<h5 class="card-title fs-30 h4 title-pages">
                            <img src="/assets/img/icon/5180858.png" width="45"> 
                            Đổi mã nhận thưởng</h5>
                     </div>
					</div>
					<div class="col-lg-6">
						<div class="item-end">
							<button class="btn  btn-get font-weight-bolder font-size-sm ml-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fa-solid fa-gift"></i> Nhập gift code</button>
						</div>
					</div>
				</div>
				<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Chọn phương thức thanh toán</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body"> ... </div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							</div>
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
						<a class="nav-link active" data-bs-toggle="tab" href="#card" role="tab" aria-selected="true"> <i class="fa fa-plus-circle"></i> Rút coin về tài khoản </a>
					</li>
					<li class="nav-item tab-item" role="presentation">
						<a class="nav-link" data-bs-toggle="tab" href="#bank" role="tab" aria-selected="true"> <i class="fa fa-list"></i> Lịch sử rút </a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="card" role="tabpanel" aria-labelledby="card">
						<!-- Body -->
						<div class="card-body">
							<!-- Form -->
							<form action="#">
								<div class="form-group">
									<label>Ngân hàng :</label>
									<select required="required" class="form-control">
										<option value="MBBANK">MBBANK</option>
                                        <option value="MOMO">MOMO</option>
									</select>
								</div>
								<div class="form-group">
									<label>Số coin rút :</label>
									<input type="number" placeholder="Nhập số coin bạn muốn rút sang tiền ngân hàng" required="required" class="form-control"> </div>
								<div class="form-group">
									<label>Mã Rút ( nếu có ) :</label>
									<input type="text" placeholder="Nhập mã rút bạn sẽ được nhận thêm hoa hồng khi rút" required="required" class="form-control"> </div>
								<button class="btn btn-primary  button-ck w-100 mt-4 mb-4">Yêu cầu rút</button>
							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank">
						<div class="card-box" style="padding-top: 0px;">
							<div class="form-group">
							<table class="table table-cen">
						<thead>
							<tr>
								<th scope="col"><a href="#">#</a></th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Alfreds Futterkiste</td>
								<td>Germany</td>
								<td>Berglunds snabbkop</td>
								<td>Sweden</td>
							</tr>
							<tr>
								<td>Alfreds Futterkiste</td>
								<td>Germany</td>
								<td>Berglunds snabbkop</td>
								<td>Sweden</td>
							</tr>	
                            <tr>
								<td>Alfreds Futterkiste</td>
								<td>Germany</td>
								<td>Berglunds snabbkop</td>
								<td>Sweden</td>
							</tr>	
                            <tr>
								<td>Alfreds Futterkiste</td>
								<td>Germany</td>
								<td>Berglunds snabbkop</td>
								<td>Sweden</td>
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
</script>
<?php require( '../end.php');?>