<?php

/**
 * This is the model class for table "{{ot}}".
 *
 * The followings are the available columns in table '{{ot}}':
 * @property string $id
 * @property string $numero
 * @property string $fechacre
 * @property string $fechafinprog
 * @property string $codpro
 * @property integer $idobjeto
 * @property string $codresponsable
 * @property string $textocorto
 * @property string $textolargo
 * @property string $grupoplan
 * @property string $codcen
 * @property integer $iduser
 * @property string $codocu
 * @property string $codestado
 * @property string $clase
 * @property string $hidoferta
 *
 * The followings are the available model relations:
 * @property Detot[] $detots
 * @property Dpeticion $hidoferta0
 * @property Clipro $codpro0
 * @property ObjetosCliente $idobjeto0
 * @property Trabajadores $codresponsable0
 */
class Ot extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ot}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numero, fechacre, fechafinprog, codpro, idobjeto, codresponsable, textocorto, textolargo, grupoplan, codcen, iduser, codocu, codestado, clase, hidoferta', 'required'),
			array('idobjeto, iduser', 'numerical', 'integerOnly'=>true),
			array('numero', 'length', 'max'=>12),
			array('codpro', 'length', 'max'=>8),
			array('codresponsable', 'length', 'max'=>6),
			array('textocorto', 'length', 'max'=>40),
			array('grupoplan, codocu', 'length', 'max'=>3),
			array('codcen', 'length', 'max'=>4),
			array('codestado', 'length', 'max'=>2),
			array('clase', 'length', 'max'=>1),
			array('hidoferta', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, numero, fechacre, fechafinprog, codpro, idobjeto, codresponsable, textocorto, textolargo, grupoplan, codcen, iduser, codocu, codestado, clase, hidoferta', 'safe', 'on'=>'search'),
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
			'detots' => array(self::HAS_MANY, 'Detot', 'hidorden'),
			'hidoferta0' => array(self::BELONGS_TO, 'Dpeticion', 'hidoferta'),
			'codpro0' => array(self::BELONGS_TO, 'Clipro', 'codpro'),
			'idobjeto0' => array(self::BELONGS_TO, 'ObjetosCliente', 'idobjeto'),
			'codresponsable0' => array(self::BELONGS_TO, 'Trabajadores', 'codresponsable'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'numero' => 'Numero',
			'fechacre' => 'Fechacre',
			'fechafinprog' => 'Fechafinprog',
			'codpro' => 'Codpro',
			'idobjeto' => 'Idobjeto',
			'codresponsable' => 'Codresponsable',
			'textocorto' => 'Textocorto',
			'textolargo' => 'Textolargo',
			'grupoplan' => 'Grupoplan',
			'codcen' => 'Codcen',
			'iduser' => 'Iduser',
			'codocu' => 'Codocu',
			'codestado' => 'Codestado',
			'clase' => 'Clase',
			'hidoferta' => 'Hidoferta',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('fechacre',$this->fechacre,true);
		$criteria->compare('fechafinprog',$this->fechafinprog,true);
		$criteria->compare('codpro',$this->codpro,true);
		$criteria->compare('idobjeto',$this->idobjeto);
		$criteria->compare('codresponsable',$this->codresponsable,true);
		$criteria->compare('textocorto',$this->textocorto,true);
		$criteria->compare('textolargo',$this->textolargo,true);
		$criteria->compare('grupoplan',$this->grupoplan,true);
		$criteria->compare('codcen',$this->codcen,true);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('codocu',$this->codocu,true);
		$criteria->compare('codestado',$this->codestado,true);
		$criteria->compare('clase',$this->clase,true);
		$criteria->compare('hidoferta',$this->hidoferta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
