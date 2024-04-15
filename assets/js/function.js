

function curl(url, method, data) {
    var api_token = $('meta[name="api-token"]').attr("content");
          $.ajax({
              type: method,
              url: url,
              data: data, 
              headers:{
                  'api-token':api_token
              },
              dataType: "json",
              success: function(data)
              {
  
                  if(data.status=='error')
                  {
                     var title = "Thất Bại!";
                     var button = "Thử lại";
                  }
                  else
                  {
                      var title = "Thành Công!";
                      var button = "Đồng ý";
                  }
      
                  Swal.fire({
                      title: title,
                      text: data.msg,
                      icon: data.status,
                      confirmButtonText: button
                    });
              }
          });
  }


  function copy(text) {
        var copyText = document.getElementById(text);

        copyText.select();
        
        navigator.clipboard.writeText(copyText.value);

        Swal.fire({
            title: 'Thành Công!',
            text: 'Đã sao chép nội dung thành công',
            icon: 'success',
            confirmButtonText: 'Đồng ý'
        });
  }

function sign(url, method, data) {

    var api_token = $('meta[name="api-token"]').attr("content");
        $.ajax({
            type: method,
            url: url,
            data: data, 
            headers:{
                'api-token':api_token
            },
            dataType: "json",
            success: function(data)
            {

                if(data.status=='error')
                {
                   var title = "Thất Bại!";
                   var button = "Thử lại";
                }
                else
                {
                    var title = "Thành Công!";
                    var button = "Đồng ý";
                    setInterval(() => {
                        window.location.replace("/trang-chu");
                    }, 800);
                }
    
                Swal.fire({
                    title: title,
                    text: data.msg,
                    icon: data.status,
                    confirmButtonText: button
                  });
            }
        });
}

function menu() {

    let sidebar = document.querySelector('.sidebar')	;
    let menu = document.querySelector('button[data-click="menu"]');
    menu.addEventListener("click", ()=>{
        sidebar.classList.toggle("active");
    });
}
$(function() {
    $('.nav-link[href^="'+location.pathname+'"]').addClass('active');
});
$(function() {
    $('.item-v[href^="'+location.pathname+'"]').addClass('active');
});



$(function() {
    var loc = window.location.pathname;
    var dts = loc.substring(0, loc.lastIndexOf('/'));
    $('.nav-link[path="'+dts+'/"]').addClass('active');
	$('.nav-link[path="'+dts+'/"]').click();
});
