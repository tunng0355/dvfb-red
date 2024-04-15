<?php 
     $title = 'Đăng Ký Tài Khoản';
     require( '../head.php'); 
     $DB->auth();
?>

        <div class="banner">
            <div class="contentx">
                <h1>Đăng Ký</h1>
                <h3>Cùng nhau phát triển một thế giới mới </h3> 
                <img src="/assets/img/icon/4522553.png" alt="banner">
            </div>
        </div>
    <div class="auth">
        <div class="card-auth">
            <div class="headers-auth"> 
                <form method="POST" id="dang_Ky" action="/v1/api"  style="margin-top: -22px;">

                    <input type="hidden" name="type" value="dang-ky" />

                    <div class="form-input">
                        <label>Tài khoản</label>
                        <input type="text"  class="form-controls" name="username" placeholder="vui lòng điền tài khoản"> 
                    </div>
                    <div class="form-input">
                        <label>Mật khẩu</label>
                        <input type="password"  class="form-controls" name="password" placeholder="vui lòng điền mật khẩu"> 
                    </div>

                    <div class="form-input">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password"  class="form-controls" name="confirm_password" placeholder="vui lòng điền lại mật khẩu"> 
                    </div>

                    <input type="submit" class="btn-login mt-2" value="Đăng Ký">

                    <div class="form-input">
                        <div class="mt-3 info-log">
                            <p class="text-gray-400 item-log">Bạn đã có tài khoản? <a href="/dang-nhap" class="link-info fw-bolder">Đăng nhập</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript">
$("#dang_Ky").submit(function(e) {
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