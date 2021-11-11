
<?php $__env->startSection('content'); ?>
    <div class="card card-default">
        <div class="card-header">
            
            <?php echo e(isset($category) ? 'Edit category' : 'Create category'); ?> 
        </div>
        <div class="card-body">
            <form action="<?php echo e(isset($category) ? route('categories.update',$category->id) : route('categories.store')); ?>" method="POST"> 
                <?php echo csrf_field(); ?>
                <?php if(isset($category)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" id="title" class="form-control" name="title" value="<?php echo e(isset($category) ? $category->title : ' '); ?>">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        <?php echo e(isset($category) ? 'Update' : 'Add category'); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\CMS\resources\views/categories/create.blade.php ENDPATH**/ ?>