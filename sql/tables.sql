-- Users
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    deleted BOOLEAN DEFAULT FALSE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Logs
CREATE TABLE IF NOT EXISTS logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    action VARCHAR(255) NOT NULL,
    table_name VARCHAR(255) NOT NULL,
    record_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    deleted BOOLEAN DEFAULT FALSE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id)
);

-- Recipes
CREATE TABLE IF NOT EXISTS recipes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    description TEXT,
    image LONGTEXT,
    deleted BOOLEAN DEFAULT FALSE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- #####################################################################################################################
-- #####################################################################################################################
-- #####################################################################################################################

ALTER TABLE users ADD COLUMN administrator BOOLEAN DEFAULT FALSE AFTER password;

CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    deleted BOOLEAN DEFAULT FALSE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- #####################################################################################################################
-- #####################################################################################################################
-- #####################################################################################################################

CREATE TABLE IF NOT EXISTS recipe_category_assignments(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    deleted BOOLEAN DEFAULT FALSE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (recipe_id) REFERENCES recipes (id),
    FOREIGN KEY (category_id) REFERENCES categories (id)
);

-- #####################################################################################################################
-- # Laptop 13.11.2025 #################################################################################################
-- #####################################################################################################################
CREATE TABLE IF NOT EXISTS stones (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    number INT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    rarity VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    seen BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);