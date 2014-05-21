<?php
/* @var $data array */
/* @var $Speciality string */
/* @var $Faculty string */
/* @var $_contract_counter integer */
/* @var $_budget_counter integer */
/* @var $_pzk_counter integer */
/* @var $_quota_counter integer */
header('Content-Type: text/html; charset=windows-1251');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('Content-transfer-encoding: binary');
header('Content-Disposition: attachment; filename='.str_replace(array(' ',':','.', ',_', '__'),'_',$Speciality).'.xls');
header('Content-Type: application/x-unknown');
/*
?>
<head>
  <meta charset="windows-1251">
</head>
<?php
*/

?>

    		<style>
			TD {
				font-size: 8pt;
				padding: 3px;
				font-family: 'Tahoma';
				vertical-align: middle;
				border:solid 1px black;
			}
			H1 {
				font-size: 16pt;
			}
		</style>
	<?php 
	?>

		<TABLE cellspacing="0" border="0" width="18cm"
           style="border-collapse:collapse;" >
			<TR>
				<TD colspan='7' style="border:solid 0px black;">
					<?php echo iconv("utf-8", "windows-1251",'Факультет:'); ?> 
          <?php echo $Faculty;?>
				</TD>
			</TR>
			<TR>
				<TD colspan='7' style="border:solid 0px black;">
					<?php echo iconv("utf-8", "windows-1251",'Напрям підготовки: '); ?>
					<?php 
					echo $Speciality;
					?>
				</TD>
			</TR>
			<TR>
				<TD colspan='7' style="border:solid 0px black;">
					<?php echo iconv("utf-8", "windows-1251",'Ліцензійний обсяг: ');  
          echo $_contract_counter + $_budget_counter; ?>
				</TD>
			</TR>
			<TR>
				<TD colspan='7' style="border:solid 0px black;">
					<?php echo iconv("utf-8", "windows-1251",'Обсяг державного замовлення: '); echo $_budget_counter; ?>
				</TD>
			</TR>
			<TR>
				<TD colspan='7' style="border:solid 0px black;">
					<?php echo iconv("utf-8", "windows-1251",'з них квота пільговиків: '); ?>
            <?php echo $_pzk_counter; ?>
          <?php echo iconv("utf-8", "windows-1251",', квота цільовиків: '); ?>
            <?php echo $_quota_counter; ?>
				</TD>
			</TR>
			<TR>
				<TD>
					<?php echo iconv("utf-8", "windows-1251",'№ п/п'); ?>
				</TD>
				<TD>
					<?php echo iconv("utf-8", "windows-1251",'ПІБ'); ?>
				</TD>
				<TD>
					<?php echo iconv("utf-8", "windows-1251",'Бал'); ?>
				</TD>
				<TD>
					<?php echo iconv("utf-8", "windows-1251",'Поза конкурс.'); ?>
				</TD>
				<TD>
					<?php echo iconv("utf-8", "windows-1251",'Першочерг.'); ?>
				</TD>
				<TD>
					<?php echo iconv("utf-8", "windows-1251",'Оригінал'); ?>
				</TD>
				<TD style='font-size: 6pt;'>
					<?php echo iconv("utf-8", "windows-1251",'Зарах за хвилею'); ?>
				</TD>
			</TR>
			
			
			<?php if (count($data['quota']) > 0){ ?>
			<TR>
				<TD colspan='7'>
					<?php echo iconv("utf-8", "windows-1251",'ЦІЛЬОВИЙ ПРИЙОМ'); ?>
				</TD>
			</TR>
			<?php } ?>
			
			<!-- Цільовики-->
			<?php for ($i = 1; $i < count($data['quota'])+1; $i++){ ?>
			<TR>
				<TD>
					<?php echo ($i);?>
				</TD>
				<TD>
					<?php echo $data['quota'][$i]['PIB'];?>
				</TD>
				<TD>
					<?php echo $data['quota'][$i]['Points'];?>
				</TD>
				<TD>
					<?php echo $data['quota'][$i]['isPZK'];?>
				</TD>
				<TD>
					<?php echo $data['quota'][$i]['isExtra'];?>
				</TD>
				<TD>
					<?php echo $data['quota'][$i]['isOriginal'];?>
				</TD>
				<TD>
					
				</TD>
			</TR>
			<?php } ?>
			
			
			<?php if (count($data['pzk']) > 0){ ?>
			<TR>
				<TD colspan='7'>
					<?php echo iconv("utf-8", "windows-1251",'ПОЗА КОНКУРСОМ'); ?>
				</TD>
			</TR>
			<?php } ?>
			
			<!-- ПОЗА КОНКУРСОМ-->
			<?php for ($i = 1; $i < count($data['pzk'])+1; $i++){ ?>
			<TR>
				<TD>
					<?php echo ($i);?>
				</TD>
				<TD>
					<?php echo $data['pzk'][$i]['PIB'];?>
				</TD>
				<TD>
					<?php echo $data['pzk'][$i]['Points'];?>
				</TD>
				<TD>
					<?php echo $data['pzk'][$i]['isPZK'];?>
				</TD>
				<TD>
					<?php echo $data['pzk'][$i]['isExtra'];?>
				</TD>
				<TD>
					<?php echo $data['pzk'][$i]['isOriginal'];?>
				</TD>
				<TD>
					
				</TD>
			</TR>
			<?php } ?>
			
			
			<?php if (count($data['budget']) > 0){ ?>
			<TR>
				<TD colspan='7'>
					<?php echo iconv("utf-8", "windows-1251",'ДЕРЖ. ЗАМОВЛЕННЯ'); ?>
				</TD>
			</TR>
			<?php } ?>
			
			<!-- ДЕРЖ. ЗАМОВЛЕННЯ-->
			<?php for ($i = 1; $i < count($data['budget'])+1; $i++){ ?>
			<TR>
				<TD>
					<?php echo ($i);?>
				</TD>
				<TD>
					<?php echo $data['budget'][$i]['PIB'];?>
				</TD>
				<TD>
					<?php echo $data['budget'][$i]['Points'];?>
				</TD>
				<TD>
					<?php echo $data['budget'][$i]['isPZK'];?>
				</TD>
				<TD>
					<?php echo $data['budget'][$i]['isExtra'];?>
				</TD>
				<TD>
					<?php echo $data['budget'][$i]['isOriginal'];?>
				</TD>
				<TD>
					
				</TD>
			</TR>
			<?php } ?>

			<?php if (count($data['contract']) > 0){ ?>
			<TR>
				<TD colspan='7'>
					<?php echo iconv("utf-8", "windows-1251",'ЗА КОНТРАКТОМ'); ?>
				</TD>
			</TR>
			<?php } ?>
			
			<!-- ЗА КОНТРАКТОМ-->
			<?php for ($i = 1; $i < count($data['contract'])+1; $i++){ ?>
			<TR>
				<TD>
					<?php echo ($i);?>
				</TD>
				<TD>
					<?php echo $data['contract'][$i]['PIB'];?>
				</TD>
				<TD>
					<?php echo $data['contract'][$i]['Points'];?>
				</TD>
				<TD>
					<?php echo $data['contract'][$i]['isPZK'];?>
				</TD>
				<TD>
					<?php echo $data['contract'][$i]['isExtra'];?>
				</TD>
				<TD>
					<?php echo $data['contract'][$i]['isOriginal'];?>
				</TD>
				<TD>
					
				</TD>
			</TR>
			<?php } ?>
      
			<!-- НЕ ПРОХОДЯТЬ ЗА КОНКУРСОМ -->
			<?php for ($i = 1; $i < count($data['below'])+1; $i++){ 
        if (!isset($data['below'][$i])){
          continue;
        }
        if ($i == 1){
          ?>
			<TR>
				<TD colspan='7' style="border:solid 0px black;">
      <center>
        =====================================================================
      </center>
				</TD>
			</TR>
          <?php
        }
        ?>
      <TR>
				<TD>
					<?php echo ($i);?>
				</TD>
				<TD>
					<?php echo $data['below'][$i]['PIB'];?>
				</TD>
				<TD>
					<?php echo $data['below'][$i]['Points'];?>
				</TD>
				<TD>
					<?php echo $data['below'][$i]['isPZK'];?>
				</TD>
				<TD>
					<?php echo $data['below'][$i]['isExtra'];?>
				</TD>
				<TD>
					<?php echo $data['below'][$i]['isOriginal'];?>
				</TD>
				<TD>
					
				</TD>
			</TR>
			<?php } ?>
			
		</TABLE>


<?php
	
?>