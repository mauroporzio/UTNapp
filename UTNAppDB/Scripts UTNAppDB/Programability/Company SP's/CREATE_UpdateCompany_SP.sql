USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateCompany;

DELIMITER //

CREATE PROCEDURE UpdateCompany
(
	IN IdCompanyParam INT,
	IN Status INT, 
	IN Sector varchar(200), 
	IN Name varchar(200),  
	IN Description varchar(200), 
	IN Cuit bigint, 
	IN CompanyLink varchar(200), 
	IN AboutUs varchar(200)  

)
BEGIN
	UPDATE Company 
	SET
		Status = Status,
        Sector = Sector,
        Name = Name,
        Description = Description,
        Cuit = Cuit,
        CompanyLink = CompanyLink,
        AboutUs = AboutUs
	WHERE IdCompany = IdCompanyParam;
END //

DELIMITER ;