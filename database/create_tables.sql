/*--------------------------------------------------------------------------------------------------
-------------------------- TABLES -----------------------------------------------------------------
--------------------------------------------------------------------------------------------------*/



-- Drop database if it exists
DROP DATABASE IF EXISTS coplanner;

-- Create database
CREATE DATABASE coplanner;

-- Use the database
USE coplanner;
-- Table to allow for multiple currencies to exist
CREATE TABLE currency(
	currency_id INT PRIMARY KEY AUTO_INCREMENT,
	currency_name VARCHAR(5) UNIQUE
);


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
    user_name VARCHAR(150) NOT NULL,
    date_registered DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    account_status ENUM ("active","suspended","deleted") DEFAULT "active"
);

CREATE TABLE admin_users(
    user_id VARCHAR(100) primary key,
    privilege ENUM ("super","view") DEFAULT "view" NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tracks the password hash for users logging in with passwords
CREATE TABLE email_users (
    user_id VARCHAR(100) PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    email_verified TINYINT(1) DEFAULT 0,
    password_hash VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tracks the Google id for users logging in with Google
CREATE TABLE google_users (
    user_id VARCHAR(100) PRIMARY KEY,
    google_id VARCHAR(255) UNIQUE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tracks the Apple id for users logging in with Apple sign-in
CREATE TABLE apple_users (
    user_id VARCHAR(100) PRIMARY KEY,
    apple_id VARCHAR(255) UNIQUE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tracks successful user login attempts
CREATE TABLE login_history (
    attempt_id VARCHAR(150) PRIMARY KEY,
    user_id VARCHAR(100) NOT NULL,
    login_timestamp TIMESTAMP NOT NULL,
    login_method VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


-- Keeps information about the destinations that can be added to itineraries
CREATE TABLE destinations(
    destination_id VARCHAR(100) PRIMARY KEY,
    destination_name VARCHAR(200) NOT NULL,
    location VARCHAR(100),
    latitude FLOAT,
    longitude FLOAT,
    rating FLOAT CHECK(rating >= 1 AND rating <= 5),
    num_ratings INT CHECK(num_ratings >= 0)
);

-- Allows tracking of activities available at each destination
CREATE TABLE destination_activities (
    destination_id VARCHAR(100),
    activity_id INT,
    currency_id INT,
    price DECIMAL(10, 2) CHECK (price >= 0),
    date_updated DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (destination_id, activity_id),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
    FOREIGN KEY (activity_id) REFERENCES activities(activity_id),
    FOREIGN KEY (currency_id) REFERENCES currency(currency_id)

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
    day_of_week ENUM ('monday','tuesday','wednesday','thursday','friday','saturday','sunday'),
    start_time TIME,
    end_time TIME,
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
    itinerary_name VARCHAR(60),
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
	start_date DATETIME,
	end_date DATETIME ,
	num_of_participants INT DEFAULT 1 CHECK(num_of_participants >0),
    visibility ENUM("private","public") DEFAULT "public"
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
    final_currency VARCHAR(5),
    final_price DECIMAL(10, 2),
	PRIMARY KEY (day_id,activity_id,destination_id),
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
	media_location TEXT NOT NULL,
	media_type ENUM("video","image") DEFAULT "image" NOT NULL,
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


-- Destinations that have been requested, or can't be found through search
CREATE TABLE destination_requests(
    request_id VARCHAR(100) PRIMARY KEY,
    destination_name VARCHAR(100),
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM ('pending', 'rejected','added') default 'pending'
);

-- Users who are subscribed to notifications when a destination is added
CREATE TABLE user_destination_request(
    request_id VARCHAR(100),
    user_id VARCHAR(100),
    PRIMARY KEY (request_id,user_id),
    FOREIGN KEY (request_id) REFERENCES destination_requests(request_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);



/*--------------------------------------------------------------------------------------------------
-------------------------- VIEWS -----------------------------------------------------------------
--------------------------------------------------------------------------------------------------*/


DROP VIEW IF EXISTS vw_users;
-- Returns all relevant user information for login and such
CREATE VIEW vw_users AS
SELECT
    u.*,
    a.apple_id,
    e.email,
    e.email_verified,
    e.password_hash,
    g.google_id,
    (select login_timestamp from login_history as lh where lh.user_id = u.user_id  order by login_timestamp desc limit 1) as last_login
FROM
    users AS u
LEFT JOIN
    google_users AS g ON g.user_id = u.user_id
LEFT JOIN
    apple_users AS a ON a.user_id = u.user_id
LEFT JOIN
    email_users AS e ON e.user_id = u.user_id;





-- Tracks all financial transactions on the platform
CREATE TABLE transactions (
    transaction_id VARCHAR(100),
	provider_transaction_id VARCHAR(150) UNIQUE,
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    sending_user VARCHAR(100),
    purpose VARCHAR(200),
    total_transaction_amount DOUBLE,
    amount DOUBLE,
    tax DOUBLE,
    charges DOUBLE,
    provider ENUM("paystack") DEFAULT "paystack",
    PRIMARY KEY (transaction_id),
    FOREIGN KEY (sending_user) REFERENCES users(user_id)
);

CREATE TABLE itinerary_payments(
    transaction_id VARCHAR(100) UNIQUE,
    itinerary_id VARCHAR(100),
    PRIMARY KEY (itinerary_id,transaction_id),
    FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id),
    FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id)
);
CREATE TABLE refunds(
    refund_id VARCHAR(100) PRIMARY KEY, -- Transaction that made the refund
    refunded_transaction_id VARCHAR(100) UNIQUE,
    FOREIGN KEY (refund_id) REFERENCES transactions(transaction_id),
    FOREIGN KEY (refunded_transaction_id) REFERENCES transactions(transaction_id)
);



-- CREATE TABLE destination_payment(
--     transaction_id VARCHAR(100) UNIQUE,
--     destination_account_id VARCHAR(100)
-- );




DROP VIEW IF EXISTS vw_itinerary_destinations;


CREATE VIEW vw_itinerary_destinations AS
SELECT
    day.itinerary_id,
    id.*,
    d.destination_name,
    d.location
from itinerary_destination as id
inner join destinations as d on d.destination_id = id.destination_id
INNER JOIN itinerary_day as day on day.day_id = id.day_id
ORDER BY id.position;



DROP VIEW IF EXISTS vw_itinerary;

CREATE VIEW vw_itinerary AS
SELECT
	i.*,
    ic.user_id as owner_id,
    u.user_name as owner_name,
    (select count(*) from itinerary_day where itinerary_day.itinerary_id = i.itinerary_id) as num_days,
    (select count(*) from vw_itinerary_destinations as vid where vid.itinerary_id = i.itinerary_id) as num_destinations,
    (select sum(final_price) from vw_itinerary_activities as via inner join itinerary_day as iid on iid.day_id = via.day_id where iid.itinerary_id = i.itinerary_id) as final_price,
    (select COALESCE(sum(price),0) from vw_itinerary_activities as via inner join itinerary_day as iid on iid.day_id = via.day_id where iid.itinerary_id = i.itinerary_id) as budget,
    (select iid.day_id from itinerary_day as iid where iid.itinerary_id = i.itinerary_id order by position limit 1) as first_day
from itinerary as i
inner join itinerary_collaborators as ic on ic.itinerary_id = i.itinerary_id
inner join users as u on u.user_id = ic.user_id;


DROP VIEW IF EXISTS vw_destination_request;
CREATE VIEW vw_destination_request AS
SELECT
    dr.*,
    (SELECT count(*) FROM user_destination_request where request_id = dr.request_id) AS num_users
FROM destination_requests as dr
where dr.status = 'pending';

DROP VIEW IF EXISTS vw_destination_request_subscribers;
CREATE VIEW vw_destination_request_subscribers AS
SELECT
    udr.*,
    u.email,
    dr.destination_name
FROM user_destination_request as udr
inner join vw_users as u on u.user_id = udr.user_id
inner join destination_requests as dr on dr.request_id = udr.request_id;



DROP VIEW IF EXISTS vw_itinerary_activities;
 /*View to display information about the activities included in each day of each itinerary*/
CREATE VIEW vw_itinerary_activities AS
SELECT
    day.itinerary_id,
    ia.*,
    a.activity_name,
    da.price,
    c.currency_name,
    da.date_updated

FROM itinerary_activity as ia
inner join activities as a on a.activity_id = ia.activity_id
inner join destination_activities as da on da.destination_id = ia.destination_id and da.activity_id = ia.activity_id
INNER JOIN itinerary_day as day on day.day_id = ia.day_id
INNER JOIN currency as c on c.currency_id = da.currency_id
ORDER BY ia.position;



DROP VIEW IF EIXSTS vw_itinerary_invoice;

CREATE VIEW vw_itinerary_invoice as
	SELECT
		u.user_id,
		u.email,
		i.itinerary_id,
		i.final_price AS itinerary_bill,
		COALESCE(SUM(t.amount), 0) AS total_paid,
		COALESCE(SUM(CASE WHEN r.refunded_transaction_id = t.transaction_id THEN t.amount ELSE 0 END), 0) AS total_refund,
		(COALESCE(i.final_price, 0) - COALESCE(SUM(t.amount), 0) - COALESCE(SUM(CASE WHEN r.refunded_transaction_id = t.transaction_id THEN t.amount ELSE 0 END), 0))
	AS amount_left FROM vw_users AS u
	INNER JOIN vw_itinerary AS i ON i.owner_id = u.user_id
	LEFT JOIN itinerary_payments AS ip ON ip.itinerary_id = i.itinerary_id LEFT JOIN transactions AS t ON ip.transaction_id = t.transaction_id
	LEFT JOIN refunds AS r ON r.refunded_transaction_id = t.transaction_id GROUP BY u.user_id, u.email, i.itinerary_id, i.final_price ORDER BY `i`.`itinerary_id` ASC;



INSERT INTO types_of_utility(type_name) VALUES
("road access"),
("swimming pool"),
("washroom"),
("wifi");

INSERT INTO types_of_destination(type_name) VALUES
("amusement park"),
("art gallery"),
("bowling alley"),
("beach"),
("botanical garden"),
("cafe"),
("casino"),
("campground"),
("library"),
("lodging"),
('hotel'),
("movie theater"),
("musem"),
("night club"),
("park"),
("stadium"),
("shopping mall"),
("restaurant"),
("waterfall"),
("tourist attraction"),
("zoo");


INSERT INTO currency(currency_id,currency_name) VALUES
(1,"GHS"),
(2,"USD");