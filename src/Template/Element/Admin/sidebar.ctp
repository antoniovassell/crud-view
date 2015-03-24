<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <?= $this->Html->image('antoniovassell.icon.png', [
                    'class' => 'img-circle', 'alt' => 'User Image'
                ]);
                ?>
            </div>
            <div class="pull-left info">
                <p>Antonio Vassell</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <?= $this->App->generateMenu('Admin'); ?>
        </ul><!-- /.sidebar-menu -->
    </section>
</aside>
