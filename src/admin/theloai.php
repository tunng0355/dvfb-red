<?php 
     $title = 'Quản lý thể loại';
     require( '../head.php'); 
	 require( '../admin.php'); 
     require( '../menu.php');
     // Tiện ích cấu trúc
	 $list = $DB->get_list("SELECT * FROM `theloai` ORDER BY id DESC ");    
?>
<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
                <div class="card-body">
				<div class="row">
					<div class="col-lg-6">
					<div class="media-mb">
							<h5 class="card-title fs-30 h4 title-pages">  
							 <img src="/assets/img/icon/7438562.png" width="45" > Quản lý thể loại
                            </h5>
						 </div>
					</div>
					<div class="col-lg-6">
						<div class="item-end">
							<button class="btn  btn-get font-weight-bolder font-size-sm ml-5" data-bs-toggle="modal" data-bs-target="#add_the_loai"><i class="fa fa-plus-circle"></i> Thêm thể loại </button>
						</div>
					</div>
				</div>
				<div class="modal fade" id="add_the_loai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<form class="modal-content"  method="POST" action="/v1/adn">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Thêm thể loại mới</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body"> 
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">
							  <div class="form-group">
						       <label>name: </label>
						       <input type="text" name="name" value="" class="form-control" placeholder="điền tên thể loại" >
					         </div>
							 <div class="form-group">
						       <label>biểu tượng: </label>
						       <input type="text" name="img" value="" class="form-control" placeholder="dán biểu tượng vào đây dạng html" >
					         </div>
							 <div class="form-group">
						       <label>mã thể loại: </label>
						       <input type="text" name="loai" value="" class="form-control" placeholder="điền mã thể loại" >
					         </div>
						    </div>
							</div>
						   </div>
							<div class="modal-footer">
							    <button type="button" class="btn btn-cam br-9" data-bs-dismiss="modal">Close</button>
								<input type="hidden" name="type" value="them-the-loai" />
								<button type="submit" class="btn btn-primary font-weight-bold br-9" >Thêm thể loại</button>
							</div>
						</div>
					</form>
				</div>
				
		<div class="form-group mt-3">
		<table class="table table-cen">
						<thead>
							<tr>
                                <th scope="col"><a href="#">#id</a></th>
								<th scope="col">tên thể loại</th>
								<th scope="col">biểu tượng</th>
								<th scope="col">mã thể loại</th>
                                <th scope="col">tiện ích</th>
							</tr>
						</thead>
						<tbody>
                        <?php
						 $i= 1; 
						 foreach($list as $theloai)
						 { 
						?>
							<tr>
                                <td><?=$i++;?></td>
								<td><?=$theloai['name'];?></td>
								<td class="img"><?=$theloai['img'];?></td>
								<td><?=$theloai['loai'];?></td>
								<td><button type="button" class="btn btn-edit text-white"data-bs-toggle="modal" data-bs-target="#check_<?=$theloai['id'];?>">xem chi tiết</button></td>
							</tr>

							
							<div class="modal fade" id="check_<?=$theloai['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
							<form method="POST"  action="/v1/adn" class="form-x3">
						    <div class="modal-content">
						    <div class="modal-header">

							<h5 class="modal-title" id="staticBackdropLabel">Chi tiết thể loại</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">	   
							<div class="modal-body mb-4 mt-0">
						    <div class="card-box">

						     <div class="form-group">
						       <label>tên thể loại: </label>
						       <input type="text" name="name_<?=$theloai['id'];?>" value="<?=$theloai['name'];?>" class="form-control" placeholder="Điền tên thể loại" >
					         </div>

							 <div class="form-group">
						       <label>biểu tượng thể loại: </label>
						       <input type="text" name="img_<?=$theloai['id'];?>" value='<?=$theloai['img'];?>' class="form-control" placeholder="Điền biểu tượng thể loại">
					         </div>

							 <div class="form-group">
						       <label>mã thể loại: </label>
							 <div class="input-group">
						        <input type="text" id="the_loai_<?=$theloai['id'];?>" name="loai_<?=$theloai['id'];?>" placeholder="Điền mã thể loại"  value="<?=$theloai['loai'];?>" class="form-control bg-white m-0 br">
					         	<button type="submit" onclick="copy('the_loai_<?=$theloai['id'];?>')" class="btn btn btn-primary btn-hight ">Copy</button>
				         	</div>
                            </div> 

							

						    </div>
						   </div>	
						 </div>

							<div class="modal-footer">
							   <button type="button"  id="detele_the_loai_<?=$theloai['id'];?>" class="btn btn-cam font-weight-bold br-9 w-100 mb-3">Xóa thể loại này</button>
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
						  $("#check_<?=$theloai['id'];?> div form").submit(function(e) {
                            e.preventDefault(); 
							   const  form = $(this);
                               const url = form.attr('action');
                               const method = form.attr('method');

                               curl(url,method,{
								   'type':'edit-the-loai',
								   'id':'<?=$theloai['id'];?>',
								   'name':$('input[name="name_<?=$theloai['id'];?>"]').val(),
								   'img':$('input[name="img_<?=$theloai['id'];?>"]').val(),
								   'loai':$('input[name="loai_<?=$theloai['id'];?>"]').val()
								});

                            });  
		
						  $("#detele_the_loai_<?=$theloai['id'];?>").click(function(){
							    curl('/v1/adn','POST',{
								   'type':'xoa-the-loai',
								   'id':'<?=$theloai['id'];?>',
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

$("#add_the_loai div form").submit(function(e) {
    e.preventDefault(); 

    const  form = $(this);
    const url = form.attr('action');
    const method = form.attr('method');

    curl(url,method,form.serialize());

  });    
 </script>

<?php require( '../end.php');?>
