DELIMITER $$

USE `abiturient`$$

DROP FUNCTION IF EXISTS `transliterate`$$

CREATE DEFINER=`root`@`localhost` FUNCTION `transliterate`(original VARCHAR(512) CHARACTER SET utf8  COLLATE utf8_bin ) RETURNS VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_bin
BEGIN
  DECLARE translit VARCHAR(512)   CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '';
  DECLARE len      INT(3)       DEFAULT 0;
  DECLARE pos      INT(3)       DEFAULT 1;
  DECLARE letter   CHAR(1) CHARACTER SET utf8  COLLATE utf8_bin;
  DECLARE is_lower BIT;
  SET len = CHAR_LENGTH(original);
  WHILE (pos <= len) DO
    SET letter   = SUBSTRING(original, pos, 1);

    CASE TRUE
    
      WHEN letter = 'А' THEN SET letter = 'A';
      WHEN letter = 'а' THEN SET letter = 'a';
      WHEN letter = 'Е' THEN SET letter = 'E';
      WHEN letter = 'е' THEN SET letter = 'e';
      WHEN letter = 'У' THEN SET letter = 'Y';
      WHEN letter = 'у' THEN SET letter = 'y';
      WHEN letter = 'О' THEN SET letter = 'O';
      WHEN letter = 'о' THEN SET letter = 'o';
      WHEN letter = 'Р' THEN SET letter = 'P';
      WHEN letter = 'р' THEN SET letter = 'p';
      WHEN letter = 'С' THEN SET letter = 'C';
      WHEN letter = 'с' THEN SET letter = 'c';
      WHEN letter = 'Х' THEN SET letter = 'X';
      WHEN letter = 'х' THEN SET letter = 'x';
      WHEN letter = 'І' THEN SET letter = 'I';
      WHEN letter = 'і' THEN SET letter = 'i';
      WHEN letter = 'К' THEN SET letter = 'K';
      WHEN letter = 'Н' THEN SET letter = 'H';
      WHEN letter = 'Т' THEN SET letter = 'T';
      WHEN letter = 'В' THEN SET letter = 'B';
      ELSE
        SET letter = letter;
    END CASE;

    -- CONCAT seems to ignore the whitespace character. As a workaround we use
    -- CONCAT_WS with a whitespace separator when the letter is a whitespace.
    SET translit = CONCAT_WS(IF(letter = ' ', ' ', ''), translit, letter);
    SET pos = pos + 1;
  END WHILE;
  RETURN translit;
END$$

DELIMITER ;