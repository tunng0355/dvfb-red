<?php 
     $title = 'Nạp tiền tài khoản';
     require( '../head.php'); 
     require( '../menu.php'); 
     $list = $DB->get_list("SELECT * FROM `bank` ORDER BY id DESC "); 
     $list2 = $DB->get_list("SELECT * FROM `payment` WHERE `username` = '".$DB->users('username')."' ORDER BY id DESC ");    
?>
<!-- Nội dung -->
<div class="content">
    <div class="card tp p4-36 mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="media-mb">
                        <h5 class="card-title fs-30 h4 title-pages"><img src="/assets/img/icon/4051376.png" width="45" /> Chuyển khoản tài khoản</h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="item-end">
                        <a href="/nap-tien" class="btn btn-get font-weight-bolder font-size-sm ml-5"> <i class="fa-solid fa-building-columns"></i> Nạp bằng thẻ cào </a>
                    </div>
                </div>
            </div>
            <div class="alert text-pre-wrap alert-danger-light mt-3 border-dashed">
            <h5 class="bg-heading font-weight-semi-bold">Lưu ý:</h5>
                <p>
                - Cố tình nạp dưới mức nạp không hỗ trợ <br />
                - Nạp sai cú pháp, sai số tài khoản, sai ngân hàng sẽ bị trừ 20% phí giao dịch. Vd: nạp 100k sai nội dung sẽ chỉ nhận được 80k coin và phải liên hệ admin để cộng tay.
                </p>
            </div>
            <ul role="tablist" style="margin-top: 28px; margin-bottom: 28px;" class="nav nav-pills nav-justified flex-column flex-sm-row">
                <li class="nav-item tab-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#card" role="tab" aria-selected="true"> <i class="fa fa-plus-circle"></i> Nạp tiền </a>
                </li>
                <li class="nav-item tab-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#bank" role="tab" aria-selected="true"> <i class="fa fa-list"></i> Lịch sử nạp </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="card" role="tabpanel" aria-labelledby="card">
                    <!-- Body -->
                    <div class="card-body">
                        <!-- Form -->
                        <div class="row">

                        <?php 
						  foreach($list as $bank)
						  {
						 ?>
                            <div class="mb-3 col-sm-6">
                                <h5 class="text-info text-center img-bank"><?=$bank['img']?></h5>
                                <div class="alert text-white bg-timx" role="alert">
                                    <div>Số tài khoản: 
                                    <input type="hidden" id="stk_<?=$bank['id']?>" value="<?=$bank['stk']?>" />
                                    <b class="text-right text-dark stk" onclick="copy('stk_<?=$bank['id']?>');"><?=$bank['stk']?></b></div>
                                    <div>Chủ tài khoản: <b class="text-right"><?=$bank['name']?></b></div>
                                    <div>Nạp tối thiểu: <b class="text-right"><?=format($bank['min'])?> VNĐ</b></div>
                                    <div>Chú ý: <b class="text-right"><?=$bank['content']?></b></div>
                                </div>
                            </div>
                       <?php
                          }
                        ?>
                            <div class="col-md-12">
                                <h5 class="text-primary mb-3">Nội dung chuyển khoản:</h5>
                                <div class="alert text-white bg-ip mb-3" role="alert">
                                    <h4 class="text-white font-weight-semi-bold text-center">
                                        <input type="hidden" id="content_codeRecharge" value="<?=$DB->users('username');?> nap" />
                                        <button onclick="copy('content_codeRecharge');"><b><?=$DB->users('username');?> nap</b> <i class="fa fa-clone"></i></button>
                                    </h4>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank">
                    <div class="card-box" style="padding-top: 0px;">
                        <div class="form-group">
                            <table class="table table-cen">
                                <thead>
                                    <tr>
                                        <th scope="col"><a href="#">#</a></th>
                                        <th scope="col">người chuyển</th>
                                        <th scope="col">số tiền</th>
                                        <th scope="col">nội dung</th>
                                        <th scope="col">thực nhận</th>
                                        <th scope="col">thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
           						   $i =1;
                                   foreach($list2 as $pay)
                                   {
                                 ?>
                                     <tr>
                                         <td><?=$i++;?></td>
                                         <td><?=$pay['stk'];?></td>
                                         <td><?=$pay['money'];?></td>
                                         <td><?=$pay['content'];?></td>
                                         <td><?=format($pay['money']);?></td>
                                         <td><?=$pay['date'];?></td>
                                     </tr>
                                 <?php
                                   }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Body -->
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
</script>
<?php require( '../end.php');?>