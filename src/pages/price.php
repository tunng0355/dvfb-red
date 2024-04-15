<?php 
     $title = 'Bảng giá dịch vụ';
     require( '../head.php'); 
     require( '../menu.php'); 
	 $list = $DB->get_list("SELECT * FROM `server` ORDER BY id DESC ");    

?>
<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
			
			<div class="card-body">
            <div class="card-box">
				<h2 class="card-title h4 title-pages mb-3">
                <img src="/assets/img/icon/743860.png" width="40px" > 
                <div class="fs-30">Bảng giá dịch vụ</div>
                </h2> 
            </div>
			<div class="form-group">
						<table class="table table-cen">
						<thead>
							<tr>
								<th class="th-red">Icon</th>
								<th class="min-24 th-red">Dịch vụ</th>
								<th class="min-24 th-red">Server</th>
								<th class="th-red">Giá</th>
								<th class="th-red">Giá CTV</th>
								<th class="th-red">Giá Đại Lý</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						  $i = 1;
						  foreach($list as $sv)
						  {
						 ?>
							<tr>
								<td class="img-price"><?=$DB->get_row("SELECT * FROM `dichvu` WHERE `type` = '".$sv['type']."'")['img'];?></td>
								<td class="cx"><?=$DB->dichvu($sv['type']);?></td>
								<td class="cx start"><?=$sv['name'];?></td>
								<td><span class="badge  bg-primary"><?=$sv['rate'];?> COIN</span> </td>
								<td><span class="badge  bg-warning"><?=$sv['rate2'];?> COIN</span> </td>
								<td><span class="badge  bg-danger2"><?=$sv['rate3'];?> COIN</span> </td>
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
