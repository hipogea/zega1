<?php

class Detot extends ModeloGeneral
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{detot}}';
	}
        
        public function behaviors()
	{
		//var_dump(yii::app()->settings->get('general','general_nregistrosporcarpeta'));die();
            
            return array(
			// Classname => path to Class
			'imagenesjpg'=>array(
				'class'=>'ext.behaviors.TomaFotosBehavior',
                            '_codocu'=>'210',
                            '_ruta'=>yii::app()->settings->get('general','general_directorioimg'),
                            '_numerofotosporcarpeta'=>yii::app()->settings->get('general','general_nregistrosporcarpeta')+0,
                            '_extensionatrabajar'=>'.jpg',
                            '_id'=>$this->getPrimarykey(),
                                ));

	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id, hidorden, item, textoactividad, codresponsable, fechainic, fechafinprog, fechacre, flaginterno, codocu, tipo, codestado, codmaster, idinventario, iduser, idusertemp, idstatus, txt', 'required'),
			array('idinventario, iduser, idaux,idusertemp, idstatus', 'numerical', 'integerOnly'=>true),
			array('codocu,idlabor,avance,codestado,nhoras,fechainic,fechafinprog,fechafin,'
                            . 'fechainiprog,idaux,nhombres,codmon,monto,tipo,txt,cc,codmaster,codgrupoplan', 'safe'),
			array('id, hidorden', 'length', 'max'=>20),
			array('item, codocu, codestado', 'length', 'max'=>3),
			array('textoactividad', 'length', 'max'=>40),
			array('codresponsable', 'length', 'max'=>8),
			array('flaginterno, tipo', 'length', 'max'=>1),
			array('codmaster', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hidorden, item, textoactividad, codresponsable, fechainic, fechafinprog, fechacre, flaginterno, codocu, tipo, codestado, codmaster, idinventario, iduser, idusertemp, idtemp, idstatus, txt', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cecosto'=> array(self::BELONGS_TO, 'Cc', 'cc'),
			'ot' => array(self::BELONGS_TO, 'Ot', 'hidorden'),
			'trabajadores' => array(self::BELONGS_TO, 'Trabajadores', 'codresponsable'),
		  'tempdetot'=>array(self::HAS_ONE, 'Tempdetot', 'id'),
                  //  'nrecursos' => array(self::STAT, 'Desolpe', 'hidlabor'),
                    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hidorden' => 'Hidorden',
			'item' => 'Item',
			'textoactividad' => 'Textoactividad',
			'codresponsable' => 'Codresponsable',
			'fechainic' => 'Fechainic',
			'fechafinprog' => 'Fechafinprog',
			'fechacre' => 'Fechacre',
			'flaginterno' => 'Flaginterno',
			'codocu' => 'Codocu',
			'tipo' => 'Tipo',
			'codestado' => 'Codestado',
			'codmaster' => 'Codmaster',
			'idinventario' => 'Idinventario',
			'iduser' => 'Iduser',
			'idusertemp' => 'Idusertemp',
			'idtemp' => 'Idtemp',
			'idstatus' => 'Idstatus',
			'txt' => 'Txt',
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('hidorden',$this->hidorden,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('textoactividad',$this->textoactividad,true);
		$criteria->compare('codresponsable',$this->codresponsable,true);
		$criteria->compare('fechainic',$this->fechainic,true);
		$criteria->compare('fechafinprog',$this->fechafinprog,true);
		$criteria->compare('fechacre',$this->fechacre,true);
		$criteria->compare('flaginterno',$this->flaginterno,true);
		$criteria->compare('codocu',$this->codocu,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('codestado',$this->codestado,true);
		$criteria->compare('codmaster',$this->codmaster,true);
		$criteria->compare('idinventario',$this->idinventario);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('idusertemp',$this->idusertemp);
		$criteria->compare('idtemp',$this->idtemp,true);
		$criteria->compare('idstatus',$this->idstatus);
		$criteria->compare('txt',$this->txt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterSave(){
		Tempdesolpe::model()->updateAll(array("hidlabor"=>$this->id),"hidlabor=:viden",array(":viden"=>$this->idtemp));
		return parent::afterSave();
    }
    
    public function afterfind(){
        if($this->idlabor==0)
            $this->idlabor=null;
		return parent::afterfind();
    }
    

PUBLIC FUNCTION nrecursos(){
        return count($this->recursos);
    }   
    
    public function recursos(){
        return Desolpe::model()->findAll("hidlabor=:vidlabor",array(":vidlabor"=>$this->idaux));
        
    }
    
    public function colocaarchivox($fullFileName,$userdata=null) {
       // $filename=$fullFileName;
        $this->colocaarchivo($fullFileName);
    }
    
  public function suggestceco($keyword,$limit=20)
	{
		$models=$this->findAll(array(
			'condition'=>'desceco LIKE :keyword',
			'order'=>'desceco',
			'limit'=>$limit,
			'params'=>array(':keyword'=>"%$keyword%")
		));
		$suggest=array();
		//$suggest=array(JSON_ENCODE($models[0]),'KFSHFKSIY');
		foreach($models as $model) {
			$suggest[] = array(
				'label'=>$model->codc.' - '.$model->desceco,  // label for dropdown list
				'value'=>$model->codc,  // value for input field
				//'id'=>$model->id,       // return values from autocomplete
				//'code'=>$model->code,
				//'call_code'=>$model->call_code,
			);
		}
		
		return $suggest;
	}  
}
