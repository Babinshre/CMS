
<?php $__env->startSection('content'); ?>
<div class="card card-default">
    <div class="card-header">Users</div>
    <div class="card-body">
        <?php if($users->count()>0): ?>
        <table class="table">
            <thead>
                <th>image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
                              
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <img width="40px" height="40px" style="border-radius: 50%" src="<?php echo e(Gravatar::src($user->email)); ?>" alt="" srcset="">
                        </td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <?php if(!$user->isAdmin()): ?>
                            <form action="<?php echo e(route('user.make-admin',$user->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <button type="submit" href="#" class="btn btn-sm btn-primary">Make admin</button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php else: ?>
            <h3 class="textcenter">No Users yet</h3>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\CMS\resources\views/users/index.blade.php ENDPATH**/ ?>