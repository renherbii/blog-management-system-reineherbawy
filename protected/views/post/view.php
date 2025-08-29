<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Update Post', 'url'=>array('update', 'id'=>$model->id)),
array('label'=>'Delete Post', 'url'=>'#', 'linkOptions'=>array(
    'submit'=>array('post/delete','id'=>$model->id),
    'params'=>array(
        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken,
    ),
    'confirm'=>'Are you sure you want to delete this item?'
)),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>View Post #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
  'data'=>$model,
  'attributes'=>array(
    'id',
    'title',
    array(
      'label'=>'Author',
      'value'=>$model->author ? $model->author->username : '',
    ),
    'created_at',
    'updated_at',
  ),
)); ?>

<?php echo nl2br(CHtml::encode($model->content)); ?>

<?php $this->renderPartial('_comments', array('model'=>$model)); ?>
<?php $this->renderPartial('_commentForm', array('model'=>$model, 'comment'=>$comment)); ?>