<?php/*  *  * Creado por jramirez  14-08-2015  *     Extension para simplifcar el uso de la libreria PHMAILER  *     cuya configuracion es complicada  *  */class Correo  extends JPhpMailer {private $_copiarausuario=true;private $_usarcorreousuario=true;private $_css_body="background-color:#f5f0dd; color: #292821;  font-family: helvetica;    font-size: 15px; text-decoration: none;    text-shadow: #ccc 2px 0px 1px; ";private $_css_table='style=" width:100%;" ';private $_css_tr='style="text-align:left; font-family:helvetica; font-size:11px; text-decoration:none; border-bottom:1px solid #ccc; caption-side:bottom; background-color:#fdfce9"';private $_css_td='style="padding:5px; border-bottom:1px solid #ccc"';private $_css_th='style="text-align:left; vertical-align:top; font-family:helvetica; padding:0.3em; border-left:1px solid #a71257; caption-side:bottom; background-color:#ddeaec; color:#376492"';    public function __construct() {        parent::__construct($exceptions = true); ///Eswto permite atrapar los erroes con TRY CATCH, de otro modo siempre habra mnen sajesd e PHP MAILER        ///QUE INTERRUMPEN LOS RENDER DE YII       // $this->CharSet = "UTF-8";        $this->SMTPDebug  = false;       $this->SMTPDebug  = yii::app()->settings->get('email','email_smtpdebug')+0; //DEBE SER UN ENTERO Y CERO =FALSE        $this->Host = yii::app()->settings->get('email','email_servemail');       // $this->exceptions = yii::app()->settings->get('email','email_servemail');        $this->SMTPAuth = true;        $this->SetLanguage('es');        $this->Username = yii::app()->settings->get('email','email_cuentahost');        $this->Password = yii::app()->params['pwdmail'];        $this->_copiarausuario=(yii::app()->user->um->getFieldValue(Yii::app()->user->id,'recibecopiasmail')=='1')?true:false;        $this->_usarcorreousuario=(yii::app()->settings->get('email','email_usamaildeusuario')=='1')?true:false;    }         public function init(){}    private function preparadestinatarios($destinatarios){        if($this->_copiarausuario){            $destinatarios.=",".Yii::app()->user->email;        }        return $destinatarios;    }    private function getemisor($nombreremitente){        if($this->_usarcorreousuario){                        $correoremitente=Yii::app()->user->email;          // $correoremitente='hipogea@hotmail.com';            //$nombreremitente='NOMBRE' ;           if(is_null($nombreremitente))                $nombreremitente=$this->getNombreremitenteusuario();                                  /*echo "   es correo uusario ";            var_dump($correoremitente);var_dump($nombreremitente);die();*/        } else {            //var_dump(yii::app()->settings('correo','email_usamaildeusuario'));            $correoremitente= $this->Username ;              if(is_null($nombreremitente))            $nombreremitente= yii::app()->settings->get('email','email_nombrewebmaster') ;            /*echo "   no es correo uusario ";            var_dump($correoremitente);var_dump($nombreremitente);die();*/        }        //var_dump($correoremitente);var_dump($nombreremitente);die();         RETURN ARRAY( $correoremitente,$nombreremitente);    }    private  function getModelPath()    {        if($this->_modelPath!==null)            return $this->_modelPath;        else            return Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'models';    }    /**     * enumControllers     *    lista los nombres de los controllers declarados.     * @access public     * @return array con nombre del controller     */    private function enumModels()    {        if ($this->_venumModels == null) {            $this->_venumModels = array();            $p = $this->getModelPath();            foreach (scandir($p) as $f) {                if ($f == '.' || $f == '..') {                    continue;                }                if (strlen($f)) {                    if ($f[0] == '.') {                        continue;                    }                }                $this->_venumModels[] = substr($f,0,strpos($f,'.php'));            }            return $this->_venumModels;        } else {            return $this->_venumModels ;        }    }        private function getNombreremitenteusuario(){       if (in_array('VwTrabajadores',$this->enumModels())){           $registro= VwTrabajadores::model()->findByPk(yii::app()->user->um->getFieldValue(Yii::app()->user->id,'codtra'));            if(!is_null($registro)){                 return ereg_replace("[^A-Za-z0-9]", " ", $registro->nombrecompleto);            }else{               return  yii::app()->settings->get("email","email_nombrewebmaster");            }       } else{            return  yii::app()->settings->get("email","email_nombrewebmaster");       }    }public function correo_adjunto( $mailto,$replyto, $subject, $message,$filename,$nombreremitente=null) {   // Yii::import('application.extensions.phpmailer.JPhpMailer');   // $mail = new JPhpMailer;    //$this->SMTPDebug  = 2;$cadena="";    $mailto=$this->preparadestinatarios($mailto);    //print_r($mailto);    //$this->IsSMTP();    //$this->Host = 'mail.neotegnia.com';    //$this->SMTPAuth = true;   // $this->Username = 'jramirez@neotegnia.com';    //$this->Password = 'quesapoeres';    $this->AddReplyTo($replyto);   $this->SetFrom($this->getemisor($nombreremitente)[0], $this->getemisor($nombreremitente)[1]);   //VAR_DUMP($this->getemisor());DIE();    $this->Subject = $subject;    $this->AltBody = 'To view the message, please use an HTML compatible email viewer!';    $this->MsgHTML($this->formateaHTML($message).'   <br>  '.$this->getemisor($nombreremitente)[1]);    foreach (explode(",",$mailto) as $clave=>$valor){        $this->AddAddress($valor);    }    $this->AddAttachment($filename, $name = '', $encoding = 'base64', $type = 'application/octet-stream');   //VAR_DUMP($this->Send());DIE();        try{ $this->Send();}    catch (phpmailerException $e){        $cadena.=$e->errorMessage();    }catch (Exception $e){        $cadena.=$e->errorMessage();    }     $this->ClearAddresses () ;   //unset($this);    return $cadena;}    public function correo_simple( $mailto,$replyto, $subject, $message,$nombreremitente=null) {        // Yii::import('application.extensions.phpmailer.JPhpMailer');        // $mail = new JPhpMailer;        //$this->SMTPDebug  = 2;        $cadena="";        $mailto=$this->preparadestinatarios($mailto);        //$this->IsSMTP();        //$this->IsHTML(true);        //$this->Host = 'mail.neotegnia.com';        //$this->SMTPAuth = true;        // $this->Username = 'jramirez@neotegnia.com';        //$this->Password = 'toxoplasma1';        $this->AddReplyTo($replyto);        $this->SetFrom($this->getemisor($nombreremitente)[0], $this->getemisor($nombreremitente)[1]);        $this->Subject = $subject;        $this->AltBody = 'To view the message, please use an HTML compatible email viewer!';      // $this->body= $message;        $this->MsgHTML($this->formateaHTML($message).'   <br> '.$this->getemisor($nombreremitente)[1]);        $mailto=$this->preparadestinatarios($mailto);        foreach (explode(",",$mailto) as $clave=>$valor){            $this->AddAddress($valor);        }      // $this->send();       try{ $this->Send();}       catch (phpmailerException $e){           $cadena.=$e->errorMessage();       }catch (Exception $e){           $cadena.=$e->errorMessage();       } $this->ClearAddresses () ;        return $cadena;    }private function formateaHTML($mensaje){      $patrones=array('/class=[\"\']{1}[A-Za-z0-9]*[\"\']{1}/','/\<span/','/\<tr/','/\<td/','/\<th/');        //$campos=array('css_body','css_tr','css_td','css_th');        $reemplazos=array(            '',            '<span '.$this->_css_body,            '<tr '.$this->_css_tr,            '<td '.$this->_css_td,             '<th '.$this->_css_th,            );       $mensaje=preg_replace ($patrones , $reemplazos , $mensaje  );       return $mensaje;            }                }?>