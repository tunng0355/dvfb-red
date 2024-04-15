<?=$DB->setting('footer');?>
<script>
$.ajax({
        type: "GET",
        url: "v1/cron",
        dataType: "json",
        success: function(data)
            {
                if(data.status=='success')
                {
                    Swal.fire({
                    title: "Thành Công!",
                    text: data.msg,
                    icon: data.status,
                    confirmButtonText: "Đồng ý"
                  });
                }
        }
});

setInterval(() => {
        $.ajax({
            type: "GET",
            url: "v1/cron",
            dataType: "json",
            success: function(data)
            {
                if(data.status=='success')
                {
                    Swal.fire({
                    title: "Thành Công!",
                    text: data.msg,
                    icon: data.status,
                    confirmButtonText: "Đồng ý"
                  });
                }
        }
    });
}, 2500);
</script>   
<script src="/assets/npm/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
</body>
</html>