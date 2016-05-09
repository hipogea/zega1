
<?php

if(!Yii::app()->user->isGuest){
    if(!(Yii::app()->user->um->getFieldValue(Yii::app()->user->id,'externo')=='1')){


        ?>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <!-- Be sure to leave the brand out there if you want it shown -->
                    <a class="brand" href="#"><?php echo CHtml::image(Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemaimagenes'].'helius.png',"Helius",array("height"=>5)); ?></a>

                    <div class="nav-collapse">
                        <?php $this->widget('zii.widgets.CMenu',array(
                            'htmlOptions'=>array('class'=>'pull-right nav'),
                            'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
                            'itemCssClass'=>'item-test',
                            'encodeLabel'=>false,
                            'items'=>array(
                                array('label'=>'Inicio', 'url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Datos maestros <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                    'items'=>array(
                                        array('label'=>'Sociedades', 'url'=>'/recurso/sociedades/admin'),
                                        array('label'=>'Centros', 'url'=>'/recurso/centros/admin'),
                                        array('label'=>'Almacenes', 'url'=>'/recurso/almacenes'),
                                        array('label'=>'Mov Almacen', 'url'=>'/recurso/almacenmovimientos'),
                                        array('label'=>'Areas', 'url'=>'/recurso/areas/admin'),
                                        array('label'=>'Canales', 'url'=>'/recurso/canales/admin'),
                                        array('label'=>'Cecos', 'url'=>'/recurso/Cc/admin'),
                                        array('label'=>'Centros', 'url'=>'/recurso/centros/admin'),
                                        array('label'=>'Conductores', 'url'=>'/recurso/choferes/admin'),
                                        array('label'=>'Proveedores', 'url'=>'/recurso/Clipro/admin'),
                                        array('label'=>'Contactos', 'url'=>'/recurso/Contactos/admin'),
                                        array('label'=>'Direcciones', 'url'=>'/recurso/Direcciones/admin'),
                                        array('label'=>'Disponibilidad', 'url'=>'/recurso/Disponibilidad/admin'),
                                        array('label'=>'Documentos', 'url'=>'/recurso/Documentos/admin'),
                                        array('label'=>'Vehiculos', 'url'=>'/recurso/Embarcaciones/admin'),
                                        array('label'=>'Estados', 'url'=>'/recurso/Estado/admin'),
                                        array('label'=>'Eventos', 'url'=>'/recurso/Eventos/admin'),
                                        array('label'=>'Grupo compras', 'url'=>'/recurso/Grupocompras/admin'),
                                        array('label'=>'Grupo ventas', 'url'=>'/recurso/Grupoventas/admin'),
                                        array('label'=>'Impuestos', 'url'=>'/recurso/Impuestos/admin'),
                                        array('label'=>'Lugares', 'url'=>'/recurso/Lugares/admin'),
                                        array('label'=>'Tipos mater.', 'url'=>'/recurso/maestrotipos/admin'),
                                        array('label'=>'Materiales', 'url'=>'/recurso/maestrocompo/admin'),
                                        array('label'=>'Moneda', 'url'=>'/recurso/Monedas/admin'),
                                        array('label'=>'Motivos traslado', 'url'=>'/recurso/Motivo/admin'),
                                        array('label'=>'Cargos', 'url'=>'/recurso/Oficios/admin'),
                                        array('label'=>'Mov Transporte', 'url'=>'/recurso/Paraqueva/admin'),
                                        array('label'=>'Periodos', 'url'=>'/recurso/Periodos/admin'),
                                        array('label'=>'Tipos AF', 'url'=>'/recurso/Tipoactivos/admin'),
                                        array('label'=>'Cambio moneda', 'url'=>'/recurso/Tipocambio/admin'),
                                        array('label'=>'Formas de pago', 'url'=>'/recurso/Tipofacturacion/admin'),
                                        array('label'=>'Trabajadores', 'url'=>'/recurso/Trabajadores/admin'),
                                        array('label'=>'Unidades med', 'url'=>'/recurso/ums/admin')
                                    ) ,
                                    'visible'=>!Yii::app()->user->isGuest
                                ),
                                array('label'=>'Operaciones <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                    'items'=>array(

                                        array('label'=>'Crear Solicitud', 'url'=>'/recurso/solpe/create'),
                                        array('label'=>'Solicitudes', 'url'=>'/recurso/solpe/admin'),
                                        array('label'=>'Tomar Solicitudes', 'url'=>'/recurso/solpe/tomarcompras'),
                                        array('label'=>'Opciones Solpe', 'url'=>'/recurso/solpe/Configuraop'),
                                        array('label'=>'Crear Orden compra', 'url'=>'/recurso/ocompra/create'),
                                        array('label'=>'Ordenes de  compra', 'url'=>'/recurso/ocompra/admin'),
                                        array('label'=>'Peticiones oferta', 'url'=>'/recurso/peticion/admin'),




                                    ) ,
                                    'visible'=>!Yii::app()->user->isGuest
                                ),


                                array('label'=>'Administracion <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                    'items'=>array(

                                        array('label'=>'Novedades', 'url'=>'/recurso/noticias/admin'),
                                        array('label'=>'Aproba avisos', 'url'=>'/recurso/noticias/poraprobar'),
                                        array('label'=>'Tipo cambio', 'url'=>'/recurso/tipocambio/admin'),
                                        array('label'=>'Contactos', 'url'=>'/recurso/contactos/admin'),
                                        array('label'=>'Trabajadores', 'url'=>'/recurso/ocompra/create'),
                                        array('label'=>'Proveedores', 'url'=>'/recurso/clipro/admin'),
                                        array('label'=>'Recepcion doc.', 'url'=>'/recurso/docingresados/admin'),
                                        array('label'=>'Caja menor.', 'url'=>'/recurso/cajachica/admin'),
                                        array('label'=>'Vehiculos', 'url'=>'/recurso/Embarcaciones/admin'),
                                        array('label'=>'Periodos', 'url'=>'/recurso/Periodos/admin'),
                                        array('label'=>'Solicitar noticia', 'url'=>'/recurso/noticias/solicita'),
                                        array('label'=>'Biblioteca', 'url'=>'/recurso/archivador/admin'),

                                        array('label'=>'Costos', 'url'=>'/recurso/cc/reporte'),
                                    ) ,
                                    'visible'=>!Yii::app()->user->isGuest
                                ),

                                array('label'=>'Almacen <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                    'items'=>array(

                                        array('label'=>'Crear movimiento', 'url'=>'/recurso/almacendocs/crear'),
                                        array('label'=>'Documentos Almacen', 'url'=>'/recurso/almacendocs/admin'),

                                        array('label'=>'Crear documento', 'url'=>'/recurso/almacendocs/crear'),
                                        array('label'=>'Ajustes de inventario', 'url'=>'/recurso/almacendocs/ajuste'),
                                        array('label'=>'Doc material', 'url'=>'/recurso/alkardex/admin'),
                                        array('label'=>'Existencias', 'url'=>'/recurso/alinventario/admin'),
                                        array('label'=>'Despachos', 'url'=>'/recurso/despacho/admin'),
                                        array('label'=>'Centros-Materiales', 'url'=>'/recurso/alinventario/cargarmat'),
                                        array('label'=>'Ajuste de solicitudes', 'url'=>'/recurso/solpe/atiendesolpe'),
                                        array('label'=>'Reportes de inventario', 'url'=>'/recurso/alinventario/repinventario'),
                                        array('label'=>'Importar Inventario', 'url'=>'/recurso/alinventario/import'),
                                        array('label'=>'Analisis ABC', 'url'=>'/recurso/alinventario/pareto'),
                                        array('label'=>'Reporte ABC', 'url'=>'/recurso/alinventario/adminpareto'),

                                    ) ,
                                    'visible'=>!Yii::app()->user->isGuest
                                ),

                                array('label'=>'Autorizaciones <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                    'items'=>array(

                                        array('label'=>'Solicitudes', 'url'=>'/recurso/solpe/liberacion'),
                                        array('label'=>'Compras', 'url'=>'/recurso/ocompra/libmasiva'),

                                    ) ,
                                    'visible'=>!Yii::app()->user->isGuest
                                ),

                                array('label'=>'Transporte <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                    'items'=>array(

                                        array('label'=>'Crear Doc Transp', 'url'=>'/recurso/guia/create'),
                                        array('label'=>'Crear Doc Recep', 'url'=>'/recurso/ne/create'),
                                        array('label'=>'Documentos', 'url'=>'/recurso/guia/admin'),
                                        array('label'=>'Crear Conductores', 'url'=>'/recurso/choferes/create'),
                                        array('label'=>'Crear Direccion', 'url'=>'/recurso/direcciones/create'),
                                        array('label'=>'Crear Ubicaciones', 'url'=>'/recurso/lugares/create'),
                                        array('label'=>'Canales de distr', 'url'=>'/recurso/canales/admin'),
                                        array('label'=>'Centro expedicion', 'url'=>'/recurso/puntodespacho/admin'),
                                        array('label'=>'Expedicion', 'url'=>'/recurso/despacho/admin'),





                                    ) ,
                                    'visible'=>!Yii::app()->user->isGuest
                                ),
                                array('label'=>'G. Activos <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                    'items'=>array(

                                        array('label'=>'Inventario AF', 'url'=>'/recurso/Inventario/admin'),
                                        array('label'=>'Crear AF', 'url'=>'/recurso/Inventario/create'),
                                        array('label'=>'Observaciones', 'url'=>'/recurso/Observaciones/admin'),
                                        array('label'=>'Crear AF', 'url'=>'/recurso/Inventario/create'),
                                        array('label'=>'Tipos AF', 'url'=>'/recurso/tipoactivos/create'),


                                    ) ,
                                    'visible'=>!Yii::app()->user->isGuest
                                ),


                                array('label'=>'Login', 'url'=>Yii::app()->user->ui->loginUrl  , 'visible'=>Yii::app()->user->isGuest),
                                array('label'=>'Cerrar sesion ('.Yii::app()->user->name.')'.Yii::app()->user->getId(), 'url'=>Yii::app()->user->ui->logoutUrl , 'visible'=>!Yii::app()->user->isGuest),

                            ),
                        )); ?>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }  else   {

        ?>









        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <!-- Be sure to leave the brand out there if you want it shown -->
                    <a class="brand" href="#"><?php echo CHtml::image(Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemaimagenes'].'helius.png',"Helius",array("height"=>5)); ?></a>

                    <div class="nav-collapse">
                        <?php $this->widget('zii.widgets.CMenu',array(
                            'htmlOptions'=>array('class'=>'pull-right nav'),
                            'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
                            'itemCssClass'=>'item-test',
                            'encodeLabel'=>false,
                            'items'=>array(
                                array('label'=>'Inicio', 'url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest),

                                array('label'=>'Operaciones <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                    'items'=>array(

                                        array('label'=>'Crear Solicitud', 'url'=>'/recurso/solpe/create'),
                                        array('label'=>'Solicitudes', 'url'=>'/recurso/solpe/admin'),
                                        array('label'=>'Tomar Solicitudes', 'url'=>'/recurso/solpe/tomarcompras'),
                                        array('label'=>'Opciones Solpe', 'url'=>'/recurso/solpe/Configuraop'),
                                        array('label'=>'Crear Orden compra', 'url'=>'/recurso/ocompra/create'),
                                        array('label'=>'Ordenes de  compra', 'url'=>'/recurso/ocompra/admin'),
                                        array('label'=>'Peticiones oferta', 'url'=>'/recurso/peticion/admin'),




                                    ) ,
                                    'visible'=>!Yii::app()->user->isGuest
                                ),

                                array('label'=>'Login', 'url'=>Yii::app()->user->ui->loginUrl  , 'visible'=>Yii::app()->user->isGuest),
                                array('label'=>'Cerrar sesion ('.Yii::app()->user->name.')'.Yii::app()->user->getId(), 'url'=>Yii::app()->user->ui->logoutUrl , 'visible'=>!Yii::app()->user->isGuest),

                            ),
                        )); ?>
                    </div>
                </div>
            </div>
        </div>




















    <?php
    }

} else  {

    ?>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <!-- Be sure to leave the brand out there if you want it shown -->
                <a class="brand" href="#"><?php echo CHtml::image(Yii::app()->getTheme()->baseUrl.Yii::app()->params['rutatemaimagenes'].'helius.png',"Helius",array("height"=>5)); ?></a>

                <div class="nav-collapse">
                    <?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'=>array('class'=>'pull-right nav'),
                        'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
                        'itemCssClass'=>'item-test',
                        'encodeLabel'=>false,
                        'items'=>array(
                            array('label'=>'Inicio', 'url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>'Datos maestros <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                'items'=>array(
                                    array('label'=>'Sociedades', 'url'=>'/recurso/sociedades/admin'),
                                    array('label'=>'Centros', 'url'=>'/recurso/centros/admin'),
                                    array('label'=>'Almacenes', 'url'=>'/recurso/almacenes'),
                                    array('label'=>'Unidades med', 'url'=>'/recurso/ums/admin'),
                                    array('label'=>'Tipos mater.', 'url'=>'/recurso/maestrotipos/admin'),
                                    array('label'=>'Materiales', 'url'=>'/recurso/maestrocompo/admin'),
                                    array('label'=>'Cargos', 'url'=>'/recurso/Oficios/admin'),
                                    array('label'=>'Trabajadores', 'url'=>'/recurso/Trabajadores/admin'),
                                    array('label'=>'Cecos', 'url'=>'/recurso/Cc/admin'),
                                    array('label'=>'Proveedores', 'url'=>'/recurso/Clipro/admin'),
                                    array('label'=>'Motivos traslado', 'url'=>'/recurso/Motivo/admin'),
                                    array('label'=>'Proveedores', 'url'=>'/recurso/Clipro/admin'),
                                    array('label'=>'Areas', 'url'=>'/recurso/Areas/admin'),
                                    array('label'=>'Documentos', 'url'=>'/recurso/Documentos/admin'),
                                    array('label'=>'Areas', 'url'=>'/recurso/Areas/admin'),
                                    array('label'=>'Formas de pago', 'url'=>'/recurso/Tipofacturacion/admin'),
                                    array('label'=>'Transportistas', 'url'=>'/recurso/Choferes/admin'),
                                    array('label'=>'Vehiculos', 'url'=>'/recurso/Embarcaciones/admin'),
                                    array('label'=>'Estados', 'url'=>'/recurso/Estado/admin'),
                                    array('label'=>'Eventos', 'url'=>'/recurso/Eventos/admin'),





                                ) ,
                                'visible'=>!Yii::app()->user->isGuest
                            ),
                            array('label'=>'Operaciones <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                'items'=>array(

                                    array('label'=>'Crear Solicitud', 'url'=>'/recurso/solpe/create'),
                                    array('label'=>'Solicitudes', 'url'=>'/recurso/solpe/admin'),
                                    array('label'=>'Tomar Solicitudes', 'url'=>'/recurso/solpe/tomarcompras'),
                                    array('label'=>'Opciones Solpe', 'url'=>'/recurso/solpe/Configuraop'),
                                    array('label'=>'Crear Orden compra', 'url'=>'/recurso/ocompra/create'),
                                    array('label'=>'Ordenes de  compra', 'url'=>'/recurso/ocompra/admin'),
                                    array('label'=>'Peticiones oferta', 'url'=>'/recurso/peticion/admin'),




                                ) ,
                                'visible'=>!Yii::app()->user->isGuest
                            ),


                            array('label'=>'Administracion <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                'items'=>array(

                                    array('label'=>'Novedades', 'url'=>'/recurso/noticias/admin'),
                                    array('label'=>'Aproba avisos', 'url'=>'/recurso/noticias/poraprobar'),
                                    array('label'=>'Tipo cambio', 'url'=>'/recurso/tipocambio/admin'),
                                    array('label'=>'Contactos', 'url'=>'/recurso/contactos/admin'),
                                    array('label'=>'Trabajadores', 'url'=>'/recurso/ocompra/create'),
                                    array('label'=>'Proveedores', 'url'=>'/recurso/clipro/admin'),
                                    array('label'=>'Recepcion doc.', 'url'=>'/recurso/docingresados/admin'),

                                    array('label'=>'Vehiculos', 'url'=>'/recurso/Embarcaciones/admin'),
                                    array('label'=>'Solicitar noticia', 'url'=>'/recurso/noticias/solicita'),
                                    array('label'=>'Biblioteca', 'url'=>'/recurso/archivador/admin'),

                                    array('label'=>'Costos', 'url'=>'/recurso/cc/reporte'),
                                ) ,
                                'visible'=>!Yii::app()->user->isGuest
                            ),

                            array('label'=>'Almacen <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                'items'=>array(

                                    array('label'=>'Crear movimiento', 'url'=>'/recurso/almacendocs/crear'),
                                    array('label'=>'Documentos Almacen', 'url'=>'/recurso/almacendocs/admin'),

                                    array('label'=>'Crear documento', 'url'=>'/recurso/almacendocs/crear'),
                                    array('label'=>'Ajustes de inventario', 'url'=>'/recurso/almacendocs/ajuste'),
                                    array('label'=>'Doc material', 'url'=>'/recurso/alkardex/admin'),
                                    array('label'=>'Existencias', 'url'=>'/recurso/alinventario/admin'),
                                    array('label'=>'Centros-Materiales', 'url'=>'/recurso/alinventario/cargarmat'),
                                    array('label'=>'Ajuste  solicitudes', 'url'=>'/recurso/solpe/atiendesolpe'),
                                    array('label'=>'Reportes de inventario', 'url'=>'/recurso/alinventario/repinventario'),
                                    array('label'=>'Importar Inventario', 'url'=>'/recurso/alinventario/import'),
                                    array('label'=>'Analisis ABC', 'url'=>'/recurso/alinventario/pareto'),
                                    array('label'=>'Reporte ABC', 'url'=>'/recurso/alinventario/adminpareto'),

                                ) ,
                                'visible'=>!Yii::app()->user->isGuest
                            ),

                            array('label'=>'Autorizaciones <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                'items'=>array(

                                    array('label'=>'Solicitudes', 'url'=>'/recurso/solpe/liberacion'),
                                    array('label'=>'Compras', 'url'=>'/recurso/ocompra/libmasiva'),

                                ) ,
                                'visible'=>!Yii::app()->user->isGuest
                            ),

                            array('label'=>'Transporte <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                'items'=>array(

                                    array('label'=>'Crear Doc Transp', 'url'=>'/recurso/guia/create'),
                                    array('label'=>'Crear Doc Recep', 'url'=>'/recurso/ne/create'),
                                    array('label'=>'Documentos', 'url'=>'/recurso/guia/admin'),
                                    array('label'=>'Crear Conductores', 'url'=>'/recurso/choferes/create'),
                                    array('label'=>'Crear Direccion', 'url'=>'/recurso/direcciones/create'),
                                    array('label'=>'Crear Ubicaciones', 'url'=>'/recurso/lugares/create'),





                                ) ,
                                'visible'=>!Yii::app()->user->isGuest
                            ),
                            array('label'=>'G. Activos <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                                'items'=>array(

                                    array('label'=>'Inventario AF', 'url'=>'/recurso/Inventario/admin'),
                                    array('label'=>'Crear AF', 'url'=>'/recurso/Inventario/create'),
                                    array('label'=>'Observaciones', 'url'=>'/recurso/Observaciones/admin'),
                                    array('label'=>'Crear AF', 'url'=>'/recurso/Inventario/create'),


                                ) ,
                                'visible'=>!Yii::app()->user->isGuest
                            ),


                            array('label'=>'Login', 'url'=>Yii::app()->user->ui->loginUrl  , 'visible'=>Yii::app()->user->isGuest),
                            array('label'=>'Cerrar sesion ('.Yii::app()->user->name.')'.Yii::app()->user->getId(), 'url'=>Yii::app()->user->ui->logoutUrl , 'visible'=>!Yii::app()->user->isGuest),

                        ),
                    )); ?>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>

