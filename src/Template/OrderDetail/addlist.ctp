<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderDetail $orderDetail
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Order Detail
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
                echo $this->Form->control('order', ['options' => $orders, ]);
				$count=0;
				for($x=count($p)-1; $x>=0;$x--){
					if(($p[$x])['status']==1){
						echo $this->Form->control('a'.$count, ['label'=>'product', 'options' => [($p[$x])['id']=>($p[$x])['name']], 'readonly'=>'readonly']);
						echo $this->Form->control('b'.$count, ['label'  =>  'unit_price', 'value'=>($p[$x])['price'], 'readonly'=>'readonly']);
						echo $this->Form->control('c'.$count,['label'  =>  'cant', 'value'=>'0']);
						$count++;
					}
				}
                //echo $this->Form->control('total_price');
              ?>
            </div>
            <!-- /.box-body -->

          <?php echo $this->Form->button(__('Pedir')); ?>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
