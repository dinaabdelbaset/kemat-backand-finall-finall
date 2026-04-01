-- ======================================================
-- Run this in phpMyAdmin on database: kemat_api
-- ======================================================

-- Step 1: Drop old tables
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS deals;
DROP TABLE IF EXISTS bazaars;
DROP TABLE IF EXISTS travel_packages;
DROP TABLE IF EXISTS destinations;
SET FOREIGN_KEY_CHECKS = 1;

-- Step 2: Create destinations table
CREATE TABLE destinations (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  src VARCHAR(255) NOT NULL,
  alt VARCHAR(255) NULL,
  tours INT DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

-- Step 3: Insert destinations
INSERT INTO destinations (title, src, alt, tours, created_at, updated_at) VALUES
('Cairo',       'http://localhost:8000/images/home_assets/cairo.jpg',     'Cairo',       1200, NOW(), NOW()),
('Alexandria',  'http://localhost:8000/images/home_assets/alex.jpg',      'Alexandria',  610,  NOW(), NOW()),
('Luxor',       'http://localhost:8000/images/home_assets/luxor.jpg',     'Luxor',       850,  NOW(), NOW()),
('Sharm El.S',  'http://localhost:8000/images/home_assets/sharm.jpg',     'Sharm',       1540, NOW(), NOW()),
('Hurghada',    'http://localhost:8000/images/home_assets/hurghada.jpg',  'Hurghada',    1390, NOW(), NOW()),
('Aswan',       'http://localhost:8000/images/home_assets/aswan.jpg',     'Aswan',       720,  NOW(), NOW()),
('Marsa Alam',  'http://localhost:8000/images/home_assets/marsa_alam.jpg','Marsa Alam',  540,  NOW(), NOW()),
('Dahab',       'http://localhost:8000/images/home_assets/dahab.jpg',     'Dahab',       980,  NOW(), NOW()),
('Marsa Matruh','http://localhost:8000/images/home_assets/matruh.jpg',    'Matruh',      460,  NOW(), NOW()),
('New Capital', 'http://localhost:8000/images/home_assets/new_cap.jpg',   'New Capital', 320,  NOW(), NOW());

-- Step 4: Create travel_packages table
CREATE TABLE travel_packages (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL,
  alt VARCHAR(255) NULL,
  tag VARCHAR(255) NULL,
  date VARCHAR(255) NULL,
  author VARCHAR(255) NULL,
  price INT DEFAULT 0,
  duration VARCHAR(255) NULL,
  activities JSON NULL,
  highlights JSON NULL,
  hotel JSON NULL,
  museum JSON NULL,
  excluded JSON NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

-- Step 5: Insert travel packages
INSERT INTO travel_packages (title, image, alt, tag, date, author, price, duration, activities, highlights, hotel, museum, excluded, created_at, updated_at) VALUES
('Siwa Oasis Safari & Camping', 'http://localhost:8000/images/home_assets/marsa_alam.jpg', 'Siwa Oasis', 'Adventure', 'November 15 2024', 'Omar Tariq', 350, '4 days',
 '["4x4 dune bashing","Sandboarding","Shali Fortress tour","Cleopatras Pool swim"]',
 '["Camp under the Milky Way","Organic Siwan meals included","Local Bedouin guide"]',
 '["Taghaghien Island Resort - 2 Nights","Desert Camp - 1 Night"]',
 '["Siwa House Museum"]',
 '["Personal Expenses","Tips & Gratuities"]',
 NOW(), NOW()),
('Luxor & Aswan Nile Cruise Magic', 'http://localhost:8000/images/home_assets/nile_cruise.jpg', 'Nile Cruise', 'Historic', 'October 10 2024', 'Sara Ahmed', 599, '5 days',
 '["Karnak Temple visit","Valley of the Kings tomb tour","Philae Temple light show"]',
 '["5-Star Nile Cruise Ship","Expert Egyptologist on board","All meals included"]',
 '["MS Esplanade Luxury Cruise - 4 Nights"]',
 '["Luxor Museum","Nubian Museum"]',
 '["International Flights","Beverages onboard"]',
 NOW(), NOW()),
('Sinai Trail & St. Catherine Hike', 'http://localhost:8000/images/home_assets/sinai_trail.jpg', 'Sinai Trail', 'Hiking', 'December 05 2024', 'Karim Hassan', 180, '3 days',
 '["Mount Sinai Sunrise Hike","St. Catherine Monastery tour","Bedouin tea gathering"]',
 '["Climb the biblical Mount Sinai","Visit the Burning Bush","Stay at an eco-lodge"]',
 '["Morgenland Village Hotel - 2 Nights"]',
 '["Monastery Library & Icons section"]',
 '["Lunches & Dinners","Camel Ride to Summit"]',
 NOW(), NOW());

-- Step 6: Create bazaars table
CREATE TABLE bazaars (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  location VARCHAR(255) NULL,
  image VARCHAR(255) NOT NULL,
  description TEXT NULL,
  specialty JSON NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

-- Step 7: Insert bazaars
INSERT INTO bazaars (title, location, image, description, specialty, created_at, updated_at) VALUES
('Khan el-Khalili', 'Cairo, Egypt', 'http://localhost:8000/images/home_assets/cairo.jpg', 'A famous historic bazaar in Cairo. Master artisans craft beautiful jewelry and lanterns.', '["Spices","Handicrafts","Jewelry"]', NOW(), NOW()),
('Aswan Spice Market', 'Aswan, Egypt', 'http://localhost:8000/images/home_assets/aswan.jpg', 'A sensory explosion of colors and aromas. Best place to buy authentic Nubian spices.', '["Spices","Herbs","Perfumes"]', NOW(), NOW()),
('Luxor Tourist Souq', 'Luxor, Egypt', 'http://localhost:8000/images/home_assets/luxor.jpg', 'Wander through lanes dedicated to alabaster statues, papyrus art near Luxor Temple.', '["Alabaster","Papyrus","Cotton"]', NOW(), NOW()),
('Sharm Old Market', 'Sharm El-Sheikh', 'http://localhost:8000/images/home_assets/sharm.jpg', 'Famous for beautiful Sahaba Mosque, traditional herbs, essential oils, and local cafes.', '["Oils","Herbs","Souvenirs"]', NOW(), NOW()),
('Shali Market', 'Siwa Oasis', 'http://localhost:8000/images/home_assets/marsa_alam.jpg', 'Shop for unique Siwan crafts, silver jewelry, and the world best organic dates.', '["Dates","Olive Oil","Silver"]', NOW(), NOW()),
('Mansheya Market', 'Alexandria, Egypt', 'http://localhost:8000/images/home_assets/alex.jpg', 'A bustling coastal square with Egyptian charm. Discover local textiles, gold, and antiques.', '["Textiles","Gold","Antiques"]', NOW(), NOW());

-- Step 8: Create deals table
CREATE TABLE deals (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(255) NULL,
  icon VARCHAR(255) NULL,
  title VARCHAR(255) NOT NULL,
  locations VARCHAR(255) NULL,
  image VARCHAR(255) NOT NULL,
  price VARCHAR(255) NULL,
  rating FLOAT NULL,
  color VARCHAR(255) NULL,
  link VARCHAR(255) NULL,
  items JSON NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

-- Step 9: Insert deals
INSERT INTO deals (category, icon, title, locations, image, price, rating, color, link, items, created_at, updated_at) VALUES
('Restaurant', '🍽️', 'Hadramaut Mandi', 'Nasr City, Cairo', 'http://localhost:8000/images/home_assets/mandi.jpg', 'From $15', 4.8, '#E74C3C', '/restaurants', '["Mandi Lamb","Madhbi Chicken","Haneeth Rice","Yemeni Bread"]', NOW(), NOW()),
('Hotel', '🏨', 'Kempinski Nile Hotel', 'Garden City, Cairo', 'http://localhost:8000/images/home_assets/hotel_nile.jpg', 'From $180/night', 4.9, '#3498DB', '/hotels', '["Deluxe Nile View Room","Executive Suite","Royal Suite","Presidential Suite"]', NOW(), NOW()),
('Museum', '🏛️', 'Grand Egyptian Museum', 'Giza Plateau, Cairo', 'http://localhost:8000/images/home_assets/museum.jpg', 'From $20', 4.9, '#D4AF37', '/museums', '["Tutankhamun Gallery","Royal Mummies Hall","Grand Staircase","Childrens Museum"]', NOW(), NOW()),
('Event', '🎪', 'Sound & Light Show', 'Giza Pyramids, Cairo', 'http://localhost:8000/images/home_assets/sound_light.jpg', 'From $25', 4.6, '#9B59B6', '/events', '["Sound & Light Show","VIP Front Row Seating","Night Photography","Hotel Transfer"]', NOW(), NOW()),
('Safari', '🏜️', 'Siwa Oasis Safari', 'Siwa Oasis, Western Desert', 'http://localhost:8000/images/home_assets/marsa_alam.jpg', 'From $85', 4.8, '#E67E22', '/safari', '["4x4 Dune Bashing","Camping Under Stars","Sandboarding","Salt Lakes"]', NOW(), NOW()),
('Diving', '🤿', 'Red Sea Diving', 'Sharm El Sheikh, Red Sea', 'http://localhost:8000/images/home_assets/diving.jpg', 'From $55', 4.9, '#1ABC9C', '/activities', '["Ras Mohamed Reef Diving","Tiran Island Snorkeling","SS Thistlegorm Wreck","Night Diving"]', NOW(), NOW()),
('Nile Cruise', '⛵', 'MS Esplanade Cruise', 'Luxor to Aswan', 'http://localhost:8000/images/home_assets/esplanade.jpg', 'From $350', 4.9, '#05073C', '/tours', '["Karnak & Luxor Temples","Valley of the Kings","Edfu & Kom Ombo","Philae Temple"]', NOW(), NOW());

-- Done!
SELECT 'Destinations' as table_name, COUNT(*) as count FROM destinations
UNION ALL
SELECT 'Travel Packages', COUNT(*) FROM travel_packages
UNION ALL
SELECT 'Bazaars', COUNT(*) FROM bazaars
UNION ALL
SELECT 'Deals', COUNT(*) FROM deals;
