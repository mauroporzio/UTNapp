USE UTNAppDB;

DROP PROCEDURE IF EXISTS  CompanyHasJobOffer;

DELIMITER //

CREATE PROCEDURE CompanyHasJobOffer
(
	IN IdCompanyParam INT
)
BEGIN
	IF EXISTS (SELECT 1 FROM JobOffer WHERE IdCompany = IdCompanyParam) THEN
		BEGIN
			SELECT 1;
		END;
		ELSE
		BEGIN 
			SELECT 0;
		END;
	END IF;
END //

DELIMITER ;