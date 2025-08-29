<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posts',
);

$this->menu = array();

if (!Yii::app()->user->isGuest) {
    $this->menu[] = array('label' => 'Create Post', 'url' => array('create'));

    if (Yii::app()->user->getState('role') === 'admin') {
        $this->menu[] = array('label' => 'Manage Post', 'url' => array('admin'));
    }
}

?>

<h1>Posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
