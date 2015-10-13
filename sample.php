<?php
$db_name = "wichai_rama";
$character_set = 'utf8';
session_start();
$link = mysql_connect("127.0.0.1", "root", "");
mysql_set_charset($character_set, $link);
mysql_select_db($db_name, $link);

function query($sql)
{
    $resource = mysql_query($sql) or die(mysql_error());
    if ($resource) {
        if (is_resource($resource)) {
            $i = 0;
            $data = array();
            while ($result = mysql_fetch_assoc($resource)) {
                $data[$i] = $result;
                $i++;
            }
            return $data;
        } else
            return mysql_insert_id();
    } else
        return false;
}

function mean($array, $key){
    $sum = 0;
    foreach($array as $row){
        $sum += $row[$key];
    }
    return $sum / count($array);
}

$sql = "SELECT * FROM patient WHERE apache_ii IS NOT NULL";
$data = query($sql);

while (true) {
    $selected = [];
    $indices = [];
    while (count($selected) < 50) {
        $index = array_rand($data);
        if (!in_array($index, $indices)) {
            $indices[] = $index;
            $selected[] = $data[$index];
        }
    }
    if(abs(mean($selected, 'apache_ii') - 25) < 1)
        break;
}

$i = 0;
echo 'Mean : ' . mean($selected, 'apache_ii');
?>
<table>
<?
foreach($selected as $row){
    ?>
    <tr>
        <td><? echo ++$i ?></td>
        <td><? echo $row['HN'] ?></td>
        <td><? echo $row['apache_ii'] ?></td>
    </tr>
    <?
}
?>
</table>
