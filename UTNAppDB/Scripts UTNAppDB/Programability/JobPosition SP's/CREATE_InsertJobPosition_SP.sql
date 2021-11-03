USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertJobPosition;

DELIMITER //

CREATE PROCEDURE InsertJobPosition 
(
	IN IdJobPosition int,		
	IN IdCareer	int,		
	IN Description varchar(200)			
)
BEGIN
	INSERT INTO JobPosition VALUES
    (
		IdJobPosition,		
		IdCareer,	
        Description	
    );
END //

DELIMITER ;