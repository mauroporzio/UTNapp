USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllJobOffers;

DELIMITER //

CREATE PROCEDURE GetAllJobOffers()
BEGIN
	SELECT * FROM JobOffer;
END //

DELIMITER ;