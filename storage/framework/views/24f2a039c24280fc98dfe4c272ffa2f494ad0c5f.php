<?php echo e(Form::open(array('route' => array('project.milestone.store',$project->id)))); ?>

<div class="row">
    <div class="form-group col-md-6">
        <?php echo e(Form::label('title', __('Title'),['class' => 'form-control-label'])); ?>

        <?php echo e(Form::text('title', null, array('class' => 'form-control','required'=>'required'))); ?>

        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-title" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('status', __('Status'),['class' => 'form-control-label'])); ?>

        <?php echo Form::select('status',\App\Models\Project::$status, null,array('class' => 'form-control','required'=>'required')); ?>

        <?php $__errorArgs = ['client'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-client" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<div class="row">
    <div class="form-group  col-md-12">
        <?php echo e(Form::label('description', __('Description'),['class' => 'form-control-label'])); ?>

        <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-description" role="alert">
        <strong class="text-danger"><?php echo e($message); ?></strong>
    </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-12 text-right">
        <?php echo e(Form::button(__('Save'), ['type' => 'submit','class' => 'btn btn-sm btn-primary rounded-pill'])); ?>

        <button type="button" class="btn btn-sm btn-secondary rounded-pill" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\Users\Frederick\Desktop\UCA\main_file\resources\views/projects/milestone.blade.php ENDPATH**/ ?>