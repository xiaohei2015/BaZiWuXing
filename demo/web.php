<?php

require __DIR__ . "/../src/index.php";

use Xiaohei2015\BaZiWuXing\GladUseGod;

$ba_zi = $_POST['ba_zi'];
?>
<html xmlns=http://www.w3.org/1999/xhtml>
<head>
    <meta http-equiv=Content-Type content="text/html;charset=utf-8">
</head>
<body>
<form method="post">
    八字<input type="text" name="ba_zi" value="<?php echo $ba_zi;?>"/>
    <input type="submit" value="测算">
</form>

<?php
if($ba_zi){
    $result = GladUseGod::getGladUseGodDetails($ba_zi);
?>
    <br/>测算结果：<br/>
    五行同类：<?php echo $result['same'][0].','.$result['same'][1].'  得分：'.$result['strength_same']; ?><br/><br/>
    五行异类：<?php echo $result['diff'][0].','.$result['diff'][1].','.$result['diff'][2].'  得分：'.$result['strength_diff']; ?><br/><br/>
    喜用神：<?php
    $str_glad_use_god = '';
    foreach ($result['glad_use_god'] as $v){
        $str_glad_use_god .= $v.',';
    }
    $str_glad_use_god = mb_substr($str_glad_use_god, 0, mb_strlen($str_glad_use_god,'UTF-8')-1,'UTF-8');
    echo $str_glad_use_god;
    ?><br/><br/>
    五行详情：<br/><?php
    foreach($result['strength_all'] as $k=>$v){
        echo $k.':'.$v.'<br/>';
    }
    ?>
<?php
    var_dump();
}
?>
</body>
</html>