USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteUser;

DELIMITER //

CREATE PROCEDURE DeleteUser
(
	IN IdStudentParamDB INT
)
BEGIN
	DELETE FROM User WHERE IdUser = IdStudentParamDB;
END //

DELIMITER ;