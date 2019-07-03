<section class="content-header">
  <h1>
    Order
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
            <dd><?= $order->has('user') ? $this->Html->link($order->user->name, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($order->id) ?></dd>
            <dt scope="row"><?= __('Ballot Number') ?></dt>
            <dd><?= $this->Number->format($order->ballot_number) ?></dd>
            <dt scope="row"><?= __('Amount') ?></dt>
            <dd><?= $this->Number->format($order->amount) ?></dd>
            <dt scope="row"><?= __('Reload') ?></dt>
            <dd><?= $this->Number->format($order->reload) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($order->date) ?></dd>
            <dt scope="row"><?= __('Status Delivery') ?></dt>
            <dd><?= $order->status_delivery ? __('Yes') : __('No'); ?></dd>
            <dt scope="row"><?= __('Status Payment') ?></dt>
            <dd><?= $order->status_payment ? __('Yes') : __('No'); ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Order Detail') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($order->order_detail)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Order Id') ?></th>
                    <th scope="col"><?= __('Code') ?></th>
                    <th scope="col"><?= __('Cant') ?></th>
                    <th scope="col"><?= __('Unit Price') ?></th>
                    <th scope="col"><?= __('Total Price') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($order->order_detail as $orderDetail): ?>
              <tr>
                    <td><?= h($orderDetail->id) ?></td>
                    <td><?= h($orderDetail->order_id) ?></td>
                    <td><?php 
						$idp=$orderDetail->product_id;
						foreach ($pr as $p){
							if($p->id==$idp){
								echo ($p->code);
							}
						}
						?></td>
                    <td><?= h($orderDetail->cant) ?></td>
                    <td><?= h($orderDetail->unit_price) ?></td>
                    <td><?= h($orderDetail->total_price) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'OrderDetail', 'action' => 'view', $orderDetail->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <!--<php?= $this->Html->link(__('Edit'), ['controller' => 'OrderDetail', 'action' => 'edit', $orderDetail->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <php?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderDetail', 'action' => 'delete', $orderDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderDetail->id), 'class'=>'btn btn-danger btn-xs']) ?>
             -->     </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
