<?php 
     $title = 'Lịch sử hoạt động';
     require( '../head.php'); 
     require( '../menu.php'); 
	 $history= $DB->get_list("SELECT * FROM `history` WHERE `username` = '".$DB->users('username')."'"); 
?>
<!-- Nội dung -->
<div class="content">		
<div class="card tp mb-4">
			<!-- Body -->
			<div class="card-body">
			<div class="card-box">
			<h2 class="card-title h4 title-pages mb-4">
               <img src="/assets/img/icon/7385049.png" width="40" > 
              <div class="fs-30"> Lịch sử hoạt động</div>
            </h2>
         </div>

				<!-- Form -->
				<div class="form-group">
                <table class="table table-cen">
				<thead>
                  <tr>
                    <th scope="col"><a href="#">#</a> </th>
                    <th scope="col">uid</th>
                    <th scope="col">số lượng</th>
                    <th scope="col">giá thành</th>
					<th scope="col">thể loại</th>
					<th scope="col">dịch vụ</th>
					<th scope="col">server</th>
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
                      <td><?=$lichsu['id'];?></td>
                        <td><?=$lichsu['uid'];?></td>
                        <td><?=format($lichsu['quantity']);?></td>
                        <td><span class="badge bg-cam"><?=format($lichsu['money']);?> COIN</span></td>
						            <td><?=$DB->theloai($lichsu['loai']);?></td>
					            	<td><?=$DB->dichvu($lichsu['type']);?></td>
						            <td><?=$DB->server($lichsu['server']);?></td>
                        <td><?=status2($lichsu['status']);?></td>
                        <td><?=timeago($lichsu['date']);?></td>
                      </tr>
                    <?php 
                        }
                    ?>
					</table>
				</div>
				<!-- End Form -->
			</div>
			<!-- End Body -->
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
