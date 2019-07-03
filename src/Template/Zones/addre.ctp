<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Zone $zone
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Zone
      <small><?php echo __('Add'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Form'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
		  
		  
		 <?php echo $this->Form->create(); ?>
            <div class="box-body">
              <?php
               // echo $this->Form->control('quantity_dealers');
                echo $this->Form->control('zones', ['options' => $zoness]);
              ?>
            </div>
            <!-- /.box-body -->

          <?php echo $this->Form->submit(__('Submit'));
				echo $this->Form->end();
				?>
		  
		  
          <?php echo $this->Form->create($zone, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('name');
                echo $this->Form->control('status');
               // echo $this->Form->control('quantity_dealers');
                echo $this->Form->control('users._ids', ['label'=>'Users', 'value'=>$ids, 'readonly'=>'readonly']);
              ?>
            </div>
            <!-- /.box-body -->

          <?php echo $this->Form->submit(__('Submit')); ?>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
