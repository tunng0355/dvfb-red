<?php 
     $title = 'Quản lý ngân hàng';
     require( '../head.php'); 
	 require( '../admin.php'); 
     require( '../menu.php');
     // Tiện ích cấu trúc
	 $list = $DB->get_list("SELECT * FROM `bank` ORDER BY id DESC ");    
?>
<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
                <div class="card-body">
				<div class="row">
					<div class="col-lg-6">
					<div class="media-mb">
							<h5 class="card-title fs-30 h4 title-pages">  
							 <img src="/assets/img/icon/4051376.png" width="45" > Quản lý ngân hàng
                            </h5>
						 </div>
					</div>
					<div class="col-lg-6">
						<div class="item-end">
							<button class="btn  btn-get font-weight-bolder font-size-sm ml-5" data-bs-toggle="modal" data-bs-target="#add_ngan_hang"><i class="fa fa-plus-circle"></i> Thêm ngân hàng </button>
						</div>
					</div>
				</div>
				<div class="modal fade" id="add_ngan_hang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<form class="modal-content"  method="POST" action="/v1/adn">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Thêm ngân hàng mới</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body"> 
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">
							  <div class="form-group">
						       <label>biểu tượng ngân hàng: </label>
						       <input type="text" name="img" value="" class="form-control" placeholder="điền tên ngân hàng" >
					         </div>
							 <div class="form-group">
						       <label>số tài khoản: </label>
						       <input type="text" name="stk" value="" class="form-control" placeholder="dán biểu tượng vào đây dạng html" >
					         </div>
							 <div class="form-group">
						       <label>chủ tài khoản: </label>
						       <input type="text" name="name" value="" class="form-control" placeholder="điền mã ngân hàng" >
					         </div>
							 <div class="form-group">
						       <label>min nạp: </label>
						       <input type="text" name="min" value="" class="form-control" placeholder="điền mã ngân hàng" >
					         </div>
							 <div class="form-group">
						       <label>ghi chú: </label>
							   <textarea class="form-control" name="content" rows="5" ></textarea>
					         </div>
						    </div>
							</div>
						   </div>
							<div class="modal-footer">
							    <button type="button" class="btn btn-cam br-9" data-bs-dismiss="modal">Close</button>
								<input type="hidden" name="type" value="them-ngan-hang" />
								<button type="submit" class="btn btn-primary font-weight-bold br-9" >Thêm ngân hàng</button>
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
								<th scope="col">số tài khoản</th>
								<th scope="col">chủ tài khoản</th>
								<th scope="col">min nạp</th>
                                <th scope="col">tiện ích</th>
							</tr>
						</thead>
						<tbody>
                        <?php
						 $i= 1; 
						 foreach($list as $bank)
						 { 
						?>
							<tr>
                                <td><?=$i++;?></td>
								<td class="img2"><?=$bank['img'];?></td>
								<td ><?=$bank['stk'];?></td>
								<td><?=$bank['name'];?></td>
								<td><?=$bank['min'];?></td>
								<td>
									<button type="button" class="btn btn-edit text-white"data-bs-toggle="modal" data-bs-target="#check_<?=$bank['id'];?>">xem chi tiết</button>
							    </td>
							</tr>

							
							<div class="modal fade" id="check_<?=$bank['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
							<form method="POST"  action="/v1/adn" class="form-x3">
						    <div class="modal-content">
						    <div class="modal-header">

							<h5 class="modal-title" id="staticBackdropLabel">Chi tiết ngân hàng</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">	   
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">
							<div class="form-group">
						       <label>biểu tượng ngân hàng: </label>
							   <input type="text" name="img_<?=$bank['id'];?>" value='<?=$bank['img'];?>' class="form-control" placeholder="Điền biểu tượng ngân hàng">
					         </div>
						     <div class="form-group">
						       <label>số tài khoản: </label>
						       <input type="text" name="stk_<?=$bank['id'];?>" value="<?=$bank['stk'];?>" class="form-control" placeholder="Điền tên ngân hàng" >
					         </div>

							 <div class="form-group">
						       <label>chủ tài khoản: </label>
						       <input type="text" name="name_<?=$bank['id'];?>" value='<?=$bank['name'];?>' class="form-control" placeholder="Điền biểu tượng ngân hàng">
					         </div>
							 <div class="form-group">
						       <label>min nạp: </label>
						       <input type="text" name="min_<?=$bank['id'];?>" value='<?=$bank['min'];?>' class="form-control" placeholder="Điền biểu tượng ngân hàng">
					         </div>

							 <div class="form-group">
						       <label>ghi chú: </label>
							 <div class="input-group">
							 <textarea class="form-control" name="content_<?=$bank['id'];?>" rows="5" ><?=$bank['content'];?></textarea>
				         	</div>
                            </div> 

							

						    </div>
						   </div>	
						 </div>

							<div class="modal-footer">
							   <button type="button"  id="detele_ngan_hang_<?=$bank['id'];?>" class="btn btn-cam font-weight-bold br-9 w-100 mb-3">Xóa ngân hàng này</button>
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
						  $("#check_<?=$bank['id'];?> div form").submit(function(e) {
                            e.preventDefault(); 
							   const  form = $(this);
                               const url = form.attr('action');
                               const method = form.attr('method');

                               curl(url,method,{
								   'type':'edit-ngan-hang',
								   'id':'<?=$bank['id'];?>',
								   'name':$('input[name="name_<?=$bank['id'];?>"]').val(),
								   'img':$('input[name="img_<?=$bank['id'];?>"]').val(),
								   'stk':$('input[name="stk_<?=$bank['id'];?>"]').val(),
								   'min':$('input[name="min_<?=$bank['id'];?>"]').val(),
								   'content':$('[name="content_<?=$bank['id'];?>"]').val()
								});

                            });  
		
						  $("#detele_ngan_hang_<?=$bank['id'];?>").click(function(){
							    curl('/v1/adn','POST',{
								   'type':'xoa-ngan-hang',
								   'id':'<?=$bank['id'];?>',
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

$("#add_ngan_hang div form").submit(function(e) {
    e.preventDefault(); 

    const  form = $(this);
    const url = form.attr('action');
    const method = form.attr('method');

    curl(url,method,form.serialize());

  });    
 </script>

<?php require( '../end.php');?>
