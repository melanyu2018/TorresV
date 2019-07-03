<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo __('Orders') ?>

    <div class="pull-right"><?php echo $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?php echo __('List'); ?></h3>

          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="<?php echo __('Search'); ?>">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('ballot_number') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('reload') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('status_delivery') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('status_payment') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($orders as $order): ?>
                <tr>
                  <td><?= $this->Number->format($order->id) ?></td>
                  <td><?= $this->Number->format($order->ballot_number) ?></td>
                  <td><?= $order->has('user') ? $this->Html->link($order->user->name, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
                  <td><?= $this->Number->format($order->amount) ?></td>
                  <td><?= $this->Number->format($order->reload) ?></td>
                  <td><?= h($order->date) ?></td>
                 
				  <?php if(h($order->status_delivery)==1): ?>
						<td><?= $this->Html->link(__('Delivered'), ['action' => ''], ['class'=>'btn btn-success btn-xs']) ?></td>
	    	  <?php endif; ?>
	    	  <?php if(h($order->status_delivery)==0): ?>
			  <td><?= $this->Form->postLink(__('Deliver'), ['action' => 'deliv', $order->id], ['confirm' => __('Pay for the order? {0}?', $order->ballot_number), 'class'=>'btn btn-danger btn-xs']) ?></td>
            	  <?php endif; ?>
				  
				  
				  <?php if(h($order->status_payment)==1): ?>
						<td><?= $this->Html->link(__('Payed'),['action' => ''] ,['class'=>'btn btn-success btn-xs']) ?></td>
	    	  <?php endif; ?>
	    	  <?php if(h($order->status_payment)	==0): ?>
			  <td><?= $this->Form->postLink(__('Pay'), ['action' => 'pay', $order->id], ['confirm' => __('Pay for the order? {0}?', $order->ballot_number), 'class'=>'btn btn-danger btn-xs']) ?></td>
            	  <?php endif; ?>
				  
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $order->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
