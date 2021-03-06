<?php 
$this->menu=array(
	//array('label'=>'List Docingresados', 'url'=>array('index')),
	array('label'=>'Ingresar Documento', 'url'=>array('create')),
    array('label'=>'Certificados Dicapi', 'url'=>array('certificadosdicapi')),
      array('label'=>'Listado detallado', 'url'=>array('detalles')),
     array('label'=>'Ingresar certificado', 'url'=>array('create','cert'=>'yes')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('docingresados-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>
  
 
<?php MiFactoria::titulo('Ingreso de Documentos','attach');
  ?>



<div class="search-form" >
<?php

$this->renderPartial('_search',array(
	'model'=>$model,
)); 

?>
</div>
<?php
//echo  CHtml::openTag("span",array("class"=>"icon icon-man icon-blue icon-fuentesize32")).'hola amiguito'.CHtml::closeTag("span");

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'docingresados-admin'	
)); ?>

<?php $gridWidget=$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'docingresados-grid',
	'dataProvider'=>$model->search(),
    'itemsCssClass'=>'table table-striped table-bordered table-hover',
	//'cssFile' => ''.Yii::app()->getTheme()->baseUrl.'grid_pyy.css',  // your version of css file
	
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		   array(
            'class'=>'CCheckBoxColumn',
           'selectableRows' => 120,
            'value'=>'$data->id',
            'checkBoxHtmlOptions' => array(
                'name' => 'cajita[]'),
            // 'id'=>'cajita' // the columnID for getChecked
                      ),
		
		//'desdocu',  
            'tipodoc',
		array('name'=>'correlativo','type'=>'raw','value'=>'CHTml::openTag("span",array("style"=>"border-radius:3px;padding:4px;background-color:$data->color"))."     ".CHTml::closeTag("span")." .".CHTml::link($data->correlativo,yii::app()->createUrl("docingresados/update",array("id"=>$data->id)),array("target"=>"_blank"))','htmlOptions'=>array('width'=>70)),
		'id',
            'numero',
		'moneda',
		'monto',
           array('name'=>'codtenencia','type'=>'raw','value'=>'CHTml::openTag("span",array("class"=>"label label-1504")).$data->codtenencia.CHTml::closeTag("span")'),
		
		//'codprov',
		'despro',
             array('name'=>'Refer','type'=>'raw','value'=>'$data->nomep'),
	
		array(
			'name'=>'fecha',
			'value'=>'date("d.m.y", strtotime($data->fecha))','htmlOptions'=>array('width'=>'30')
		),
		array(
			'name'=>'fechain',
			'value'=>'date("d.m.y", strtotime($data->fechain))','htmlOptions'=>array('width'=>'30')
		),	
		'numdocref',
            array(
			'name'=>'cuantoshay','type'=>'raw',
			'value'=>'Chtml::image(Yii::app()->getTheme()->baseUrl.DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."attach_2.png").CHtml::openTag("span",array("class"=>"label badge-warning"),true).$data->cuantosfileshay()','htmlOptions'=>array('width'=>'30')
		),
            // array('name'=>'falta','type'=>'raw','value'=>'($data->tiempofaltante())','htmlOptions'=>array('width'=>120)),
           
		'ap',
            'descripcion',
            
           // array('name'=>'ad','type'=>'raw','value'=>'$data->procesoactivo[0]->tenenciasproc->eventos->descripcion'),
		//'apoderado',
		//'estado',
	
		/*
		'moneda',
		'descorta',
		'codepv',
		'monto',
		'codgrupo',
		'codresponsable',
		'creadopor',
		'creadoel',
		'texv',
		'docref',
		*/
		array(
			'class'=>'CButtonColumn',
			
			 'buttons'=>array(
			 
			  'view'=>
                            array(
                                   
								'visible'=>'false',
                                ),
						 
                        'update'=>
                            array(
                                    'url'=>'$this->grid->controller->createUrl(
                                        "/Docingresados/update",
                                          array("id"=>$data->id),
                                            array("target"=>"_blank")
                                            )',
                                    
								'label'=>'Modificar', 
                                ),
								'delete'=>
                            array(
                                   
								'visible'=>'false',
                            ),
			
				),
			),
))); ?>


		<?php
				$botones=array(
					
					 'briefcase' => array(
                            'type' => 'D', //AJAX LINK
                          //  'ruta' => array('coordocs/hacereporte', array('id' => $model->idreporte, 'idfiltrodocu' => $model->idguia, 'file' => 1)),
                            'ruta' => array($this->id . '/poneralcarro', array()),
                            'opajax'=>array(
                                'type'=>'POST',
                               // 'url'=>array('coordocs/hacereporte', array('id' => $model->idreporte, 'idfiltrodocu' => $model->idguia, 'file' => 1)),
                                'ruta' => array($this->id . '/poneralcarro', array()),
                                'success'=>"function(data) {
					$.growlUI('Growl Notification', data); 
                                    }",
                            ),                           
                            'visiblex' => array('10'),

                        ),		
'clear' => array(
                            'type' => 'D', //AJAX LINK
                          //  'ruta' => array('coordocs/hacereporte', array('id' => $model->idreporte, 'idfiltrodocu' => $model->idguia, 'file' => 1)),
                            'ruta' => array($this->id . '/limpiarcarro', array()),
                            'opajax'=>array(
                                'type'=>'POST',
                               // 'url'=>array('coordocs/hacereporte', array('id' => $model->idreporte, 'idfiltrodocu' => $model->idguia, 'file' => 1)),
                                'ruta' => array($this->id . '/limpiarcarro', array()),
                                'success'=>"function(data) {
					$.growlUI('Growl Notification', data); 
                                    }",
                            ),                           
                            'visiblex' => array('10'),

                        ),
                                    
                            'ok'=>array(
						'type'=>'B',
						'ruta'=>array($this->id.'/procesavarios',array()),//apreuba guia
						'visiblex'=>array('10'),
                                            ),        
                                    

			);
				$this->widget('ext.toolbar.Barra',
					array(
						//'botones'=>MiFactoria::opcionestoolbar($model->id,$this->documento,$model->codestado),
						'botones'=>$botones,
						'size'=>24,
						'extension'=>'png',
						'status'=>'10',

					)
				); ?>	




<?php $this->endWidget(); ?>


<?php
//Capture your CGridView widget on a variable
//$gridWidget=$this->widget('bootstrap.widgets.TbGridView', array( . . .
$this->renderExportGridButton($gridWidget,'Exportar resultados',array('class'=>'btn btn-info pull-right'));
?>


<?php
//--------------------- begin new code --------------------------
   // add the (closed) dialog for the iframe
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'cru-dialog3',
    'options'=>array(
        'title'=>'Actualizar Ingreso',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>750,
        'height'=>510,
    ),
    ));
?>
<iframe id="cru-frame3" width="100%" height="100%"></iframe>
<?php
 
$this->endWidget();


?>



