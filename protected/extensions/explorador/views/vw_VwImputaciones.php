
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
	'method'=>'GET',
)); ?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'Inventario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'cssFile' => Yii::app()->getTheme()->baseUrl.'/css/grilla_naranja.css',
	'columns'=>array(
						array(
									'class'=>'CCheckBoxColumn',
									'selectableRows' => 1,
									'value'=>'$data->codc',
									'checkBoxHtmlOptions' => array(                
																'name' => 'checkselected[]',
																	),
           // 'id'=>'cajita' // the columnID for getChecked
							),
	
		'codc',
		array('name'=>'clasecolector',
			'type'=>'raw',
			'value'=>'$data->desimputa',
			'filter'=>CHtml::listData(Tipimputa::model()->findAll(),'codimpu','desimputa'  )
		     ),
		'desceco',
		//'desimputa',

				)
)); ?>


<div class="row buttons">
		<?php echo CHtml::submitButton('Seleccionar'); ?>
	</div>
<?php $this->endWidget(); ?>