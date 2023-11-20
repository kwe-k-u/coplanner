

DROP PROCEDURE IF EXISTS test_procedure;
DELIMITER //
CREATE PROCEDURE test_procedure  ()
begin
/*
=============================================================================
                        TESTING FUNCTIONS
=============================================================================
*/
/*Variables used for test*/
 /*Users*/

DECLARE user_1 VARCHAR(100);
DECLARE user_2 VARCHAR(100);
/*Destinations*/
DECLARE des_1 VARCHAR(100);
DECLARE des_2 VARCHAR(100);
/* Itineraries*/
DECLARE itinerary_1 VARCHAR(100);
DECLARE itinerary_2 VARCHAR(100);

DECLARE temp_id VARCHAR(100);
select sleep(1);

/*
== Authentication ==
1. Create a user with email
*/
SELECT email_signup("First user","first.user@email.com","first.user@email.com");
select sleep(1);
/*
2. Create another user with the same email to test duplicates
*/
SELECT email_signup("Second user","second.user@email.com","second.user@email.com");
select sleep(1);
/*
3. Create user with google
*/
SELECT provider_signup("google","Google user","google_user_1");
select sleep(1);
/*
4. Create user with apple
*/
SELECT provider_signup("apple","Apple user","apple_user_1");
select sleep(1);

/*
5. Sign in with email user (wrong password)
*/
SELECT email_login("first.user@email.com","second.user@email.com");
select sleep(1);
/*
6. Sign in with email user (correct password)
*/
SELECT email_login("first.user@email.com","first.user@email.com");
select sleep(1);
/*
7. Sign in with email user (non-existing user)
*/
SELECT email_login("fake.user@email.com","first.user@email.com");
select sleep(1);
/*
8. Sign in with google user (existing google id)
*/
SELECT provider_login("google","google_user_1");
select sleep(1);
/*
9. Sign in with google user (unknown google id)
*/
SELECT provider_login("google","rando_user_1");
select sleep(1);
/*
10. Sign in with apple user (existing apple id)
*/
SELECT provider_login("apple","apple_user_1");
select sleep(1);
/*
11. Sign in with apple user (unknown apple id)
*/
SELECT provider_login("apple","rando_apple_user_1");
select sleep(1);
/*

== Destinations ==
12. Create destination
*/
SELECT create_destination("Shai Hills","Accra,Ghana",1.23,-5.6,1) into des_1;
select sleep(1);
/*
13. Create destination with the same name
*/
SELECT create_destination("Shai Hills","Accra,Ghana",1.23,-5.6,1);
select sleep(1);
/*
14. Add activity to the destination
*/
SELECT add_destination_activity(des_1,"Hiking",0);
select sleep(1);
/*
15. Duplicate activity add to the destination
*/
SELECT add_destination_activity(des_1,"Hiking",0);
select sleep(1);
/*
16. Add second activity to the destination
*/
SELECT add_destination_activity(des_1,"Siteseeing",0);
select sleep(1);
/*
17. Add second destination
*/
SELECT create_destination("Bunso Eco Park","Bunso,Ghana",1.23,-51.6,1) into des_2;
select sleep(1);
/*
18. Add second activity to second destination
*/
SELECT add_destination_activity(des_2,"Siteseeing",0);

/*

== Itineraries ==
19. Create itineary for email user
*/
SELECT user_id into temp_id FROM vw_users where email = "first.user@email.com";
SELECT create_itinerary(temp_id,2,"public") into itinerary_1;
SELECT add_itinerary_day(itinerary_1);
select sleep(1);
/*
20. Create itinerary for google user
*/
SELECT user_id into temp_id FROM vw_users where google_id = "google_user_1";
SELECT create_itinerary(temp_id,5,"private") into itinerary_2;
SELECT add_itinerary_day(itinerary_2);
select sleep(1);

/*
21. Add first destination to email user itinerary (no activity)
*/
SELECT day_id into temp_id FROM itinerary_day where itinerary_id = itinerary_1;
SELECT add_itinerary_destination(temp_id, des_1);
select sleep(1);
/*
22. Add second destination to google user itinerary (no activity)
*/
SELECT day_id into temp_id FROM itinerary_day where itinerary_id = itinerary_2;
SELECT add_itinerary_destination(temp_id, des_2);
select sleep(1);
/*
23. Add activity (first destination) to second itinerary
*/

/*
24. Add second day to first itinerary
24. Add destination to second day of first itinerary
*/
/*
*/

end //
delimiter ;

call test_procedure();