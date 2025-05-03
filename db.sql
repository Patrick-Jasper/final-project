SET FOREIGN_KEY_CHECKS = 0

-- Create 'users' table
CREATE TABLE users (
  username VARCHAR(50) PRIMARY KEY,
  email_address VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  birth_date DATE
);

-- Create 'catalog' table
CREATE TABLE catalog (
  catalog_id INT PRIMARY KEY,
  catalog_name VARCHAR(100) NOT NULL,
  description TEXT,
  availability VARCHAR(255) NOT NULL,
  sustainability_rating DECIMAL(3, 1) NOT NULL
);

-- Create 'user_to_catalog' junction table
CREATE TABLE user_to_catalog (
  PRIMARY KEY (username, catalog_id)
  FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
  FOREIGN KEY (catalog_id) REFERENCES catalog(catalog_id) ON DELETE CASCADE,
  PRIMARY KEY (username, catalog_id)
);

-- Insert users
INSERT INTO users VALUES
	('pjvillareal', 'patrickjaspervillareal', '123', 'Patrick', 'Villareal', '1997-06-28'),
	('mbrowning', 'm.browning', '456', 'Marcus', 'Browning', '1967-01-21'),
	('swhite', 's.white', '789', 'Sarah', 'White', '1988-12-03');

-- Insert catalog items
INSERT INTO catalog VALUES
	(1, 'Eco bag', 'Reusable bag made of recycled materials for reducing use of single-use plastics. 3 Rs into one!', 'Almost all convenience stores and supermarkets nationwide', 3.5),
	(2, 'Bamboo straws', 'Organic replaces plastic. It''s a straw made from bamboo, which is the fastest growing and most versatile plant (look it up in Wikipedia).', 'On select supermarkets and specialty stores', 3.7),
	(3, 'Kitchen Composter', 'Electric composter that turns food waste into rich soil for your garden.', 'Specialty appliance stores only', 2.8);

-- Link users to catalog
INSERT INTO user_to_catalog (username,catalog_id) VALUES
	('pjvillareal', 1),
	('pjvillareal', 2),
	('pjvillareal', 3),
	('m.browning', 3),
	('s.white', 1),
	('s.white', 2);