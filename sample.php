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

function sd($array, $key){
    $mean = mean($array, $key);
    $sum = 0;
    foreach($array as $row){
        $sum += pow($mean - $row[$key], 2);
    }
    return pow($sum / (count($array) - 1), 0.5);
}

function percent($array, $key){
    $cnt = 0;
    foreach($array as $row){
        $cnt += !empty($row[$key]) ? 1 : 0;
    }
    return $cnt / count($array);
}

$cnt = 50;
if(!empty($_GET['cnt']))
    $cnt = $_GET['cnt'];

$mean = 25;
if(!empty($_GET['mean']))
    $mean = $_GET['mean'];

$sd = 8;
if(!empty($_GET['sd']))
    $sd = $_GET['sd'];

$disease_code = 'J80';
if(!empty($_GET['disease_code']))
    $disease_code = $_GET['disease_code'];

$disease_percent = '20';
if(!empty($_GET['disease_percent']))
    $disease_percent = $_GET['disease_percent'];

$disease_percent_range = '5';
if(!empty($_GET['disease_percent_range']))
    $disease_percent_range = $_GET['disease_percent_range'];

$primary_key = 'HN';
$exclude_key = [];
if(!empty($_GET['exclude_key'])){
    $exclude_key = explode(',',$_GET['exclude_key']);
}

$sql = "SELECT p.*, IF(COUNT(CASE DX_CODE WHEN '$disease_code' THEN DISEASE_NAME ELSE NULL END) > 0, 1, 0) AS '$disease_code'";
$sql .= " FROM patient p LEFT JOIN disease d USING(HN) WHERE apache_ii IS NOT NULL GROUP BY HN";
$data = query($sql);

while (true) {
    $indices = [];
    $selected = [];
    while (count($selected) < $cnt) {
        $index = array_rand($data);
        if (!in_array($index, $indices) && !in_array($data[$index][$primary_key], $exclude_key)) {
            $indices[] = $index;
            $selected[] = $data[$index];
        }
    }
    if(abs(mean($selected, 'apache_ii') - $mean) < 1 && abs(sd($selected, 'apache_ii') - $sd) < 1
        && abs(percent($selected, $disease_code) - ($disease_percent / 100)) < ($disease_percent_range / 100))
        break;
}

usort($selected, function($a, $b) {
    return $a['HN'] - $b['HN'];
});

$i = 0;
echo 'Mean : ' . mean($selected, 'apache_ii') . '<br>';
echo 'SD : ' . sd($selected, 'apache_ii') . '<br>';
echo 'Percent : ' . percent($selected, $disease_code) * 100 . '%<br>';
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
