<?php

/**
 * Тестирование функционала commands/TaskCommand.php
 */
class Test1 extends CDbTestCase
{
    public $fixtures=array(
        'Task'=>'Task'
    );

    /*
     ** getActualTask - возвращает список актуальных задач
     ** finishTask - проверяем завершенна ли задача и правельные ли выставленны параметры
     * goTask - проверяем правильно ли обработла задачу и какой результат выдал
     */

    /**
     * Проверяем параметры поиска актуальных задач
     */
	public function testCountActualTask()
	{
        require_once  "../commands/TaskCommand.php";
        $obj = new TaskCommand();

        $list = $obj->getActualTask();
		$this->assertCount( 2, $list );
	}

    /**
     * Проверяем финишируется ли задача и правельные параметры ли ей выставляются
     */
	public function testFinishTask()
	{
        require_once  "../commands/TaskCommand.php";
        $obj = new TaskCommand();

        // Выбираем любую запись для финиширования
        $task = Task::model()->findByPk(2971107);
        $this->assertEquals( 2971107, $task->id );

        $randomResult = md5( time() );
        $obj->finishTask( $task, 1, $randomResult );

        // Проверяем параметры
        $task = Task::model()->findByPk(2971107);
        $this->assertEquals( 1, $task->status );
        $this->assertEquals( json_encode( $randomResult ), $task->result );
	}

    /**
     * Проверяем результат запуска команды и правильность выставления параметров по завершению
     */
    public function testGoTask()
    {
        require_once  "../commands/TaskCommand.php";
        $obj = new TaskCommand();

        // Первая проверка актуальной задачи
        $task = Task::model()->findByPk(2971187);
        $this->assertEquals( date("Y-m-d H:i")." ".$task->id." ".$task->task." ".$task->action." 1\n\r", $obj->goTask( $task ) ); // проверяем возврящаемое выражение
        // проверяем значение которые ей были выставленны
        $this->assertEquals( 1, $task->status );
        $this->assertEquals( json_encode(true), $task->result );

        // Первая проверка не актуальной задачи ( со статусом = 1 )
        $task = Task::model()->findByPk(2971122);
        $result = date("Y-m-d H:i")." ".$task->id." ".$task->task." ".$task->action." - ERROR task #".$task->id." is not actual\n\r";
        $this->assertEquals( $result, $obj->goTask( $task ) );
    }
}
