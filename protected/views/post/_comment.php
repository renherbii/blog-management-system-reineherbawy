<div class="comment-item">
  <strong><?php echo CHtml::encode($data->user_name); ?></strong>
  <span style="color:#777"> — <?php echo CHtml::encode($data->created_at); ?></span>
  <div><?php echo nl2br(CHtml::encode($data->comment_text)); ?></div>
  <hr/>
</div>
