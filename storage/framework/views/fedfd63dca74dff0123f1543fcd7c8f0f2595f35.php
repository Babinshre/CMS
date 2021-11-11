
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-end mb-2">
    <a href="<?php echo e(route('tags.create')); ?>" class="btn btn-success">Create tag</a>
</div>
    <div class="card card-default">
        <div class="card-header">tags</div>
        <div class="card-body">
          <?php if($tags->count()>0): ?>      
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Post count</th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($tag->title); ?>

                            </td>
                            <td><?php echo e($tag->posts->count()); ?></td>
                            <td>
                                
                                <a class="btn btn-info btn-sm" href="<?php echo e(route('tags.edit',$tag->id)); ?>">Edit</a> 
                            </td>
                            <td>
                              <button class="btn btn-sm btn-danger" onclick="handleDelete(<?php echo e($tag->id); ?>)">delete</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
          <?php else: ?>
              <h3 class="textcenter">No tag added yet</h3>
          <?php endif; ?>
              <!-- Modal -->
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">Delete
                  <form action="" method="POST" id="deletetagForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="text-center text-bold">
                          Are you sure you want to delete tag?
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
      function handleDelete(id){
        var form = document.getElementById('deletetagForm');
        form.action = '/tags/'+id;
        console.log('deleting..',id);
        $('#deleteModal').modal('show');
      }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\CMS\resources\views/tags/index.blade.php ENDPATH**/ ?>