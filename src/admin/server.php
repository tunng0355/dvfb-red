<?php 
     $title = 'Quản lý server';
     require( '../head.php'); 
	 require( '../admin.php'); 
     require( '../menu.php');
     // Tiện ích cấu trúc
	 $list = $DB->get_list("SELECT * FROM `dichvu` ORDER BY id DESC ");    
	 $loai = $DB->get_list("SELECT * FROM `theloai` ORDER BY id DESC ");    
	 $sv = $DB->get_list("SELECT * FROM `server` ORDER BY id DESC ");    

?>
<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
                <div class="card-body">
				<div class="row">
					<div class="col-lg-6">
					<div class="media-mb">
							<h5 class="card-title fs-30 h4 title-pages">  
							 <img src="/assets/img/icon/4152008.png" width="45" > Quản lý server
                            </h5>
						 </div>
					</div>
					<div class="col-lg-6">
						<div class="item-end">
							<button class="btn  btn-get font-weight-bolder font-size-sm ml-5" data-bs-toggle="modal" data-bs-target="#add_dich-vu"><i class="fa fa-plus-circle"></i> Thêm server </button>
						</div>
					</div>
				</div>
				<div class="modal fade" id="add_dich-vu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<form class="modal-content"  method="POST" action="/v1/adn" oninput="loadcheck()">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Thêm server mới</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body"> 
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">
							  <div class="form-group">
						       <label>name: </label>
						       <input type="text" name="name" value="" class="form-control" placeholder="điền tên server" >
					         </div>
							 <div class="form-group">
						       <label>rate thành viên: </label>
						       <input type="text" name="rate" value="" class="form-control" placeholder="điền rate server" >
					         </div>
							 <div class="form-group">
						       <label>rate cộng tác viên: </label>
						       <input type="text" name="rate2" value="" class="form-control" placeholder="điền rate server" >
					         </div>
							 <div class="form-group">
						       <label>rate đại lý: </label>
						       <input type="text" name="rate3" value="" class="form-control" placeholder="điền rate server" >
					         </div>
							 <div class="form-group">
						    <label>thể loại: </label>
							 <select name="loai" class="form-control">
							       <option value="">Chọn thể loại</option>
                            <?php
						       foreach($loai as $theloai)
						       {          
							?>
                                    <option value="<?=$theloai['loai'];?>"><?=$theloai['name'];?></option>
							<?php
							   }
							?>
							</select>
							</div>
                            <div class="form-group">
						    <label>dịch vụ: </label>
							 <select name="code" class="form-control">
							       <option value="">Chọn dịch vụ</option>
                            <?php
						       foreach($list as $dichvu)
						       {          
							?>
                                    <option value="<?=$dichvu['type'];?>"><?=$dichvu['name'];?> [<?=$DB->theloai($dichvu['loai']);?>]</option>
							<?php
							   }
							?>
							</select>
							</div>
						    </div>
							</div>
						   </div>
							<div class="modal-footer">
							    <button type="button" class="btn btn-cam br-9" data-bs-dismiss="modal">Close</button>
								<input type="hidden" name="type" value="them-server" />
								<button type="submit" class="btn btn-primary font-weight-bold br-9" >Thêm server</button>
							</div>
						</div>
					</form>
				</div>
				
		<div class="form-group mt-3">
		    <table class="table table-cen">
						<thead>
							<tr>
                                <th scope="col"><a href="#">#id</a></th>
								<th scope="col">tên server</th>
								<th scope="col">giá thành viên</th>
								<th scope="col">giá cộng tác viên</th>
								<th scope="col">giá đại lý</th>
								<th scope="col">thể loại</th>
                                <th scope="col">dịch vụ</th>
                                <th scope="col">tiện ích</th>
							</tr>
						</thead>
						<tbody>
                        <?php
						 $i= 1; 
						 foreach($sv as $server)
						 { 
						?>
							<tr>
                                <td><?=$i++;?></td>
								<td><?=$server['name'];?></td>
								<td><?=$server['rate'];?></td>
								<td><?=$server['rate2'];?></td>
								<td><?=$server['rate3'];?></td>
								<td><?=$DB->theloai($server['loai']);?></td>
                                <td><?=$DB->dichvu($server['type']);?></td>
								<td><button type="button" class="btn btn-edit text-white"data-bs-toggle="modal" data-bs-target="#check_<?=$server['id'];?>">xem chi tiết</button></td>
							</tr>

							
							<div class="modal fade" id="check_<?=$server['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
							<form method="POST"  action="/v1/adn" class="form-x3">
						    <div class="modal-content">
						    <div class="modal-header">

							<h5 class="modal-title" id="staticBackdropLabel">Chi tiết server</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">	   
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">

						     <div class="form-group">
						       <label>tên server: </label>
						       <input type="text" name="name_<?=$server['id'];?>" value="<?=$server['name'];?>" class="form-control" placeholder="Điền tên server" >
					         </div>

							 <div class="form-group">
						       <label>rate thành viên: </label>
						        <input type="text"  name="rate_<?=$server['id'];?>" placeholder="Điền rate server"  value="<?=$server['rate'];?>" class="form-control">
				         	</div>
							 <div class="form-group">
						       <label>rate cộng tác viên: </label>
						        <input type="text"  name="rate2_<?=$server['id'];?>" placeholder="Điền rate server"  value="<?=$server['rate2'];?>" class="form-control">
				         	</div>
							 <div class="form-group">
						       <label>rate đại lý: </label>
						        <input type="text"  name="rate3_<?=$server['id'];?>" placeholder="Điền rate server"  value="<?=$server['rate3'];?>" class="form-control">
				         	</div>

							<div class="form-group">
						    <label>thể loại: </label>
							 <select name="loai_<?=$server['id'];?>" class="form-control">
							<option value="<?=$server['loai'];?>">Mặc định (<?=$DB->theloai($server['loai']);?>) </option>
                            <?php
						       foreach($loai as $theloai2)
						       {          
							?>
                                <option value="<?=$theloai2['loai'];?>"><?=$theloai2['name'];?> </option>
							<?php
							   }
							?>
							</select>
							</div>

                            <div class="form-group">
						    <label>dichvu: </label>
							 <select name="code_<?=$server['id'];?>" class="form-control">
							<option value="<?=$server['type'];?>">Mặc định (<?=$DB->dichvu($server['type']);?>) </option>
                            <?php
						       foreach($list as $dv)
						       {          
							?>
                                <option value="<?=$dv['type'];?>"><?=$dv['name'];?> [<?=$DB->theloai($dv['loai']);?>]</option>
							<?php
							   }
							?>
							</select>
							</div>
                            
						    </div>
						   </div>	
						 </div>

							<div class="modal-footer">
							   <button type="button"  id="detele_server_<?=$server['id'];?>" class="btn btn-cam font-weight-bold br-9 w-100 mb-3">Xóa server này</button>
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
						  $("#check_<?=$server['id'];?> div form").submit(function(e) {
                            e.preventDefault(); 
							   const  form = $(this);
                               const url = form.attr('action');
                               const method = form.attr('method');

                               curl(url,method,{
								   'type':'edit-server',
								   'id':'<?=$server['id'];?>',
								   'name':$('input[name="name_<?=$server['id'];?>"]').val(),
								   'rate':$('input[name="rate_<?=$server['id'];?>"]').val(),
								   'rate2':$('input[name="rate2_<?=$server['id'];?>"]').val(),
								   'rate3':$('input[name="rate3_<?=$server['id'];?>"]').val(),
								   'loai':$('[name="loai_<?=$server['id'];?>"]').val(),
                                   'code':$('[name="code_<?=$server['id'];?>"]').val()
								});

                            });  

						  $("#detele_server_<?=$server['id'];?>").click(function(){
							    curl('/v1/adn','POST',{
								   'type':'xoa-server',
								   'id':'<?=$server['id'];?>',
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

$("#add_dich-vu div form").submit(function(e) {
    e.preventDefault(); 

    const  form = $(this);
    const url = form.attr('action');
    const method = form.attr('method');

    curl(url,method,form.serialize());

  });    



 </script>

<?php require( '../end.php');?>
