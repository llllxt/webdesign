CREATE TABLE customers (
  id int unsigned not null auto_increment primary key,
  first_name  varchar(255) not null,
  last_name  varchar(255) not null,
  email  varchar(255) not null,
  password  varchar(255) not null,
  dateofbirth  date
);

CREATE TABLE  products  (
   id  int unsigned not null auto_increment primary key,
   name  varchar(255) not null,
   category  varchar(255) not null,
   sub_category  varchar(255) not null,
   price  float not null,
   detail  varchar(255) not null,
   material  varchar(255) not null,
   stock  int not null,
   color  varchar(255) not null,
   theme  varchar(255) not null,
   image1  varchar(255) not null,
   image2  varchar(255) not null,
   image3  varchar(255) not null
);

CREATE TABLE  order  (
   id  int unsigned not null auto_increment primary key,
   customer_id  int not null,
   date_order_placed  datetime not null,
   total_price  float not null,
   FOREIGN KEY order(customer_id) REFERENCES customers(id)
);

CREATE TABLE  order_items  (
   id  int unsigned not null auto_increment primary key,
   product_id  int not null,
   order_id  int not null,
   order_item_quantity  int not null,
   order_item_price  float not null,
   FOREIGN KEY order_items(product_id) REFERENCES products(id),
   FOREIGN KEY order_items(order_id) REFERENCES order(id)
);

CREATE TABLE discount{
  id  int unsigned not null auto_increment primary key,
  product_id int not null,
  discount float not null,
  FOREIGN KEY discount(product_id) REFERENCES products(id)

};
-- ///add this 
CREATE TABLE shopping_cart(
	id  int unsigned not null auto_increment primary key,
	customer_id  int not null,
	product_id int not null,
	item_quantity  int not null,
	FOREIGN KEY shopping_cart(product_id) REFERENCES products(id)
	FOREIGN KEY shopping_cart(customer_id) REFERENCES customers(id)
)
-- ///add this 
CREATE TABLE bank_simulation (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  type BIT(1) NOT NULL,
  number VARCHAR(19) NOT NULL,
  expiry DATE NOT NULL,
  CVV VARCHAR(4) NOT NULL,
  name VARCHAR(50) NOT NULL
);


INSERT INTO products (name,category,)