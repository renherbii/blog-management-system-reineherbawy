<?php

class PostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
public function accessRules()
{
    return array(
        array('allow',
            'actions'=>array('index','view'),
            'users'=>array('*'),
        ),

        array('allow',
            'actions'=>array('create','update'),
            'expression'=>'!Yii::app()->user->isGuest && in_array(Yii::app()->user->getState("role"), array("editor","admin"))',
        ),

        array('allow',
            'actions'=>array('admin','delete'),
            'expression'=>'!Yii::app()->user->isGuest && Yii::app()->user->getState("role")==="admin"',
        ),

        array('deny','users'=>array('*')),
    );
}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
{
    $post = $this->loadModel($id);
    $comment = new Comment;
    $comment->post_id = (int)$id;

    if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
        echo CActiveForm::validate($comment);
        Yii::app()->end();
    }

    if (isset($_POST['Comment'])) {
        $comment->attributes = $_POST['Comment'];
        $comment->post_id = $post->id;

        if ($comment->save()) {
            if (Yii::app()->request->isAjaxRequest) {
                $this->renderPartial('_comment', array('data'=>$comment), false, true);
                Yii::app()->end();
            } else {
                $this->redirect(array('view','id'=>$post->id));
            }
        }
    }

    $this->render('view', array(
        'model'   => $post,
        'comment' => $comment,
    ));
}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->author_id = Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
public function actionUpdate($id)
{
    $model = $this->loadModel($id); // already checks if editor owns the post

    if (isset($_POST['Post'])) {
        $model->attributes = $_POST['Post'];
        if ($model->save())
            $this->redirect(array('view','id'=>$model->id));
    }

    $this->render('update', array('model'=>$model));
}



	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
{
    $dataProvider = new CActiveDataProvider('Post', array(
        'pagination' => array('pageSize' => 10),
        'criteria'   => array('order' => 'created_at DESC'),
    ));
    $this->render('index', array('dataProvider' => $dataProvider));
}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Post the loaded model
	 * @throws CHttpException
	 */
public function loadModel($id)
{
    $model = Post::model()->findByPk($id);

    if ($model === null)
        throw new CHttpException(404, 'The requested page does not exist.');

    // Only check for ownership if editor is trying to UPDATE
    if (
        Yii::app()->controller->action->id === 'update' &&
        Yii::app()->user->getState("role") === 'editor' &&
        $model->author_id !== Yii::app()->user->id
    ) {
        throw new CHttpException(403, 'You are not allowed to update this post.');
    }

    return $model;
}


	/**
	 * Performs the AJAX validation.
	 * @param Post $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
