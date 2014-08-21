
<?php
/* @var $data CArrayDataProvider */
/* @var $columns array */
  header('Content-Type: text/html; charset=utf-8');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');
  header('Content-transfer-encoding: binary');
  header('Content-Disposition: attachment; filename=REPORT-' . date('d.m.Y') . '.xls');
  header('Content-Type: application/x-unknown');
$models = $data->getData();
$HTML = '';
$HTML .= '<html><head><meta charset="windows-1251"><title>REPORT-' . date('d.m.Y'). '</title></head><body>';
$HTML .= '<table border=1>';
$i = 0;
foreach ($models as $model){
  if (!$i){
    $HTML .= '<tr>'; 
    foreach ($columns as $column){
      $HTML .= '<th>'.$column['header'].'</th>';
    }
    $HTML .= '</tr>';
  }
  $HTML .= '<tr>';
  foreach ($columns as $column){
    ob_start();
    //eval('echo '.str_replace('data','model',$column['value']).';');
    $column['value']($model);
    $out = ob_get_contents();
    $HTML .= '<td>'.$out.'</td>';
    ob_end_clean();
    //$HTML .= '<td>'.eval($column['value']).'</td>';
  }
  $HTML .= '</tr>';
  $i++;
}
$HTML .= '</table></body></html>';
echo iconv("utf-8", "windows-1251", $HTML);