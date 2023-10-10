<div id="main-content">
    <!--Begin: Section Manga list-->
    <section class="block_area block_area_profile">
        <div class="block_area-header">
            <div class="bah-heading">
                <h2 class="cat-heading"><?php echo e(L::_('Request Permission')); ?></h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="block_area-content">
            <form class="preform" METHOD="POST">
                <?php if(input()->value('submit')): ?>
                    <div class="alert alert-success" id="login-error" style="">Đã gửi yêu cầu, vui lòng đợi BQT xem xét nhé!</div>
                <?php endif; ?>
                <div class="form-group">
                    <label class="prelabel text-bold" for="pro5-email">Tên Nhóm Dịch (Nếu có)</label>
                    <input type="text" name="name_group" class="form-control" value="<?php echo e(input()->value('name_group')); ?>">
                </div>
                <div class="form-group">
                    <label class="prelabel" for="pro5-name">Link Sản Phẩm Đã Làm</label>
                    <input type="url" class="form-control" required name="url_produce" value="<?php echo e(input()->value('url_produce')); ?>">
                </div>
                <div class="form-check custom-control custom-checkbox mb-3">
                    <div class="float-left">
                        <input class="custom-control-input" id="agree" name="agree" type="checkbox" required>
                        <label class="custom-control-label" for="agree">Đồng ý với tất cả <a href="<?php echo e(url('request-permission')); ?>" style="color: #0c84ff!important;">điều khoản</a></label>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <input hidden name="submit" value="permission">
                <input type="submit" class="btn btn-block btn-primary" value="Yêu Cầu">

            </form>
        </div>
    </section>
    <!--End: Section Manga list-->
    <div class="clearfix"></div>
</div><?php /**PATH /www/wwwroot/hoimetruyen.com/resources/views/themes/mangareader/components/user/request-permission.blade.php ENDPATH**/ ?>