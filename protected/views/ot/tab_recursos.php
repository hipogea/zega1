<DIV>

<?php
$prove=$modelolabor->search_por_ot($model->id);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detalle-recursos-grid',
	'dataProvider'=>$prove,
	'filter'=>$modelolabor,
	'itemsCssClass'=>'table table-striped table-bordered table-hover',
   'summaryText'=>' Total de Items : {count}',
	'columns'=>array(
            
		array(
           'class'=>'CCheckBoxColumn',
		    'selectableRows' => 20,
		    'value'=>'$data->idtemp',
			'checkBoxHtmlOptions' => array(                
				'name' => 'cajitarecursos[]',
		   ),
                ),
		array(
			'class'=>'CButtonColumn',
                      'htmlOptions'=>array('width'=>80),
			'buttons'=>array(

				'view'=>
					array(
						'visible'=>'true',
						'url'=>'$this->grid->controller->createUrl("/Ocompra/Verdetoc/",
										    array("id"=>$data->id,"action"=>$this->grid->controller->action->id,
                                                                                         "asDialog"=>1,
											"gridId"=>$this->grid->id
											)
									    )',
						'click'=>('function(){
							    $("#cru-detalle").attr("src",$(this).attr("href"));
							    $("#cru-dialogdetalle").dialog("open");
							     return false;
							 }'),
						'imageUrl'=>''.Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemagrid'].'find.png',
						'label'=>'Visualizar Item',
					),

				'update'=>
					array(
						'visible'=>($this->eseditable($model->{$this->campoestado}))?'false':'true',
						'url'=>'$this->grid->controller->createUrl("/Ot/Modificadetallerecurso/",
										    array("id"=>$data->idtemp,
                                                                                         "asDialog"=>1,
											"gridId"=>$this->grid->id
											)
									    )',
						'click'=>('function(){
							    $("#cru-detalle").attr("src",$(this).attr("href"));
							    $("#cru-dialogdetalle").dialog("open");
							     return false;
							 }'),
						'imageUrl'=>''.Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemagrid'].'update.png',
						'label'=>'Actualizar Item',
					),

					'delete'=>

                             array(
                             	    'visible'=>'true',
                                    'url'=>'$this->grid->controller->createUrl("/Solpe/cargadetalle", array("identi"=>$data->id))',
							 'options' => array( 'ajax' => array('type' => 'GET', 'update'=>'#zona' ,'url'=>'js:$(this).attr("href")'),
							  'onClick'=>'Loading.show();Loading.hide(); ',
							 ) ,
						    'imageUrl'=>''.Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemaimagenes'].'hand_point.png',
								'label'=>'Ver detalle',
                                ),	
							
			),
		),
             
                //array( 'type'=>'raw','header'=>'Solic.','value'=>'$data->solpe->numero','htmlOptions'=>array('width'=>6) ),		
		array('name'=>'item', 'type'=>'raw','header'=>'Item','htmlOptions'=>array('width'=>20) ),
		//array('htmlOptions'=>array('width'=>24),'name'=>'st.','header'=>'st', 'type'=>'raw','value'=>'CHtml::image(Yii::app()->getTheme()->baseUrl.Yii::app()->params["rutatemaimagenes"].$data->coddocu.$data->estadodetalle.".png")'),
		//array('name'=>'codentro', 'type'=>'raw','header'=>'Centro','htmlOptions'=>array('width'=>20) ),
		//array('name'=>'cant', 'type'=>'raw','value'=>'Chtml::openTag("span", array("style"=>"float:right;font-weight:bold;")).Mifactoria::decimal($data->cant,4).Chtml::closeTag("span")','header'=>'Cant','htmlOptions'=>array('width'=>20) ),
		//array('htmlOptions'=>array('width'=>10),'name'=>'codigoalma','visible'=>(yii::app()->settings->get("materiales","materiales_codigoservicio")==$data->codart)?true:false),
		//array('htmlOptions'=>array('width'=>5),'header'=>'um','value'=>'$data->ums->desum'),
		//array('htmlOptions'=>array('width'=>5), 'type'=>'raw','name'=>'codart','value'=>'$data->codart','visible'=>(!yii::app()->settings->get("materiales","materiales_codigoservicio")==$data->codart)?true:false),
		array('header'=>'N° Solic','type'=>'raw','value'=>'CHTml::link($data->solpe->numero,yii::app()->createUrl("/solpe/update/",array("id"=>$data->hidsolpe)), array("target"=>"_blank" ))', 'htmlOptions'=>array('width'=>4),),
		array('name'=>'cant', 'type'=>'raw','header'=>'Cant','htmlOptions'=>array('width'=>20) ),
		array('name'=>'codart', 'type'=>'raw','header'=>'Cod','value'=>'($data->tipsolpe=="M")?$data->codart:CHtml::image(Yii::app()->getTheme()->baseUrl."/img/hammer.png") ','htmlOptions'=>array('width'=>20) ),
		
                                                        //array('name'=>'.','type'=>'raw','value'=>'($data->tipsolpe=="S")?CHtml::image(Yii::app()->getTheme()->baseUrl.Yii::app()->params["rutatemaimagenes"]."hammer.png"):""'),

                                                        array('name'=>'hidlabor','header'=>'Recurso','value'=>'$data->txtmaterial','filter'=>CHTml::listData(Tempdetot::model()->findAll("idusertemp=:vuser and hidorden=:vorden",array(":vorden"=>$model->id,":vuser"=>yii::app()->user->id)),'idaux','textoactividad'), 'htmlOptions'=>array('width'=>400),),
		
                                                       // 'txtmaterial',
		//'codart',

		// array('name'=>'texto', 'type'=>'raw','header'=>'t','value'=>'(!empty($data->detalle))?CHtml::image(Yii::app()->getTheme()->baseUrl.Yii::app()->params["rutatemaimagenes"]."texto.png","hola"):""' ),
		//array('name'=>'punit', 'type'=>'raw','header'=>'Pu','value'=>'Chtml::openTag("span", array("style"=>"float:right;font-weight:bold;")).Mifactoria::decimal($data->punit,3).Chtml::closeTag("span")','htmlOptions'=>array('width'=>20)),
		//array('name'=>'Subt', 'type'=>'raw','header'=>'Subt','value'=>'Chtml::openTag("span", array("style"=>"float:right;font-weight:bold;")).Mifactoria::decimal($data->cant*($data->punit),3).Chtml::closeTag("span")','htmlOptions'=>array('width'=>68)),
		array('name'=>'punitplan','header'=>'Plan','value'=>'MiFactoria::decimal($data->punitplan)','footer'=>MiFactoria::decimal(Tempdesolpe::getTotal($prove)['plan'],2), 'htmlOptions'=>array('width'=>30)),
		array('name'=>'punitreal','header'=>'Real','value'=>'MiFactoria::decimal( $data->desolpe->punitreal,2)','footer'=>MiFactoria::decimal(Tempdesolpe::getTotal($prove)['real'],2), 'htmlOptions'=>array('width'=>40)),
                array('name'=>'st.','header'=>'st', 'type'=>'raw','value'=>'CHtml::image(Yii::app()->getTheme()->baseUrl.Yii::app()->params["rutatemaimagenes"].$data->codocu.$data->est.".png")'),
	   


	),
)); ?>

<div id="zona"></div>



	<?php
	if($this->estasEnsesion($model->id)) {
		$botones = array(
			'add' => array(
				'type' => 'C',
				'ruta' => array($this->id . '/creadetallerecurso', array(
					'idcabeza' => $model->id,
					'cest' => $model->{$this->campoestado},
					//"id"=>$model->n_direc,
					"asDialog" => 1,
					"gridId" => 'detalle-grid',
				)
				),
				'dialog' => 'cru-dialogdetalle',
				'frame' => 'cru-detalle',
				'visiblex' => array('10'),

			),

			'tool' => array(
				'type' => 'C',
				'ruta' => array($this->id . '/creaservicio', array(
					'id' => $model->id,'asDialog'=>'1'
				)
				),
				'dialog' => 'cru-dialogdetalle',
				'frame' => 'cru-detalle',
				'visiblex' => array(ESTADO_CREADO),

			),

			'minus' => array(
				'type' => 'D',
				'ruta' => array($this->id . '/borraitemsdesolpe', array()),

				'opajax' => array(
					'type' => 'POST',
					'url' => Yii::app()->createUrl($this->id . '/borraitemsdesolpe', array()),
					'complete' => "function(data) {
										 $.growlUI('Growl Notification', data);  
                                                          
                                              $.fn.yiiGridView.update('detalle-recursos-grid');                                              
                                               return false;
                                        }",
					'beforeSend' => 'js:function(){
                                  				 var r = confirm("Esta seguro de Eliminar estos Items?");
                          						 if(!r){return false;}
                               							 }
                               					',

				),
				'visiblex' => array(ESTADO_CREADO, ESTADO_AUTORIZADO, ESTADO_ANULADO, ESTADO_CONFIRMADO, ESTADO_FACTURADO),

			),


			'checklist' => array(
				'type' => 'C',
				'ruta' => array($this->id . '/JalaMateriales', array(
					'id' => $model->id,
					//"id"=>$model->n_direc,
					"asDialog" => 1,
					"gridId" => 'detalle-grid',
				)
				),
				'dialog' => 'cru-dialog3',
				'frame' => 'cru-frame3',
				'visiblex' => array(ESTADO_CREADO),
			),
			'pack2' => array(
				'type' => 'B',
				'ruta' => array($this->id . '/procesardocumento', array('id' => $model->id, 'ev' => 35)),
				'visiblex' => array(ESTADO_CREADO),

			),


			'briefcase' => array(
				'type' => 'D',
				'ruta' => array($this->id . '/Agregardelmaletin', array()),
				'opajax' => array(
					'type' => 'GET',
					'data' => array('id' => $model->id),
					'url' => Yii::app()->createUrl($this->id . '/Agregardelmaletin', array()),
					'success' => 'js:function(data) {
                            $("#AjFlash").html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut("slow");
                            $.fn.yiiGridView.update("detalle-grid"); alert(data);}',
					'beforeSend' => 'js:
                               					 function(){
                                  				 var r = confirm("¿Esta seguro de agregar los items del maletin ?");
                          						 if(!r){return false;}
                               							 }
                               					',
				),
				'visiblex' => array(ESTADO_CREADO, ESTADO_AUTORIZADO, ESTADO_ANULADO, ESTADO_CONFIRMADO, ESTADO_FACTURADO),

			),


			'join' => array(
				'type' => 'C',
				'ruta' => array($this->id . '/agregaritemsolpe', array(
					'idguia' => $model->id,
					//"id"=>$model->n_direc,
					"asDialog" => 1,
					"gridId" => 'detalle-grid',
				)
				),
				'dialog' => 'cru-dialogdetalle',
				'frame' => 'cru-detalle',
				'visiblex' => array(ESTADO_CREADO),

			),

			'pack' => array(
				'type' => 'C',
				'ruta' => array($this->id . '/agregarmasivamente', array(
					'idguia' => $model->id,
					//"id"=>$model->n_direc,
					"asDialog" => 1,
					"gridId" => 'detalle-grid',
				)
				),
				'dialog' => 'cru-dialogdetalle',
				'frame' => 'cru-detalle',
				'visiblex' => array(ESTADO_CREADO),

			),


		);


		$this->widget('ext.toolbar.Barra',
			array(
				//'botones'=>MiFactoria::opcionestoolbar($model->id,$this->documento,$model->codestado),
				'botones' => $botones,
				'size' => 24,
				'extension' => 'png',
				'status' => $model->{$this->campoestado},


			)
		);
	}
	?>

</div>