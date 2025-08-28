<h3>Comments</h3>
<div id="comment-list">
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => new CActiveDataProvider('Comment', array(
        'criteria' => array(
            'condition' => 'post_id=:pid',
            'params'    => array(':pid'=>$model->id),
            'order'     => 'created_at DESC',
        ),
        'pagination' => array('pageSize'=>5),
    )),
    'itemView' => '_comment',
));
?>
</div>
