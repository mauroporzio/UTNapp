==========================================================================================================================================
							!!!! ACLARACIONES !!!!
==========================================================================================================================================
EN LA RUTA: \UTNapp\UTNAppDB\Scripts UTNAppDB\GetDBReady
1-) EJECUTAR "(1) EXECUTE_SCHEMA_AND_SPs_DB".
2-) EJECUTAR "(2) ADD_ADMINS".
3-) Configurar Config.php (!!! VER RecieverAdress PARA PHP MAILER !!!)
4-) EJECUTAR "(3) ADD_TEST_DATA". --> EXEC Luego de logearse en la app.
==========================================================================================================================================
							   <-- GUIA SPs -->
==========================================================================================================================================
Company (PK -> IdCompany, Name, Cuit) ====================================================================================================

GetAllCompanys()
GetAllActiveCompanys()
GetCompanyById(IdCompany)
GetCompanyByName(Name)
InsertCompany(Status, Sector, Name, Description, Cuit, CompanyLink, AboutUs) --> NO SE EL PASA EL IdCompany porque lo genera la base.
UpdateCompany(IdComapny, Status, Sector, Name, Description, Cuit, CompanyLink, AboutUs)
DeleteCompany(IdCompany)

==========================================================================================================================================
JobOffer (PK -> IdJobOffer) ==============================================================================================================

GetAllJobOffers()
GetJobOfferById(IdJobOffer)
InsertJobOffer(IdJobPosition, IdCompany) --> NO SE EL PASA EL IdJobOffer porque lo genera la base.
UpdateJobOffer(IdJobOffer,IdJobPosition, IdCompany)
DeleteJobOffer(IdJobOffer)

==========================================================================================================================================
Postulation (PK -> IdStudent, IdJobOffer) ================================================================================================

GetAllPostulations()
GetPostulationByStudent(IdStudent)
GetPostulationByJobOffer(IdJobOffer)
InsertPostulation(IdStudent, IdJobOffer, PostulationDate)
UpdatePostulation(IdStudent, IdJobOffer, PostulationDate)
DeletePostulation(IdStudent)

==========================================================================================================================================

==========================================================================================================================================
H_Postulation (PK -> IdStudent, IdJobOffer) ================================================================================================

GetAllPostulations()
GetPostulationByStudent(IdStudent)
GetPostulationByJobOffer(IdJobOffer)
InsertPostulation(IdStudent, IdJobOffer, PostulationDate)
UpdatePostulation(IdStudent, IdJobOffer, PostulationDate)
DeletePostulation(IdStudent)

==========================================================================================================================================
H_JobOffer (PK -> IdHJobOffer) ===========================================================================================================

GetAllHistoricJobOffers()
GetAllHistoricJobOffersById()

==========================================================================================================================================
Mails (Notificaciones IN-APP -> Se envian mails por PHPMailer )(PK -> IdMail) ============================================================

DeleteMail(IdMail)
GetAllMailByEmail(Email)
GetEmailById(IdMail)
InsertMail(Email, IdCompany, Header, Message)

==========================================================================================================================================
Users (PK -> IdUser, Email) ==============================================================================================================

GetAllUsers()
GetUserByEmail(Email)
GetUserById(IdUser)
InsertMail(FirstName, LastName, Email, Password, Rol)

==========================================================================================================================================
