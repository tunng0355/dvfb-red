<?php 
     $title = 'Cài đặt website';
     require( '../head.php'); 
	 require( '../admin.php'); 
     require( '../menu.php');
     // Tiện ích cấu trúc
?>
<!-- Nội dung -->
<div class="content">
<div class="card tp mb-4">
			<!-- Body -->
			<div class="card-body">
			<div class="card-box">
				<h2 class="card-title h4 title-pages">
               <img src="/assets/img/icon/7438659.png" width="45" > 
              <div class="fs-30">Cài đặt website</div>
            </h2>
         </div>

				<!-- Form -->
				<form method="POST" id="setting" action="/v1/adn">

                <input type="hidden" name="type" value="edit_website" />

					<div class="form-group">
						<label>Tiêu đề :</label>
						<input type="text" value="<?=$DB->setting('title');?>" name="title"  class="form-control"> 
					</div>
                    <div class="form-group">
						<label>mô tả: </label>
						<textarea class="form-control" name="description" rows="3" ><?=$DB->setting('description');?></textarea>
					</div>
                    <div class="form-group">
						<label>keyword: </label>
						<textarea class="form-control" name="keyword" rows="3" ><?=$DB->setting('keyword');?></textarea>
					</div>
                    <div class="form-group">
						<label>Partner ID :</label>
						<input type="text" value="<?=$DB->setting('partner_id');?>" name="partner_id"  class="form-control"> 
					</div>
                    <div class="form-group">
						<label>Partner KEY :</label>
						<input type="text" value="<?=$DB->setting('partner_key');?>" name="partner_key"  class="form-control"> 
					</div>
                    <div class="form-group">
						<label>head: </label>
						<textarea class="form-control" name="head" rows="7" ><?=$DB->setting('head');?></textarea>
					</div>
                    <div class="form-group">
						<label>footer: </label>
						<textarea class="form-control" name="footer" rows="7" ><?=$DB->setting('footer');?></textarea>
					</div>
                    <div class="form-group">
					  <label>trạng thái: </label>
					  <select name="status" class="form-control">
						 <option value="<?=$DB->setting('status');?>">Chọn trạng thái</option>
                         <option value="false">Bảo trì</option>
                         <option value="true">Hoạt động</option>
					  </select>
					</div>
					<button class="btn btn-primary  button-ck w-100 mt-4 mb-4">Cập nhật thông tin</button>
				</form>
			</div>
		</div>

    <!-- End Nội dung -->
</div>
<script type="text/javascript">
  // Request api 
  $("#setting").submit(function(e) {
  e.preventDefault(); 

  const  form = $(this);
  const url = form.attr('action');
  const method = form.attr('method');

  curl(url,method,form.serialize());
	
  });    

</script>
<?php require( '../end.php');?>
