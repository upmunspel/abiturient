INSERT INTO `basespeciality_relation` (`PersonBaseSpecialityID`, `SpecialityID`)
SELECT personbasespeciality.idPersonBaseSpeciality,  `specialities`.`idSpeciality` 
FROM personbasespeciality
INNER JOIN  `specialities` ON  `specialities`.`idSpeciality` =140725
