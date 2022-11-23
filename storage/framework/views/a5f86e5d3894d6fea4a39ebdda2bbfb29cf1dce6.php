<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Contract')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
   
<?php if(Auth::user()->type == 'owner'): ?>
    
    <a href="#" class="btn btn-sm btn-white btn-icon-only rounded-circle ml-2" data-url="<?php echo e(route('contractclient.create')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Contract')); ?>">
        <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
    </a>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3 col-6">
            <div class="card comp-card size">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-20"><?php echo e(__('Total Contracts')); ?></h6>
                            <h6 class="text-primary"><?php echo e($cnt_contract['total']); ?></h6>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-success text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-xl-3 col-6">
            <div class="card comp-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-20"><?php echo e(__('This Month Total Contracts')); ?></h6>
                            <h6 class="text-info"><?php echo e($cnt_contract['this_month']); ?></h6>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-info text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-6">
            <div class="card comp-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-20"><?php echo e(__('This Week Total Contracts')); ?></h6>
                            <h6 class="text-warning"><?php echo e($cnt_contract['this_week']); ?></h6>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-warning text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-6">
            <div class="card comp-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-20"><?php echo e(__('Last 30 Days Total Contracts')); ?></h6>
                            <h6 class="text-danger"><?php echo e($cnt_contract['last_30days']); ?></h6>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-danger text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable" id="selection-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Contract')); ?></th>
                                    <th><?php echo e(__('Project')); ?></th>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Client Name')); ?></th>
                                    <th><?php echo e(__('Value')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Start Date')); ?></th>
                                    <th><?php echo e(__('End Date')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th width="250px"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>    
                                        <td class="id">
                                            <a href="<?php echo e(route('contractclient.show', $contract->id)); ?>" class="btn btn-outline-primary"><?php echo e(App\Models\Utility::contractNumberFormat($contract->id)); ?></a>
                                        </td>
                                        <td><?php echo e(!empty($contract->getprojectname) ? $contract->getprojectname->name : '-'); ?> </td>
                                         <td><?php echo e($contract->subject); ?> </td>    
                                        <td><?php echo e(!empty($contract->clientdetail) ? $contract->clientdetail->name : '-'); ?></td>
                                        <td><?php echo e(Auth::user()->priceFormat($contract->value)); ?></td>
                                        <td><?php echo e(!empty($contract->ContractType) ? $contract->ContractType->name : '-'); ?></td>
                                        <td><?php echo e(Auth::user()->dateFormat($contract->start_date)); ?></td>
                                        <td><?php echo e(Auth::user()->dateFormat($contract->end_date)); ?></td>
                                        <td>  
                                            <?php if($contract->status == 'pending'): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__('Pending')); ?></span>
                                            <?php elseif($contract->status == 'accept'): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__('Accept')); ?></span>
                                            <?php else: ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('Decline')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                             <div class="actions">
                                               <?php if($contract->status == 'accept' && Auth::user()->type == 'owner'): ?>
                                                <a href="#" class="action-item px-2"  data-url="<?php echo e(route('contracts.copy',$contract->id)); ?>"  data-ajax-popup="true" data-size="lg"  data-title="<?php echo e(__('Duplicate')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Duplicate')); ?>">
                                                    <i class="fas fa-copy"></i>
                                                </a>
                                                 <?php endif; ?>
                                                  
                                                <a href="<?php echo e(route('contractclient.show', $contract->id)); ?>" class="action-item px-2"   data-title="<?php echo e(__('Show')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Show')); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>  
                                                <?php if(Auth::user()->type == 'owner'): ?>
                                                <a href="#" class="action-item px-2" data-url="<?php echo e(route('contractclient.edit',$contract->id)); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if(Auth::user()->type == 'owner'): ?>
                                                    <a href="#" class="action-item text-danger px-2" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-tax-<?php echo e($contract->id); ?>').submit();">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                            </div>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['contractclient.destroy',$contract->id],'id'=>'delete-tax-'.$contract->id]); ?>

                                                <?php echo Form::close(); ?>

                                                 <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        $(document).on('change', '.client_id', function() {
            var client_id=$(this).val();
            var data = {
                'client_id': client_id,
                _token: $('meta[name="csrf-token"]').attr('content')
                
            }
            $.ajax({
                type: "POST",
                url: "<?php echo e(route('project.by.user.id')); ?>",
                data: data,
                success: function(response) {
                    $('.project').html('');
                    $.each(response, function(index, value) {
                        
                       var html= '<option value="'+index+'">'+value+'</option>';
                           
                            $('.project').append(html);
                        });
                }
            });
           
        });

    </script>   





<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Frederick\Desktop\UCA\main_file\resources\views/contracts/index.blade.php ENDPATH**/ ?>