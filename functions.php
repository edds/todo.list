<?php
error_reporting(0);
include('./config.php');
mysql_connect($db_host,$db_user,$db_pass) or die('mysql connection failed. Please check config.php');
mysql_select_db($db_database);


function getLists(){
    $lists = array();
    $result = mysql_query("SELECT * FROM todo_lists WHERE Archive='0'") or die(mysql_error());
    while($row = mysql_fetch_assoc($result)){
        $lists[$row['ListID']]['Title'] = $row['Title'];    
    }
    $result = mysql_query("SELECT * FROM todo_tasks WHERE Archive='0'") or die(mysql_error());
    while($row = mysql_fetch_assoc($result)){
        $lists[$row['ListID']]['Tasks'][] = $row;    
    }
    return $lists;
}

function printLists(){
    $lists = getLists();
    $out = '';
    foreach($lists as $ListID => $list){
        $out .= '<h1 list="'.$ListID.'">'.$list['Title'].'</h1>'."\n";
        $out .= '<ul list="'.$ListID.'">'."\n";
        if(count($list['Tasks']))
            foreach($list['Tasks'] as $task){
                $checked = $task['Done'] ? ' checked="checked"' : '';
                $class = $task['Done'] ? ' class="done"' : '';
                $text = preg_replace('/(@[^\W]+)/','<em>\1</em>', $task['Text']);
                $out .= "\t".'<li task="'.$task['TaskID'].'"><input type="checkbox"'.$checked.'> <span'.$class.'>'.$text.'</span></li>'."\n";
            }
        $out .= '</ul>'."\n".
            '<p class="actions" list="'.$ListID.'"><a class="newitem" list="'.$ListID.'" href="#">new item</a> - <a class="archiveDone" href="./action.php?archive='.$ListID.'">archive done</a> - <span class="archive">archive entire list</span></p>'."\n\n";
    }
    print $out;
}
?>