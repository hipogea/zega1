<?php/*  *  * Creado por jramirez  14-08-2015  *     Extension para simplifcar el uso de la libreria PHMAILER  *     cuya configuracion es complicada  *  */class Correo  extends JPhpMailer {private $_copiarausuario=true;private $_usarcorreousuario=true;    public function __construct() {        parent::__construct($exceptions = true); ///Eswto permite atrapar los erroes con TRY CATCH, de otro modo siempre habra mnen sajesd e PHP MAILER        ///QUE INTERRUMPEN LOS RENDER DE YII        $this->SMTPDebug  = false;       $this->SMTPDebug  = yii::app()->settings->get('email','email_smtpdebug')+0; //DEBE SER UN ENTERO Y CERO =FALSE        $this->Host = yii::app()->settings->get('email','email_servemail');       // $this->exceptions = yii::app()->settings->get('email','email_servemail');        $this->SMTPAuth = true;        $this->SetLanguage('es');        $this->Username = yii::app()->settings->get('email','email_adminemail');        $this->Password = 'toxoplasma1';        $this->_copiarausuario=(yii::app()->user->um->getFieldValue(Yii::app()->user->id,'recibecopiasmail')=='1')?true:false;        $this->_usarcorreousuario=(yii::app()->settings->get('email','email_usamaildeusuario')=='1')?true:false;    }         public function init(){}    private function preparadestinatarios($destinatarios){        if($this->_copiarausuario){            $destinatarios.=",".Yii::app()->user->email;        }        return $destinatarios;    }    private function getemisor(){        if($this->_usarcorreousuario){                        $correoremitente=Yii::app()->user->email;            $nombreremitente=$this->getNombreremitenteusuario();            /*echo "   es correo uusario ";            var_dump($correoremitente);var_dump($nombreremitente);die();*/        } else {            //var_dump(yii::app()->settings('correo','email_usamaildeusuario'));            $correoremitente= $this->Username ;            $nombreremitente= yii::app()->settings->get('email','email_nombrewebmaster') ;            /*echo "   no es correo uusario ";            var_dump($correoremitente);var_dump($nombreremitente);die();*/        }        RETURN ARRAY( $correoremitente,$nombreremitente);    }    private  function getModelPath()    {        if($this->_modelPath!==null)            return $this->_modelPath;        else            return Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'models';    }    /**     * enumControllers     *    lista los nombres de los controllers declarados.     * @access public     * @return array con nombre del controller     */    private function enumModels()    {        if ($this->_venumModels == null) {            $this->_venumModels = array();            $p = $this->getModelPath();            foreach (scandir($p) as $f) {                if ($f == '.' || $f == '..') {                    continue;                }                if (strlen($f)) {                    if ($f[0] == '.') {                        continue;                    }                }                $this->_venumModels[] = substr($f,0,strpos($f,'.php'));            }            return $this->_venumModels;        } else {            return $this->_venumModels ;        }    }    private function getNombreremitenteusuario(){       if (in_array('VwTrabajadores',$this->enumModels())){           $registro= VwTrabajadores::model()->findByPk(yii::app()->user->um->getFieldValue(Yii::app()->user->id,'codtra'));            if(!is_null($registro)){                return $registro->nombrecompleto;            }else{                return "";            }       } else{           return "";       }    }public function correo_adjunto( $mailto,$replyto, $subject, $message,$filename) {   // Yii::import('application.extensions.phpmailer.JPhpMailer');   // $mail = new JPhpMailer;    //$this->SMTPDebug  = 2;$cadena="";    $mailto=$this->preparadestinatarios($mailto);    //print_r($mailto);    $this->IsSMTP();    //$this->Host = 'mail.neotegnia.com';    //$this->SMTPAuth = true;   // $this->Username = 'jramirez@neotegnia.com';    //$this->Password = 'toxoplasma1';   $this->SetFrom($this->getemisor()[0], $this->getemisor()[1]);    $this->Subject = $subject;    $this->AltBody = 'To view the message, please use an HTML compatible email viewer!';    $this->MsgHTML($message.'   <br>  '.$this->getemisor()[1]);    foreach (explode(",",$mailto) as $clave=>$valor){        $this->AddAddress($valor);    }    $this->AddAttachment($filename, $name = '', $encoding = 'base64', $type = 'application/octet-stream');    try{ $this->Send();}    catch (phpmailerException $e){        $cadena.=$e->errorMessage();    }catch (Exception $e){        $cadena.=$e->errorMessage();    }    return $cadena;}    public function correo_simple( $mailto,$replyto, $subject, $message) {        // Yii::import('application.extensions.phpmailer.JPhpMailer');        // $mail = new JPhpMailer;        //$this->SMTPDebug  = 2;        $cadena="";        $mailto=$this->preparadestinatarios($mailto);        $this->IsSMTP();        $this->IsHTML(true);        //$this->Host = 'mail.neotegnia.com';        //$this->SMTPAuth = true;        // $this->Username = 'jramirez@neotegnia.com';        //$this->Password = 'toxoplasma1';        $this->SetFrom($this->getemisor()[0], $this->getemisor()[1]);        $this->Subject = $subject;        $this->AltBody = 'To view the message, please use an HTML compatible email viewer!';      // $this->body= $message;        $this->MsgHTML($message.'   <br> '.$this->getemisor()[1]);        $mailto=$this->preparadestinatarios($mailto);        foreach (explode(",",$mailto) as $clave=>$valor){            $this->AddAddress($valor);        }      // $this->send();       try{ $this->Send();}       catch (phpmailerException $e){           $cadena.=$e->errorMessage();       }catch (Exception $e){           $cadena.=$e->errorMessage();       }        return $cadena;    }}?>