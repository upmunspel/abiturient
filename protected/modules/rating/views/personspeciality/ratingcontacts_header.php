<?php
  header('Content-Type: text/html; charset=windows-1251');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');
if (1) {
  header('Content-transfer-encoding: binary');
  header('Content-Disposition: attachment; filename=' . iconv("windows-1251", "utf-8",str_replace(array(' ', ':', '.', ',_', '__'), '_', $Faculty) . '.xls'));
  header('Content-Type: application/x-unknown');
}
  ?>
<html>
  <head>
    <meta charset="windows-1251">
    <title><?php echo iconv("windows-1251","utf-8",$Faculty); ?></title>
    <style id="rating_style">
  .faculty {
    font-size: 8pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border-left:solid 1px black;
    border-right:solid 1px black;
    border-top:solid 1px black;
  }
  
  .direction, .license_count, .budget_count, .quota_count {
    font-size: 8pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border-left:solid 1px black;
    border-right:solid 1px black;
  }
  
  
  .number_header , .original_header , .original_header, .pzk_header , .pv_header {
    font-size: 8pt;
    font-weight: bold;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
  }
  
  .person_header , .points_header {
    font-size: 10pt;
    font-weight: bold;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
  }
  
  .contacts_header {
    font-size: 10pt;
    font-weight: bold;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
    word-break: break-all;
    width: 3cm;
  }
  
  .target_committee , .pzk_committee , .budget_committee , .contract_committee, .fatal_line{
    font-size: 10pt;
    font-weight: bold;
    padding: 5px;
    font-family: 'Tahoma';
    border-left:solid 1px black;
    border-right:solid 1px black;
  }
  
  .num , .pzk , .pv , .original {
    font-size: 8pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
    word-break: break-all;
    width: 1cm;

  }
  
  .contacts{
    font-size: 10pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
    word-break: break-all;
    width: 3cm;
  }
  
  .person , .points {
    font-size: 10pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
  }
    </style>
  </head>
<?php
?>
<body>
  <TABLE cellspacing="0" border="0"
         style="border-collapse:collapse;" >