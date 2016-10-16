<?php
$this->widget('ext.coco.CocoWidget'
              ,array(
		'id'=>'cocowidget1',
		'onCompleted'=>'function(id,filename,jsoninfo){  }',
		'onCancelled'=>'function(id,filename){ alert("cancelled"); }',
		'onMessage'=>'function(m){ alert(m); }',
		'allowedExtensions'=>array('JPEG','JPG','gif','PNG'), // server-side mime-type validated
		'sizeLimit'=>8000000, // limit in server-side and in client-side
		'uploadDir' =>  $model->getulpoaddirectory(), // coco will @mkdir it
			// this arguments are used to send a notification
			// on a specific class when a new file is uploaded,
		'buttonText'=>'Subir Imagen',
		'receptorClassName'=>'application.models.'.get_class($model),
                 //'modelin'=> $model,
                                                                     // 'modeli'=>23,
                                                                                    //'receptorClassName'=>'application.models.Tempdetot',
										//'methodName'=>'FileReceptor',
                 'methodName'=>'colocaarchivox',
		//'userdata'=>$model->codigo,
			// controls how many files must be uploaded
		'maxUploads'=>3, // defaults to -1 (unlimited)
		'maxUploadsReachMessage'=>'No esta permitido cargar mas archivos', // if empty, no message is shown
			// controls how many files the can select (not upload, for uploads see also: maxUploads)
		'multipleFileSelection'=>true, // true or false, defaults: true
										//'nombrealt'=>$model->codigo.'',
		));


/*$this->widget('ext.camara.Camara',
					array(
                                            'accion'=>''
					)
				);
                                                
      */                                          
  ?>


