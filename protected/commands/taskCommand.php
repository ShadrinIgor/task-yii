<?php


/**
 * SiteController is the default controller to handle user requests.
 */
class TaskCommand extends CConsoleCommand
{
	/**
	 * Дефолтовое действие
	 */
	public function run()
	{
        do{
            $listTask = $this->getActualTask();
            foreach( $listTask as $task ){
                echo $this->goTask( $task );
            }
        }while( 1==1 );
	}

    /**
     * Возвращяет список актуальных задач
     * @return array Task[]
     */
    public function getActualTask()
    {
        return Task::model()->findAll( "status = 0 AND ( ISNULL(deffer) OR deffer<=:deffer )", [":deffer"=>date("Y-m-d H:i")] );
    }

    /**
     * Завершаем задачу, выставляя ей соответсвующие параметры
     * @param $task
     * @param $status
     * @param $result
     */
    public function finishTask( $task, $status, $result )
    {
        $task->status = $status;
        $task->finished = date("Y-m-d h:i");
        $task->result = json_encode( $result );
        $task->save();
    }

    /**
     * Исполняем задачу и завершаем по окончанию
     * @param $task
     * @return string
     */
    public function goTask( $task )
    {
        $class = $task->task;
        $action = $task->action;
        $params = json_decode( $task->data );

        $cout = date("Y-m-d H:i")." ".$task->id." ".$class." ".$action." ";

        if( $task->status == 0 ){

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
                $cout .= $exeption."\n\r";
                $task->save();
                return $cout;
            }

            catch( FatalException $exeption ){
                Yii::log('#'.$task->id.' Task Error: '. $exeption, "error", "controllers.SiteController");
                $cout = $exeption."\n\r";
                $this->finishTask( $task, 2, "" );
                return $cout;
            }

            catch (Exception $exeption) {
                $cout .= $exeption."\n\r";
                $this->finishTask( $task, 2, $exeption );
                return $cout;
            }

            if( !empty( $result ) && $result !== false ){
                $cout .= $result."\n\r";
                $this->finishTask( $task, 1, $result );
            }
        }
            else $cout .= "- ERROR task #".$task->id." is not actual\n\r";

        return $cout;
    }
}

