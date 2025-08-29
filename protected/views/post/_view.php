<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
	<?php echo CHtml::encode($data->author_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<?php if (!Yii::app()->user->isGuest): ?>
		<div style="margin-top: 10px;">
			<?php
			$role = Yii::app()->user->getState('role');
			if (in_array($role, array('admin', 'editor'))):
				echo CHtml::link('Update', Yii::app()->createUrl('post/update', array('id' => $data->id)));

			endif;

			if ($role === 'admin') {
				echo ' | ';
				echo CHtml::link('Delete', '#', array(
  				'submit' => array('post/delete', 'id' => $data->id),
  				'params' => array(
    			Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken,
  				),
  				'confirm' => 'Are you sure you want to delete this post?',
				));



			}
			?>
		</div>
	<?php endif; ?>

</div>
