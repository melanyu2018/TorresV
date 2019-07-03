<section class="content-header">
  <h1>
    Users Car
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Information'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('User') ?></dt>
            <dd><?= $usersCar->has('user') ? $this->Html->link($usersCar->user->name, ['controller' => 'Users', 'action' => 'view', $usersCar->user->id]) : '' ?></dd>
            <dt scope="row"><?= __('Car') ?></dt>
            <dd><?= $usersCar->has('car') ? $this->Html->link($usersCar->car->id, ['controller' => 'Cars', 'action' => 'view', $usersCar->car->id]) : '' ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
