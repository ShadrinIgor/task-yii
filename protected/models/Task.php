<?php
 /**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property string $id
 * @property string $account_id
 * @property string $created
 * @property string $deffer
 * @property integer $type
 * @property string $task
 * @property string $action
 * @property string $data
 * @property integer $status
 * @property integer $retries
 * @property string $finished
 * @property string $result
 */

 //namespace Plp\Task;

class Task extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, status, retries', 'numerical', 'integerOnly'=>true),
			array('account_id', 'length', 'max'=>10),
			array('task, action', 'length', 'max'=>45),
			array('created, deffer, data, finished, result', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_id, created, deffer, type, task, action, data, status, retries, finished, result', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account_id' => 'Account',
			'created' => 'Created',
			'deffer' => 'Deffer',
			'type' => 'Type',
			'task' => 'Task',
			'action' => 'Action',
			'data' => 'Data',
			'status' => 'Status',
			'retries' => 'Retries',
			'finished' => 'Finished',
			'result' => 'Result',
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
		$criteria->compare('account_id',$this->account_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('deffer',$this->deffer,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('task',$this->task,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('retries',$this->retries);
		$criteria->compare('finished',$this->finished,true);
		$criteria->compare('result',$this->result,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
