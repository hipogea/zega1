<?php
/* @var $this TipoactivosController */
/* @var $model Tipoactivos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipoactivos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'codtipo'); ?>
		<?php echo $form->textField($model,'codtipo',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'codtipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destipo'); ?>
		<?php echo $form->textField($model,'destipo',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'destipo'); ?>
	</div>

 <div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->checkBox($model,'activo'); ?>
		
	</div>
        
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->