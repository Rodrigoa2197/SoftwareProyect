<?php $__env->startPush('css-page'); ?>
<?php echo $__env->make('Chatify::layouts.headLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Messenger')); ?>

<?php $__env->stopSection(); ?>

<?php
// $color = App\Models\Utility::color();
$setting = App\Models\Utility::colorset();
$color = (!empty($setting['color'])) ? $setting['color'] : '#6fd943';
$avatar = \App\Models\Utility::get_file('/');
?>

<?php $__env->startSection('content'); ?>
<div class="card rounded-12">    
    <div class="messenger rounded min-h-750 overflow-hidden py-2">
        
        <div class="messenger-listView">
            
            <div class="m-header">
                <nav>
                    <nav class="m-header-right">
                        <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                    </nav>
                </nav>
                
                <input type="text" class="messenger-search" placeholder="<?php echo e(__('Search')); ?>" />
                
                <div class="messenger-listView-tabs">
                    <a href="#" <?php if($route == 'user'): ?> class="active-tab" <?php endif; ?> data-view="users">
                         <span class="fas fa-clock" title="<?php echo e(__('Recent')); ?>"></span>
                     </a>
                    <a href="#" <?php if($route == 'group'): ?> class="active-tab" <?php endif; ?> data-view="groups">
                        <span class="fas fa-users" title="<?php echo e(__('Members')); ?>"></span></a>
                </div>
            </div>
            
            <div class="m-body">
               
               
               <div class="<?php if($route == 'user'): ?> show <?php endif; ?> messenger-tab app-scroll" data-view="users">

                   
                    <p class="messenger-title">Favorites</p>
                    <div class="messenger-favorites app-scroll-thin"></div>

                   
                   <?php echo view('Chatify::layouts.listItem', ['get' => 'saved','id' => $id])->render(); ?>


                   
                   <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);position: relative;"></div>

               </div>

               
               <div class="all_members <?php if($route == 'group'): ?> show <?php endif; ?> messenger-tab app-scroll" data-view="groups">
                        <p style="text-align: center;color:grey;"><?php echo e(__('Soon will be available')); ?></p>
                    </div>

                 
               <div class="messenger-tab app-scroll" data-view="search">
                    
                    <p class="messenger-title"><?php echo e(__('Search')); ?></p>
                    <div class="search-records">
                        <p class="message-hint center-el"><span><?php echo e(__('Type to search..')); ?></span></p>
                    </div>
                 </div>
            </div>
        </div>

        
        <div class="messenger-messagingView">
            
            <div class="m-header m-header-messaging">
                <nav>
                    
                    <div style="display: inline-block;">
                            <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i> </a>
                            <?php if(!empty(Auth::user()->avatar)): ?>
                                <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('<?php echo e($avatar.Auth::user()->avatar); ?>');"></div>
                            <?php else: ?>
                                <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('<?php echo e($avatar.'avatar.png'); ?>');"></div>
                            <?php endif; ?>
                            <a href="#" class="user-name"><?php echo e(config('chatify.name')); ?></a>
                        </div>
                    
                    <nav class="m-header-right">
                        <a href="#" class="add-to-favorite my-lg-1 my-xl-1 mx-lg-3 mx-xl-3"><i class="fas fa-star"></i></a>
                        <a href="#" class="show-infoSide my-lg-1 my-xl-1 mx-lg-3 mx-xl-3"><i class="fas fa-info-circle"></i></a>
                    </nav>
                </nav>
            </div>
            
            <div class="internet-connection">
                <span class="ic-connected"><?php echo e(__('Connected')); ?></span>
                <span class="ic-connecting"><?php echo e(__('Connecting...')); ?></span>
                <span class="ic-noInternet"><?php echo e(__('Please add pusher settings for using messenger.')); ?></span>
            </div>
            
            <div class="m-body app-scroll w-100">
                <div class="messages">
                    <p class="message-hint"><span><?php echo e(__('Please select a chat to start messaging')); ?></span></p>
                </div>

                
                <div class="typing-indicator">
                    <div class="message-card typing">
                        <p>
                            <span class="typing-dots">
                                <span class="dot dot-1"></span>
                                <span class="dot dot-2"></span>
                                <span class="dot dot-3"></span>
                            </span>
                        </p>
                    </div>
                </div>
                
                <?php echo $__env->make('Chatify::layouts.sendForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        
        <div class="messenger-infoView app-scroll text-center">
            
            <nav class="text-center">
                <a href="#"><i class="fas fa-times"></i></a>
            </nav>
            <?php echo view('Chatify::layouts.info')->render(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <?php echo $__env->make('Chatify::layouts.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>



<style type="text/css">
    .m-list-active, .m-list-active:hover, .m-list-active:focus {
    background: <?php echo e($color); ?> !important;
}
.mc-sender p {
    background: <?php echo e($color); ?> !important;
}

.messenger-favorites div.avatar {
    box-shadow: 0px 0px 0px 2px <?php echo e($color); ?> !important;
}
.messenger-listView-tabs a, .messenger-listView-tabs a:hover, .messenger-listView-tabs a:focus {
    color: <?php echo e($color); ?> !important;
}
.m-header svg {
    color: <?php echo e($color); ?> !important;
}
.active-tab {
    border-bottom: 2px solid <?php echo e($color); ?> !important;
}
.messenger-infoView nav a {
  
    color: <?php echo e($color); ?> !important;
}


.messenger-list-item td span .lastMessageIndicator {

    color: <?php echo e($color); ?> !important;
    font-weight: bold;
}
.messenger-sendCard button svg {
     color: <?php echo e($color); ?> !important;
}


.mc-sender p sub {
    color: #fff !important;
}

.mc-sender p {
    direction: ltr;
    color: #fff !important;
}

.m-list-active  td span .lastMessageIndicator{
     color: #fff !important;
}


.messenger-list-item td b {
    
    background-color:  <?php echo e($color); ?> !important;
}

</style>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Frederick\Desktop\UCA\main_file\resources\views/vendor/Chatify/pages/app.blade.php ENDPATH**/ ?>