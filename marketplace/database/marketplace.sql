CREATE DATABASE marketplace;
USE marketplace;

DESCRIBE users;
DESCRIBE stores;
DESCRIBE products;
DESCRIBE categories;

SELECT * FROM users;
SELECT * FROM stores;
SELECT * FROM products;
SELECT * FROM categories;
SELECT * FROM category_product;
SELECT * FROM product_photos;
SELECT * FROM user_orders;
SELECT * FROM order_store;
SELECT * FROM notifications;

DELETE FROM `marketplace`.`users` WHERE (`id` = '47');

SELECT count('store_id') as products_count FROM products
LEFT JOIN stores on stores.id = products.store_id
group by store_id
order by products_count desc;