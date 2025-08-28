<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array('Posts'=>array('admin'),'Manage');

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'post-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'title',
        array(
            'name'  => 'authorName',
            'value' => '$data->author ? $data->author->username : ""',
        ),
        'created_at',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
));
