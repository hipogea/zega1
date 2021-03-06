<?php
/* @var $this DetguiController */
/* @var $model Detgui */
/* @var $form CActiveForm */
?>

	<div class="wide form">
		<?php
		$habil=$this->eseditablecab($idcabeza);
		$habilitado='disabled'; //Siempre empezando por el lado mas restrictivo, asumimos que no hay permiso
		//if (isset($_GET['ed'])) {   //si alguien coloco la URL EDITAR
		//if ($_GET['ed']=='si') //si se presiono la opcion editar
		if ($habil==='si') //si es editable la guia (VERIFICADO EN BASE DE DATOS)
			$habilitado='';
		?>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'detgui-form',
			'enableClientValidation'=>TRUE,
			'clientOptions' => array(
				'validateOnSubmit'=>TRUE,
				'validateOnChange'=>TRUE  ,
			),
			'enableAjaxValidation'=>FALSE,
		)); ?>

		<?php echo $form->errorSummary($model); ?>
		<div class="row">
			<?php echo ($model->isNewRecord)?$form->hiddenField($model,'hidvale',array('value'=>$idcabeza)):''; ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'codart'); ?>
			<?php if ($this->eseditable($model->codestado)=='')

			{

				$this->widget('ext.matchcode.MatchCode',array(
					'nombrecampo'=>'codart',
					'ordencampo'=>6,
					'controlador'=>'Tempalkardex',
					'relaciones'=>$model->relations(),
					'tamano'=>8,
					'model'=>$model,
					'form'=>$form,
					'nombredialogo'=>'cru-dialog3',
					'nombreframe'=>'cru-frame3',
					'nombrearea'=>'fhdfj',
				));

			} else{
				echo CHtml::textField('a',$model->maestro->descripcion,array('disabled'=>'disabled','size'=>40)) ;

			}

			?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'cant'); ?>
			<?php echo $form->textField($model,'cant',array('size'=>8,'maxlength'=>8, 'disabled'=>$habilitado)); ?>
			<?php echo $form->error($model,'cant'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'preciounit'); ?>
			<?php echo $form->textField($model,'preciounit',array('size'=>8,'maxlength'=>8, 'disabled'=>$habilitado)); ?>
			<?php echo $form->error($model,'preciounit'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'um'); ?>
			<?php
			$datos = CHtml::listData(Ums::model()->findAll(),'um','desum');
			echo $form->DropDownList($model,'um',$datos, array('cols'=>4,'empty'=>'--Unidad de medida--', 'disabled'=>$habilitado)  )  ;
			?>
			<?php echo $form->error($model,'um'); ?>
		</div>


		<?php echo $form->hiddenField($model,'codcentro'); ?>
		<?php echo $form->hiddenField($model,'alemi'); ?>





		<div id ="zonamaterial" class="consultastock">


		</div>










		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar'); ?>
		</div>

		<?php $this->endWidget(); ?>

	</div><!-- form -->



<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'cru-dialog3',
	'options'=>array(
		'title'=>'Explorador',
		'autoOpen'=>false,
		'modal'=>true,
		'width'=>800,
		'height'=>500,
	),
));
?>
	<iframe id="cru-frame3" width="100%" height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?>