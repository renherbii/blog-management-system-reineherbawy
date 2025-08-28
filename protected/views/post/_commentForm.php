<h4>Add a comment</h4>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'comment-form',
    'enableAjaxValidation'=>true,
    'action' => array('post/view','id'=>$model->id),
    'htmlOptions' => array('onsubmit'=>'return submitComment(this);'),
));
?>
  <?php echo $form->errorSummary($comment); ?>

  <div class="row">
    <?php echo $form->labelEx($comment,'user_name'); ?>
    <?php echo $form->textField($comment,'user_name', array('maxlength'=>100)); ?>
    <?php echo $form->error($comment,'user_name'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($comment,'comment_text'); ?>
    <?php echo $form->textArea($comment,'comment_text', array('rows'=>4)); ?>
    <?php echo $form->error($comment,'comment_text'); ?>
  </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton('Post Comment'); ?>
  </div>
<?php $this->endWidget(); ?>

<script>
function submitComment(form) {
  $.ajax({
    url: form.action,
    type: 'POST',
    data: $(form).serialize(),
    success: function(html) {
      $('#comment-list').prepend(html);
      $('#Comment_user_name').val('');
      $('#Comment_comment_text').val('');
    }
  });
  return false;
}
</script>
