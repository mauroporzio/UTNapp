USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetUserById;

DELIMITER //

CREATE PROCEDURE GetUserById
(
	IN IdUserDBParam INT
)
BEGIN
	SELECT * FROM Users WHERE IdUser = IdUserDBParam;
END //

DELIMITER ;