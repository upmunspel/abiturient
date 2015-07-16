DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    FUNCTION `abiturient_2015`.`set_bal`(AtestatValue FLOAT)
    RETURNS VARCHAR(5)
    DETERMINISTIC 
    /*LANGUAGE SQL
    | [NOT] DETERMINISTIC
    | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
    | SQL SECURITY { DEFINER | INVOKER }
    | COMMENT 'string'*/
    BEGIN
	DECLARE r VARCHAR(5);
	SELECT two_hundred_p INTO r FROM convert_attestat WHERE ABS(twelve_p - AtestatValue ) <= 0.05 ORDER BY ABS(twelve_p - AtestatValue ) ASC LIMIT 1;
	RETURN r;
    END$$

DELIMITER ;