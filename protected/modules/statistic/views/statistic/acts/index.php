<?php

	/*mysql_connect("10.1.103.26","root","ehHYAuj");
	mysql_query("set names utf8");
	mysql_query("use abiturient");
	//mysql_query("delete from edbo_data");*/
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Акты</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
                <script type="text/javascript">
                function who()
                {
                    val = document.act.facultet.options[document.act.facultet.selectedIndex].value;
                    var objSpec = document.act.spec;
                    var objSpecialization = document.act.specialization;
                    
                    switch(val)
                    {
                        case 'Математичний': 
                            for (i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;
                            }
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization[i] = null;
                            }
                            
                            objSpec.options[0] = new Option("Програмна інженерія","Програмна інженерія",true,true);
                            objSpec.options[1] = new Option("Інформатика","Інформатика",false,false);
                            objSpec.options[2] = new Option("Прикладна математика","Прикладна математика",false,false);
                            objSpec.options[3] = new Option("Математика","Математика",false,false);     
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true); 
                            
                            break;
                            
                        case 'Біологічний': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                            
                            }  
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("екологія, охорона навколишнього середовища та збал...",
                                                   "екологія, охорона навколишнього середовища та збалансоване природокористування",true,true);
                            objSpec.options[1] = new Option("Біологія","Біологія",false,false);
                            objSpec.options[2] = new Option("Хімія","Хімія",false,false);
                            objSpec.options[3] = new Option("Лісове і садово-паркове господарство","Лісове і садово-паркове господарство",false,false);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                            
                        case 'Економічний': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                            
                            }
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("Економічна кібернетика","Економічна кібернетика",true,true);
                            objSpec.options[1] = new Option("Міжнародна економіка","Міжнародна економіка",false,false);
                            objSpec.options[2] = new Option("Управління персоналом та економіка праці","Управління персоналом та економіка праці",false,false);
                            objSpec.options[3] = new Option("Фінанси і кредит","Фінанси і кредит",false,false);
                            objSpec.options[4] = new Option("Облік і аудит","Облік і аудит",false,false);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break; 
                        
                        case 'Історичний': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                            
                            }  
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("Історія","Історія",true,true);
                            objSpec.options[1] = new Option("Країнознавство","Країнознавство",false,false);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                            
                       case 'Фізичний': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                             
                            } 
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("Фізика","Фізика",true,true);
                            objSpec.options[1] = new Option("Прикладна фізика","Прикладна фізика",false,false);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                            
                       case 'Журналістики': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                         
                            }
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("Журналістика","Журналістика",true,true);
                            objSpec.options[1] = new Option("Реклама і зв’язки з громадськістю","Реклама і зв’язки з громадськістю",false,false);
                            objSpec.options[2] = new Option("Видавнича справа та редагування","Видавнича справа та редагування",false,false);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                            
                       case 'Менеджменту': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                         
                            }
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("Менеджмент","Менеджмент",true,true);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                            
                            
                       case 'Філологічний': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                          
                            }    
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("філологія","філологія",true,true);
                            objSpecialization.options[0] = new Option("українська мова і література","українська мова і література",true,true);
                            objSpecialization.options[1] = new Option("мова і література: російська","мова і література: російська",false,false);
                            objSpecialization.options[2] = new Option("переклад: українська, російська, польська мови","переклад: українська, російська, польська мови",false,false);
                            objSpecialization.options[3] = new Option("переклад: українська, російська, болгарська мови","переклад: українська, російська, болгарська мови",false,false);
                            break;
                            
                       case 'Іноземної філології': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                          
                            }  
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("філологія","філологія",true,true);
                            objSpecialization.options[0] = new Option("мова і література: англійська","мова і література: англійська",true,true);
                            objSpecialization.options[1] = new Option("мова і література: німецька","мова і література: німецька",false,false);
                            objSpecialization.options[2] = new Option("мова і література: французька","мова і література: французька",false,false);
                            objSpecialization.options[3] = new Option("мова і література: іспанська","мова і література: іспанська",false,false);
                            objSpecialization.options[4] = new Option("переклад: англійська мова","переклад: англійська мова",false,false);
                            objSpecialization.options[5] = new Option("переклад: переклад (німецька)","переклад: переклад (німецька)",false,false);
                            objSpecialization.options[6] = new Option("переклад: переклад (французька)","переклад: переклад (французька)",false,false);
                            break;
                            
                       case 'Юридичний': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                         
                            } 
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("правознавство ","правознавство ",true,true);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                            
                       case 'Фізичного виховання': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                            
                            }   
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("Спорт","Спорт",true,true);
                            objSpec.options[1] = new Option("Здоров’я людини","Здоров’я людини",false,false);
                            objSpec.options[2] = new Option("Фізичне виховання","Фізичне виховання",false,false);
                            objSpec.options[3] = new Option("Туризм","Туризм",false,false);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                            
                       case 'Соціальної педагогіки та психології': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                          
                            }                         
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("соціальна педагогіка","соціальна педагогіка",true,true);
                            objSpec.options[1] = new Option("Театральне мистецтво","Театральне мистецтво",false,false);
                            objSpec.options[2] = new Option("Психологія","Психологія",false,false);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                            
                       case 'Соціології та управління': 
                            for(i = objSpec.options.length-1; i >= 0; i--) {
                              objSpec.options[i] = null;                        
                            }  
                            for (i = objSpecialization.options.length-1; i >= 0; i--) {
                              objSpecialization.options[i] = null;
                            }
                            objSpec.options[0] = new Option("Соціальна робота","Соціальна робота",true,true);
                            objSpec.options[1] = new Option("Політологія","Політологія",false,false);
                            objSpec.options[2] = new Option("Соціологія","Соціологія",false,false);
                            objSpec.options[3] = new Option("Філософія","Філософія",false,false);
                            objSpecialization[0] = new Option("Спеціалізації немає","",true,true);
                            break;
                    }
                }
                </script>
	</head>
	<body>
   <form  action="createacts" method="post" name="act">
   Виберіть факультет:
   <p><select id="fac" name="facultet" onchange="who()">
    <option disabled>Выберите Факультет</option>
    <option selected value="Математичний">Математичний</option>
    <option value="Біологічний">Біологічний</option>
    <option value="Економічний">Економічний</option>
    <option value="Історичний">Історичний</option>
    <option value="Фізичний">Фізичний</option>
    <option value="Журналістики">Журналістики</option>
    <option value="Філологічний">Філологічний</option>
    <option value="Іноземної філології">Іноземної філології</option>
    <option value="Менеджменту">Менеджменту</option>
    <option value="Юридичний">Юридичний</option>
    <option value="Фізичного виховання">Фізичного виховання</option>
    <option value="Соціальної педагогіки та психології">СПП</option>
    <option value="Соціології та управління">Соціології та управління</option>	
   </select></p>
   
   Виберіть спеціальність:
   <p><select id="spec" name="spec">
    <option value="Прикладна математика">Прикладна математика</option>
    <option value="Математика">Математика</option>
    <option value="Інформатика">Інформатика</option>
    <option selected value="Програмна інженерія">Програмна інженерія</option>
    </select></p>   
    Якщо потрібно, оберіть спеціалізацію:
    <p><select id="specialization" name="specialization">
             <option value=""></option>
     </select></p>
     <input type="radio" name="budgetcontract" value="1">Бюджет</input>
     <input type="radio" name="budgetcontract" value="0">Контракт</input>
     <p>
     <input type="radio" name="eduform" value="1">Дневная</input>
     <input type="radio" name="eduform" value="0">Заочная</input>
   <p><input type="submit" value="Отправить"></p>
  </form>
	</body>
</html>
