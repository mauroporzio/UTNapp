USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllUsers;

DELIMITER //

CREATE PROCEDURE GetAllUsers()
BEGIN
	SELECT * FROM Users;
END //

DELIMITER ;