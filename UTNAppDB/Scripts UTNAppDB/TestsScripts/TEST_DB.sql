/*TEST DE BASE COMPLETA*/

USE UTNAppDB;
SET SQL_SAFE_UPDATES = 0;

/*DELETE ALL ====================================================================================================*/
DELETE FROM H_Postulation;
DELETE FROM Postulation;
DELETE FROM JobOffer;
DELETE FROM JobPosition;
DELETE FROM Student;
DELETE FROM Career;
DELETE FROM Company;

/*INSERT ALL ====================================================================================================*/
CALL InsertCareer(1, 'Tecnico Universtiario en Programacion', True);
CALL InsertCareer(2, 'Ingeniero en Sistemas', True);
CALL InsertCareer(3, 'Arquitecto de Sistemas', True);

CALL InsertJobPosition(1, 1, 'Desarrollador JR Full-Time');
CALL InsertJobPosition(2, 2, 'Desarrollador JR Part-Time');
CALL InsertJobPosition(3, 3, 'Arquitecto Pasante');

CALL InsertStudent(1, 'Mauro', 'Porzio', 'mauro@gmail.com', 1234, 1231231, True, 1, null, 'M', '2021-12-02', 22323454, True);
CALL InsertStudent(2, 'Matias', 'Menillo', 'matias@gmail.com', 1234, 1112231, True, 2, null, 'M', '2000-01-01', 22354363, True);
CALL InsertStudent(3, 'Rodrigo', 'Moreno', 'rodrigo@gmail.com', 1234, 1234123, True, 2, null, 'M', '1997-01-10', 223560654, True);

CALL InsertCompany(1, 'Software', 'EDSA', 'Empresa Tandilense', 1111111111, 'WWW.EDSA.COM.AR', 'Estrategias Diferenciadas S.A');
CALL InsertCompany(1, 'Software', 'Globant', 'Empresa Internacional', 222222222, 'WWW.Globant.COM.AR', 'Globant Company');
CALL InsertCompany(1, 'Software', 'Accenture', 'Empresa Internacional 2', 333333333, 'WWW.Accenture.COM.AR', 'Accenture Company');

CALL InsertJobOffer(1, (SELECT IdCompany FROM Company WHERE Name = 'EDSA'));
CALL InsertJobOffer(6, (SELECT IdCompany FROM Company WHERE Name = 'Globant'));
CALL InsertJobOffer(8, (SELECT IdCompany FROM Company WHERE Name = 'Accenture'));

CALL InsertPostulation(1, (SELECT IdJobOffer FROM JobOffer WHERE IdJobPosition = 1), CURDATE());
CALL InsertPostulation(2, (SELECT IdJobOffer FROM JobOffer WHERE IdJobPosition = 3), CURDATE());

/*CAREER =====================================================================================================*/
CALL GetAllCareers();

CALL UpdateCareer(3, 'Arquitecto', False);

CALL GetCareerById(3);

CALL DeleteCareer(3);

/*STUDENT ====================================================================================================*/
CALL GetAllStudents();
DESCRIBE STUDENT;

CALL DeleteStudent(2);

CALL GetAllStudents();

CALL UpdateStudent(1, 'Mauro', 'Porzio', 'mauro@gmail.com', 1234, 1231231, True, 1, null, 'M', '2000-12-02', 22323454, False);

CALL GetStudentById(2);

CALL GetAllActiveStudents();

/*COMPANY ====================================================================================================*/
CALL GetAllCompanys();

CALL UpdateCompany((SELECT IdCompany FROM Company WHERE Name = 'Accenture'), False, 'Software', 'Accenture', 'Empresa Internacional 2', 1112312, 'WWW.Accenture.COM.AR', 'Accenture Company');

CALL GetAllActiveCompanys();

CALL DeleteCompany((SELECT IdCompany FROM Company WHERE Name = 'Accenture'));

CALL GetCompanyById((SELECT IdCompany FROM Company WHERE Name = 'EDSA'));

/*JobPosition  ====================================================================================================*/
CALL GetAllJobPositions();

CALL UpdateJobPosition(2, 2, 'Desarrollador JR Part-Time Pago');

CALL GetJobPositionById(2);

CALL DeleteJobPosition(3);

/*JobOffer  ========================================================================================================*/
CALL GetAllJobOffers();

CALL UpdateJobOffer((SELECT IdJobOffer FROM JobOffer WHERE IdJobPosition = 2), 2, (SELECT IdCompany FROM Company WHERE Name = 'EDSA'));

CALL GetJobOfferById((SELECT IdJobOffer FROM JobOffer WHERE IdJobPosition = 2));

CALL DeleteJobOffer((SELECT IdJobOffer FROM JobOffer WHERE IdJobPosition = 5));

/*Postultions  ========================================================================================================*/
CALL GetAllPostulations();

CALL GetPostulationByJobOffer((SELECT IdJobOffer FROM JobOffer WHERE IdJobPosition = 3));

CALL UpdatePostulation(1, (SELECT IdJobOffer FROM JobOffer WHERE IdJobPosition = 3), CURDATE());

CALL GetPostulationByStudent(1);

CALL DeletePostulation(1);

/*Postultions  ========================================================================================================*/

CALL GetAllHistoricPostulations();

CALL GetAllHistoricPostulationsByStudent(189);




