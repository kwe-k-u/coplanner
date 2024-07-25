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
    account_status ENUM ("active",'by_pass',"suspended","deleted") DEFAULT "active",
	phone varchar(15)
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
    email VARCHAR(100),
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
    visit_date DATETIME,
	FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id)
);

-- Helps track which activities are selected for each itinerary
	-- add check to see if the destination+itineray combination appears in itinerary_destination
CREATE TABLE itinerary_activity(
	day_id VARCHAR(100),
	activity_id INT,
	destination_id VARCHAR(100),
	position INT CHECK (position >=0),
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


DROP TABLE IF EXISTS accommodation;
DROP TABLE IF EXISTS types_of_bed;

-- The bed option
CREATE TABLE types_of_bed(
	type_id INT PRIMARY KEY AUTO_INCREMENT,
	type_name VARCHAR(100) UNIQUE
);

-- Room information for destinations with accommodation options
CREATE TABLE accommodation(
	accommodation_id VARCHAR(100) PRIMARY KEY,
	destination_id VARCHAR(100),
    nickname VARCHAR(100),
	occupancy INT,
    currency_id INT,
	price DECIMAL(10,2),
	bed_type INT,
	date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
	date_updated DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (bed_type) REFERENCES types_of_bed(type_id),
    FOREIGN KEY (currency_id) REFERENCES currency(currency_id)
);


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




CREATE TABLE itinerary_invoice(
	invoice_id VARCHAR(100) PRIMARY KEY,
	itinerary_id VARCHAR(100),
	date_created DATETIME DEFAULT CURRENT_TIMESTAMP(),
	num_people INT,
	status ENUM ('cancelled',"active","closed") DEFAULT "active"
);

CREATE TABLE itinerary_invoice_destinations(
	invoice_id VARCHAR(100),
	destination_id VARCHAR(100),
	date_updated DATETIME,
	booking_acceptance ENUM("accepted","pending","rejected") DEFAULT "pending",
	primary key (invoice_id,destination_id),
	FOREIGN KEY (invoice_id) REFERENCES itinerary_invoice(invoice_id),
	FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE itinerary_invoice_activities(
	invoice_id VARCHAR(100),
	activity_id VARCHAR(100),
	destination_id VARCHAR(100),
	currency VARCHAR(15),
	price DOUBLE,
	visit_date DATETIME, --  The date that the person will be visiting
	primary key (invoice_id,activity_id,destination_id),
	FOREIGN KEY (invoice_id,destination_id) REFERENCES itinerary_invoice_destinations(invoice_id,destination_id)
);

CREATE TABLE invoice_payments(
	transaction_id VARCHAR(100) UNIQUE,
	invoice_id VARCHAR(100),
	PRIMARY KEY(transaction_id, invoice_id),
	FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id)
);


DROP TABLE IF EXISTS curator;
CREATE TABLE curator(
	curator_id VARCHAR(100) PRIMARY KEY,
	curator_name VARCHAR(100),
	date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
	logo_id VARCHAR(100),
	registration_doc_id VARCHAR(100),
	FOREIGN KEY (logo_id) REFERENCES media(media_id),
	FOREIGN KEY (registration_doc_id) REFERENCES media(media_id)
);


CREATE TABLE payout_accounts(
	account_id VARCHAR(100) PRIMARY KEY, -- paystack payout account id
	bank_id VARCHAR(10),
	bank_name VARCHAR(100),
	account_name VARCHAR(100) NOT NULL,
	account_number VARCHAR(100)  NOT NULL,
	date_created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	date_update DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS curator_manager;
CREATE TABLE curator_manager(
	curator_id VARCHAR(100),
	user_id VARCHAR(100),
	id_card_front VARCHAR(100),
	id_card_back VARCHAR(100),
	date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (curator_id, user_id),
	FOREIGN KEY (curator_id) REFERENCES curator(curator_id),
	FOREIGN KEY (id_card_back) REFERENCES media(media_id),
	FOREIGN KEY (id_card_front) REFERENCES media(media_id),
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);



CREATE TABLE curator_payout_account(
	curator_id VARCHAR(100),
	payout_account_id VARCHAR(100),
	PRIMARY KEY (curator_id, payout_account_id),
	FOREIGN KEY (curator_id) REFERENCES curator(curator_id),
	FOREIGN KEY (payout_account_id) REFERENCES payout_accounts(account_id)
);

CREATE TABLE shared_experiences(
	experience_id VARCHAR(100) PRIMARY KEY,
	experience_name VARCHAR(60),
	experience_description TEXT,
	curator_id VARCHAR(100),
	date_uploaded DATETIME DEFAULT CURRENT_TIMESTAMP,
	start_date DATETIME,
	number_of_seats INT,
	is_visible TINYINT (1) DEFAULT 0,
	media_id VARCHAR(100),
	FOREIGN KEY (curator_id) REFERENCES curator(curator_id),
	FOREIGN KEY (media_id) REFERENCES  media(media_id)
);

CREATE TABLE shared_experience_destinations(
	experience_id VARCHAR(100),
	destination_id VARCHAR(100),
	date_updated DATETIME,
	booking_acceptance ENUM("accepted","pending","rejected") DEFAULT "pending",
	primary key (experience_id,destination_id),
	FOREIGN KEY (experience_id) REFERENCES shared_experiences(experience_id),
	FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE shared_experience_activities(
	experience_id VARCHAR(100),
	activity_id VARCHAR(100),
	destination_id VARCHAR(100),
	currency VARCHAR(15),
	price DOUBLE,
	visit_date DATETIME, --  The date that the person will be visiting
	date_updated DATETIME DEFAULT CURRENT_TIMESTAMP,
	primary key (experience_id,activity_id,destination_id),
	FOREIGN KEY (experience_id,destination_id) REFERENCES shared_experience_destinations(experience_id,destination_id)
);

  CREATE TABLE shared_experience_bookings(
	experience_id VARCHAR(100),
	user_id VARCHAR(100),
	experience_package VARCHAR(100),
	transaction_id VARCHAR(100),
	number_of_seats INT,
	PRIMARY KEY (experience_id, user_id),
	FOREIGN KEY (experience_id) REFERENCES shared_experiences(experience_id),
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	FOREIGN KEY (transaction_id ) REFERENCES transactions(transaction_id),
	FOREIGN KEY (experience_package) REFERENCES shared_experience_payment_package(plan_id)
);


-- Allows curator to create different booking packages
-- Couple packages, early bird
DROP TABLE IF EXISTS shared_experience_payment_package;
CREATE TABLE shared_experience_payment_package(
	plan_id VARCHAR(100),
	experience_id VARCHAR(100),
	package_name VARCHAR(50) DEFAULT "Standard", -- Installment plans can be called "installment plan"
	package_description VARCHAR(200),
	is_default TINYINT(1) DEFAULT 1, -- 1: standard package,
	seats INT DEFAULT 1 NOT NULL, -- Number of seats that this gets you
	currency_id INT DEFAULT 1 NOT NULL,
	min_amount DOUBLE, -- deposit amount
	max_amount DOUBLE, --
	expires_on DATE, -- Date the option isn't available (if its empty hide it when the trip ends)
	order_index INT DEFAULT 0, -- order to arrange them
	PRIMARY KEY (plan_id),
	FOREIGN KEY (experience_id) REFERENCES shared_experiences(experience_id),
	FOREIGN KEY (currency_id) REFERENCES currency(currency_id)
);


DROP TABLE IF EXISTS experience_wishlist;
CREATE TABLE experience_wishlist (
	experience_id VARCHAR(100),
	user_id VARCHAR(100),
	PRIMARY KEY (experience_id,user_id),
	FOREIGN KEY (experience_id) REFERENCES shared_experiences(experience_id),
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE curator_media(
	curator_id VARCHAR(100),
	media_id VARCHAR(100),
	PRIMARY KEY (curator_id,media_id),
	FOREIGN KEY (curator_id) REFERENCES curator(curator_id),
	FOREIGN KEY (media_id) REFERENcES media(media_id)
);


CREATE TABLE curator_collaborator_invite (
	invite_id VARCHAR(100) PRIMARY KEY,
	curator_id VARCHAR(100),
	email VARCHAR(100) UNIQUE,
	date_invite DATETIME DEFAULT CURRENT_TIMESTAMP(),
	FOREIGN KEY (curator_id) REFERENCES curator(curator_id)
 );


CREATE TABLE travel_plan_collections(
	collection_id VARCHAR(100),
	collection_name VARCHAR(30),
	PRIMARY KEY (collection_id)
);

CREATE TABLE travel_plan (
	itinerary_id VARCHAR(100),
	collection_id VARCHAR(100),
	price DOUBLE,
	currency_id INT,
	PRIMARY KEY (itinerary_id,collection_id),
	FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id),
	FOREIGN KEY (collection_id) REFERENCES travel_plan_collections(collection_id),
	FOREIGN KEY (currency_id) REFERENCES currency(currency_id)
);


CREATE TABLE travel_plan_media(
	itinerary_id VARCHAR(100),
	media_id VARCHAR(100),
	PRIMARY KEY (itinerary_id, media_id),
	FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id),
	FOREIGN KEY (media_id) REFERENCES media(media_id)
);



CREATE TABLE experience_tags(
	tag_id INT PRIMARY KEY AUTO_INCREMENT,
	tag_name VARCHAR(50)
);



CREATE TABLE shared_experience_tags(
	experience_id VARCHAR(100),
	tag_id INT,
	PRIMARY KEY(experience_id,tag_id),
	FOREIGN KEY (experience_id) REFERENCES shared_experiences(experience_id)
);


CREATE TABLE shared_experience_media (
	experience_id VARCHAR(100),
	media_id VARCHAR(100),
	is_visible TINYINT(1) DEFAULT 1,
	PRIMARY KEY (experience_id,media_id),
	FOREIGN KEY (experience_id) REFERENCES shared_experiences(experience_id),
	FOREIGN KEY (media_id) REFERENCES media(media_id)
);



CREATE TABLE travel_plan(
	travel_plan_id VARCHAR(100) PRIMARY KEY,
	curator_id VARCHAR(100),
	experience_name VARCHAR(100),
	description TEXT,
	min_size INT,
	currency_id INT,
	price DOUBLE,
	flyer VARCHAR(100),
	what_to_expect TEXT,
	general_location VARCHAR(50),
	is_visible TINYINT(1) DEFAULT 0,
	FOREIGN KEY (currency_id) REFERENCES currency(currency_id),
	FOREIGN KEY (flyer) REFERENCES media(media_id),
	FOREIGN KEY (curator_id) REFERENCES  curator(curator_id)
);

CREATE TABLE collections(
	collection_id INT PRIMARY KEY,
	collection_name VARCHAR(30)
);

CREATE TABLE travel_plan_collections(
	travel_plan_id VARCHAR(100),
	collection_id INT,
	primary key (travel_plan_id,collection_id),
	FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_plan_id),
	FOREIGN KEY (collection_id) REFERENCES collections(collection_id)
);

CREATE TABLE travel_plan_media(
	media_id VARCHAR(100),
	travel_plan_id VARCHAR(100),
	PRIMARY KEY (media_id,travel_plan_id),
	FOREIGN KEY (media_id) REFERENCES media(media_id),
	FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_plan_id)
);

CREATE TABLE travel_plan_tag(
	travel_plan_id VARCHAR(100),
	tag_id INT,
	PRIMARY KEY (travel_plan_id,tag_id),
	FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_plan_id)
);


CREATE TABLE travel_plan_activities(
	travel_plan_id VARCHAR(100),
	activity_id INT,
	destination_id VARCHAR(100),
	day_index INT,
	activity_index INT,
	FOREIGN KEY (activity_id) REFERENCES activities(activity_id),
	FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_plan_id),
	FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE travel_plan_destination(
	travel_plan_id VARCHAR(100),
	destination_id VARCHAR(100),
	booking_status ENUM ("pending","rejected","accepted") DEFAULT "pending",
	PRIMARY KEY (travel_plan_id,destination_id),
	FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
	FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_plan_id)
);



CREATE TABLE travel_plan_requests(
	request_id VARCHAR(100) PRIMARY KEY,
	travel_plan_id VARCHAR(100),
	user_id VARCHAR(100),
	group_size INT,
	date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
	preferred_date DATETIME,
	curator_quote DOUBLE,
	currency_id INT,
	additional_notes TEXT,
	curator_quote_notes TEXT,
	airport_pickup_requested TINYINT(1) DEFAULT 0,
	accommodation_requested TINYINT(1) DEFAULT 0,
	status enum("pending","accepted","rejected","completed") DEFAULT "pending",
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_plan_id)
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
    COALESCE(g.email, e.email) as email,
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




DROP VIEW IF EXISTS vw_itinerary;
CREATE VIEW vw_itinerary AS
SELECT
	i.*,
    ic.user_id as owner_id,
    u.user_name as owner_name,
    (select count(*) from itinerary_day where itinerary_day.itinerary_id = i.itinerary_id) as num_days,
    (select count(*) from vw_itinerary_destinations as vid where vid.itinerary_id = i.itinerary_id) as num_destinations,
    -- (select sum(final_price) from vw_itinerary_activities as via inner join itinerary_day as iid on iid.day_id = via.day_id where iid.itinerary_id = i.itinerary_id) as final_price,
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




DROP VIEW IF EXISTS vw_itinerary_invoice;

CREATE VIEW vw_itinerary_invoice as
	SELECT
		iv.invoice_id,
		u.user_id,
		u.user_name,
		u.email,
		i.itinerary_id,
		-- TODO add currency
		sum(iia.price)*1.071 as total_bill,
		sum(iia.price)*0.071 as platform_bill,
		sum(iia.price) as activity_bill,
		0 as accommodation_bill,
		0 as transportation_bill,
		COALESCE(SUM(t.amount),0) AS total_paid,
		COALESCE(SUM(CASE WHEN r.refunded_transaction_id = t.transaction_id THEN t.amount ELSE 0 END), 0) AS total_refund,
		(
			sum(iia.price) * 1.071
			- COALESCE(SUM(t.amount), 0)
			- COALESCE(SUM(CASE WHEN r.refunded_transaction_id = t.transaction_id THEN t.amount ELSE 0 END), 0)
		)as amount_left
		FROM vw_users AS u
		INNER JOIN vw_itinerary AS i on i.owner_id = u.user_id
		INNER JOIN itinerary_invoice as iv on iv.itinerary_id = i.itinerary_id
		LEFT JOIN itinerary_invoice_activities as iia on iia.invoice_id = iv.invoice_id
		-- Get all transactions associated with the invoice
		LEFT JOIN invoice_payments as ip on ip.invoice_id = iv.invoice_id
		LEFT JOIN transactions as t on t.transaction_id = ip.transaction_id
		LEFT JOIN refunds AS r ON r.refunded_transaction_id = t.transaction_id
		GROUP BY u.user_id, u.email, iv.invoice_id
		ORDER BY iv.invoice_id;

DROP VIEW IF EXISTS vw_invoice_activities;
CREATE VIEW vw_invoice_activities AS
 SELECT iia.*, a.activity_name,
 d.destination_name
 from itinerary_invoice_activities as iia
 inner join activities as a on a.activity_id = iia.activity_id
 inner join destinations as d on d.destination_id = iia.destination_id
  ORDER BY iia.visit_date, iia.destination_id;


DROP VIEW IF EXISTS vw_curators;
CREATE VIEW vw_curators as
	SELECT c.*,
	m.media_location as logo_location,
	pa.account_id as payout_account_id,
	pa.account_number as payout_account_number,
	pa.account_name as payout_account_name,
	pa.bank_name as payout_bank_name,
	pa.bank_id as payout_bank_id,
	(SELECT 0) as revenue,
	(SELECT 0) as active_listings,
	(SELECT 0) as booking_count
	 from curator as c
	left join curator_payout_account as cpa on cpa.curator_id = c.curator_id
	left join media as m on m.media_id = c.curator_id
	left join payout_accounts as pa on pa.account_id = cpa.payout_account_id;



DROP VIEW IF EXISTS vw_shared_experiences;
CREATE VIEW vw_shared_experiences AS
	SELECT
		se.experience_id,
        se.experience_name,
		se.experience_description,
        se.date_uploaded,
        se.media_id,
        se.is_visible,
		se.curator_id,
        se.number_of_seats,
		se.start_date,
		currency.currency_name,
        p.min_amount as booking_fee,
		p.plan_id,
		p.package_name,
		c.curator_name,
		(SELECT 0) as remaining_seats,
        (SELECT p.min_amount * 0.03) as platform_fee,
        (select platform_fee + p.min_amount) as total_fee,
		m.media_location
	 from
	shared_experiences as se
	inner join curator as c on c.curator_id = se.curator_id
    inner join shared_experience_payment_package as p on p.experience_id = se.experience_id
	inner join currency on currency.currency_id = p.currency_id
	left join media as m on m.media_id = se.media_id
    where p.is_default = 1;


DROP VIEW IF EXISTS vw_payout_accounts;
CREATE VIEW vw_payout_accounts as
	select
	cpa.curator_id,
	pa.*
	from payout_accounts as pa
	left join curator_payout_account as cpa on cpa.payout_account_id = pa.account_id;


DROP VIEW IF EXISTS  vw_shared_experience_bookings;
CREATE VIEW vw_shared_experience_bookings
AS
	SELECT
		seb.*,
		se.experience_name,
		se.curator_id,
		se.number_of_seats as seats_booked,
		se.start_date,
		u.user_name,
		(SELECT "GHS") AS currency_name,
		t.date_created as date_booked,
		t.total_transaction_amount * 0.93 as amount
	 FROM shared_experience_bookings as seb
	inner join shared_experiences as se on se.experience_id = seb.experience_id
	inner join vw_users as u on u.user_id = seb.user_id
	inner join transactions as t on t.transaction_id = seb.transaction_id
	;



DROP VIEW IF EXISTS vw_curator_managers;
CREATE VIEW vw_curator_managers AS
	SELECT
		c.curator_name,
		cm.*,
		u.user_name,
		u.email
	 FROM curator_manager as cm
	inner join vw_users as u on u.user_id = cm.user_id
	inner join vw_curators as c on c.curator_id = cm.curator_id;

DROP VIEW IF EXISTS vw_travel_plans;
CREATE VIEW vw_travel_plans AS SELECT
	t.*,
	c.currency_name,
	cc.curator_name,
	m.media_location,
	m.media_type
	from travel_plan as t
	inner join media as m on m.media_id = t.flyer
	inner join currency as c on c.currency_id = t.currency_id
	inner join curator as cc on cc.curator_id = t.curator_id;

DROP VIEW IF EXISTS vw_travel_plan_media;
CREATE VIEW vw_travel_plan_media AS SELECT
	t.*, m.media_location, m.media_type FROM travel_plan_media as t
	inner join media as m on m.media_id = t.media_id;

DROP VIEW IF EXISTS vw_travel_plan_activities;
CREATE VIEW vw_travel_plan_activities AS SELECT
	ta.*,
	a.activity_name,
	d.destination_name
	 FROM travel_plan_activities as ta
	inner join activities as a on a.activity_id = ta.activity_id
	inner join destinations as d on d.destination_id = ta.destination_id;

-- Drop the view if it exists and create a new view
DROP VIEW IF EXISTS vw_travel_plan_requests;
CREATE VIEW vw_travel_plan_requests AS
SELECT
    r.*,
    u.user_name,
	cn.currency_name,
    t.experience_name,
    c.curator_name,
	t.curator_id
FROM travel_plan_requests AS r
INNER JOIN travel_plan AS t ON t.travel_plan_id = r.travel_plan_id
INNER JOIN vw_users AS u ON u.user_id = r.user_id
LEFT JOIN currency as cn ON r.currency_id = cn.currency_id
INNER JOIN vw_curators AS c ON c.curator_id = t.curator_id;



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


INSERT INTO types_of_bed (type_name) VALUES
('Single Bed (Twin Bed)'),
('Double Bed'),
('Queen Bed'),
('King Bed');


INSERT experience_tags(tag_name) VALUES
("Adventure"),
("Arts"),
("Softlife & Wellness"),
("History & Culture"),
("Waterfalls"),
("Hikes"),
("Nature & Wildlife");


