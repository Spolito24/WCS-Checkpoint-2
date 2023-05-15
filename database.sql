USE checkpoint2;

CREATE TABLE `accessory` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
  );
  
CREATE TABLE `cupcake` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `color1` char(7) NOT NULL,
  `color2` char(7) NOT NULL,
  `color3` char(7) NOT NULL,
  `created_at` DATE NOT NULL,
  `accessory_id` INT NOT NULL,
	CONSTRAINT fk_accessory
	FOREIGN KEY (accessory_id)
	REFERENCES accessory(id)
);