

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
  ) RETURNS VARCHAR(100)
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
          INSERT INTO google_users(user_id,google_id,email) VALUES (new_id, in_provider_id,in_email);
          SET results = 1;
    END CASE;
    RETURN new_id;
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
CREATE FUNCTION provider_signup(provider VARCHAR(50), in_username VARCHAR(100), in_provider_id VARCHAR(100), in_email VARCHAR(100)) RETURNS VARCHAR(100)
BEGIN

  RETURN create_user(provider,in_username,in_email,null,in_provider_id);
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
CREATE FUNCTION add_destination_activity (in_destination_id VARCHAR(100), in_activity_name VARCHAR(100), in_price FLOAT, in_currency VARCHAR(10))
RETURNS TINYINT(1)
BEGIN
   DECLARE act_id INT;
   DECLARE temp INT;
   DECLARE in_currency_id INT;


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

   SELECT currency_id into in_currency_id FROM currency WHERE currency_name = in_currency;




   INSERT INTO destination_activities (destination_id, activity_id, price, date_updated,currency_id)
   VALUES (in_destination_id, act_id, in_price, CURRENT_TIMESTAMP,in_currency_id);

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
        (SELECT COUNT(u.user_id) FROM users AS u LEFT JOIN admin_users AS au ON u.user_id = au.user_id WHERE au.user_id IS NULL) AS user_count,
        (SELECT COUNT(DISTINCT i.itinerary_id) FROM itinerary AS i INNER JOIN itinerary_collaborators AS ic ON ic.itinerary_id = i.itinerary_id LEFT JOIN admin_users AS au ON ic.user_id = au.user_id WHERE au.user_id IS NULL) AS itinerary_count,
        (SELECT COUNT( u.user_id) FROM users as u left join admin_users as au on u.user_id = au.user_id WHERE au.user_id is null and u.date_registered >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)) AS signup_count,
        (SELECT COUNT(*) FROM destinations AS d LEFT JOIN accommodation AS a ON d.destination_id = a.destination_id WHERE a.destination_id IS NULL) AS destination_count,
        (SELECT sum(da.price) from itinerary_activity as ia inner join destination_activities as da on da.activity_id = ia.activity_id and da.destination_id = ia.destination_id) AS total_itinerary_value,
        (SELECT SUM(price) from itinerary_invoice_activities) AS total_booking_value,
        (SELECT total_booking_value/count(distinct invoice_id) from itinerary_invoice_activities ) AS average_booking_value,
        (SELECT count(user_id)/count(distinct itinerary_id) from itinerary_collaborators ) AS average_itinerary_participants
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
	SELECT
	i.*,
	m.media_location
	 FROM vw_itinerary as i
	left join travel_plan_media as tm on tm.itinerary_id = in_itinerary_id
	left join media as m on m.media_id = tm.media_id
	WHERE i.itinerary_id = in_itinerary_id;
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
CREATE PROCEDURE generate_activity_invoice(IN in_itinerary_id VARCHAR(100), IN in_invoice_id VARCHAR(100))
BEGIN
  DECLARE temp_day_id VARCHAR(100);
  DECLARE temp_activity_id VARCHAR(100);
  DECLARE temp_destination_id VARCHAR(100);
  DECLARE day_counter INT;
  DECLARE activity_counter INT;
  DECLARE destination_counter INT;
  DECLARE temp_price DECIMAL(10,2);
  DECLARE temp_currency VARCHAR(5);
  DECLARE temp_day_date DATETIME;

  -- Count the number of days
  SELECT COUNT(*) INTO day_counter FROM itinerary_day WHERE itinerary_id = in_itinerary_id;

  -- For each day, loop through the activities, getting the destination price and saving it as final
  WHILE day_counter > 0 DO
    SET day_counter = day_counter - 1;

    -- Get the current day id
    SELECT day_id,visit_date INTO temp_day_id,temp_day_date FROM itinerary_day WHERE itinerary_id = in_itinerary_id AND position = day_counter;
    SELECT visit_date INTO temp_day_date FROM itinerary_day WHERE itinerary_id = in_itinerary_id AND position = day_counter;

    -- Get the destinations for the selected day
    SELECT COUNT(*) INTO destination_counter FROM vw_itinerary_destinations WHERE itinerary_id = in_itinerary_id AND day_id = temp_day_id;

    WHILE destination_counter > 0 DO
      SET destination_counter = destination_counter - 1;

	--   Create destination entry into the invoice
      SELECT destination_id INTO temp_destination_id FROM vw_itinerary_destinations
      WHERE itinerary_id = in_itinerary_id AND position = destination_counter AND day_id = temp_day_id;

	  INSERT INTO `itinerary_invoice_destinations`(`invoice_id`, `destination_id`)
	  VALUES (in_invoice_id,temp_destination_id);
      -- Get the activities for the selected day
      SELECT COUNT(*) INTO activity_counter FROM vw_itinerary_activities WHERE itinerary_id = in_itinerary_id AND day_id = temp_day_id AND destination_id = temp_destination_id;

      WHILE activity_counter > 0 DO
        SET activity_counter = activity_counter - 1;
        SELECT currency_name, price INTO temp_currency, temp_price FROM vw_itinerary_activities
        WHERE day_id = temp_day_id AND destination_id = temp_destination_id AND position = activity_counter;

        SELECT activity_id into temp_activity_id FROM itinerary_activity WHERE day_id = temp_day_id AND destination_id = temp_destination_id AND position = activity_counter;
        -- UPDATE itinerary_activity SET final_price = temp_price, final_currency = temp_currency WHERE day_id = temp_day_id AND destination_id = temp_destination_id AND position = activity_counter;
		INSERT INTO `itinerary_invoice_activities`(`invoice_id`, `activity_id`, `destination_id`, `currency`,`price`, `visit_date`)
		VALUES (in_invoice_id,temp_activity_id,temp_destination_id,temp_currency,temp_price,temp_day_date);

      END WHILE;

    END WHILE;

  END WHILE;

  -- Display the value of the test variable (just for debugging purposes)

END //
DELIMITER ;


DROP FUNCTION IF EXISTS create_itinerary_invoice;
DELIMITER //
CREATE FUNCTION create_itinerary_invoice( itinerary_id VARCHAR(100)) returns int
BEGIN
    CALL generate_activity_invoice(itinerary_id);
	return null;
END //
DELIMITER ;




DROP PROCEDURE IF EXISTS make_itinerary_payment;
DROP PROCEDURE IF EXISTS make_invoice_payment;
DELIMITER //
CREATE PROCEDURE make_invoice_payment(
	IN in_invoice_id VARCHAR(100),
    IN in_provider_id VARCHAR(100),
    IN in_sending_user VARCHAR(100),
    IN in_purpose VARCHAR(200),
    IN in_transaction_amount DOUBLE,
    IN in_amount DOUBLE,
    IN in_tax DOUBLE,
    IN in_charges DOUBLE,
	IN in_provider VARCHAR(10)
)
begin
	DECLARE in_transaction_id VARCHAR(100);
	-- Record the transaction
	SELECT record_transaction(in_sending_user,in_provider_id ,in_purpose ,in_transaction_amount ,in_amount ,in_tax ,in_charges ,in_provider) INTO in_transaction_id;
	-- Create the invoice payment connection
	INSERT INTO invoice_payments(transaction_id,invoice_id)
	VALUES(in_transaction_id,in_invoice_id);
	-- Make the transaction id accessible to the calling function
	SELECT in_transaction_id;
end //
DELIMITER ;


DROP FUNCTION IF EXISTS record_transaction;
DELIMITER //
CREATE FUNCTION record_transaction(
	in_user_id VARCHAR(100),
	in_provider_id VARCHAR(100),
	in_purpose VARCHAR(200),
	in_transaction_amount DOUBLE,
	in_amount DOUBLE,
	in_tax DOUBLE,
	in_charges DOUBLE,
	in_provider VARCHAR(50)
) RETURNS VARCHAR(100)
begin
	DECLARE in_transaction_id VARCHAR(100);
	SELECT  generate_id() INTO in_transaction_id;
	INSERT INTO `transactions`(`transaction_id`, `provider_transaction_id` , `sending_user`, `purpose`, `total_transaction_amount`, `amount`, `tax`, `charges`, `provider`)
	VALUES (in_transaction_id,in_provider_id,in_user_id,in_purpose,in_transaction_amount,in_amount,in_tax,in_charges,in_provider);

	RETURN in_transaction_id;
end //

DELIMITER ;


DROP PROCEDURE IF EXISTS get_itinerary_invoice;
DROP PROCEDURE IF EXISTS get_invoice;
DELIMITER //
CREATE PROCEDURE get_invoice(
	in in_invoice_id VARCHAR(100)
)begin
	SELECT * from vw_itinerary_invoice where invoice_id = in_invoice_id;
end //
DELIMITER ;



DROP FUNCTION IF EXISTS add_bed_type;
delimiter //
CREATE FUNCTION add_bed_type(in_name VARCHAR(50))returns INT
begin
	DECLARE bed_id INT;
	SELECT type_id INTO bed_id from types_of_bed where type_name = in_bed_type;

	IF bed_id is null then
		INSERT INTO types_of_bed(type_name) VALUES (in_bed_type);
	end if;
	return bed_id;
end//
delimiter ;


DROP FUNCTION IF EXISTS add_accommodation;
delimiter //
CREATE FUNCTION add_accommodation(
	in_destination_id VARCHAR(100),
	in_nickname VARCHAR(100),
	in_bed_type VARCHAR(50),
	in_occupancy INT,
	in_currency VARCHAR(100),
	in_price DECIMAL(10,2)
)RETURNS VARCHAR(100) MODIFIES SQL DATA
begin
	DECLARE in_bed_id INT;
	DECLARE in_accommodation_id VARCHAR(100);
	DECLARE in_currency_id INT;

	SELECT generate_id() INTO in_accommodation_id;
	SELECT type_id INTO in_bed_id from types_of_bed where type_name = in_bed_type;
	SELECT currency_id INTO in_currency_id from currency where currency_name = in_currency;

	INSERT INTO `accommodation`(`accommodation_id`, `destination_id`, `occupancy`, `price`, `bed_type`, `nickname`, `currency_id`)
	VALUES (in_accommodation_id,in_destination_id,in_occupancy,in_price,in_bed_id, in_nickname,in_currency_id);

	RETURN in_accommodation_id;
end//
delimiter ;

DROP PROCEDURE IF EXISTS get_itinerary_invoices;
DELIMITER //
CREATE PROCEDURE  get_itinerary_invoices(IN in_itinerary_id VARCHAR(100))
BEGIN
	SELECT * FROM vw_itinerary_invoice where itinerary_id = in_itinerary_id;
END//
DELIMITER ;


DROP FUNCTION IF EXISTS create_itinerary_invoice;
DELIMITER //
CREATE FUNCTION create_itinerary_invoice( in_itinerary_id VARCHAR(100), in_num_people INT) returns varchar(100)
BEGIN
	DECLARE in_invoice_id VARCHAR(100);
	SELECT generate_id() into in_invoice_id;
	INSERT INTO `itinerary_invoice`(`invoice_id`, `itinerary_id`,`num_people`) VALUES (in_invoice_id,in_itinerary_id,in_num_people);
	-- Create entries for activities
    CALL generate_activity_invoice(in_itinerary_id, in_invoice_id);

	return in_invoice_id;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_invoice_by_id;
DELIMITER //
CREATE PROCEDURE get_invoice_by_id(IN in_invoice_id VARCHAR(100))
BEGIN
	SELECT * FROM vw_itinerary_invoice where invoice_id = in_invoice_id;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS get_invoice_destinations;
DROP PROCEDURE IF EXISTS get_invoice_activities;
DELIMITER //
CREATE PROCEDURE get_invoice_activities(IN in_invoice_id VARCHAR(100))
BEGIN
	SELECT * from vw_invoice_activities WHERE invoice_id = in_invoice_id;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS  set_itinerary_visibility;
DELIMITER //
CREATE PROCEDURE set_itinerary_visibility(IN in_itinerary_id VARCHAR(100), IN in_visibility VARCHAR(100))
BEGIN
	UPDATE itinerary SET visibility = in_visibility where itinerary_id = in_itinerary_id;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS set_itinerary_day_date;
DELIMITER //
CREATE PROCEDURE set_itinerary_day_date(IN in_day_id VARCHAR(100), IN in_date DATETIME)
BEGIN
	UPDATE itinerary_day SET visit_date = in_date where day_id = in_day_id;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS make_user_admin;
DELIMITER //
CREATE PROCEDURE make_user_admin(IN in_user_id VARCHAR(100), IN in_privilege VARCHAR(20))
BEGIN
	-- Check if the user is already an admin
	DECLARE temp_id  VARCHAR(100);
	SELECT user_id into temp_id from admin_users where user_id = in_user_id;
	if temp_id is null  then
		INSERT INTO `admin_users`(`user_id`, `privilege`) VALUES (in_user_id,in_privilege);
	end if;
END //
DELIMITER ;


DROP FUNCTION IF EXISTS get_admin_privilege;
DELIMITER //
CREATE FUNCTION get_admin_privilege(in_user_id VARCHAR(100)) RETURNS VARCHAR(30)
READS SQL DATA
BEGIN
    DECLARE result VARCHAR(30);
    SELECT privilege INTO result FROM admin_users WHERE user_id = in_user_id;
    RETURN result;
END //
DELIMITER ;




DROP FUNCTION IF EXISTS create_curator;
DELIMITER //
CREATE FUNCTION create_curator(
	in_username VARCHAR(100),
	in_email VARCHAR(100),
	in_password VARCHAR(100),
	in_phone VARCHAR(100),
	in_curator_name VARCHAR(100),
	in_bank_id VARCHAR(100),
	in_bank_name VARCHAR(100),
	in_account_number VARCHAR(100),
	in_account_name VARCHAR(100),
	in_subaccount_id VARCHAR(100),
	in_logo_location VARCHAR(200),
	in_logo_type VARCHAR(40),
	in_doc_location VARCHAR(200),
	in_doc_type VARCHAR(40)
) RETURNS VARCHAR(100)
BEGIN
	DECLARE temp_user_id VARCHAR(100);
	DECLARE temp_curator_id VARCHAR(100);
	DECLARE in_logo_id VARCHAR(100);
	DECLARE in_company_doc VARCHAR(100);


	SELECT generate_id() INTO temp_curator_id;

	SELECT upload_media(in_logo_location,in_logo_type,0) INTO in_logo_id;
	SELECT upload_media(in_doc_location,in_doc_type,0) INTO in_company_doc;

	-- Create a user account
	SELECT user_id INTO temp_user_id FROM vw_users WHERE email = in_email;
	IF temp_user_id IS NULL THEN
		SELECT create_user("email",in_username,in_email,in_password,NULL) INTO temp_user_id;
	END IF;

	-- Create a curator account
	INSERT INTO curator(curator_id, curator_name, logo_id, registration_doc_id) VALUES (temp_curator_id, in_curator_name,in_logo_id,in_company_doc);
	INSERT INTO curator_manager(curator_id, user_id) VALUES (temp_curator_id, temp_user_id);

	-- Add payout account
	INSERT INTO payout_accounts(account_id, bank_id, bank_name, account_name, account_number)
	VALUES (in_subaccount_id, in_bank_id, in_bank_name, in_account_name, in_account_number);

	INSERT INTO curator_payout_account(payout_account_id, curator_id)
	VALUES (in_subaccount_id, temp_curator_id);


	RETURN temp_curator_id;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS get_curator_account_by_user_id;
DELIMITER //
CREATE PROCEDURE get_curator_account_by_user_id(IN in_user_id varchar(100))
begin
	SELECT * from vw_curators as c inner join curator_manager as cm where cm.user_id = in_user_id;
end//
DELIMITER ;


DROP PROCEDURE IF EXISTS generate_shared_experience;
DELIMITER //
CREATE PROCEDURE generate_shared_experience(IN in_itinerary_id VARCHAR(100), IN in_experience_id VARCHAR(100))
BEGIN
  DECLARE temp_day_id VARCHAR(100);
  DECLARE temp_activity_id VARCHAR(100);
  DECLARE temp_destination_id VARCHAR(100);
  DECLARE day_counter INT;
  DECLARE activity_counter INT;
  DECLARE destination_counter INT;
  DECLARE temp_price DECIMAL(10,2);
  DECLARE temp_currency VARCHAR(5);
  DECLARE temp_day_date DATETIME;
  DECLARE temp_experience VARCHAR(100) DEFAULT null;

  -- Count the number of days
  SELECT COUNT(*) INTO day_counter FROM itinerary_day WHERE itinerary_id = in_itinerary_id;

  -- For each day, loop through the activities, getting the destination price and saving it as final
  WHILE day_counter > 0 DO
    SET day_counter = day_counter - 1;

    -- Get the current day id
    SELECT day_id,visit_date INTO temp_day_id,temp_day_date FROM itinerary_day WHERE itinerary_id = in_itinerary_id AND position = day_counter;
    SELECT visit_date INTO temp_day_date FROM itinerary_day WHERE itinerary_id = in_itinerary_id AND position = day_counter;

    -- Get the destinations for the selected day
    SELECT COUNT(*) INTO destination_counter FROM vw_itinerary_destinations WHERE itinerary_id = in_itinerary_id AND day_id = temp_day_id;

    WHILE destination_counter > 0 DO
      SET destination_counter = destination_counter - 1;

	--   Create destination entry into the invoice
      SELECT destination_id INTO temp_destination_id FROM vw_itinerary_destinations
      WHERE itinerary_id = in_itinerary_id AND position = destination_counter AND day_id = temp_day_id;

	  SELECT experience_id into temp_experience FROM shared_experience_destinations
	  where experience_id = in_experience_id and destination_id = temp_destination_id;

	  IF temp_experience is null then
		INSERT INTO `shared_experience_destinations`(`experience_id`, `destination_id`)
		VALUES (in_experience_id,temp_destination_id);
	  end if;

      -- Get the activities for the selected day
      SELECT COUNT(*) INTO activity_counter FROM vw_itinerary_activities WHERE itinerary_id = in_itinerary_id AND day_id = temp_day_id AND destination_id = temp_destination_id;

      WHILE activity_counter > 0 DO
        SET activity_counter = activity_counter - 1;
        SELECT currency_name, price INTO temp_currency, temp_price FROM vw_itinerary_activities
        WHERE day_id = temp_day_id AND destination_id = temp_destination_id AND position = activity_counter;

        SELECT activity_id into temp_activity_id FROM itinerary_activity WHERE day_id = temp_day_id AND destination_id = temp_destination_id AND position = activity_counter;
        -- UPDATE itinerary_activity SET final_price = temp_price, final_currency = temp_currency WHERE day_id = temp_day_id AND destination_id = temp_destination_id AND position = activity_counter;
		INSERT INTO `shared_experience_activities`(`experience_id`, `activity_id`, `destination_id`, `currency`,`price`, `visit_date`)
		VALUES (in_experience_id,temp_activity_id,temp_destination_id,temp_currency,temp_price,temp_day_date);

      END WHILE;

    END WHILE;

  END WHILE;

  -- Display the value of the test variable (just for debugging purposes)

END //
DELIMITER ;



DROP FUNCTION IF EXISTS create_shared_experience;

DELIMITER //
CREATE FUNCTION create_shared_experience(
	in_itinerary_id VARCHAR(100),
	in_curator_id VARCHAR(100),
  in_experience_name VARCHAR(60),
	in_currency INT,
	in_fee DOUBLE,
	in_seats INT,
	in_media_location TEXT,
	in_media_type VARCHAR(30)
) returns varchar(100)
begin
	DECLARE in_experience_id varchar(100);
	DECLARE in_start_date DATETIME;
	DECLARE in_media_id VARCHAR(100);

	SELECT generate_id() into in_experience_id;
	SELECT visit_date into in_start_date from itinerary_day where itinerary_id = in_itinerary_id  ORDER BY visit_date ASC LIMIT 1;

	INSERT INTO shared_experiences(experience_id,experience_name,curator_id,start_date,booking_fee,number_of_seats)
	VALUES (in_experience_id, in_experience_name, in_curator_id,in_start_date,in_fee,in_seats);

	IF in_media_location IS NOT NULL THEN
		SELECT upload_media(in_media_location, in_media_type,0) INTO in_media_id;

		UPDATE shared_experiences SET media_id = in_media_id where experience_id = in_experience_id;

	END IF;


	CALL generate_shared_experience(in_itinerary_id,in_experience_id);

	return in_experience_id;

end//
DELIMITER ;


DROP PROCEDURE IF EXISTS get_curator_listings;
DELIMITER //
CREATE PROCEDURE get_curator_listings(IN in_curator_id VARCHAR(100))
BEGIN
	SELECT * FROM vw_shared_experiences where curator_id = in_curator_id;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS get_curator_bookings;
DELIMITER //
CREATE PROCEDURE get_curator_bookings(IN in_curator_id VARCHAR(100))
BEGIN
	SELECT * FROM vw_shared_experience_bookings where curator_id = in_curator_id;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS get_curator_collaborators;
DELIMITER //
CREATE PROCEDURE get_curator_collaborators(IN in_curator_id VARCHAR(100))
BEGIN
	SELECT cm.*, u.user_name, u.email, cm.date_added FROM curator_manager as cm
	inner join vw_users as u on u.user_id = cm.user_id WHERE cm.curator_i = in_curator_id;
END//
DELIMITER ;


DROP PROCEDURE IF EXISTS get_shared_experience_by_id;
DELIMITER //
CREATE PROCEDURE get_shared_experience_by_id(in in_experience_id varchar(100))
begin
  select * from vw_shared_experiences where experience_id = in_experience_id;
end //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_shared_experiences;
DELIMITER //
CREATE PROCEDURE get_shared_experiences(IN in_show_all TINYINT)
begin
  IF in_show_all = 0 then
    select * from vw_shared_experiences where is_visible = 1;
  else
    select * from vw_shared_experiences;
  end if;
end //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_shared_experience_destinations;
DELIMITER //
CREATE PROCEDURE get_shared_experience_destinations(in in_experience_id varchar(100))
BEGIN
	SELECT * from shared_experience_destinations where experience_id = in_experience_id;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_shared_experience_activities;
DELIMITER //
CREATE PROCEDURE get_shared_experience_activities(IN in_experience_id VARCHAR(100))
BEGIN
	SELECT sa.*, a.activity_name, d.destination_name, d.location,d.rating FROM shared_experience_activities as sa
	inner join destinations as d on d.destination_id = sa.destination_id
	inner join activities as a on a.activity_id = sa.activity_id
	where sa.experience_id = in_experience_id
   order by sa.visit_date, sa.destination_id;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS create_travel_plan;

DELIMITER //
CREATE PROCEDURE create_travel_plan (
	IN in_itinerary_id VARCHAR(100),
	IN in_price DOUBLE,
	IN in_currency_name VARCHAR(100),
	IN in_collection VARCHAR(30),
	IN in_media_location TEXT,
	IN in_media_type VARCHAR(10)
)BEGIN
	DECLARE temp_collection_id VARCHAR(100);
	DECLARE in_media_id VARCHAR(100);
	DECLARE in_currency VARCHAR(100);

	SELECT collection_id into temp_collection_id from travel_plan_collections
	WHERE collection_name = in_collection;

	-- Check if collection EXISTS, create if not
	IF temp_collection_id IS NULL THEN
		SELECT generate_id() into temp_collection_id;
		INSERT INTO travel_plan_collections (collection_id, collection_name)
		 VALUES (temp_collection_id ,in_collection);
	END IF;

	SELECT currency_id INTO in_currency from currency
	WHERE currency_name = in_currency_name;
	IF in_currency IS NULL THEN
		INSERT INTO currency(currency_name) VALUES (in_currency_name);

		SELECT currency_id INTO in_currency from currency
		WHERE currency_name = in_currency_name;
	END IF;

	INSERT INTO travel_plan(itinerary_id,collection_id,price,currency_id)
	VALUES (in_itinerary_id, temp_collection_id, in_price, in_currency);




	-- create travel plan (itienrary,collection)
	-- upload media
	SELECT upload_media(in_media_location,in_media_type,0) INTO in_media_id;

	INSERT INTO travel_plan_media(media_id,itinerary_id) VALUES (in_media_id,in_itinerary_id);


END //
DELIMITER ;


DROP PROCEDURE IF EXISTS get_travel_plan_categories;

DELIMITER //
CREATE PROCEDURE get_travel_plan_categories()
begin
	SELECT * FROM travel_plan_collections;
end //
DELIMITER ;

DROP PROCEDURE IF EXISTS get_travel_plan_collection
DELIMITER //
CREATE PROCEDURE get_travel_plan_collection(IN in_collection_id VARCHAr(100))
Begin
	SELECT tp.*,m.media_location, m.media_type,m.is_foreign FROM travel_plan as tp
	left join travel_plan_media as tpm on tpm.itinerary_id = tp.itinerary_id
	left join media as m on m.media_id = tpm.media_id
	 where tp.collection_id = in_collection_id;
end //
DELIMITER ;






DROP FUNCTION IF EXISTS toggle_experience_wishlist;
DELIMITER //
CREATE FUNCTION toggle_experience_wishlist(
  in_user_id VARCHAR(100),
  in_experience_id VARCHAR(100)
  )
RETURNS TINYINT
BEGIN
  DECLARE temp_id VARCHAR(100);

  SELECT user_id INTO  temp_id FROM experience_wishlist WHERE user_id = in_user_id AND experience_id = in_experience_id;
  if temp_id is null then
    INSERT INTO experience_wishlist(user_id,experience_id) VALUES (in_user_id,in_experience_id);
    return 1;
  end if;

  DELETE FROM experience_wishlist where user_id = in_user_id and experience_id = in_experience_id;
  return 0;


END //
DELIMITER ;




DROP FUNCTION IF EXISTS upload_media;
DELIMITER //
CREATE FUNCTION upload_media(in_media_location VARCHAR(100), in_media_type VARCHAR(30),in_is_foreign TINYINT(1))
returns varchar(100)
begin
	DECLARE in_media_id VARCHAR(100);
	SELECT generate_id() into in_media_id;
	INSERT INTO `media`(`media_id`, `media_location`, `media_type`,  `is_foreign`)
  VALUES (in_media_id,in_media_location,in_media_type,in_is_foreign);
  return in_media_id;
end //
DELIMITER ;





DROP FUNCTION IF EXISTS curator_media_upload;
DELIMITER //
CREATE FUNCTION curator_media_upload(
	in_curator_id VARCHAR(100), in_media_location VARCHAR(100),
	in_media_type VARCHAR(30),in_is_foreign TINYINT(1)
	)
	returns varchar(100)
begin
	DECLARE in_media_id VARCHAR(100);
	SELECT upload_media(in_media_location, in_media_type, in_is_foreign) into in_media_id;
	INSERT INTO curator_media(curator_id,media_id) VALUES (in_curator_id,in_media_id);
	RETURN in_media_id;
end //
delimiter ;


DROP PROCEDURE IF EXISTS upload_curator_identification;
DELIMITER //
CREATE PROCEDURE upload_curator_identification(
	in in_email VARCHAR(100),
	IN in_front_location VARCHAR(200),
	IN in_front_type VARCHAR(20),
	IN in_back_location VARCHAR(200),
	IN in_back_type VARCHAR(20)
)
begin
	DECLARE in_user_id VARCHAR(100);
	DECLARE front_media_id VARCHAR(100);
	DECLARE back_media_id VARCHAR(100);
	SELECT user_id into in_user_id from vw_users where email = in_email;

	SELECT upload_media(in_front_location,in_front_type,0) INTO front_media_id;
	SELECT upload_media(in_back_location,in_back_type,0) INTO back_media_id;

	UPDATE curator_manager set id_card_front = front_media_id, id_card_back = back_media_id
	where user_id = in_user_id;

  SELECT 1;


end //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `get_curator_payout_account`(IN in_curator_id VARCHAR(100))
BEGIN
	SELECT * FROM vw_payout_accounts where curator_id = in_curator_id;
END //
DELIMITER ;




DELIMITER //
CREATE  PROCEDURE `make_experience_payment`(
	IN in_experience_id VARCHAR(100),
	IN in_seat_count INT,
    IN in_provider_id VARCHAR(100),
    IN in_sending_user VARCHAR(100),
    IN in_description VARCHAR(200),
    IN in_transaction_amount DOUBLE,
    IN in_amount DOUBLE,
    IN in_tax DOUBLE,
    IN in_charges DOUBLE,
	IN in_provider VARCHAR(10)
)
begin
	DECLARE in_transaction_id VARCHAR(100);

	SELECT record_transaction(in_sending_user,in_provider_id ,in_description ,in_transaction_amount ,in_amount ,in_tax ,in_charges ,in_provider) INTO in_transaction_id;

	INSERT INTO shared_experience_bookings(`experience_id`, `user_id`, `transaction_id`, `number_of_seats`)
	VALUES (in_experience_id,in_sending_user,in_transaction_id,in_seat_count);

	SELECT in_transaction_id;
end //
DELIMITER ;


DROP FUNCTION IF EXISTS invite_curator_collaborator;
DELIMITER //
 CREATE FUNCTION invite_curator_collaborator(
	in_curator_id VARCHAR(100), in_email VARCHAR(100)
	) RETURNS VARCHAR(100)
 BEGIN
	DECLARE in_invite_id VARCHAR(100);
	DECLARE checks VARCHAR(100);

	-- Check if associated with a curator account
	SELECT curator_id into checks from vw_curator_managers where email = in_email;
	CASE
		WHEN checks = in_curator_id then
			return 1; -- Error if curator already invited to account

		WHEN checks != in_curator_id then
			return 2;
		WHEN checks is null then
			SELECT null into checks; -- Do nothing
	END CASE;



	-- check if email has invite
	SELECT invite_id,curator_id INTO in_invite_id,checks from curator_collaborator_invite where email = in_email;

	CASE
		WHEN in_invite_id is null THEN
			SELECT generate_id() into in_invite_id;
			INSERT INTO curator_collaborator_invite(invite_id,curator_id,email) VALUES (in_invite_id, in_curator_id,in_email);
			RETURN in_invite_id; -- return new id if email doesn't have association

		when checks = in_curator_id THEN
			return in_invite_id; -- Return invite id if invited to same account

		WHEN in_curator_id != checks THEN
			return 3; -- Error code if invited to different account
	END CASE;

	return 0; -- something else happened


 END //
 DELIMITER ;



DROP FUNCTION IF EXISTS create_curator_manager;
DELIMITER //
CREATE FUNCTION create_curator_manager(
	in_token VARCHAR(100),
	in_username VARCHAR(100),
	in_email VARCHAR(100),
	in_password VARCHAR(100),
	in_phone VARCHAR(100)
) RETURNS VARCHAR(100)
BEGIN
	DECLARE temp_user_id VARCHAR(100);
	DECLARE temp_curator_id VARCHAR(100);
	DECLARE temp_email VARCHAR(100);

	-- check that the invite exists
	SELECT curator_id,email INTO temp_curator_id,temp_email FROM curator_collaborator_invite where invite_id = in_token;

	CASE
		WHEN temp_curator_id is null then
			return 1; -- no invite was found
		WHEN temp_email != in_email THEN
			return 2; -- Emails don't match
		WHEN temp_email = in_email THEN -- get user_id
			SELECT user_id INTO temp_user_id FROM vw_users WHERE email = in_email;
	END CASE;



	-- Create a user account
	IF temp_user_id IS NULL THEN
		SELECT create_user("email",in_username,in_email,in_password,NULL) INTO temp_user_id;
	END IF;

	-- Create a curator account
	INSERT INTO curator_manager(curator_id, user_id) VALUES (temp_curator_id, temp_user_id);

	DELETE FROM curator_collaborator_invite where invite_id = in_token;


	RETURN temp_user_id;
END //
DELIMITER ;


DROP FUNCTION IF EXISTS bypass_signup;
DELIMITER //
CREATE FUNCTION bypass_signup(
  in_name VARCHAR(100),
  in_email VARCHAR(100),
 in_phone VARCHAR(15)
 ) RETURNS VARCHAR(100)
begin
  DECLARE result varchar(100);
  -- If user email exists send -1
  SELECT user_id into result from vw_users where email = in_email;
  IF result IS NOT NULL THEN
    return result;
  end if;


  SELECT generate_id() into result;

  INSERT INTO users(user_id,user_name,phone,account_status)
  VALUES (result,in_name,in_phone, 'by_pass');

  INSERT INTO email_users (user_id,email) VALUES (result,in_email);
  RETURN result;
end //
DELIMITER ;



DROP PROCEDURE IF EXISTS get_travel_plan_bill;
DELIMITER //
	CREATE PROCEDURE get_travel_plan_bill(
		in in_itinerary_id VARCHAR(100)
	) BEGIN
		SELECT
		tp.price,
		c.currency_name,
		(select count( destination_id) from vw_itinerary_destinations where itinerary_id = in_itinerary_id) as num_destinations
		FROM
		travel_plan as tp
		inner join currency as c on c.currency_id = tp.currency_id
		where tp.itinerary_id = in_itinerary_id;
	END //
DELIMITER ;