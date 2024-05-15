CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


INSERT INTO `admin` (`username`, `email`, `password`) VALUES
('admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500');

CREATE TABLE IF NOT EXISTS `users` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `email` VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    `address` VARCHAR(255),
	`phone_number` VARCHAR(20),
    `gender` ENUM('male', 'female', 'other'),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Create lawyers table
CREATE TABLE IF NOT EXISTS `lawyers` (
    `lawyer_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `email` VARCHAR(255),
    `password` VARCHAR(255) DEFAULT NULL,
    `contact_number` VARCHAR(20),
    `location` VARCHAR(100),
    `specialization` VARCHAR(255),
    `description` TEXT,
    `profile_picture` VARCHAR(255),
    `bar_association_number` VARCHAR(50),
    `experience_years` INT
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Create appointments table
CREATE TABLE IF NOT EXISTS `appointments` (
    `appointment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `lawyer_id` INT,
    `appointment_date` DATE,
    `additional_information` TEXT,
    `status` ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
    FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers`(`lawyer_id`) ON DELETE CASCADE
);


-- Create articles table
CREATE TABLE IF NOT EXISTS `articles` (
    `article_id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255),
    `description` TEXT,
    `image` VARCHAR(255),
    `status` ENUM('draft', 'published') DEFAULT 'published',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create news table
CREATE TABLE IF NOT EXISTS `news` (
    `news_id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255),
    `description` TEXT,
    `image` VARCHAR(255),
    `status` ENUM('draft', 'published') DEFAULT 'published',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
