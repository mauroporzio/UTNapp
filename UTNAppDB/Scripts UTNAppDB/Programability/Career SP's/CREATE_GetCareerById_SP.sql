USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetCareerById;

DELIMITER //

CREATE PROCEDURE GetCareerById
(
	IN IdCareerDBParam INT
)
BEGIN
	SELECT * FROM Career WHERE IdCareerDB = IdCareerDBParam;
END //

DELIMITER ;