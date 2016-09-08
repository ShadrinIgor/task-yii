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
    }

	/**
	 * Дефолтове действие
	 */
	public function actionIndex()
	{
        do
        {
            $listTask = Task::model()->findAll( "status = 0 AND ( ISNULL(deffer) OR deffer<=:deffer )", [":deffer"=>date("Y-m-d H:i")] );

            foreach( $listTask as $task ){
                $class = $task->task;
                $action = $task->action;
                $params = json_decode( $task->data );

                echo date("Y-m-d H:i")." ".$task->id." ".$class." ".$action." ";
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
                    echo $exeption."\n\r";
                    $task->save();
                    continue;
                }

                catch( FatalException $exeption ){
                    Yii::log('#'.$task->id.' Task Error: '. $exeption, "error", "controllers.SiteController");
                    echo $exeption."\n\r";
                    $this->finishTask( $task, 2, "" );
                }

                catch (Exception $exeption) {
                    echo $exeption."\n\r";
                    $this->finishTask( $task, 2, $exeption );
                }

                if( !empty( $result ) && $result !== false ){
                    echo $result."\n\r";
                    $this->finishTask( $task, 1, $result );
                }
            }

        }while( 1==1 );

	}

    private function finishTask( $task, $status, $result )
    {
        $task->status = $status;
        $task->finished = date("Y-m-d h:i");
        $task->result = json_encode( $result );
        $task->save();
    }
}

