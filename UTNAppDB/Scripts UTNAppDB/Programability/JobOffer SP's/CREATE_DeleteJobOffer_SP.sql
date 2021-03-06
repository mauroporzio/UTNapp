USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteJobOffer;

DELIMITER //

CREATE PROCEDURE DeleteJobOffer
(
	IN IdJobOfferParam INT 
)
BEGIN
	DELETE FROM Postulation WHERE IdJobOffer = IdJobOfferParam;
	DELETE FROM JobOffer WHERE IdJobOffer = IdJobOfferParam;
END //

DELIMITER ;