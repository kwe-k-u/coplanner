

drop function if exists generate_id;
DELIMITER //
CREATE FUNCTION generate_id()returns varchar(100)
begin
return CONCAT("a",LOWER(REPLACE(UUID(),'-','')));
end //
DELIMITER ;


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
  DECLARE random_id VARCHAR(100);
  SELECT generate_id() into random_id;

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
    VALUES (random_id, login_result, CURRENT_TIMESTAMP, in_auth_type);
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
    SELECT generate_id() into new_id;
    SET exist = NULL;

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
  in_rating TINYINT(3),
  in_num_ratings INT
      ) RETURNS VARCHAR(100)
BEGIN
  DECLARE new_id VARCHAR(100);
  /*Return null if a destination with the same name exists*/
  SELECT destination_name into new_id from destinations where destination_name = in_name;
  if new_id is not null then
    RETURN NULL;
  end if;
  SELECT generate_id() into new_id;

  INSERT INTO `destinations`(`destination_id`, `destination_name`, `location`, `latitude`, `longitude`, `rating`, `num_ratings`)
  VALUES (new_id, in_name,in_location,lat,lon,in_rating,in_num_ratings);
  RETURN new_id;
END //
DELIMITER ;






DROP FUNCTION IF EXISTS add_destination_activity;
DELIMITER //
-- Function adds an activity to the list of available activities at a destination
CREATE FUNCTION add_destination_activity (in_destination_id VARCHAR(100), in_activity_name VARCHAR(100), in_price FLOAT)
RETURNS TINYINT(1)
BEGIN
   DECLARE act_id INT;
   DECLARE temp INT;


   SELECT activity_id INTO act_id FROM activities WHERE activity_name = in_activity_name;

   IF act_id IS NULL THEN
      INSERT INTO activities (activity_name) VALUES (in_activity_name);
      SET act_id = LAST_INSERT_ID();
   END IF;

   /*Check if the activity destination pair does not exist. Terminate if it does*/
   select activity_id into temp FROM destination_activities as da
    where da.destination_id = in_destination_id and da.activity_id = act_id;
   IF temp IS NOT NULL THEN
    return 0;
   END IF;


   INSERT INTO destination_activities (destination_id, activity_id, price, date_updated)
   VALUES (in_destination_id, act_id, in_price, CURRENT_TIMESTAMP);

   RETURN 1;
END //

DELIMITER ;







DROP FUNCTION IF EXISTS add_itinerary_day;
-- Adds an extra day to an itinerary
DELIMITER //
CREATE FUNCTION add_itinerary_day(in_itinerary_id VARCHAR(100)) RETURNS VARCHAR(100)
BEGIN
  DECLARE pos INT;
  DECLARE day_id VARCHAR(100);
  select generate_id() into day_id;


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
  DECLARE in_day_id VARCHAR(1000);
  select generate_id() into id;
  select generate_id() into in_day_id;

  INSERT INTO `itinerary`(`itinerary_id`, `date_created`, `num_of_participants`, `visibility`)
  VALUES (id, CURRENT_TIMESTAMP, num_people, in_visibility);

  INSERT INTO `itinerary_collaborators`(`itinerary_id`, `user_id`, `role`, `date_added`)
  VALUES (id, in_user_id, 'owner', CURRENT_TIMESTAMP);

  INSERT INTO `itinerary_day`(`day_id`, `itinerary_id`, `position`)
  VALUES (in_day_id,id,'0');


  RETURN id;
END //

DELIMITER ;

DROP FUNCTION IF EXISTS add_itinerary_destination;
DELIMITER //
-- Adds a destination to the lineup for a day in an itinerary
CREATE FUNCTION add_itinerary_destination(in_day_id VARCHAR(100), in_destination_id VARCHAR(100)) RETURNS TINYINT(1)
BEGIN
  DECLARE pos INT;
  DECLARE temp VARCHAR(100);

  -- Check if the destination already exists for that day
  SELECT destination_id INTO temp FROM itinerary_destination WHERE destination_id = in_destination_id AND day_id = in_day_id;

  IF temp IS NOT NULL THEN
    RETURN pos; -- Destination already exists, return 0
  END IF;

  -- Fetch the maximum position for the given day and destination
  SELECT COALESCE(MAX(position), -1) INTO pos FROM itinerary_destination WHERE day_id = in_day_id;

  SET pos = pos + 1; -- Increment the position

  INSERT INTO itinerary_destination(day_id, destination_id, position)
  VALUES (in_day_id, in_destination_id, pos);

  RETURN pos; -- Successful insertion, return 1
END //

DELIMITER ;




DROP FUNCTION IF EXISTS add_itinerary_activity;
DELIMITER //
-- Inserts an activity into an itinerary for the given day
CREATE FUNCTION add_itinerary_activity(in_day_id VARCHAR(100), in_activity_id INT, in_destination_id VARCHAR(100)) RETURNS TINYINT(1)
BEGIN
    DECLARE pos INT;
    DECLARE temp VARCHAR(100);

    -- Check if the destination has been added to the day
    SELECT destination_id INTO temp FROM itinerary_destination
    WHERE day_id = in_day_id AND destination_id = in_destination_id;

    IF temp IS NULL THEN
        SELECT add_itinerary_destination(in_day_id, in_destination_id) INTO  temp;
    END IF;
    SET temp = NULL;

    -- Check if the activity already exists for that day
    SELECT destination_id INTO temp FROM itinerary_activity
    WHERE activity_id = in_activity_id AND day_id = in_day_id AND destination_id = in_destination_id;

    IF temp IS NOT NULL THEN
        RETURN 0; -- Activity already exists, return 0
    END IF;

    -- Fetch the maximum position for the given day and activity
    SELECT COALESCE(MAX(position), -1) INTO pos FROM itinerary_activity
    WHERE day_id = in_day_id AND destination_id = in_destination_id;

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
        select generate_id() into m_id;
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
CREATE FUNCTION add_type_of_utility(
  utility_name VARCHAR(100)
) RETURNS INT
BEGIN
  DECLARE new_id INT;
  SELECT type_id INTO new_id FROM types_of_utility WHERE type_name = utility_name;
  IF new_id IS NULL THEN
    INSERT INTO types_of_utility(type_name) VALUES (utility_name);
    SET new_id = LAST_INSERT_ID();
  END IF;
  RETURN new_id;
END //
DELIMITER ;


DROP FUNCTION IF EXISTS add_destination_utility;
DELIMITER //
CREATE FUNCTION add_destination_utility(
  in_destination_id VARCHAR(150),
  in_utility VARCHAR(60)
) RETURNS TINYINT
BEGIN
  DECLARE utility_id INT;
  DECLARE temp INT;

  SELECT type_id INTO utility_id FROM types_of_utility WHERE type_id = in_utility OR type_name = in_utility limit 1;

  IF utility_id IS NULL OR NOT in_utility REGEXP '^[0-9]+$' THEN
    SELECT add_type_of_utility(in_utility) INTO utility_id;
    SELECT type_id INTO utility_id FROM types_of_utility WHERE type_id = in_utility OR type_name = in_utility limit 1;
  END IF;

  /*Check and terminate if the destination_utility pair already exists*/
  SELECT type_id into temp FROM destination_utilities AS du
  where du.destination_id = in_destination_id AND du.type_id = utility_id;

  IF temp IS NOT NULL THEN
    return 0;
  END IF;
  INSERT INTO destination_utilities(destination_id, type_id, rating)
  VALUES (in_destination_id, utility_id, 3);

  RETURN 1;
END //
DELIMITER ;


DROP FUNCTION IF EXISTS add_type_of_destination;
DELIMITER //
CREATE FUNCTION  add_type_of_destination(
  des_type_name VARCHAR(100)
)RETURNS INT
 begin

  DECLARE new_id INT;
  SELECT type_id INTO new_id FROM types_of_destination WHERE type_name = des_type_name;
  IF new_id IS NULL THEN
    INSERT INTO types_of_destination(type_name) VALUES (des_type_name);
    SET new_id = LAST_INSERT_ID();
  END IF;
  RETURN new_id;

end //
DELIMITER ;


DROP FUNCTION IF EXISTS add_destination_type;
DELIMITER //
CREATE FUNCTION add_destination_type(
  in_destination_id VARCHAR(150),
  in_utility VARCHAR(60)
) RETURNS TINYINT
BEGIN
  DECLARE utility_id INT;
  DECLARE temp INT;

  SELECT type_id INTO utility_id FROM types_of_destination WHERE type_id = in_utility OR type_name = in_utility limit 1;

  IF utility_id IS NULL OR NOT in_utility REGEXP '^[0-9]+$' THEN
    SELECT add_type_of_destination(in_utility) INTO utility_id;
    SELECT type_id INTO utility_id FROM types_of_destination WHERE type_id = in_utility OR type_name = in_utility limit 1;
  END IF;

  /*Check and terminate if the destination_utility pair already exists*/
  SELECT type_id into temp FROM destination_type AS du
  where du.destination_id = in_destination_id AND du.type_id = utility_id;

  IF temp IS NOT NULL THEN
    return 0;
  END IF;
  INSERT INTO destination_type(destination_id, type_id)
  VALUES (in_destination_id, utility_id);

  RETURN utility_id;
END //
DELIMITER ;


DROP FUNCTION IF EXISTS update_itinerary_name;
DELIMITER //
CREATE FUNCTION update_itinerary_name(
    in_itinerary_id VARCHAR(100),
    in_name VARCHAR(60)
 ) RETURNS TINYINT(1)
 begin
 UPDATE itinerary set itinerary_name = in_name where itinerary_id = in_itinerary_id ;
 return 1;
 end//
DELIMITER ;



DROP FUNCTION  IF EXISTS duplicate_itinerary;
DELIMITER //
CREATE FUNCTION duplicate_itinerary(
  in_itinerary_id VARCHAR(100),
  in_user_id VARCHAR(100)
) RETURNS VARCHAR(100)
BEGIN
  DECLARE new_itinerary_id VARCHAR(100);
  DECLARE temp_id VARCHAR(100);
  DECLARE old_id VARCHAR(100);
  DECLARE temp_int INT;
  DECLARE temp VARCHAR(50);

  -- Create a duplicate of the parent itinerary
  SELECT num_of_participants, visibility into temp_int, temp  from vw_itinerary
  where itinerary_id = in_itinerary_id;
  SELECT create_itinerary(in_user_id,temp_int,temp_id) INTO new_itinerary_id;

  SELECT COUNT(*) INTO temp_int FROM itinerary_day where itinerary_id = in_itinerary_id;


  -- duplicate the days
  WHILE 0 < temp_int DO
    SET temp_int = temp_int - 1;
    -- Create a duplicate day
    SELECT day_id into temp_id from itinerary_day where itinerary_id = new_itinerary_id and position = temp_int;

    if temp_id is NULL then-- Allows us to skip the first day which has already been duplicated
      SELECT add_itinerary_day(new_itinerary_id) INTO temp_id;
    end if;

    SELECT day_id INTO old_id from itinerary_day
    where itinerary_id = in_itinerary_id and position =temp_int;

    CALL duplicate_day_activities(old_id,temp_id);
  END WHILE;

  RETURN new_itinerary_id;
END //
DELIMITER ;


DROP FUNCTION IF EXISTS toggle_itinerary_wishlist;
DELIMITER //
CREATE FUNCTION toggle_itinerary_wishlist(
  in_user_id VARCHAR(100),
  in_itinerary_id VARCHAR(100)
  )
RETURNS TINYINT
BEGIN
  DECLARE temp_id VARCHAR(100);

  SELECT user_id INTO  temp_id FROM wishlist WHERE user_id = in_user_id AND itinerary_id = in_itinerary_id;
  if temp_id is null then
    INSERT INTO wishlist(user_id,itinerary_id) VALUES (in_user_id,in_itinerary_id);
    return 1;
  end if;

  DELETE FROM wishlist where user_id = in_user_id and itinerary_id = in_itinerary_id;
  return 0;


END //
DELIMITER ;



DROP FUNCTION IF EXISTS add_destination_request;
DELIMITER //
CREATE FUNCTION add_destination_request(
  in_query VARCHAR(100),
  in_user_id VARCHAR(100)
) RETURNS TINYINT
begin
  DECLARE temp_request_id varchar(100);
  DECLARE temp_user_id VARCHAR(100);
  -- Check if a request with the same name exists.
  SELECT request_id into temp_request_id FROM destination_requests WHERE destination_name = in_query;
  if temp_request_id IS NOT NULL THEN
    -- If a request with same name exists, add the user as a subscriber if not already subscribed
    SELECT user_id into temp_user_id FROM user_destination_request
    WHERE user_id = in_user_id;
    IF temp_user_id is null then
      INSERT INTO user_destination_request(request_id,user_id) VALUES (temp_request_id,in_user_id);
    end if;
  return 0;
  END IF;
  -- If the request hasn't been created, create it and add the user
  SET temp_request_id = generate_id();
    INSERT INTO destination_requests(request_id,destination_name) VALUES (temp_request_id, in_query);
    INSERT INTO user_destination_request(request_id,user_id) VALUES (temp_request_id,in_user_id);
  return 1;
end //
DELIMITER ;





DROP PROCEDURE IF EXISTS duplicate_day_activities;
DELIMITER //
CREATE PROCEDURE duplicate_day_activities(
  IN in_old_day_id VARCHAR(100),
   IN in_new_day_id VARCHAR(100)
  )
  begin
    DECLARE activity_counter INT;
    DECLARE destination_counter INT;
    DECLARE temp_destination_id VARCHAR(100);
    DECLARE temp_activity_id VARCHAR(100);
    DECLARE temp VARCHAR(100);

    -- Count the destinations for the day
    SELECT count(*) INTO destination_counter FROM vw_itinerary_destinations
    WHERE day_id = in_old_day_id;

    -- For every destination index, get the activities and duplicate them
    WHILE 0 < destination_counter DO
      SET destination_counter = destination_counter -1;
    -- get the destination id for the day and position
      SELECT destination_id into temp_destination_id FROM vw_itinerary_destinations
       WHERE day_id = in_old_day_ID AND position = destination_counter;

      --  duplicate the destination
      SELECT add_itinerary_destination(in_new_day_id,temp_destination_id)  INTO temp;

      -- count activities for the destination
      SELECT count(*) INTO activity_counter FROM vw_itinerary_activities
       WHERE day_id = in_old_day_id and destination_id = temp_destination_id;
       WHILE 0 < activity_counter DO
        SET activity_counter = activity_counter -1;
        -- get the activity id
        SELECT activity_id INTO temp_activity_id FROM vw_itinerary_activities WHERE
        day_id = in_old_day_id
        AND destination_id = temp_destination_id
         AND position = activity_counter;


        SELECT add_itinerary_activity(in_new_day_id,temp_activity_id, temp_destination_id) INTO temp;

       END WHILE;

       -- increase destination count
    END WHILE;


  end //
DELIMITER ;



DROP PROCEDURE IF EXISTS duplicate_day_destinations;


DROP PROCEDURE IF EXISTS get_stats_summary;
DELIMITER //
CREATE PROCEDURE get_stats_summary()
begin
    SELECT
        (SELECT COUNT(*) FROM users) AS user_count,
        (SELECT COUNT(*) FROM itinerary) AS itinerary_count,
        (SELECT COUNT(*) FROM users WHERE date_registered >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)) AS signup_count,
        (SELECT COUNT(*) FROM destinations) AS destination_count,
        (SELECT 0) AS total_itinerary_value,
        (SELECT 0) AS average_itinerary_value,
        (SELECT 0) AS average_itinerary_participants
;
end
//

DELIMITER ;


DROP PROCEDURE IF EXISTS get_destinations;
DELIMITER //
CREATE PROCEDURE get_destinations()
begin
  SELECT * from destinations ORDER BY num_ratings DESC;
end //
DELIMITER ;

DROP PROCEDURE IF EXISTS get_destination_activities;
DELIMITER //
CREATE PROCEDURE  get_destination_activities(in_destination_id VARCHAR(100))
BEGIN
SELECT * from destination_activities as da left join activities as a on a.activity_id = da.activity_id where da.destination_id = in_destination_id;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_destination_utilities;
DELIMITER //
CREATE PROCEDURE get_destination_utilities( in_destination_id VARCHAR(100))
BEGIN
SELECT * FROM destination_utilities as du inner join types_of_utility as tu on tu.type_id = du.type_id where du.destination_id = in_destination_id;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_destination_type;
DELIMITER //
CREATE PROCEDURE get_destination_type(in_destination_id VARCHAR(100))
BEGIN
SELECT * from destination_type as dt inner join types_of_destination as td on td.type_id = dt.type_id where dt.destination_id = in_destination_id;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_users;
DELIMITER //
CREATE PROCEDURE get_users()
BEGIN
  SELECT * FROM vw_users;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS get_itineraries;
DELIMITER //
CREATE PROCEDURE get_itineraries(IN in_user_id VARCHAR(100) )
BEGIN
    IF in_user_id IS NULL THEN
        SELECT * FROM vw_itinerary order by date_created desc;
    ELSE
        SELECT * FROM vw_itinerary WHERE owner_id = in_user_id order by date_created desc;
    END IF;
END //

DELIMITER ;

DROP PROCEDURE IF EXISTS get_itinerary_by_id;
DELIMITER //
CREATE PROCEDURE get_itinerary_by_id(
  IN in_itinerary_id VARCHAR(100)
) BEGIN
SELECT * FROM vw_itinerary WHERE itinerary_id = in_itinerary_id;
END //
DELIMITER ;




DROP PROCEDURE IF EXISTS get_itinerary_collaborators;
DELIMITER //

CREATE PROCEDURE get_itinerary_collaborators(IN in_itinerary_id VARCHAR(100))
BEGIN
    SELECT * FROM itinerary_collaborators WHERE itinerary_id = in_itinerary_id;
END //

DELIMITER ;


DROP PROCEDURE IF EXISTS get_itinerary_day_activities;
DELIMITER //
CREATE PROCEDURE get_itinerary_day_activities(
  IN in_day_id VARCHAR(100)
)
BEGIN
  SELECT * FROM vw_itinerary_activities WHERE day_id = in_day_id;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_itinerary_day_destinations;
DELIMITER //
CREATE PROCEDURE get_itinerary_day_destinations(
IN in_day_id VARCHAR(100)
)
begin
  SELECT * FROM vw_itinerary_destinations WHERE day_id = in_day_id;
end //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_itinerary_day_info;
DELIMITER //
CREATE PROCEDURE get_itinerary_day_info(IN in_day_id varchar(100))
BEGIN
SELECT * FROM itinerary_destination as id where id.day_id = in_day_id;
select * from itinerary_activity as ia where ia.day_id = in_day_id;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS get_itinerary_days;
DELIMITER //
CREATE PROCEDURE get_itinerary_days(IN in_itinerary_id VARCHAR(100))
BEGIN
SELECT * FROM itinerary_day WHERE itinerary_id = in_itinerary_id order by position;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS get_day_destination_activities;
DELIMITER //
CREATE PROCEDURE get_day_destination_activities(IN in_destination_id VARCHAR(100), IN in_day_id VARCHAR(100))
BEGIN
  SELECT * FROM vw_itinerary_activities where destination_id = in_destination_id and day_id = in_day_id order by position;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS get_itinerary_activities;
DELIMITER //
CREATE PROCEDURE get_itinerary_activities(IN in_itinerary_id VARCHAR(100))
BEGIN
  SELECT * FROM vw_itinerary_activities where itinerary_id = in_itinerary_id;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS generate_activity_invoice;
DELIMITER //
CREATE PROCEDURE generate_activity_invoice(IN in_itinerary_id VARCHAR(100))
BEGIN
  DECLARE temp_day_id VARCHAR(100);
  DECLARE temp_activity_id VARCHAR(100);
  DECLARE temp_destination_id VARCHAR(100);
  DECLARE day_counter INT;
  DECLARE activity_counter INT;
  DECLARE destination_counter INT;
  DECLARE temp_price DECIMAL(10,2);
  DECLARE temp_currency VARCHAR(5);

  -- Count the number of days
  SELECT COUNT(*) INTO day_counter FROM itinerary_day WHERE itinerary_id = in_itinerary_id;

  -- For each day, loop through the activities, getting the destination price and saving it as final
  WHILE day_counter > 0 DO
    SET day_counter = day_counter - 1;

    -- Get the current day id
    SELECT day_id INTO temp_day_id FROM itinerary_day WHERE itinerary_id = in_itinerary_id AND position = day_counter;

    -- Get the destinations for the selected day
    SELECT COUNT(*) INTO destination_counter FROM vw_itinerary_destinations WHERE itinerary_id = in_itinerary_id AND day_id = temp_day_id;

    WHILE destination_counter > 0 DO
      SET destination_counter = destination_counter - 1;
      SELECT destination_id INTO temp_destination_id FROM vw_itinerary_destinations
      WHERE itinerary_id = in_itinerary_id AND position = destination_counter AND day_id = temp_day_id;

      -- Get the activities for the selected day
      SELECT COUNT(*) INTO activity_counter FROM vw_itinerary_activities WHERE itinerary_id = in_itinerary_id AND day_id = temp_day_id AND destination_id = temp_destination_id;

      WHILE activity_counter > 0 DO
        SET activity_counter = activity_counter - 1;
        SELECT currency_name, price INTO temp_currency, temp_price FROM vw_itinerary_activities
        WHERE day_id = temp_day_id AND destination_id = temp_destination_id AND position = activity_counter;

        UPDATE itinerary_activity SET final_price = temp_price, final_currency = temp_currency WHERE day_id = temp_day_id AND destination_id = temp_destination_id AND position = activity_counter;

      END WHILE;

    END WHILE;

  END WHILE;

  -- Display the value of the test variable (just for debugging purposes)

END //
DELIMITER ;



DROP FUNCTION IF EXISTS create_itinerary_invoice;
DELIMITER //
CREATE FUNCTION create_itinerary_invoice( itinerary_id VARCHAR(100))
BEGIN
    CALL generate_activity_invoice(itinerary_id);
END
DELIMITER ;