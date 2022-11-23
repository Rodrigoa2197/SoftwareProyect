<div class="scrollbar-inner">
    <div class="min-h-500 mh-500">
        <div class="list-group list-group-flush">
            <?php if(count($user_data['projects']) > 0): ?>
                <?php $__currentLoopData = $user_data['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('projects.show',$project)); ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <img <?php echo e($project->img_image); ?> class="avatar rounded-circle"/>
                            </div>
                            <div class="flex-fill pl-3 text-limit">
                                <div class="row">
                                    <div class="col-9">
                                        <h6 class="progress-text mb-1 text-sm d-block text-limit"><?php echo e($project->name); ?></h6>
                                    </div>
                                    <div class="col-3 text-right">
                                        <span class="badge badge-xs badge-<?php echo e((Auth::user()->checkProject($project->id) == 'Owner') ? 'success' : 'warning'); ?>"><?php echo e(Auth::user()->checkProject($project->id)); ?></span>
                                    </div>
                                </div>
                                <div class="progress progress-xs mb-0">
                                    <div class="progress-bar bg-<?php echo e($project->project_progress()['color']); ?>" role="progressbar" style="width: <?php echo e($project->project_progress()['percentage']); ?>;" aria-valuenow="<?php echo e($project->project_progress()['percentage']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between text-xs text-muted text-right mt-1">
                                    <div>
                                        <span class="font-weight-bold text-<?php echo e(\App\Models\Project::$status_color[$project->status]); ?>"><?php echo e(\App\Models\Project::$status[$project->status]); ?></span>
                                    </div>
                                    <div>
                                        <?php echo e($project->countTask($user->id)); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="py-5">
                    <h6 class="h6 text-center"><?php echo e(__('No Projects Found.')); ?></h6>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Frederick\Desktop\UCA\main_file\resources\views/users/project.blade.php ENDPATH**/ ?>