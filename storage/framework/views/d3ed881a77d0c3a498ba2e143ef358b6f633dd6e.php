
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-end mb-2">
    <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">Post</div>
    <div class="card-body">
        <?php if($posts->count()>0): ?>
        <table class="table">
            <thead>
                <th>image</th>
                <th>title</th>
                <th>category</th>
                <th>action</th>               
            </thead>
            <tbody>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <img src="<?php echo e(asset('storage/'.$post->image)); ?>" width="120px" alt="img">
                        </td>
                        <td><?php echo e($post->title); ?></td>
                        <td><?php echo e($post->category->title); ?></td>
                            <?php if($post->trashed()): ?>
                                <td>
                                    <form action="<?php echo e(route('restore-post',$post->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" class="btn btn-sm btn-info" type="submit">Restore</button>
                                    </form>
                                </td>
                            <?php else: ?>
                                <td><a type="button" href="<?php echo e(route('posts.edit',$post->id)); ?>" class="btn btn-sm btn-info" type="submit">Edit</a></td>
                            <?php endif; ?>

                        <td>
                            <form action="<?php echo e(route('posts.destroy',$post->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <?php echo e($post->trashed() ? 'delete' : 'trash'); ?>

                                </button>
                            </form>
                        </td>
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php else: ?>
            <h3 class="textcenter">No post yet</h3>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\CMS\resources\views/posts/index.blade.php ENDPATH**/ ?>