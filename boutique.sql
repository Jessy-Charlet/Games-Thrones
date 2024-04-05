CREATE TABLE `category`(
    `category_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `parent_category_id` INT NOT NULL
);
CREATE TABLE `order`(
    `order_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT NOT NULL,
    `order_date` DATETIME NOT NULL,
    `order_status` VARCHAR(255) NOT NULL,
    `total_price` DECIMAL(10, 2) NOT NULL,
    `shipping_address_id` INT NOT NULL,
    `billing_address_id` INT NOT NULL
);
CREATE TABLE `brand`(
    `brand_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);
CREATE TABLE `adress`(
    `adress_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `зostal_code_id` INT NOT NULL,
    `city` VARCHAR(26) NOT NULL,
    `postal_code` MEDIUMINT NOT NULL,
    `adress` TEXT NOT NULL,
    `customer_id` INT NOT NULL
);
CREATE TABLE `customer`(
    `customer_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `customer_last-name` VARCHAR(255) NOT NULL,
    `customer_first-name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `billing_address_id` INT NOT NULL
);
CREATE TABLE `product_image`(
    `product_image_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT NOT NULL,
    `image_url` VARCHAR(255) NOT NULL,
    `is_main_image` VARCHAR(255) NOT NULL
);

CREATE TABLE `product_review`(
    `product_review_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `rating` DECIMAL(2, 1) NOT NULL,
    `review_text` TEXT NOT NULL,
    `review_date` DATETIME NOT NULL
);
CREATE TABLE `product`(
    `product_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `category_id` INT NOT NULL,
    `brand_id` INT NOT NULL,
    `description` TEXT NOT NULL,
    `material` VARCHAR(255) NOT NULL,
    `coleur` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `stock` INT NOT NULL,
    `average_rating` DECIMAL(2, 1) NOT NULL,
    `number_of_ratings` INT NOT NULL,
    `vendor_code` VARCHAR(10) NOT NULL
);
CREATE TABLE `order_item`(
    `order_item_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL DEFAULT '1',
    `price` DECIMAL(10, 2) NOT NULL,
    `vendor_code` VARCHAR(10) NOT NULL
);
ALTER TABLE
    `product review` ADD CONSTRAINT `product review_product_review_id_foreign` FOREIGN KEY(`product_review_id`) REFERENCES `product`(`product_id`);
ALTER TABLE
    `order_item` ADD CONSTRAINT `order_item_order_id_foreign` FOREIGN KEY(`order_id`) REFERENCES `order`(`order_id`);
ALTER TABLE
    `product` ADD CONSTRAINT `product_product_id_foreign` FOREIGN KEY(`product_id`) REFERENCES `category`(`category_id`);
ALTER TABLE
    `product` ADD CONSTRAINT `product_product_id_foreign` FOREIGN KEY(`product_id`) REFERENCES `brand`(`brand_id`);
ALTER TABLE
    `customer` ADD CONSTRAINT `customer_shipping_address_id_foreign` FOREIGN KEY(`shipping_address_id`) REFERENCES `adress`(`adress_id`);
ALTER TABLE
    `order` ADD CONSTRAINT `order_billing_address_id_foreign` FOREIGN KEY(`billing_address_id`) REFERENCES `adress`(`adress_id`);
ALTER TABLE
    `order` ADD CONSTRAINT `order_shipping_address_id_foreign` FOREIGN KEY(`shipping_address_id`) REFERENCES `adress`(`adress_id`);
ALTER TABLE
    `adress` ADD CONSTRAINT `adress_postal_code_id_foreign` FOREIGN KEY(`postal_code_id`) REFERENCES `postal code`(`postal_code_id`);
ALTER TABLE
    `product image` ADD CONSTRAINT `product image_product_image_id_foreign` FOREIGN KEY(`product_image_id`) REFERENCES `product`(`product_id`);
ALTER TABLE
    `order` ADD CONSTRAINT `order_customer_id_foreign` FOREIGN KEY(`customer_id`) REFERENCES `customer`(`customer_id`);
ALTER TABLE
    `customer` ADD CONSTRAINT `customer_billing_address_id_foreign` FOREIGN KEY(`billing_address_id`) REFERENCES `adress`(`adress_id`);
ALTER TABLE
    `product review` ADD CONSTRAINT `product review_product_review_id_foreign` FOREIGN KEY(`product_review_id`) REFERENCES `customer`(`customer_id`);
    