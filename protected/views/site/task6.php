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
    <div class="panel-heading">Задание #6</div>
    <div class="panel-body">
<?php

echo CHtml::openTag('table',[ "width"=>"100%"]);
for( $i=0;$i< sizeof( $rowsArray );$i++  ){
    echo CHtml::openTag('tr');

    echo CHtml::tag('td', [], $rowsArray[$i][0]); // for cells
    echo CHtml::tag('td', [], $rowsArray[$i][1]); // for cells
    echo CHtml::closeTag('tr');
}
echo CHtml::closeTag('table');

?>
    </div>
</div>
</body>
</html>