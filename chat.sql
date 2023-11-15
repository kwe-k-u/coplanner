CREATE TABLE destination_type (
    destination_type_id INT PRIMARY KEY,
    destination_type_name VARCHAR(100)
);

CREATE TABLE activities (
    activity_id INT PRIMARY KEY,
    activity_name VARCHAR(150),
    activity_description TEXT,
    activity_type VARCHAR(50)
);

CREATE TABLE users (
    user_id VARCHAR(100) PRIMARY KEY,
    user_name VARCHAR(150),
    email VARCHAR(255),
    password_hash VARCHAR(255),
    date_registered DATE,
    last_login TIMESTAMP
);

CREATE TABLE destinations (
    destination_id INT PRIMARY KEY,
    destination_name VARCHAR(200),
    destination_type_id INT,
    location VARCHAR(255),
	latitiude FLOAT,
	longitude FLOAT,
    rating FLOAT ,
    FOREIGN KEY (destination_type_id) REFERENCES destination_type(destination_type_id)
);

CREATE TABLE destination_activities (
    destination_activity_id INT PRIMARY KEY,
    destination_id INT,
    activity_id INT,
    schedule_date DATE,
    start_time TIME,
    end_time TIME,
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
    FOREIGN KEY (activity_id) REFERENCES activities(activity_id)
);

CREATE TABLE utilities (
    utility_id INT PRIMARY KEY,
    utility_name VARCHAR(150),
    utility_description TEXT
);

CREATE TABLE destination_utilities (
    destination_utility_id INT PRIMARY KEY,
    destination_id INT,
    utility_id INT,
    quantity_available INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
    FOREIGN KEY (utility_id) REFERENCES utilities(utility_id)
);

CREATE TABLE destination_operating_hours (
    operating_hours_id INT PRIMARY KEY,
    destination_id INT,
    day_of_week VARCHAR(15),
    open_time TIME,
    close_time TIME,
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE destination_ideal_hours (
    ideal_hours_id INT PRIMARY KEY,
    destination_id INT,
    suggested_duration INT,
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE destination_rating (
    rating_id INT PRIMARY KEY,
    destination_id INT,
    user_id VARCHAR(100),
    rating_value INT,
    review_text TEXT,
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE itinerary (
    itinerary_id INT PRIMARY KEY,
    user_id VARCHAR(100),
    start_date DATE,
    end_date DATE,
    total_cost DECIMAL(10, 2),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE itinerary_day (
    itinerary_day_id INT PRIMARY KEY,
    itinerary_id INT,
    day_number INT,
    date DATE,
    notes TEXT,
    FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id)
);

CREATE TABLE itinerary_activity (
    itinerary_activity_id INT PRIMARY KEY,
    itinerary_day_id INT,
    destination_activity_id INT,
    FOREIGN KEY (itinerary_day_id) REFERENCES itinerary_day(itinerary_day_id),
    FOREIGN KEY (destination_activity_id) REFERENCES destination_activities(destination_activity_id)
);

CREATE TABLE themes (
    theme_id INT PRIMARY KEY,
    theme_name VARCHAR(100)
);

CREATE TABLE itinerary_theme (
    itinerary_theme_id INT PRIMARY KEY,
    itinerary_id INT,
    theme_id INT,
    FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id),
    FOREIGN KEY (theme_id) REFERENCES themes(theme_id)
);

CREATE TABLE itinerary_collaborators (
    itinerary_id INT,
    user_id VARCHAR(100),
    PRIMARY KEY (itinerary_id, user_id),
    FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE itinerary_poll (
    poll_id INT PRIMARY KEY,
    itinerary_id INT,
    poll_question TEXT,
    FOREIGN KEY (itinerary_id) REFERENCES itinerary(itinerary_id)
);

CREATE TABLE itinerary_poll_activity (
    poll_activity_id INT PRIMARY KEY,
    poll_id INT,
    itinerary_activity_id INT,
    FOREIGN KEY (poll_id) REFERENCES itinerary_poll(poll_id),
    FOREIGN KEY (itinerary_activity_id) REFERENCES itinerary_activity(itinerary_activity_id)
);

CREATE TABLE service_type (
    service_type_id INT PRIMARY KEY,
    service_name VARCHAR(100)
);

CREATE TABLE provider_type (
    provider_type_id INT PRIMARY KEY,
    provider_type_name VARCHAR(100)
);

CREATE TABLE provider (
    provider_id INT PRIMARY KEY,
    provider_name VARCHAR(200),
    provider_type_id INT,
    FOREIGN KEY (provider_type_id) REFERENCES provider_type(provider_type_id)
);

CREATE TABLE provider_users (
    provider_id INT,
    user_id VARCHAR(100),
    PRIMARY KEY (provider_id, user_id),
    FOREIGN KEY (provider_id) REFERENCES provider(provider_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE wishlist (
    wishlist_id INT PRIMARY KEY,
    user_id VARCHAR(100),
    destination_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE transactions (
    transaction_id INT PRIMARY KEY,
    user_id VARCHAR(100),
    destination_id INT,
    transaction_date DATE,
    amount DECIMAL(10, 2),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE media (
    media_id INT PRIMARY KEY,
    media_type VARCHAR(50),
    media_url VARCHAR(255)
);

CREATE TABLE destination_media (
    destination_media_id INT PRIMARY KEY,
    destination_id INT,
    media_id INT,
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id),
    FOREIGN KEY (media_id) REFERENCES media(media_id)
);
