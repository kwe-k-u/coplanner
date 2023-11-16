/*--------------------------------------------------------------------------------------------------
-------------------------- TABLES -----------------------------------------------------------------
--------------------------------------------------------------------------------------------------*/



-- Drop database if it exists
DROP DATABASE IF EXISTS coplanner;

-- Create database
CREATE DATABASE coplanner;

-- Use the database
USE coplanner;

-- Rest of your SQL script goes here...

-- Table for the possible categories a destination may be placed in
CREATE TABLE types_of_destination(
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(100)
);

-- Table for the possible categories of utilities a destination may have
CREATE TABLE types_of_utility(
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(100)
);

-- Table for the different themes that itineraries can be classified
CREATE TABLE themes(
    theme_id INT AUTO_INCREMENT PRIMARY KEY,
    theme_name VARCHAR(100)
);

-- Table for the different activities that are possible
CREATE TABLE activities(
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    activity_name VARCHAR(100)
);

-- Allows user information tracking
CREATE TABLE users (
    user_id VARCHAR(100) PRIMARY KEY,
    user_name VARCHAR(150),
    date_registered DATETIME DEFAULT CURRENT_TIMESTAMP,
    account_status ENUM ("active","suspended","deleted") DEFAULT "active"
);

-- Tracks the password hash for users logging in with passwords
CREATE TABLE email_users (
    user_id VARCHAR(100) PRIMARY KEY,
    email VARCHAR(100) UNIQUE,
    email_verified TINYINT(1) DEFAULT 0,
    password_hash VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tracks the Google id for users logging in with Google
CREATE TABLE google_users (
    user_id VARCHAR(100) PRIMARY KEY,
    google_id VARCHAR(255) UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tracks the Apple id for users logging in with Apple sign-in
CREATE TABLE apple_users (
    user_id VARCHAR(100) PRIMARY KEY,
    apple_id VARCHAR(255) UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tracks user login attempts
CREATE TABLE login_history (
    attempt_id VARCHAR(150) PRIMARY KEY,
    user_id VARCHAR(100),
    login_timestamp TIMESTAMP,
    login_method VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


-- Keeps information about the destinations that can be added to itineraries
CREATE TABLE destinations(
    destination_id VARCHAR(100) PRIMARY KEY,
    destination_name VARCHAR(200),
    location VARCHAR(100),
    latitude FLOAT,
    longitude FLOAT,
    rating FLOAT CHECK(rating >= 1 AND rating <= 5) DEFAULT 1
);

-- Allows tracking of activities available at each destination
CREATE TABLE destination_activities (
    destination_id VARCHAR(100),
    activity_id INT,
    price DECIMAL(10, 2) CHECK (price >= 0),
    date_updated DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (destination_id, activity_id),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
    FOREIGN KEY (activity_id) REFERENCES activities(activity_id)
);

-- Helps to track categories for destinations
CREATE TABLE destination_type(
    destination_id VARCHAR(100),
    type_id INT,
    PRIMARY KEY (destination_id,type_id),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
    FOREIGN KEY (type_id) REFERENCES types_of_destination(type_id)
);

-- Table to track the utilities available at the destinations
CREATE TABLE destination_utilities(
    destination_id VARCHAR(100),
    type_id INT,
    rating FLOAT CHECK (rating >= 1 AND rating <= 5),
    PRIMARY KEY (destination_id,type_id),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
    FOREIGN KEY (type_id) REFERENCES types_of_utility(type_id)
);

-- Table to keep track of opening and ending periods
CREATE TABLE destination_operating_hours(
    destination_id VARCHAR(100),
    day_of_week ENUM ("monday","tuesday","wednesday","thursday","friday","saturday","sunday"),
    start_time TIME,
    end_time TIME check (end_time > start_time),
    PRIMARY KEY (destination_id,day_of_week),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);



CREATE TABLE destination_rating(
	destination_id VARCHAR(100),
	user_id INT,
	rating DOUBLE CHECK (rating >=1 and rating <=5),
    comments TEXT,
	PRIMARY KEY (destination_id,user_id),
	FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);


-- Tracks the different itineraries that are created by users
CREATE TABLE itinerary(
	itinerary_id VARCHAR(100) PRIMARY KEY,
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
	start_date DATETIME,
	end_date DATETIME CHECK (end_date >= start_date),
	num_of_participants INT DEFAULT 1 CHECK(num_of_participants >0),
    visibilty ENUM("private","public") DEFAULT "public"
);



-- Helps track the destination additions for each itinerary date
CREATE TABLE itinerary_day(
	day_id VARCHAR(100) PRIMARY KEY,
	itinerary_id VARCHAR(100),
	position INT CHECK (position >=0),
	FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id)
);

-- Helps track which activities are selected for each itinerary
	-- add check to see if the destination+itineray combination appears in itinerary_destination
CREATE TABLE itinerary_activity(
	day_id VARCHAR(100),
	activity_id INT,
	destination_id VARCHAR(100),
	position INT CHECK (position >=0),
	PRIMARY KEY (day_id,activity_id),
	FOREIGN KEY (day_id) REFERENCES itinerary_day(day_id),
	FOREIGN KEY (activity_id) REFERENCES activities(activity_id),
	FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);


-- Helps track which destinations have been added for each itinerary
CREATE TABLE itinerary_destination(
	day_id VARCHAR(100),
	destination_id VARCHAR(100),
	position INT CHECK (position >=0),
	PRIMARY KEY (day_id,destination_id),
	FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
	FOREIGN KEY (day_id) REFERENCES itinerary_day(day_id)
);



-- Tracks the categories for itineraries
CREATE TABLE itinerary_theme(
	itinerary_id VARCHAR(100),
	theme_id INT,
	PRIMARY KEY (itinerary_id,theme_id),
	FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id),
	FOREIGN KEY (theme_id) REFERENCES themes(theme_id)
);


-- Tracks the users who have access to the itinerary
CREATE TABLE itinerary_collaborators(
	itinerary_id VARCHAR(100),
	user_id VARCHAR(100),
	role ENUM ("owner", "viewer") DEFAULT "owner",
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(itinerary_id,user_id),
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);



-- Tracks itineraries that have been wishlisted by other users
CREATE TABLE wishlist(
	user_id VARCHAR(100),
	itinerary_id VARCHAR(100),
	PRIMARY KEY (user_id,itinerary_id),
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id)
);



-- Keeps track of all the media uploaded to the platform
CREATE TABLE media(
	media_id VARCHAR(100) PRIMARY KEY,
	media_location TEXT,
	media_type ENUM("video","image") DEFAULT "image",
	upload_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	is_foreign TINYINT(1) DEFAULT 0
);

-- Tracks which media files should be associated with which destination
CREATE TABLE destination_media(
	destination_id VARCHAR(100),
	media_id VARCHAR(100),
	PRIMARY KEY (destination_id,media_id),
	FOREIGN KEY (media_id) REFERENCES media(media_id),
	FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)

);



/*--------------------------------------------------------------------------------------------------
-------------------------- VIEWS -----------------------------------------------------------------
--------------------------------------------------------------------------------------------------*/


-- Returns all relevant user information for login and such
CREATE VIEW vw_users AS
SELECT
    u.*,
    a.apple_id,
    e.email,
    e.password_hash,
    g.google_id
FROM
    users AS u
INNER JOIN
    google_users AS g ON g.user_id = u.user_id
INNER JOIN
    apple_users AS a ON a.user_id = u.user_id
INNER JOIN
    email_users AS e ON e.user_id = u.user_id;






-- Returns the wishlist information with the itinerary data

