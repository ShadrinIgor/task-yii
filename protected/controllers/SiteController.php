<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends CController
{
    public function init()
    {
    }

    /**
     * Возвращает ошибку
     */
    public function actionError()
    {
        echo "Error:";
        print_r( Yii::app()->errorHandler->error );
    }

	/**
	 * Дефолтове действие
	 */
	public function actionIndex()
	{
        $listTask = Task::model()->findAll( "status = 0" );
        foreach( $listTask as $task ){
            $class = $task->task;
            $action = $task->action;
            if( class_exists( $class ) && property_exists( $class, $action ) )  {
                $params = json_decode( $task->data );
                try{
                    $result = $class::$action( $params );
                }
                catch( \Plp\Task\UserException $exeption ){
                    if( $task->retries < 3 ){
                        $task->retries ++;
                        $task->deffer = date( "Y-m-d H:i", time() + 60*60 ); // Выставляет отсрочку следующего запуска на 1 час
                        $task->save();
                        continue;
                    }
                }
                catch( \Plp\Task\FatalException $exeption ){

                }


                if( $result !== false ){
                    $task->status = 1;
                    $task->finished = date("Y-m-d h:i");
                    $task->result = $result;
                    $task->save();
                }
            }
                else {
                    // Если класс не найден закрываем задачу с ошибкой
                    $task->status = 2;
                    $task->finished = date("Y-m-d h:i");
                    $task->result = 'Error: no exists '.$class."::".$action;
                    $task->save();
                }

        }

	}

}

