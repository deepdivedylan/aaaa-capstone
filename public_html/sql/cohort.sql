INSERT INTO cohort (cohortId, cohortName) VALUES (NULL, "Fullstack January 2017");
INSERT INTO cohort (cohortId, cohortName) VALUES (NULL, "Fullstack April 2017");
INSERT INTO cohort (cohortId, cohortName) VALUES (NULL, ".Net February 2017");

INSERT INTO application (applicationID,
								 applicationFirstName,
								 applicationLastName,
								 applicationEmail,
								 applicationPhoneNumber,
								 applicationSource,
								 applicationAboutYou,
								 applicationHopeToAccomplish,
								 applicationExperience,
								 applicationDateTime,
								 applicationUtmCampaign,
								 applicationUtmMedium,
								 applicationUtmSource)
	VALUES (NULL, "Foo", "Bar", "test1@test.net", "5052345678", "sourceempty", "aboutempty","hopeempty", "expempty", CURRENT_TIMESTAMP, "empty", "empty", "empty");
INSERT INTO application (applicationID,
								 applicationFirstName,
								 applicationLastName,
								 applicationEmail,
								 applicationPhoneNumber,
								 applicationSource,
								 applicationAboutYou,
								 applicationHopeToAccomplish,
								 applicationExperience,
								 applicationDateTime,
								 applicationUtmCampaign,
								 applicationUtmMedium,
								 applicationUtmSource)
VALUES (NULL, "Foo2", "Bar2", "test2@test.net", "5052345679", "sourceempty2", "aboutempty2","hopeempty2", "expempty2", CURRENT_TIMESTAMP, "empty2", "empty2", "empty2");

INSERT INTO application (applicationID,
								 applicationFirstName,
								 applicationLastName,
								 applicationEmail,
								 applicationPhoneNumber,
								 applicationSource,
								 applicationAboutYou,
								 applicationHopeToAccomplish,
								 applicationExperience,
								 applicationDateTime,
								 applicationUtmCampaign,
								 applicationUtmMedium,
								 applicationUtmSource)
VALUES (NULL, "Joh", "Doe", "test3@test.net", "5052445679", "surceempty2", "aboutpty2","hoempty2", "exppty2", CURRENT_TIMESTAMP, "epty2", "emty2", "empty23");

INSERT INTO application (applicationID,
								 applicationFirstName,
								 applicationLastName,
								 applicationEmail,
								 applicationPhoneNumber,
								 applicationSource,
								 applicationAboutYou,
								 applicationHopeToAccomplish,
								 applicationExperience,
								 applicationDateTime,
								 applicationUtmCampaign,
								 applicationUtmMedium,
								 applicationUtmSource)
VALUES (NULL, "Jane", "Foe", "te2@test.net", "5052366679", "sourceempty2", "aboutempty2","hopeempty2", "expempty2", CURRENT_TIMESTAMP, "empty2", "rrrrsty2", "emptrrr");
INSERT INTO application (applicationID,
								 applicationFirstName,
								 applicationLastName,
								 applicationEmail,
								 applicationPhoneNumber,
								 applicationSource,
								 applicationAboutYou,
								 applicationHopeToAccomplish,
								 applicationExperience,
								 applicationDateTime,
								 applicationUtmCampaign,
								 applicationUtmMedium,
								 applicationUtmSource)
VALUES (NULL, "fu", "TomWu", "test2@33st.net", "5052345679", "soyyrceempty2", "aboutwwwpty2","opteempty2", "expttmpty2", CURRENT_TIMESTAMP, "emptyy2", "empty32", "empty2444");



INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
	VALUE (NULL, 1, 1);

INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
	VALUE (NULL, 2, 2);
INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
	VALUE (NULL, 3, 2);
INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
	VALUE (NULL, 4, 2);
INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
VALUE (NULL, 5, 2);
INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
	VALUE (NULL, 6, 1);
INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
	VALUE (NULL, 7, 1);
INSERT INTO statusType (statusTypeId, statusTypeName)  VALUE (1, "Checked Out");
INSERT INTO statusType (statusTypeId, statusTypeName) VALUE (2, "Checked In");
INSERT INTO placard (placardId, placardNumber, placardStatusTypeId) VALUES (NULL, 1, 1);
INSERT INTO swipe (swipeId, swipeNumber, swipeStatusTypeId) VALUES (NULL, 1, 1);
INSERT INTO studentPermit (studentPermitId, studentPermitApplicationId, studentPermitSwipeId, studentPermitPlacardId, studentPermitCheckOutDate, studentPermitCheckInDate) VALUES (NULL, 1, 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);





/*SELECT * FROM application, cohort AS tempApp, tempCohort;*/











