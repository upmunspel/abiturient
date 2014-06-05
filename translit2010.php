<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
  </head>
<body>  
<?php
  function str_split_unicode($str, $l = 0) {
      if ($l > 0) {
          $ret = array();
          $len = mb_strlen($str, "UTF-8");
          for ($i = 0; $i < $len; $i += $l) {
              $ret[] = mb_substr($str, $i, $l, "UTF-8");
          }
          return $ret;
      }
      return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
  }

  function ua2translit_letter($letter,$previous_letter=''){
    $general_translit_assoc = array(
      "а" => 'a',
      "б" => 'b',
      "в" => 'v',
      "г" => 'h',
      "ґ" => 'g',
      "д" => 'd',
      "е" => 'e',
      "є" => 'ie',
      "ж" => 'zh',
      "з" => 'z',
      "и" => 'y',
      "і" => 'i',
      "ї" => 'i',
      "й" => 'i',
      "к" => 'k',
      "л" => 'l',
      "м" => 'm',
      "н" => 'n',
      "о" => 'o',
      "п" => 'p',
      "р" => 'r',
      "с" => 's',
      "т" => 't',
      "у" => 'u',
      "ф" => 'f',
      "х" => 'kh',
      "ц" => 'ts',
      "ч" => 'ch',
      "ш" => 'sh',
      "щ" => 'shch',
      "ь" => '',
      "ю" => 'iu',
      "я" => 'ia',
      "А" => 'A',
      "Б" => 'B',
      "В" => 'V',
      "Г" => 'H',
      "Ґ" => 'G',
      "Д" => 'D',
      "Е" => 'E',
      "Є" => 'Ie',
      "Ж" => 'Zh',
      "З" => 'Z',
      "И" => 'Y',
      "І" => 'I',
      "Ї" => 'I',
      "Й" => 'I',
      "К" => 'K',
      "Л" => 'L',
      "М" => 'M',
      "Н" => 'N',
      "О" => 'O',
      "П" => 'P',
      "Р" => 'R',
      "С" => 'S',
      "Т" => 'T',
      "У" => 'U',
      "Ф" => 'F',
      "Х" => 'Kh',
      "Ц" => 'Ts',
      "Ч" => 'Ch',
      "Ш" => 'Sh',
      "Щ" => 'Shch',
      "Ь" => '',
      "Ю" => 'Iu',
      "Я" => 'Ia',
      "'" => '',
      "`" => '',
      "\u2019" => '',
      "\u02BC" => '',
    );
    $special_translit_assoc = array(
      'є' => 'ye',
      'ї' => 'yi',
      'й' => 'y',
      'ю' => 'yu',
      'я' => 'ya',
      'Є' => 'Ye',
      'Ї' => 'Yi',
      'Й' => 'Y',
      'Ю' => 'Yu',
      'Я' => 'Ya',
    );
    $word_separators = array(
      ' ' => true,
      "\r" => true,
      "\n" => true,
      "\0" => true,
      "\t" => true,
      "-" => true,
      "." => true,
      "," => true,
      "?" => true,
      "!" => true,
      "(" => true,
      ")" => true,
      "[" => true,
      "]" => true,
      "{" => true,
      "}" => true,
      "~" => true,
      "<" => true,
      ">" => true,
      "+" => true,
      "&" => true,
      "@" => true,
      "/" => true,
      "\\" => true,
      "%" => true,
    );
    if ($letter == 'г' && 
      ($previous_letter == 'з' || $previous_letter == 'З')){
      return 'gh';
    }
    
    if ((isset($word_separators[$previous_letter]) || $previous_letter === '') && (isset($special_translit_assoc[$letter]))){
      return $special_translit_assoc[$letter];
    }
    if ((isset($word_separators[$previous_letter]) || $previous_letter === '') && (isset($general_translit_assoc[$letter]))){
      return $general_translit_assoc[$letter];
    }
    if (!(isset($word_separators[$previous_letter]) || $previous_letter === '') && (isset($general_translit_assoc[$letter]))){
      return $general_translit_assoc[$letter];
    }
    return $letter;
  }
  
  $ua_text = 'Згідно вимог, треба війська перевести в Йемен, а потім у Євпаторію, Югославію вже озброїли їжаки!Я';
  $ua_letters = str_split_unicode($ua_text,1);
  $translit_text = '';
  echo $ua_text;
  echo "<hr/>";
  for ($i = 0; $i < count($ua_letters); $i++){
    if ($i){
      //echo $ua_letters[$i].' => '.ua2translit_letter($ua_letters[$i],$ua_letters[$i-1])."<br/>";
      $translit_text .= ua2translit_letter($ua_letters[$i],$ua_letters[$i-1]);
    } else {
      //echo $ua_letters[$i].' => '.ua2translit_letter($ua_letters[$i],'')."<br/>";
      $translit_text .= ua2translit_letter($ua_letters[$i],'');
    }
  }
  echo $translit_text;
?>
</body>
</html>