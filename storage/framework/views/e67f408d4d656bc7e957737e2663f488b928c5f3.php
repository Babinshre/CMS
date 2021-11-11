
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v3.7.min.css" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card card-default">
        <div class="card-header">
            
            <?php echo e(isset($post) ? 'Edit post' : 'Create post'); ?> 
        </div>
        <div class="card-body">
            <form action="<?php echo e(isset($post) ? route('posts.update',$post->id) : route('posts.store')); ?>" method="POST" enctype="multipart/form-data"> 
                <?php echo csrf_field(); ?>
                <?php if(isset($post)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" name="title" value="<?php echo e(isset($post) ? $post->title : ' '); ?>">
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
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description" rows="3"><?php echo e(isset($post) ? $post->description : ' '); ?></textarea>
                </div>
                <div class="form-group">
                  <label for="category_id">Category</label>
                  <select class="form-control" name="category_id" id="category_id">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($post)): ?>
                        <option  <?php echo e($post->category_id == $category->id ? 'selected' : ''); ?>  value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                        <?php else: ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
                <div class="form-group">
                  <label for="content">content</label>
                    <input id="content" type="hidden" name="content" value="<?php echo e(isset($post) ? $post->content : ' '); ?>">
                    <trix-editor input="content"></trix-editor>
                </div>
                <?php if($tags->count()>0): ?>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select class="form-control tags-selector" name="tags[]" id="tags" multiple>
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tag->id); ?>"
                                <?php if(isset($post)): ?>
                                    <?php if($post->hasTag($tag->id)): ?>
                                        selected
                                    <?php endif; ?>
                                <?php endif; ?>
                               >
                                <?php echo e($tag->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                  </div>
                <?php endif; ?>
                <div class="form-group">
                  <label for="image">Upload image</label>
                  <?php if(isset($post)): ?>
                      <div class="form-group">
                      <img src="<?php echo e(asset('storage/'.$post->image)); ?>" alt="kan" style="width: 20%">
                      </div>
                  <?php endif; ?>
                  <input type="file" class="form-control-file" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
                </div>
                <div class="form-group">
                  <label for="published_at">published_at</label>
                  <input type="text" name="published_at" id="published_at" class="form-control" placeholder="" aria-describedby="helpId" value="<?php echo e(isset($post) ? $post->published_at : ' '); ?>">
                </div>
                
                

                <div class="form-group">
                    <button class="btn btn-success">
                        <?php echo e(isset($post) ? 'Update' : 'Add post'); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at');
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\CMS\resources\views/posts/create.blade.php ENDPATH**/ ?>