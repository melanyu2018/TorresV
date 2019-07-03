
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <h1><?= __('Login') ?></h1>
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
		<?php if(is_null($this->request->getSession()->read('Auth.User.name'))):?>
        <div class="box box-primary">
		
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Form'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">
                <?= $this->Form->create() ?>
				<?= $this->Form->control(__('email')) ?>
				<?= $this->Form->control('password') ?>
			  <!-- show captcha image -->
			  <?= captcha_image_html() ?> 
			  <!-- Captcha code user input textbox --> 
			  <?= $this->Form->input('CaptchaCode', [ 
				'label' => 'Retype the characters from the picture:', 
				'maxlength' => '10', 
				'style' => 'width: 270px;', 
				'id' => 'CaptchaCode' 
			  ])
              ?>
            </div>
            <!-- /.box-body -->

<?= $this->Form->button(__('Login')) ?>
<?= $this->Form->end() ?>
        </div>
        <?php else:?>
            <div class="box-body">
					<h2><?php
					$userl=$this->request->getSession()->read('Auth.User.name');
					echo __('Session started with user '.$userl)?>
					</h2>
			</div>
		<?php endif?>
		<!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
