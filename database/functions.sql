


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
        IF exist is null THEN
          INSERT INTO users(user_id, user_name) VALUES (new_id, in_username);
          INSERT INTO email_users(user_id,email,password_hash) VALUES (new_id,in_email,in_password);
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
CREATE FUNCTION create_destination(
  in_name VARCHAR(100),
   in_location VARCHAR(100),
    lat FLOAT, lon FLOAT,
     in_rating TINYINT(3) ) RETURNS VARCHAR(100)
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

DROP FUNCTION IF EXISTS add_type_of_utility;
DELIMITER //
/*Creates a type of utlity that a destination may have*/
CREATE FUNCTION add_type_of_utility(
  utility_name VARCHAR(100)
) RETURNS INT
BEGIN
  INSERT INTO types_of_utility(type_name) VALUE (utility_name);
  return LAST_INSERT_ID();

END //
DELIMITER ;


DROP FUNCTION IF EXISTS add_destination_utility;
DELIMITER //
CREATE FUNCTION add_destination_utility(
  destination_id VARCHAR(150),
  utility_id INT
) returns tinyint(1)
BEGIN
  INSERT INTO `destination_utilities`(`destination_id`, `type_id`, `rating`)
  VALUES (destination_id,utility_id,3);
  return 1;
END //
DELIMITER ;

