<?php

class EventosController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','borrarmensaje','creadestinatario','cargaestadoorigen','cargaestadodestino'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$modelin1=new Mensajesd;
		$criteria=new CDbCriteria;

		
		$criteria->addcondition('hidevento='.$id);

		$proveedor= new CActiveDataProvider($modelin1, array(
			'criteria'=>$criteria,
		));
		$this->render('view',array(
			'model'=>$this->loadModel($id),'proveedor'=>$proveedor,
		));
	}


public function actionborrarmensaje($id)
	{

		$modelin1=Mensajesd::model()->find("id=".$id);
		$modelin1->delete();

	}


public function actionCreadestinatario($id)
	{
			$model=new Mensajesd;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
			

		if(isset($_POST['Mensajesd']))
		{
				$model->attributes=$_POST['Mensajesd'];
				if($model->save()) {
										if (!empty($_GET['asDialog']))
												{
													//Close the dialog, reset the iframe and update the grid
													echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
														Yii::app()->end();
												}
			  
										
				
								}else {
									throw new CHttpException(404,'No se pudo grabar el destinatario');;
									
								}
		
		
		//----- begin new code --------------------
				//if (!empty($_GET['asDialog']))
					$this->layout = '//layouts/iframe';
    //----- end new code --------------------
		
		
		
		}
		if (!empty($_GET['asDialog']))
					$this->layout = '//layouts/iframe';
		$this->render('_form_destintario',array('model'=>$model,'id'=>$id));
		
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Eventos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Eventos']))
		{
			$model->attributes=$_POST['Eventos'];
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
	public function actioncargaestadoorigen()
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("c_hcod=:proved");
		$valor=$_POST['Eventos']['codocu'];
		$data=CHtml::listData(	Estado::model()->findAll(  "codocu='".$valor."'"),
		  //$data=CHtml::listData(	Direcciones::model()->findAll(),
												"codestado",
												"estado"
											
												); 
			echo CHtml::tag('option', array('value'=>null),CHtml::encode('Escoja un estado'),true);
			foreach($data as $value=>$name) { 
			    echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
			   } 
	}
	
	
	
	public function actioncargaestadodestino()
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("c_hcod=:proved");
		$valor=$_POST['Eventos']['codocu'];
		$data=CHtml::listData(	Estado::model()->findAll(  "codocu='".$valor."'"),
		  //$data=CHtml::listData(	Direcciones::model()->findAll(),
												"codestado",
												"estado"
											
												); 
			echo CHtml::tag('option', array('value'=>null),CHtml::encode('Escoja un estado'),true);
			foreach($data as $value=>$name) { 
			    echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
			   } 
	}
	
	
	
	
	
	
	
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Eventos']))
		{
			$model->attributes=$_POST['Eventos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}



		$modelin1=new Mensajesd;
		$criteria=new CDbCriteria;

		
		$criteria->addcondition('hidevento='.$id);

		$proveedor= new CActiveDataProvider($modelin1, array(
			'criteria'=>$criteria,
		));
		/*$this->render('view',array(
			'model'=>$this->loadModel($id),'proveedor'=>$proveedor,
		));*/
		$this->render('update',array(
			'model'=>$model,'proveedor'=>$proveedor,
		));
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
		$dataProvider=new CActiveDataProvider('Eventos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new VwEventos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VwEventos']))
			$model->attributes=$_GET['VwEventos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Eventos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Eventos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Eventos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='eventos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
