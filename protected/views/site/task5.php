<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Language" content="ru" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="themes/css/bootstrap.min.css" rel="stylesheet" />
        <link href="themes/css/style.css" rel="stylesheet" />
        <script type="text/javascript" src="themes/js/bootstrap.min.js" ></script>
        <script>
            var baseUrl = '<?= Yii::app()->params['baseUrl'] ?>';
        </script>
    </head>
<body>
<div class="panel panel-success">
    <div class="panel-heading">Задание #5</div>
    <div class="panel-body">
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model,
));

?>
    </div>
</div>
</body>
</html>