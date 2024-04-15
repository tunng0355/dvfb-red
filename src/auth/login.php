<?php 
     $title = 'Đăng Nhập Tài Khoản';
     require( '../head.php'); 
	 $DB->auth();
?>
<div class="banner">
	<div class="contentx">
		<h1>Đăng Nhập</h1>
		<h3>Cùng nhau phát triển một thế giới mới </h3> 
        <img src="/assets/img/icon/4522545.png" alt="banner"> 
    </div>
</div>
<div class="auth">
	<div class="card-auth">
		<div class="headers-auth">
			<form method="POST" id="dang_nhap" action="/v1/api" class="form-x3">
			    <input type="hidden" name="type" value="dang-nhap" />

				<div class="form-input mb-2">
					<label>Username</label>
					<input type="text"  class="form-controls" name="username" placeholder="vui lòng điền tài khoản" />
                 </div>

				<div class="form-input mb-2">
					<label>Password</label>
					<input type="password"   class="form-controls" name="password" placeholder="vui lòng điền tài khoản" /> 
                </div>

				<input type="submit" class="btn-login mt-2 " value="Đăng Nhập">

				<div class="form-input">
					<div class="mt-4 info-log">
						<p class="text-gray-400 item-log">Bạn chưa có tài khoản? <a href="dang-ky" class="link-info fw-bolder">Tạo tài khoản</a> </p>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$("#dang_nhap").submit(function(e) {
  e.preventDefault(); 

  const  form = $(this);
  const url = form.attr('action');
  const method = form.attr('method');

  sign(url,method,form.serialize());
	
});    
</script>
<?php 
     require( '../end.php'); 
?>