<?php $__currentLoopData = $taxonomys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxonomy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a class="btn btn-info" href="<?php echo e(url(null, ['type' => $taxonomy->taxonomy])); ?>"><?php echo e(ucfirst($taxonomy->taxonomy)); ?></a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH D:\ANHNGHIA\HoiMeTruyen\resources\views/admin/components/taxonomy/all.blade.php ENDPATH**/ ?>