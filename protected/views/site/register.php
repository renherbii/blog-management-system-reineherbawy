<?php echo CHtml::errorSummary($model); ?>

<?php
/* @var $this SiteController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle = 'Register';
?>

<h1>Register</h1>

<?php if (Yii::app()->user->hasFlash('success')): ?>
  <div class="flash-success"><?php echo Yii::app()->user->getFlash('success'); ?></div>
<?php endif; ?>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'register-form',
    'enableAjaxValidation'=>false,
)); ?>

  <p class="note">Fields with <span class="required">*</span> are required.</p>
  <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <?php echo $form->labelEx($model,'username'); ?>
    <?php echo $form->textField($model,'username', array('maxlength'=>50)); ?>
    <?php echo $form->error($model,'username'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'email'); ?>
    <?php echo $form->textField($model,'email', array('maxlength'=>100)); ?>
    <?php echo $form->error($model,'email'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password'); ?>
    <?php echo $form->error($model,'password'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'password_repeat'); ?>
    <?php echo $form->passwordField($model,'password_repeat'); ?>
    <?php echo $form->error($model,'password_repeat'); ?>
  </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton('Create account'); ?>
  </div>

<?php $this->endWidget(); ?>
</div>
