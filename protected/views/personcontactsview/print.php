<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>Список абітурієнтів</title>
<style>
TD {
	font-size: 8pt;
	border: 1px solid black;
  font-family: Tahoma;
}

TH {
	font-size: 8pt;
	border: 1px solid black;
  font-family: Tahoma;
  font-weight: bold;
        
}

H1 {
	font-size: 20pt;
  text-align: center;
}

/* Request status styling */
  .req-status-0 {
    color: red;
  }
  .req-status-1 {
    color: black;
  }
  .req-status-2 {
    color: #EE5f5B;
  }
  .req-status-3 {
    color: #800000;
  }
  .req-status-4 {
    color: blue;
  }
  .req-status-5 {
    color: #298dcd;
  }
  .req-status-6 {
    color: #c09853;
  }
  .req-status-7 {
    color: green;
  }
  .req-status-8 {
    color: black;
  }
  .req-status-9 {
    color: #EE5f5B;
  }
  .req-status-10 {
    color: red;
  }

</style>
</head>

<body>
    
  <table style="border-collapse: collapse; width: 18cm;">
    <tr>
      <th>
        ПІБ
      </th>
      <th>
        Контактні дані
      </th>
      <th>
        Спеціальності
      </th>
    </tr>
    <?php 
      //Зпропонував метод булевої змінної: Денис Валерійович Коронець
      $odd = false;
      
      foreach ($contact_data as $contact){
        $bgcolor = ($odd)? "#DDDDDD":"#FFFFFF";
        $cnt_specs = count($contact['SPECS']);
        $cnt_contacts = count($contact['PsnContacts']);
        $lt = ($cnt_specs < $cnt_contacts);
        $rowspan = (!$lt)?
            $cnt_specs : $cnt_contacts;
        $rowspan_diff = (!$lt)?
            $cnt_specs - $cnt_contacts : $cnt_contacts - $cnt_specs;
        
    ?>
    <tr>
      <td style="background-color: <?php echo $bgcolor; ?>;" 
          rowspan="<?php echo $rowspan; ?>">
        <?php echo $contact['NAME']; ?>
      </td>
      
      <?php 
      for ($j = 0; $j < $rowspan; $j++){
        if ($j){
          echo "<tr>";
        }
        if (isset($contact['PsnContacts'][$j])){
        ?>
          <td style="background-color: <?php echo $bgcolor; ?>;" 
            <?php echo (!isset($contact['PsnContacts'][$j+1]) && isset($contact['SPECS'][$j+1]))?
          'rowspan='.($rowspan_diff+1):""; ?> >
            <?php echo (isset($contact['PsnContacts'][$j]))? 
            $contact['PsnContacts'][$j]:""; ?>
          </td>
        <?php 
        }
        
        if (isset($contact['SPECS'][$j])){
        ?>
          <td 
            style="background-color: <?php echo $bgcolor; ?>;"
            class="req-status-<?php echo $contact['status_ids'][$j]; ?>"
            title="<?php echo $contact['statuses'][$j]; ?>"
            <?php echo (!isset($contact['SPECS'][$j+1]) && isset($contact['PsnContacts'][$j+1]))?
          'rowspan='.($rowspan_diff+1):""; ?> >
            <?php echo (isset($contact['SPECS'][$j]))? 
            "<sub style='font-size: 7pt;'>{".$contact['statuses'][$j]."}</sub> ".$contact['SPECS'][$j]:""; ?>
          </td>
        <?php } ?>
        
        </tr>
      <?php } ?>
        
    </tr>
    <?php 
      $odd = !$odd;
    } ?>
  </table>

</body>
</html>