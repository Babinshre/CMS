

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">My profile</div>

    <div class="card-body">
        <form action="<?php echo e(route('user.update-profile')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="<?php echo e($user->name); ?>" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label for="about">About</label>
              <textarea class="form-control" name="about" id="about" rows="3"><?php echo e($user->about); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Profile</button>
        </form>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\CMS\resources\views/users/edit.blade.php ENDPATH**/ ?>