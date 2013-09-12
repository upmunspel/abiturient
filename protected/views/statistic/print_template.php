<?php
function print_template($data,$columns,$labels,$title,$group_field_name){
    $N = count($data);
    if (isset($data['totals'])){
        $N --;
    }
    $html_header = "
    <html>
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>".$title."</title>
    <style media=\"print\">
    TD {
            font-size: 7pt;
            border: 1px solid black;
            font-family: 'Tahoma';
    }
    TH {
            font-size: 7pt;
            border: 1px solid black;
            font-family: 'Tahoma';
    }
    H1 {
            font-size: 12pt;
            font-family: 'Tahoma';
    }

    A {
            text-decoration: none;
            color: black;
            font-family: 'Tahoma';
    }
    </style>
    <style media=\"screen\">
    TD {
            font-size: 10pt;
            /* border: 1px solid black; */
            padding: 5px;
            font-family: 'Tahoma';
    }
    TH {
            font-size: 8pt;
            /* border: 1px solid black; */
            padding: 3px;
            font-family: 'Tahoma';

    }
    H1 {
            font-size: 16pt;
    }


    </style>
    </head>
    <body>

    <center><h1>
        ".$title."
    </h1>";
    if ($group_field_name != ""){ 
        $rowspans = array();
        $r = 0;
        $rspan = 1;
        for ($i = 0; $i < $N-1; $i++){
            /* @var $curr string */
            /* @var $next string */
            if (isset($data[$i][$group_field_name])){
                $curr = $data[$i][$group_field_name];
                $next = $data[$i+1][$group_field_name];
            } else {
                $curr = $data[$i]->getAttribute($group_field_name);
                $next = $data[$i+1]->getAttribute($group_field_name);
            }
            if ($next != $curr){
               $rowspans[$r++] = $rspan;
               $rspan = 1;
            } else {
                $rspan++;
            }
        }
        $rowspans[$r] = $rspan;
    }

   // var_dump($table_row);
    $j = 0;

    $table_header = "<table border=\"1\" cellspacing=\"0\"><tr>";
    foreach ($columns as $col){
        if (isset($col['htmlOptions']) && $col['htmlOptions']){
            $table_header .= "<th style='".$col['htmlOptions']['style']."'>";
        } else {
            $table_header .=  "<th>";
        }
        $table_header .= $labels[$col['name']]."</th>";
    }
    $table_header .= "</tr>";

    $table_row = array();
    $r = 0;
    $k = 0;
    for ($i = 0; $i < $N; $i++, $r++, $j++){
        $table_row[$j] = "<tr>";
        $is_group = 0;
        if (isset($rowspans) && $r == $rowspans[$k] || $i == 0){
            $k++;
            if ($i == 0) ($k--);
            $r = 0;
            $is_group = 1;
        }
        foreach ($columns as $col){
            $table_row[$j] .= "<td ";
            if ($col['name'] == $group_field_name && $is_group == 1){
                $table_row[$j] .= "rowspan='".$rowspans[$k]."' ";
            }
            if ($col['name'] == $group_field_name && $is_group == 0){
                continue;
            }
            if (isset($col['htmlOptions']) && $col['htmlOptions']){
                $table_row[$j] .= "style='".$col['htmlOptions']['style']."'>";
            } else {
                $table_row[$j] .=  ">";
            }
            
            if (isset($data[$i][$col['name']])){
                $value = $data[$i][$col['name']];
            } else {
                $value = $data[$i]->getAttribute($col['name']);
            }
            $table_row[$j] .= $value."</td>";
        }
        $table_row[$j] .= "</tr>";
        //echo $table_row[$j++];
    }
    $table_total = "";
    if (isset($data['totals'])){
        $colspan_total = count($labels) - count($data['totals']);
        $table_total .= "<tr><td colspan=\"".$colspan_total."\" align='center'>Усього</td>";
        foreach ($labels as $key=>$lab){
            if (isset($data['totals'][$key])){
                $table_total .= "<td>".$data['totals'][$key]."</td>";
            }
        }
        $table_total .= "</tr>";
    }
    
    $html_footer = "
    </table>
    </center>

    </body>
    </html>    
    ";
    
    //vivod
    echo $html_header;
    echo $table_header;
    for ($j = 0; $j < count($table_row); $j++){
        echo $table_row[$j];
    }
    echo $table_total;
    echo $html_footer;
}
?>