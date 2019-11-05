   tft USE f34ee;

CREATE TABLE customers (
  id int unsigned auto_increment primary key,
  first_name  varchar(255) not null,
  last_name  varchar(255) not null,
  email  varchar(255) not null,
  password  varchar(255) not null,
  dateofbirth  date
);

CREATE TABLE products  (
   id  int unsigned primary key,
   name  varchar(255) not null,
   category  varchar(255) not null,
   sub_category  varchar(255) not null,
   price  float not null,
   detail  LONGTEXT not null,
   stock  int not null,
   color  varchar(255) not null,
   theme  varchar(255) not null,
   image1  varchar(255) not null,
   image2  varchar(255) not null,
   discount float not null
);

CREATE TABLE  t_order  (
   id  int unsigned auto_increment primary key,
   customer_id  int not null,
   date_order_placed  datetime not null,
   total_price  float not null
);

CREATE TABLE  order_items  (
   id  int unsigned auto_increment primary key,
   product_id  int not null,
   order_id  int not null,
   order_item_quantity  int not null,
   order_item_price  float not null
);


CREATE TABLE shopping_cart(
  id  int unsigned not null auto_increment primary key,
  customer_id  int not null,
  product_id int not null,
  item_quantity  int not null
);


CREATE TABLE banner(
  id int unsigned auto_increment primary key,
  img1 varchar(255) not null,
  img2 varchar(255) not null,
  img3 varchar(255) not null,
  category varchar(255) not null
);

CREATE TABLE wishlist(
  id int unsigned auto_increment primary key,
  customer_id  int not null,
  product_id int not null
);




-- INSERT INTO banner (img1,img2,img3,category) VALUES(

-- )

INSERT INTO products (id,name,category,sub_category,price,detail,stock,color,theme,image1,image2,discount)
VALUES(
  1,
  "Bruno the Unicorn Punk Band Dangle Charm",
  "Charms",
  "Dangle Charms",
  60.00,
  "Get the band back together by enlisting Bruno the Unicorn, the lead guitarist from The Pandoras and a true rock star.",
  50,
  "Multi",
  "Hobbies & Passions",
  "img/798320ENMX_RGB.jpeg",
  "img/798320ENMX_ABC123_MODEL_ECOM_RGB.jpeg",
  1
),
(
2,
"Disney Luminous Ariel Dangle Charm",
"Charms",
"Dangle Charms",
75.00,
"Ariel will become part of your world with this Disney The Little Mermaid charm. Striking a delicate pose, Ariel sits atop a freshwater cultured pearl. ",
50,
"Multi",
"Fairytale",
"img/798232CZ_RGB.jpeg",
"img/798232CZ_ABC123_MODEL_ECOM_RGB.jpeg",
0.85
),
(
3,
"Pink Heart Labyrinth Dangle Charm",
"Charms",
"Dangle Charms",
60.00,
"Follow your heart always with this sweet token of love. Mixing openwork hearts, our signature metals and pretty pink enamel, the labyrinthian design features the words 'Follow your' and a cut-out heart.",
50,
"Multi",
"Love & Romance",
"img/787801NBP_RGB.jpeg",
"img/787801NBP_ABC123_MODEL_ECOM_RGB.jpeg",
0.6
),
(
  4,
  "Pandora Reflexions™ Letter G Clip Charm",
  "Charms",
  "Clips",
  35.00,
  "Detailed with contrasting sides, this decorative letter G charm is hand-finished from sterling silver.",
  50,
  "Silver",
  "Alphabet & Numbers",
  "img/798203_RGB.jpeg",
  "img/798203_ABC123_MODEL_ECOM_RGB.jpeg",
  1
),
(
  5,
  "Lucky Four-Leaf Clover Clip Charm",
  "Charms",
  "Clips",
  50.00,
  "Wear a lasting reminder of a family that grows and blossoms with this clip charm, compatible with PANDORA Reflexions™ flat weave bracelets. The sterling silver design features a family tree motif as a precious symbol of family heritage and beloved members.",
  50,
  "Clear",
  "Flowers & Nature",
  "img/768000CZ_RGB.jpeg",
  "img/768000CZ_V2_RGB.jpeg",
  0.5
),
(
6,
"Polished Flower Clip Charm",
"Charms",
"Clips",
45.00,
"Add floral sophistication to your Pandora Reflexions bracelet with this radiant Pandora Rose clip charm. The blushing pink metal design is reversible: one side is detailed with indentations, the other is left smooth.",
50,
"Golden",
"Flowers & Nature",
"img/787897_RGB.jpeg",
"img/787897_ABC123_MODEL_ECOM_RGB.jpeg",
1
),
(
  7,
  "Disney, Mickey Floating Locket, Clear CZ",
  "Necklaces",
  "Locket Necklaces",
  180.00,
  "This Mickey-mouse shaped floating locket design has been specially designed to let you celebrate you favorite Disney moments. Its sterling silver frame and clear sapphire glass walls beautifully display and protect your tiny treasures.",
  50,
  "Silver",
  "Love & Romance",
  "img/397177_RGB.jpeg",
  "img/397177_ABC123_MODEL_eCOM_02_RGB.jpeg",
  0.75
),
(
8,
"Pandora Lockets Heart Key Necklace",
"Necklaces",
"Locket Necklaces",
140.00,
"Express your personal love story with this striking key-shaped locket pendant. Crafted from sterling silver with a luxurious sapphire crystal window, the timeless design lends meaningful dimension to your personal collection of petite charms.",
50,
"Silver",
"Love & Romance",
"img/396581CZ_RGB.jpeg",
"img/396581CZ_ABC123_MODEL_eCOM_01_RGB.jpeg",
1
),
(
9,
"Pandora ESSENCE Snake Chain Necklace",
"Necklaces",
"Locket Necklaces",
200.00,
"This stylish and slender ESSENCE Collection necklace is hand-finished from beautiful PANDORA Rose™. The collier length elegantly displays your charms and highlights your collarbone.",
50,
"Gold",
"Flower & Nature",
"img/387277_RGB.jpeg",
"img/387277_ABC123_MODEL_eCOM_01_RGB.jpeg",
0.78
),
(
10,
"Chiming Filigree Hearts Pendant Necklace",
"Necklaces",
"Chain Necklaces",
60.00,
"Emitting a soft and soothing chime, this intricate PANDORA Rose™ filigree necklace promotes calm and relaxation – a welcome feeling for any woman.",
50,
"Gold",
"Flower & Nature",
"img/387299_RGB.jpeg",
"img/387299_ABC123_MODEL_eCOM_01_RGB.jpeg",
1
),
(
11,
"Vintage Circle Collier Necklace",
"Necklaces",
"Chain Necklaces",
125.00,
"Enhance any neckline in a spectacular fashion with this striking geometric design in PANDORA Rose™. The necklace's shape and dazzling cubic zirconia stone embellishments will nestle elegantly against your collarbones",
50,
"Gold",
"Flower & Nature",
"img/380523CZ_RGB.jpeg",
"img/380523CZ_ABC123_MODEL_eCOM_01_RGB.jpeg",
0.9
),
(
12,
"Crown & Interwined Hearts Pendant Necklace",
"Necklaces",
"Chain Necklaces",
90.00,
"Complete your outfit with a crown. This sterling silver necklace creates a modern fairy tale feel with united hearts and their crowning glory. Wear it in three different lengths to suit your look.",
50,
"Silver",
"Love & Romance",
"img/397719_RGB.jpeg",
"img/397719_ABC123_MODEL_eCOM_01_RGB.jpeg",
1
),
(
  13,
  "Sparkling Wishbone Ring",
  "Rings",
  "Promise",
  55.00,
  "Make all your wishes come true with this delicate Pandora Rose™ ring, lined with sparkling cubic zirconia stones. Simple yet elegant, this wishbone-shaped ring can be worn on its own as a shimmering statement, or paired with other Pandora stackable rings to create a unique, highly individual look.",
  50,
  "Clear",
  "Flowers & Nature",
  "img/186316CZ_RGB.jpeg",
  "img/186316CZ_ABC123_MODEL_eCOM_01_RGB.jpeg",
  0.8
),
(
14,
"Round Sparkle Halo Ring",
"Rings",
"Promise",
90.00,
"Exude timeless glamor with this opulent cocktail ring. Finely crafted in sterling silver, this vintage-inspired piece features a large brilliant-cut cubic zirconia stone surrounded by tiny shimmering stones. This sparkling Pandora ring will add sophistication to every outfit, from simple, everyday ensembles to glamorous evening wear.",
50,
"Clear",
"",
"img/196250CZ_RGB.jpeg",
"img/196250CZ_MODEL_eCom_01_RGB.jpeg",
1
),
(
  15,
  "Square Sparkle Halo Ring",
  "Rings",
  "Promise",
  120.00,
  "This stunning vintage-inspired ring is one you'll treasure forever. Crafted in Pandora Rose™ ",
  50,
  "Clear",
  "",
  "img/180947CZ_RGB.jpeg",
  "img/180947CZ_V2_RGB.jpeg",
  0.95

),
(
  16,
  "Princess Wishbone Ring",
  "Rings",
  "stackable",
  170.00,
  "Our popular wishbone ring gets a royal makeover with the princess wishbone ring in Pandora Rose™ featuring a tiara design. ",
  50,
  "Clear",
  "",
  "img/187736CZ_RGB.jpeg",
  "img/187736CZ_ABC123_MODEL_ECOM_RGB.jpeg",
  1
),
(
  17,
  "Tiara Wishbone Ring",
  "Rings",
  "stackable",
  130.00,
  "Turn heads wherever you go with this Tiara Wishbone ring hand-finished in smooth and polished sterling silver. The stackable wishbone ring features five claw-set clear cubic zirconia that form a delicate tiara crown on top of the ring. It's perfect worn by itself or can be used to create more drama when stacked with wishbone rings in mixed metals, like sterling silver and Pandora Shine™ (18k gold-plated sterling silver)",
  50,
  "Clear",
  "",
  "img/198282CZ_RGB.jpeg",
  "img/198282CZ_ABC123_MODEL_ECOM_RGB.jpeg",
  0.75
);


INSERT INTO banner(img1,img2,img3,category) VALUES(
	"img/slides/slide1.jpg",
	"img/slides/slide2.jpg",
	"img/slides/slide3.jpg",
	"home"
),
(
	"img/slides/slide_charm1.jpg",
	"img/slides/slide_charm2.jpg",
	"img/slides/slide_charm3.jpg",
	"Charms"
),
(
	"img/slides/slide_ring1.jpg",
	"img/slides/slide_ring2.jpg",
	"img/slides/slide_ring3.jpg",
	"Rings"
),
(
	"img/slides/slide_necklace1.jpg",
	"img/slides/slide_necklace2.jpg",
	"img/slides/slide_necklace3.jpg",
	"Necklaces"
),
(

	"img/slides/slide_sale1.jpg",
	"img/slides/slide_sale2.jpg",
	"img/slides/slide_sale3.jpg",
	"Sales"
),
(
	"img/slides/slide_charm2.jpg",
	"img/slides/slide_sale2.jpg",
	"img/slides/slide_sale3.jpg",
	"subcat"

);



