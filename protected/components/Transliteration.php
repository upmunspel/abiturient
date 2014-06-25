<?php
class Transliteration
{
  /**
   * Do transliteration for file names
   * @param unknown $filename
   * @param string $source_langcode
   * @return multitype:|Ambigous <mixed, string>
   */
  public static function file($filename, $lowercase = TRUE, $source_langcode = NULL) {
    if (is_array($filename)) {
      foreach ($filename as $key => $value) {
        $filename[$key] = self::file($value, $source_langcode);
      }
      return $filename;
    }
    $filename = self::text($filename, '', $source_langcode);
    // Replace whitespace.
    $filename = str_replace(' ', '_', $filename);
    // Remove remaining unsafe characters.
    $filename = preg_replace('![^0-9A-Za-z_.-]!', '', $filename);
    // Remove multiple consecutive non-alphabetical characters.
    $filename = preg_replace('/(_)_+|(\.)\.+|(-)-+/', '\\1\\2\\3', $filename);
    // Force lowercase to prevent issues on case-insensitive file systems.
    if ($lowercase) {
      $filename = strtolower($filename);
    }
    return $filename;
  }

  /**
   * Transliterates UTF-8 encoded text to US-ASCII.
   *
   * Based on Mediawiki's UtfNormal::quickIsNFCVerify().
   *
   * @param $string
   *   UTF-8 encoded text input.
   * @param $unknown
   *   Replacement string for characters that do not have a suitable ASCII
   *   equivalent.
   * @param $source_langcode
   *   Optional ISO 639 language code that denotes the language of the input and
   *   is used to apply language-specific variations. If the source language is
   *   not known at the time of transliteration, it is recommended to set this
   *   argument to the site default language to produce consistent results.
   *   Otherwise the current display language will be used.
   * @return
   *   Transliterated text.
   */
  public static function text($string, $unknown = '?', $source_langcode = NULL) {
    // ASCII is always valid NFC! If we're only ever given plain ASCII, we can
    // avoid the overhead of initializing the decomposition tables by skipping
    // out early.
    if (!preg_match('/[\x80-\xff]/', $string)) {
      return $string;
    }

    static $tail_bytes;

    if (!isset($tail_bytes)) {
      // Each UTF-8 head byte is followed by a certain number of tail bytes.
      $tail_bytes = array();
      for ($n = 0; $n < 256; $n++) {
        if ($n < 0xc0) {
          $remaining = 0;
        }
        elseif ($n < 0xe0) {
          $remaining = 1;
        }
        elseif ($n < 0xf0) {
          $remaining = 2;
        }
        elseif ($n < 0xf8) {
          $remaining = 3;
        }
        elseif ($n < 0xfc) {
          $remaining = 4;
        }
        elseif ($n < 0xfe) {
          $remaining = 5;
        }
        else {
          $remaining = 0;
        }
        $tail_bytes[chr($n)] = $remaining;
      }
    }

    // Chop the text into pure-ASCII and non-ASCII areas; large ASCII parts can
    // be handled much more quickly. Don't chop up Unicode areas for punctuation,
    // though, that wastes energy.
    preg_match_all('/[\x00-\x7f]+|[\x80-\xff][\x00-\x40\x5b-\x5f\x7b-\xff]*/', $string, $matches);

    $result = '';
    foreach ($matches[0] as $str) {
      if ($str[0] < "\x80") {
        // ASCII chunk: guaranteed to be valid UTF-8 and in normal form C, so
        // skip over it.
        $result .= $str;
        continue;
      }

      // We'll have to examine the chunk byte by byte to ensure that it consists
      // of valid UTF-8 sequences, and to see if any of them might not be
      // normalized.
      //
      // Since PHP is not the fastest language on earth, some of this code is a
      // little ugly with inner loop optimizations.

      $head = '';
      $chunk = strlen($str);
      // Counting down is faster. I'm *so* sorry.
      $len = $chunk + 1;

      for ($i = -1; --$len; ) {
        $c = $str[++$i];
        if ($remaining = $tail_bytes[$c]) {
          // UTF-8 head byte!
          $sequence = $head = $c;
          do {
            // Look for the defined number of tail bytes...
            if (--$len && ($c = $str[++$i]) >= "\x80" && $c < "\xc0") {
              // Legal tail bytes are nice.
              $sequence .= $c;
            }
            else {
              if ($len == 0) {
                // Premature end of string! Drop a replacement character into
                // output to represent the invalid UTF-8 sequence.
                $result .= $unknown;
                break 2;
              }
              else {
                // Illegal tail byte; abandon the sequence.
                $result .= $unknown;
                // Back up and reprocess this byte; it may itself be a legal
                // ASCII or UTF-8 sequence head.
                --$i;
                ++$len;
                continue 2;
              }
            }
          } while (--$remaining);

          $n = ord($head);
          if ($n <= 0xdf) {
            $ord = ($n - 192) * 64 + (ord($sequence[1]) - 128);
          }
          elseif ($n <= 0xef) {
            $ord = ($n - 224) * 4096 + (ord($sequence[1]) - 128) * 64 + (ord($sequence[2]) - 128);
          }
          elseif ($n <= 0xf7) {
            $ord = ($n - 240) * 262144 + (ord($sequence[1]) - 128) * 4096 + (ord($sequence[2]) - 128) * 64 + (ord($sequence[3]) - 128);
          }
          elseif ($n <= 0xfb) {
            $ord = ($n - 248) * 16777216 + (ord($sequence[1]) - 128) * 262144 + (ord($sequence[2]) - 128) * 4096 + (ord($sequence[3]) - 128) * 64 + (ord($sequence[4]) - 128);
          }
          elseif ($n <= 0xfd) {
            $ord = ($n - 252) * 1073741824 + (ord($sequence[1]) - 128) * 16777216 + (ord($sequence[2]) - 128) * 262144 + (ord($sequence[3]) - 128) * 4096 + (ord($sequence[4]) - 128) * 64 + (ord($sequence[5]) - 128);
          }
          $result .= self::replace($ord, $unknown, $source_langcode);
          $head = '';
        }
        elseif ($c < "\x80") {
          // ASCII byte.
          $result .= $c;
          $head = '';
        }
        elseif ($c < "\xc0") {
          // Illegal tail bytes.
          if ($head == '') {
            $result .= $unknown;
          }
        }
        else {
          // Miscellaneous freaks.
          $result .= $unknown;
          $head = '';
        }
      }
    }
    return $result;
  }

  /**
   * Replaces a Unicode character using the transliteration database.
   *
   * @param $ord
   *   An ordinal Unicode character code.
   * @param $unknown
   *   Replacement string for characters that do not have a suitable ASCII
   *   equivalent.
   * @param $langcode
   *   Optional ISO 639 language code that denotes the language of the input and
   *   is used to apply language-specific variations.  Defaults to the current
   *   display language.
   * @return
   *   ASCII replacement character.
   */
  public static function replace($ord, $unknown = '?', $langcode = NULL) {
    static $map = array();

    if (!isset($langcode)) {
      $langcode = Yii::app()->language;
    }

    $bank = $ord >> 8;

    if (!isset($map[$bank][$langcode])) {
      $file = dirname(__FILE__) . '/transliteration/' . sprintf('x%02x', $bank) . '.php';
      if (file_exists($file)) {
        include $file;
        if ($langcode != 'en' && isset($variant[$langcode])) {
          // Merge in language specific mappings.
          $map[$bank][$langcode] = $variant[$langcode] + $base;
        }
        else {
          $map[$bank][$langcode] = $base;
        }
      }
      else {
        $map[$bank][$langcode] = array();
      }
    }

    $ord = $ord & 255;

    return isset($map[$bank][$langcode][$ord]) ? $map[$bank][$langcode][$ord] : $unknown;
  }
  
  protected function str_split_unicode($str, $l = 0) {
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

  protected function ua2translit_letter($letter,$previous_letter=''){
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
  
  /**
   * Транслітерація згідно постанови N 55 від 27 січня 2010 р. Про впорядкування транслітерації українського алфавіту латиницею.
   * @param $ua_text string 
   *   Текст українською
   * @return string
   *   Текст транслітом
   */
  public static function translit2010($ua_text){
    $ua_letters = $this->str_split_unicode($ua_text,1);
    $translit_text = '';
    for ($i = 0; $i < count($ua_letters); $i++){
      if ($i){
        $translit_text .= $this->ua2translit_letter($ua_letters[$i],$ua_letters[$i-1]);
      } else {
        $translit_text .= $this->ua2translit_letter($ua_letters[$i],'');
      }
    }
    return $translit_text;
  }

}
