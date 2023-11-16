


DROP FUNCTION IF EXISTS attempt_user_login;
 /* Function to log users in using each authentication provider*/
DELIMITER //
CREATE FUNCTION attempt_user_login(
  in_auth_type VARCHAR(100),
  in_email VARCHAR(100),
  in_password VARCHAR(255),
  in_auth_id VARCHAR(255)
) RETURNS VARCHAR(100)
BEGIN
  DECLARE login_result VARCHAR(100);

  /* Attempt login based on the authentication type */
  CASE in_auth_type
    WHEN 'email' THEN
      SELECT users.user_id INTO login_result
      FROM vw_users AS users
      WHERE users.email = in_email AND users.password_hash = in_password;

    WHEN 'google' THEN
      SELECT users.user_id INTO login_result
      FROM vw_users AS users
      WHERE users.google_id = in_auth_id;

    WHEN 'apple' THEN
      SELECT users.user_id INTO login_result
      FROM vw_users AS users
      WHERE users.apple_id = in_auth_id;

    ELSE
      SET login_result = NULL;
  END CASE;

  IF login_result IS NOT NULL THEN
  	INSERT INTO login_history (attempt_id, user_id, login_timestamp, login_method)
    VALUES (UUID(), login_result, CURRENT_TIMESTAMP, in_auth_type);
  end if;

  RETURN login_result;
END//
DELIMITER ;


DROP FUNCTION IF EXISTS email_login;
/* Function to log users in with email*/
DELIMITER //
CREATE FUNCTION email_login( in_email VARCHAR(100),in_password VARCHAR(255)) RETURNS VARCHAR(100)
BEGIN
  RETURN attempt_user_login("email", in_email,in_password,null);
END//
DELIMITER ;


DROP FUNCTION IF EXISTS provider_login;
/* Function to log users in using a third party provider*/
DELIMITER //
CREATE FUNCTION provider_login( provider varchar(100),platform_id VARCHAR(255)) RETURNS VARCHAR(100)
BEGIN
  RETURN attempt_user_login(provider, null,null, platform_id);
END//
DELIMITER ;



DROP FUNCTION IF EXISTS create_user;
-- A general function to create user accounts
DELIMITER //
CREATE FUNCTION create_user(
  auth_type VARCHAR(50),
  in_username varchar(100),
  in_email varchar(100),
  in_password varchar(255),
  in_provider_id varchar(100)
  ) RETURNS TINYINT(1)
  BEGIN
    DECLARE exist VARCHAR(100);
    DECLARE results TINYINT(1);
    DECLARE new_id VARCHAR(100);
    SET exist = NULL;
    SET new_id = UUID();

    CASE auth_type
      WHEN "email" THEN
        -- Check if user exists;
        SELECT user_id into exist from email_users where email_users.email = in_email;

        -- Create email account if does not exist
        IF NOT exist THEN
          INSERT INTO users(user_id, user_name) VALUES (new_id, in_username);
          INSERT INTO email_users(user_id,email,password) VALUES (new_id,in_email,in_password);
          SET results = 1;
        END IF;
      WHEN 'apple' THEN
          INSERT INTO users(user_id, user_name) VALUES (new_id, in_username);
          INSERT INTO apple_users(user_id,apple_id) VALUES (new_id, in_provider_id);
          SET results = 1;
      WHEN 'google' THEN
          INSERT INTO users(user_id, user_name) VALUES (new_id, in_username);
          INSERT INTO google_users(user_id,google_id) VALUES (new_id, in_provider_id);
          SET results = 1;
    END CASE;
    RETURN results;
  END//
  DELIMITER ;



DROP FUNCTION IF EXISTS email_signup;
  -- Function that creates user accounts with emails
  DELIMITER //
  CREATE FUNCTION email_signup (in_username VARCHAR(100), in_email VARCHAR(100), in_password VARCHAR(255)) RETURNS TINYINT(1)
  BEGIN
    RETURN create_user(
      "email",
      in_username,
      in_email,
      in_password,
      NULL
    );
  END //
  DELIMITER ;





DROP FUNCTION IF EXISTS  provider_signup;
DELIMITER //
-- Function that creates user accounts using third party authentication
CREATE FUNCTION provider_signup(provider VARCHAR(50), in_username VARCHAR(100), provider_id VARCHAR(100)) RETURNS TINYINT(1)
BEGIN
  RETURN create_user(provider,in_username,null,null,provider_id);
END //
DELIMITER ;






DROP FUNCTION IF EXISTS create_destination;
-- Function that adds a destination to the database
DELIMITER //
CREATE FUNCTION create_destination(in_name VARCHAR(100), in_location VARCHAR(100), lat FLOAT, lon FLOAT, in_rating TINYINT(3) ) RETURNS VARCHAR(100)
BEGIN
  DECLARE new_id VARCHAR(100);
  /*Return null if a destination with the same name exists*/
  SELECT destination_name into new_id from destinations where destination_name = in_name;
  if new_id is not null then
    RETURN NULL;
  end if;
  SET new_id = UUID();
  INSERT INTO `destinations`(`destination_id`, `destination_name`, `location`, `latitude`, `longitude`, `rating`)
  VALUES (new_id, in_name,in_location,lat,lon,in_rating);
  RETURN new_id;
END //
DELIMITER ;






DROP FUNCTION IF EXISTS add_destination_activity;
DELIMITER //
-- Function adds an activity to the list of available activites at a destination
CREATE FUNCTION add_destination_activity (in_destination_id VARCHAR(100), in_activity_name VARCHAR(100), in_price FLOAT)
RETURNS TINYINT(1)
BEGIN
   DECLARE act_id INT;
   DECLARE result TINYINT(1);
   SET result = 0;
   SET act_id = -1;

   SELECT activity_id INTO act_id FROM activities WHERE activity_name = in_activity_name;

   IF act_id = -1 THEN
      INSERT INTO activities (activity_name) VALUES (in_activity_name);
      SET act_id = LAST_INSERT_ID();
   END IF;
   INSERT INTO destination_activities (destination_id, activity_id, price, date_updated)
   VALUES (in_destination_id, act_id, in_price, CURRENT_TIMESTAMP);

   RETURN result;
END //

DELIMITER ;







DROP FUNCTION IF EXISTS add_itinerary_day;
-- Adds an extra day to an itinerary
DELIMITER //
CREATE FUNCTION add_itinerary_day(in_itinerary_id VARCHAR(100)) RETURNS VARCHAR(100)
BEGIN
  DECLARE pos INT;
  DECLARE day_id VARCHAR(100);

  SET day_id = UUID();

  -- Fetch the maximum position for the given itinerary_id
  SELECT COALESCE(MAX(position), -1) INTO pos
  FROM itinerary_day
  WHERE itinerary_id = in_itinerary_id;

  -- Increment the position or start from 0 if there are no previous entries
  SET pos = pos + 1;

  INSERT INTO itinerary_day(day_id, itinerary_id, position)
  VALUES (day_id, in_itinerary_id, pos);

  RETURN day_id;
END //

DELIMITER ;


DROP FUNCTION IF EXISTS create_itinerary;
DELIMITER //
-- Function to create itineraries and assign an owner
CREATE FUNCTION create_itinerary(in_user_id VARCHAR(100), num_people INT, in_visibility VARCHAR(20)) RETURNS VARCHAR(100)
BEGIN
  DECLARE id VARCHAR(100);
  SET id = UUID();

  INSERT INTO `itinerary`(`itinerary_id`, `date_created`, `num_of_participants`, `visibility`)
  VALUES (id, CURRENT_TIMESTAMP, num_people, in_visibility);

  INSERT INTO `itinerary_collaborators`(`itinerary_id`, `user_id`, `role`, `date_added`)
  VALUES (id, in_user_id, 'owner', CURRENT_TIMESTAMP);


  RETURN id;
END //

DELIMITER ;

DROP FUNCTION IF EXISTS add_itinerary_destination;
DELIMITER //
-- Adds a destination to the lineup for a day in an itinerary
CREATE FUNCTION add_itinerary_destination(in_day_id VARCHAR(100), in_destination_id VARCHAR(100)) RETURNS TINYINT(1)
BEGIN
  DECLARE pos INT;

  -- Check if the destination already exists for that day
  SELECT position INTO pos FROM itinerary_destination WHERE destination_id = in_destination_id AND day_id = in_day_id;

  IF pos IS NOT NULL THEN
    RETURN 0; -- Destination already exists, return 0
  END IF;

  -- Fetch the maximum position for the given day and destination
  SELECT COALESCE(MAX(position), -1) INTO pos FROM itinerary_destination WHERE day_id = in_day_id AND destination_id = in_destination_id;

  SET pos = pos + 1; -- Increment the position

  INSERT INTO itinerary_destination(day_id, destination_id, position)
  VALUES (in_day_id, in_destination_id, pos);

  RETURN 1; -- Successful insertion, return 1
END //

DELIMITER ;




DROP FUNCTION IF EXISTS add_itinerary_activity;
DELIMITER //
-- Inserts an activity into an itinerary for the given day
CREATE FUNCTION add_itinerary_activity(in_day_id VARCHAR(100), in_activity_id INT, in_destination_id VARCHAR(100)) RETURNS TINYINT(1)
BEGIN
    DECLARE pos INT;

    -- Check if the activity already exists for that day
    SELECT position INTO pos FROM itinerary_activity WHERE activity_id = in_activity_id AND day_id = in_day_id AND destination_id = in_destination_id;

    IF pos IS NOT NULL THEN
        RETURN 0; -- Activity already exists, return 0
    END IF;

    -- Fetch the maximum position for the given day and activity
    SELECT COALESCE(MAX(position), -1) INTO pos FROM itinerary_activity WHERE day_id = in_day_id AND activity_id = in_activity_id;

    SET pos = pos + 1; -- Increment the position

    INSERT INTO itinerary_activity(day_id, activity_id,destination_id, position)
    VALUES (in_day_id, in_activity_id, in_destination_id, pos);

    RETURN 1; -- Successful insertion, return 1
END //

DELIMITER ;



DROP FUNCTION IF EXISTS add_destination_media;
DELIMITER //
 /* Adds media a destination*/
CREATE FUNCTION add_destination_media(
    in_destination_id VARCHAR(100),
    in_media_location TEXT,
    in_media_type TEXT,
    in_is_foreign TINYINT
) RETURNS TINYINT(1)
BEGIN
    DECLARE m_id VARCHAR(100);
    DECLARE media_exists INT;

    /* Check if the media already exists in the media table based on location */
    SELECT media_id INTO m_id
    FROM media
    WHERE media_location = in_media_location;

    IF m_id IS NULL THEN
        /* Media doesn't exist, insert into the media table */
        SET m_id = UUID();
        INSERT INTO media(media_id, media_location, media_type, is_foreign)
        VALUES (m_id, in_media_location, in_media_type, in_is_foreign);

    END IF;

    /* Check if the media is already associated with the destination*/
    SELECT COUNT(*) INTO media_exists
    FROM destination_media
    WHERE destination_id = in_destination_id AND media_id = m_id;

    IF media_exists > 0 THEN
        RETURN 0; /* Media already associated, return 0*/
    ELSE
        /* Insert the media for the destination */
        INSERT INTO destination_media(destination_id, media_id)
        VALUES (in_destination_id, m_id);

        RETURN 1; /* Successful insertion, return 1*/
    END IF;
END //

DELIMITER ;






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
select sleep(1);

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