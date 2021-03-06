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
     
    // $habilitado='';

//echo "habil  ".($habil==='si');
          


  ?>

		<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detgui-form',
	'enableClientValidation'=>true,
   
	'enableAjaxValidation'=>false,
	



)); ?>




	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<?php echo ($model->isNewRecord)?$form->hiddenField($model,'n_hguia',array('value'=>Guia::model()->findbypk($idcabeza)->n_guia)):''; ?>
		
	</div>
	
	
	<div class="row">
				<?php echo $form->labelEx($model,'modo'); ?>
				<?php echo $model->getScenario(); ?>
					<?php
							//$opciones=array();
							if( $esembaracable=$model->guia->direccionesllegada->esembarque=='1'){
							      $opciones=array('1'=>'Retorno','2'=>'Embarque','3'=>'Definitivo');

							} else {
								$opciones=array('1'=>'Retorno','3'=>'Definitivo');


									}

						?>

		<?php
		// echo $form->radioButtonList($model, 'c_estado', array('1'=>'Retorno', '2'=>'Embarque', '3'=>'Definitivo'),array('labelOptions'=>array('style'=>'display:inline'),'separator' => "  " ));
		
		echo $form->radioButtonList($model,'modo',
			$opciones,
			array(
				'template'=>'{input}{label}',
				'separator'=>'',
				'labelOptions'=>array(
					'style'=> '
                padding-left:1px !important;
                width: 60px !important;
                float: left !important;
            '),
				'style'=>'float:left;',
			)

		);


		?>
		<?php echo $form->error($model,'modo'); ?>
	</div>

	
	

	<div class="row">
		<?php //echo $form->labelEx($model,'n_cangui'); ?>
		<?php echo $form->hiddenField($model,'n_cangui',array('value'=>1)); ?>

	</div>

<div class="row">
		<?php
		if(yii::app()->settings->get('transporte','transporte_objenguia')=='1') {

			?>
			<?php echo $form->labelEx($model, 'codob'); ?>
			<?php
					$codpro=Guia::model()->findByPk($idcabeza)->c_coclig;
			?>
			<?php $datos15 = CHtml::listData( ObjetosCliente::model()->findAll(array('condition'=>"codpro=:codpro",'params'=>array(':codpro'=>$codpro),'order' => 'nombreobjeto')), 'codobjeto', 'nombreobjeto');
			echo $form->DropDownList($model, 'codob', $datos15, array('empty' => '--Seleccione un objeto--', 'disabled' => $habilitado,
				'options' => array(
					isset(Yii::app()->session['codob']) ? Yii::app()->session['codob'] : $model->c_edgui => array('selected' => true)
				)));
			?>
			<?php echo $form->error($model, 'codob'); ?>
		<?php
		         }
		?>
	</div>
    
    


	<div class="row">
		<?php echo $form->labelEx($model,'c_codactivo'); ?>
		<?php /* echo $form->textField($model,'c_codactivo',array('size'=>13,'maxlength'=>13,
																'ajax'=>array(
																		'type'=>'POST',
																		//'data'=>array('codsap'=>$model->c_codsap),
																		'url'=>Yii::app()->createUrl('/Guia/Pintaactivo'),					//
																		'replace'=>'#Detgui_c_descri',
																			)
															 ));
				*/
                //$cd=New Inventario();
               // var_dump($cd->attributeNames());
		$this->widget('ext.matchcode1.MatchCode1',array(
			'nombrecampo'=>'c_codactivo',
			'campoex'=>'codigoaf',
			'pintarcaja'=>0, ///indica si debe de pintar el textbox al iniciar
			'ordencampo'=>9,
			'controlador'=>'Tempdetgui',
			'relaciones'=>$model->relations(),
			'tamano'=>13,
			'model'=>$model,
			'form'=>$form,
			'habilitado'=>$habil,
			'nombredialogo'=>'cru-dialog3',
			'nombreframe'=>'cru-frame3',
			'nombrearea'=>'miffwwwufu',
			'nombrecampoareemplazar'=>'c_descri',
			//'comopintar'=>'c_descri',//Significa que va a ha reemplazar al imput del campo
		));
		?>

		


		<?php echo $form->error($model,'c_codactivo'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'c_descri'); ?>
		<?php echo $form->textField($model,'c_descri',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'c_descri'); ?>


	</div>

	<div class="row">
            <?php if(yii::app()->settings->get('transporte','transporte_objinterno')=='1') { ?>
		<?php echo $form->labelEx($model,'c_codep'); ?>
		<?php  $datos1 = CHtml::listData(Embarcaciones::model()->findAll(array('order'=>'nomep')),'codep','nomep');
		  echo $form->DropDownList($model,'c_codep',$datos1, array('empty'=>'--Seleccione una referencia--',  'disabled'=>$habilitado,
													   'options'=>array(
													          isset(Yii::app()->session['c_codep'])?Yii::app()->session['c_codep']:$model->c_codep=>array('selected'=>true)
																		)  ) ) ;
		?>
		<?php echo $form->error($model,'c_codep'); ?>
            <?php  }  ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_edgui'); ?>
		<?php  $datos11 = CHtml::listData(Paraqueva::model()->findAll(array('order'=>'motivo')),'cmotivo','motivo');
		  echo $form->DropDownList($model,'c_edgui',$datos11, array('empty'=>'--Seleccione un destino--',  'disabled'=>$habilitado,
													   'options'=>array(
													          isset(Yii::app()->session['c_edgui'])?Yii::app()->session['c_edgui']:$model->c_edgui=>array('selected'=>true)
																		) ))  ;
		?>
            
            
            
		<?php echo $form->error($model,'c_edgui'); ?>
	</div>
	


	<div class="row">
		<?php echo $form->labelEx($model,'m_obs'); ?>
		<?php echo $form->textArea($model,'m_obs',array( 'disabled'=>$habilitado,'rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'m_obs'); ?>
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
        'width'=>400,
        'height'=>600,
    ),
    ));
?>
<iframe id="cru-frame3" width="100%" height="100%"></iframe>
<?php
 
$this->endWidget();
//--------------------- end new code --------------------------
?>