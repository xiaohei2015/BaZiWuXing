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
?>
    <br/>测算结果：
<?php
    var_dump(GladUseGod::getGladUseGodDetails($ba_zi));
}
?>
</body>
</html>