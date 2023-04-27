<?php

$con = mysql_connect('blah blah blah') or die(mysql_error());
$db = mysql_select_db('blah',$con) or die(mysql_error());
$result = mysql_query("query MAYBE NARROW DOWN TO MORE RELEVANT RESULT SET") or die (mysql_error());

$option = '<select size="1" name="optionBox">';

if(mysql_num_rows($result)>=1){
    while ($row=mysql_fetch_assoc($result)){
        $option .="<option selected value=\"".$row['ItemName']."\">".$row['ItemName']."</option>\n";
    }
}else{
    $option .='<option selected value="0">No items to list</option>';
}
$option .='</select>';

echo $option;

mysql_close($con);
?>