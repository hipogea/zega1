
 <?php  $this->renderPartial('vw_detalle_grilla', array("model"=>$model,"idparent"=>$model->id,"idcabecera"=>$modelcabecera->id,'eseditable'=>$eseditable),false, true);
 ?>



     <?php
     $botones=array(
         'add'=>array(
             'type'=>'C',
             'ruta'=>array($this->id.'/creadetallecaja',array(
                 'id'=>$model->id,"cest"=>'10',
                 //"id"=>$model->n_direc,
                 "asDialog"=>1,
                 "gridId"=>'detalle-grid',
             )
             ),
             'dialog'=>'cru-dialog2',
             'frame'=>'cru-frame2',
             'visiblex'=>array('10'),

         ),
         'minus'=>array(
             'type'=>'D',
             'ruta'=>array('cajachica/borraitems',array()),
             'opajax'=>array(
                 'type'=>'POST',
                 'url'=>ARRAY('cajachica/borraitems',array()),
                 'success'=>'js:function(data) { $.fn.yiiGridView.update("detalle-grid"); alert(data);}',
                 'beforeSend' => 'js:function(){
									 var r = confirm("¿Esta seguro de Eliminar estos Items?");
 										if(!r){return false;}
 										}
 								',
             ),
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
     );  ?>













