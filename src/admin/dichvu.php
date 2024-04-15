<?php 
     $title = 'Quản lý nhiệm vụ';
     require( '../head.php'); 
	 require( '../admin.php'); 
     require( '../menu.php');
     // Tiện ích cấu trúc
	 $list = $DB->get_list("SELECT * FROM `dichvu` ORDER BY id DESC ");    
	 $loai = $DB->get_list("SELECT * FROM `theloai` ORDER BY id DESC ");    

?>
<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
                <div class="card-body">
				<div class="row">
					<div class="col-lg-6">
					<div class="media-mb">
							<h5 class="card-title fs-30 h4 title-pages">  
							 <img src="/assets/img/icon/4151778.png" width="45" > Quản lý dịch vụ
                            </h5>
						 </div>
					</div>
					<div class="col-lg-6">
						<div class="item-end">
							<button class="btn  btn-get font-weight-bolder font-size-sm ml-5" data-bs-toggle="modal" data-bs-target="#add_dich-vu"><i class="fa fa-plus-circle"></i> Thêm dịch vụ </button>
						</div>
					</div>
				</div>
				<div class="modal fade" id="add_dich-vu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<form class="modal-content"  method="POST" action="/v1/adn">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Thêm dịch vụ mới</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body"> 
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">
							  <div class="form-group">
						       <label>name: </label>
						       <input type="text" name="name" value="" class="form-control" placeholder="điền tên dịch vụ" >
					         </div>
							 <div class="form-group">
						       <label>biểu tượng: </label>
						       <input type="text" name="img" value="" class="form-control" placeholder="dán biểu tượng vào đây dạng html" >
					         </div>
							 <div class="form-group">
						       <label>mã dịch vụ: </label>
						       <input type="text" name="code" value="" class="form-control" placeholder="điền mã dịch vụ" >
					         </div>
							 <div class="form-group">
						       <label>ghi chú dịch vụ: </label>
							   <textarea class="form-control" name="content" rows="5" ></textarea>
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

						    </div>
							</div>
						   </div>
							<div class="modal-footer">
							    <button type="button" class="btn btn-cam br-9" data-bs-dismiss="modal">Close</button>
								<input type="hidden" name="type" value="them-dich-vu" />
								<button type="submit" class="btn btn-primary font-weight-bold br-9" >Thêm dịch vụ</button>
							</div>
						</div>
					</form>
				</div>
				
		<div class="form-group mt-3">
		<table class="table table-cen">
						<thead>
							<tr>
                                <th scope="col"><a href="#">#id</a></th>
								<th scope="col">biểu tượng</th>
								<th scope="col">tên dịch vụ</th>
								<th scope="col">thể loại</th>
								<th scope="col">mã dịch vụ</th>
                                <th scope="col">tiện ích</th>
							</tr>
						</thead>
						<tbody>
                        <?php
						 $i= 1; 
						 foreach($list as $dichvu)
						 { 
						?>
							<tr>
                                <td><?=$i++;?></td>
								<td class="img-dv"><?=$dichvu['img'];?></td>
								<td><?=$dichvu['name'];?></td>
								<td><?=$DB->theloai($dichvu['loai']);?></td>
								<td><?=$dichvu['type'];?></td>
								<td><button type="button" class="btn btn-edit text-white"data-bs-toggle="modal" data-bs-target="#check_<?=$dichvu['id'];?>">xem chi tiết</button></td>
							</tr>

							
							<div class="modal fade" id="check_<?=$dichvu['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
							<form method="POST"  action="/v1/adn" class="form-x3">
						    <div class="modal-content">
						    <div class="modal-header">

							<h5 class="modal-title" id="staticBackdropLabel">Chi tiết dịch vụ</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">	   
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">

						     <div class="form-group">
						       <label>tên dịch vụ: </label>
						       <input type="text" name="name_<?=$dichvu['id'];?>" value="<?=$dichvu['name'];?>" class="form-control" placeholder="Điền tên dịch vụ" >
					         </div>

							 <div class="form-group">
						       <label>ghi chú dịch vụ: </label>
							   <textarea class="form-control" name="content_<?=$dichvu['id'];?>" rows="5" ><?=$dichvu['content'];?></textarea>
					         </div>

							 <div class="form-group">
						       <label>biểu tượng dịch vụ: </label>
							   <input type="text" name="img_<?=$dichvu['id'];?>" value='<?=$dichvu['img'];?>' class="form-control" placeholder="Điền biểu tượng dịch vụ">
					         </div>

							 <div class="form-group">
						       <label>mã dịch vụ: </label>
							 <div class="input-group">
						        <input type="text" id="mtl" name="code_<?=$dichvu['id'];?>" placeholder="Điền mã dịch vụ"  value="<?=$dichvu['type'];?>" class="form-control bg-white m-0 br">
					         	<button type="submit" onclick="copy('mtl')" class="btn btn btn-primary btn-hight ">Copy</button>
				         	</div>
                            </div> 

							<div class="form-group">
						    <label>thể loại: </label>
							 <select name="loai_<?=$dichvu['id'];?>" class="form-control">
							<option value="<?=$theloai['loai'];?>">Mặc định (<?=$DB->theloai($theloai['loai']);?>) </option>
                            <?php
						       foreach($loai as $theloai2)
						       {          
							?>
                                <option value="<?=$theloai2['loai'];?>"><?=$theloai2['name'];?></option>
							<?php
							   }
							?>
							</select>
							</div>

						    </div>
						   </div>	
						 </div>

							<div class="modal-footer">
							   <button type="button"  id="detele_dich_vu_<?=$dichvu['id'];?>" class="btn btn-cam font-weight-bold br-9 w-100 mb-3">Xóa dịch vụ này</button>
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
						  $("#check_<?=$dichvu['id'];?> div form").submit(function(e) {
                            e.preventDefault(); 
							   const  form = $(this);
                               const url = form.attr('action');
                               const method = form.attr('method');

                               curl(url,method,{
								   'type':'edit-dich-vu',
								   'uid':'<?=$dichvu['id'];?>',
								   'name':$('input[name="name_<?=$dichvu['id'];?>"]').val(),
								   'img':$('input[name="img_<?=$dichvu['id'];?>"]').val(),
								   'code':$('input[name="code_<?=$dichvu['id'];?>"]').val(),
								   'loai':$('select[name="loai_<?=$dichvu['id'];?>"]').val(),
								   'content':$('textarea[name="content_<?=$dichvu['id'];?>"]').val(),

								});

                            });  
		
						  $("#detele_dich_vu_<?=$dichvu['id'];?>").click(function(){
							    curl('/v1/adn','POST',{
								   'type':'xoa-dich-vu',
								   'id':'<?=$dichvu['id'];?>',
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
