<?php

//use \Plp\Task;
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
        $listTask = Task::model()->findAll( "status = 0 AND ( ISNULL(deffer) OR deffer<=:deffer )", [":deffer"=>date("Y-m-d H:i")] );

        foreach( $listTask as $task ){
            $class = $task->task;
            $action = $task->action;
            $params = json_decode( $task->data );

            try{
                $result = $class::$action( $params );
            }
            catch( UserException $exeption ){
                if( $task->retries < 3 ){
                    $task->retries ++;
                    $task->deffer = date( "Y-m-d H:i", time() + 60*60 ); // Выставляет отсрочку следующего запуска на 1 час
                }
                    else {
                        $task->status = 2;
                        $task->finished = date("Y-m-d h:i");
                    }

                $task->result = $exeption;
                $task->save();
                continue;
            }

            catch( FatalException $exeption ){
                Yii::log('#'.$task->id.' Task Error: '. $exeption, "error", "controllers.SiteController");
                $this->finishTask( $task, 2, "" );
            }

            catch (Exception $e) {
                $this->finishTask( $task, 2, $exeption );
            }

            if( !empty( $result ) && $result !== false ){
                $this->finishTask( $task, 1, $result );
            }
        }

	}

    private function finishTask( $task, $status, $result )
    {
        $task->status = $status;
        $task->finished = date("Y-m-d h:i");
        $task->result = $result;
        $task->save();
    }
}

