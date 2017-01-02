<?php
/* @var $this CargamasivaController */
/* @var $model Cargamasiva */
/* @var $form CActiveForm */
?>


<div class="division">
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cargamasiva-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'modelo'); ?>
		<?php //echo $form->textField($model,'modelo',array('size'=>60,'maxlength'=>100)); ?>
		<?php
		     $datos = $model->enumModels();
			 $valores=array();
			 foreach ($datos  as $clave => $valor) {
				  $valores[$valor]=$valor;
			 }
				echo $form->DropDownList
				(	$model,'modelo',$valores, 
						array(
							'empty'=>'--Escoja el modelo--',
							'disabled'=>($model->isNewRecord)?'':'disabled',
							'ajax' => array(
												'type' => 'POST',  
												'url' => CController::createUrl('Cargamasiva/cargaescenario'), //  la acci贸n que va a cargar el segundo div 
												'update' => '#Cargamasiva_escenario' // el div que se va a actualizar
											),
						     )
				);

		?>
		<?php echo $form->error($model,'modelo'); ?>
	</div>
	
	
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'escenario'); ?>
		<?php //echo $form->textField($model,'modelo',array('size'=>60,'maxlength'=>100)); ?>
		<?php
		    if($model->isNewRecord){

			 $valoresx=array();

				echo $form->DropDownList($model,'escenario',$valoresx, array('empty'=>'--Escoja el escenario--', 'disabled'=>($model->isNewRecord)?'':'disabled'));
			}else {
				
				echo Chtml::textField("SKJKSFS",$model->escenario);
			}
		
		
		
		?>
		<?php echo $form->error($model,'escenario'); ?>
	</div>
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'iduser'); ?>
		<?php echo ($model->isNewRecord)?'':Chtml::textField('iduser',strtoupper(Yii::app()->user->um->loadUserById($model->iduser,false)->username)); ?>
	
	</div>
	
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'fechacreac'); ?>
		<?php echo ($model->isNewRecord)?'':Chtml::textField('fechacreac',$model->fechacreac); ?>
	
	
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'insercion'); ?>
		<?php IF(!$model->insercion=='1') {?>
		<?php echo $form->checkBox($model,'insercion',array('disabled'=>($model->isNewRecord)?'':'disabled')); ?>
		<?php }else {?>
			<?php echo $form->hiddenField($model,'insercion',array('value'=>'1')); ?>
			<?php echo CHTml::checkBox('chcbosinsercion',array('value'=>'1','disabled'=>'disabled')); ?>
		<?php } ?>

		<?php echo $form->error($model,'insercion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>40)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>
	
		<div class="row">
		<?php if(!$model->isNewRecord) { ?>
		<?php echo CHtml::label('Archivo de carga','Archivo de carga'); ?>
		<?php echo CHtml::link('Cargar datos ...',Yii::app()->createUrl('/cargamasiva/import',array('id'=>$model->id))); ?>
		<?php } ?>
		
		
	</div>
	
	
	<div class="row">
	<?php
//echo $model->getulpoaddirectory();
$campoclave=$model->getMetadata()->tableSchema->primaryKey;
$this->widget('ext.coco.CocoWidget'
              ,array(
		'id'=>'cocowidget1',
		'onCompleted'=>'function(id,filename,jsoninfo){  }',
		'onCancelled'=>'function(id,filename){ alert("cancelled"); }',
		'onMessage'=>'function(m){ alert(m); }',
		'allowedExtensions'=>array('csv'), // server-side mime-type validated
		'sizeLimit'=>8000000, // limit in server-side and in client-side
		'uploadDir' => 'carpeta/',
                  //$model->getulpoaddirectory(), // coco will @mkdir it
			// this arguments are used to send a notification
			// on a specific class when a new file is uploaded,
		'buttonText'=>'Subir Archivo',
		'receptorClassName'=>'application.models.'.get_class($model),
                 //'modelin'=> $model,					//'methodName'=>'FileReceptor',
                 'methodName'=>'cargaconajax',
                  
                'userdata'=>$model->{$campoclave}, //OJ ES EL CAMPO CLAVE PARA EL MODELO TEMPRAL
			// controls how many files must be uploaded
		'maxUploads'=>3, // defaults to -1 (unlimited)
		'maxUploadsReachMessage'=>'No esta permitido cargar mas archivos', // if empty, no message is shown
			// controls how many files the can select (not upload, for uploads see also: maxUploads)
		'multipleFileSelection'=>false, // true or false, defaults: true
										//'nombrealt'=>$model->codigo.'',
		));


/*$this->widget('ext.camara.Camara',
					array(
                                            'accion'=>''
					)
				);
                                                
      */                                          
  ?>
</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detalle-grid',
	'dataProvider'=>Cargamasivadet::model()->search_por_carga($model->id),
	'cssFile' => Yii::app()->getTheme()->baseUrl.'/css/grilla_naranja.css',
	//'filter'=>$model,
	'columns'=>array(	
        array(
			'htmlOptions'=>array('width'=>15),
			'class'=>'CButtonColumn',
			 'buttons'=>array(
			 
			 
                        'update'=>
                            array(
                            	   'visible'=>'true',
                                    'url'=>'$this->grid->controller->createUrl("/Cargamasiva/Modificadetalle/",
										    array("id"=>$data->id,
                                                                                         "asDialog"=>1,
											"gridId"=>$this->grid->id,
											)
									    )',
                                    'click'=>('function(){ 
							    $("#cru-detalle").attr("src",$(this).attr("href")); 
							    $("#cru-dialogdetalle").dialog("open");  
							     return false;
							 }'),
								'imageUrl'=>''.Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemaimagenes'].'page_white_edit.png',
								'label'=>'Actualizar Item', 
                                ),


								'delete'=>

                             array(
                             	    'visible'=>'false',
                                    'url'=>'$this->grid->controller->createUrl("/Cargamasiva/borracarga", array("id"=>$data->id))',
							 'options' => array( 'ajax' => array('type' => 'GET','data'=>'Se borro el registro', 'success'=>'reloadGrid' ,'url'=>'js:$(this).attr("href")'),
							  'onClick'=>'Loading.show();Loading.hide(); ',
							 ) ,
						    'imageUrl'=>''.Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemaimagenes'].'hand_point.png',
								'label'=>'Ver detalle',
                                ),	
							

                            


                               'view'=>
                            array(
                            	   'visible'=>'false',
                                    'url'=>'$this->grid->controller->createUrl("/solpe/Reservaitem/",
										    array("id"=>$data->id,
                                                                                         "asDialog"=>1,
											"gridId"=>$this->grid->id,
											"ed"=>"no",

											)
									    )',
                                    'click'=>('function(){ 
							    $("#cru-detalle").attr("src",$(this).attr("href")); 
							    $("#cru-dialogdetalle").dialog("open");  
							     return false;
							 }'),
								'imageUrl'=>''.Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemaimagenes'].'box.png',
								'label'=>'Reservar', 
                                ),

                            ),
	               ),	
		'id',
		'aliascampo',
		array('name'=>'nombrecampo','header'=>'Campo','type'=>'raw','value'=>'($data->esclave=="1")?CHtml::image(Yii::app()->getTheme()->baseUrl.Yii::app()->params["rutatemaimagenes"]."ajustes.png")." - ".$data->nombrecampo:"".$data->nombrecampo'),
		'esclave',
		'requerida',
		'longitud',
		'tipo',
		'orden',
		'activa',
		/*
		'descripcion',
		*/
	
	
	
	
	
	
	
	
	),
)); ?>


</div>
</div><!-- form -->





<?php
	//--------------------- begin new code --------------------------
	// add the (closed) dialog for the iframe
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'cru-dialogdetalle',
		'options'=>array(
			'title'=>'Favorito',
			'autoOpen'=>false,
			'modal'=>true,
			'width'=>500,
			'height'=>400,
			'show'=>'Transform',
		),
	));
	?>
<iframe id="cru-detalle" frameborder="0"  width="100%" height="100%" ></iframe>
<?php
 
$this->endWidget();
//--------------------- end new code --------------------------
?>
<script>
function reloadGrid(data) {
    $.fn.yiiGridView.update('detalle-grid');
	alert(data);
}
</script>