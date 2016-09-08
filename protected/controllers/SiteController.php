<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends CController
{
    protected $p;

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
	 * Task 4
	 */
	public function actionIndex()
	{
        $sql = "SELECT s.cx, s.title, r.ndc FROM `tb_source` s INNER JOIN ( SELECT cx, ndc FROM `tb_rel` GROUP BY cx ) r USING( cx ) WHERE INSTR( s.title, 'title 1' ) = 1";

        $rowsArray = [];
        $list = TbSource::model()->findAllBySql( $sql );
        foreach( $list as $obj ){
            $rowsArray[] = [ $obj->getAttributes(false)["cx"], $obj->getAttributes(false)["title"] ];
        }

		$this->render('index', [ "columnsArray"=>["cx", "ndc", "title"],  "rowsArray"=>$rowsArray ]);
	}

    public function actionTask5()
    {
        $sql = "SELECT s.cx, s.title, r.ndc FROM `tb_source` s INNER JOIN ( SELECT cx, ndc FROM `tb_rel` GROUP BY cx ) r USING( cx ) WHERE INSTR( s.title, 'title 1' ) = 1";
        $sql2 = "SELECT count( s.cx ) as count FROM `tb_source` s INNER JOIN ( SELECT cx, ndc FROM `tb_rel` GROUP BY cx ) r USING( cx ) WHERE INSTR( s.title, 'title 1' ) = 1";
        $count = Yii::app()->db->createCommand( $sql2 )->queryScalar();

        $model = new CSqlDataProvider( $sql, array(
            'keyField' => 'cx',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'cx', 'ndc'
                ),
                'defaultOrder' => array(
                    'cx' => CSort::SORT_ASC,
                ),
            ),
            'pagination' => array(
                'pageSize' => 25,
            ),
        ));

        $this->render('task5', [ "model"=>$model ]);
    }

    public function actionTask6()
    {
        $sql = "SELECT s.cx, s.title, r.ndc FROM `tb_source` s INNER JOIN ( SELECT cx, ndc FROM `tb_rel` GROUP BY cx ) r USING( cx ) WHERE INSTR( s.title, 'title 1' ) = 1";

        $rowsArray = [];
        $list = TbSource::model()->cache(1000)->findAllBySql( $sql );
        foreach( $list as $obj ){
            $rowsArray[] = [ $obj->getAttributes(false)["cx"], $obj->getAttributes(false)["title"] ];
        }

        $this->render('task6', [ "columnsArray"=>["cx", "ndc", "title"],  "rowsArray"=>$rowsArray ]);
    }
}

