<section class="content-header">
  <h1>
    Order Detail
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
            <dt scope="row"><?= __('Order') ?></dt>
            <dd><?= $orderDetail->has('order') ? $this->Html->link($orderDetail->order->id, ['controller' => 'Orders', 'action' => 'view', $orderDetail->order->id]) : '' ?></dd>
            <dt scope="row"><?= __('Product') ?></dt>
            <dd><?= $orderDetail->has('product') ? $this->Html->link($orderDetail->product->name, ['controller' => 'Products', 'action' => 'view', $orderDetail->product->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($orderDetail->id) ?></dd>
            <dt scope="row"><?= __('Cant') ?></dt>
            <dd><?= $this->Number->format($orderDetail->cant) ?></dd>
            <dt scope="row"><?= __('Unit Price') ?></dt>
            <dd><?= $this->Number->format($orderDetail->unit_price) ?></dd>
            <dt scope="row"><?= __('Total Price') ?></dt>
            <dd><?= $this->Number->format($orderDetail->total_price) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
