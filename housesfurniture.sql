/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : housesfurniture

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 05/08/2021 21:08:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for basket
-- ----------------------------
DROP TABLE IF EXISTS `basket`;
CREATE TABLE `basket`  (
  `basket_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `basket_user_id` int UNSIGNED NOT NULL,
  `basket_product_id` int UNSIGNED NOT NULL,
  `basket_quantity` int UNSIGNED NOT NULL DEFAULT 1,
  `basket_accepted` tinyint(1) UNSIGNED NOT NULL,
  `basket_time` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `basket_confirm` tinyint UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`basket_id`) USING BTREE,
  INDEX `fk_basket_user_id`(`basket_user_id`) USING BTREE,
  INDEX `fk_basket_product_id`(`basket_product_id`) USING BTREE,
  CONSTRAINT `fk_basket_product_id` FOREIGN KEY (`basket_product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_basket_user_id` FOREIGN KEY (`basket_user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of basket
-- ----------------------------
INSERT INTO `basket` VALUES (2, 19, 62, 1, 1, '2021-08-05 20:46:37', 0);
INSERT INTO `basket` VALUES (3, 19, 65, 1, 0, NULL, 0);
INSERT INTO `basket` VALUES (4, 19, 68, 1, 0, NULL, 0);
INSERT INTO `basket` VALUES (5, 20, 67, 1, 1, '2021-08-05 21:00:51', 0);
INSERT INTO `basket` VALUES (7, 20, 69, 1, 1, '2021-08-05 21:00:52', 0);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Houses');
INSERT INTO `category` VALUES (2, 'Furniture');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `comment_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_product_id` int UNSIGNED NOT NULL,
  `comment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_time` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`comment_id`) USING BTREE,
  INDEX `fk_comment_product_id`(`comment_product_id`) USING BTREE,
  CONSTRAINT `fk_comment_product_id` FOREIGN KEY (`comment_product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for image_product
-- ----------------------------
DROP TABLE IF EXISTS `image_product`;
CREATE TABLE `image_product`  (
  `image_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_product_id` int UNSIGNED NOT NULL,
  `name_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`image_id`) USING BTREE,
  INDEX `fk_image_procuct`(`image_product_id`) USING BTREE,
  CONSTRAINT `fk_image_procuct` FOREIGN KEY (`image_product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of image_product
-- ----------------------------
INSERT INTO `image_product` VALUES (1, 62, '1628188877.8059.jpg', NULL);
INSERT INTO `image_product` VALUES (2, 62, '1628188877.8196.jpg', NULL);
INSERT INTO `image_product` VALUES (3, 62, '1628188877.8219.jpg', NULL);
INSERT INTO `image_product` VALUES (4, 62, '1628188877.8243.jpg', NULL);
INSERT INTO `image_product` VALUES (5, 63, '1628189001.2424.jpg', NULL);
INSERT INTO `image_product` VALUES (6, 63, '1628189001.2454.jpg', NULL);
INSERT INTO `image_product` VALUES (7, 63, '1628189001.2477.jpg', NULL);
INSERT INTO `image_product` VALUES (8, 64, '1628189057.4976.jpg', NULL);
INSERT INTO `image_product` VALUES (9, 64, '1628189057.5055.jpg', NULL);
INSERT INTO `image_product` VALUES (10, 64, '1628189057.5273.jpg', NULL);
INSERT INTO `image_product` VALUES (11, 65, '1628189180.9055.jpg', NULL);
INSERT INTO `image_product` VALUES (12, 65, '1628189180.9078.jpg', NULL);
INSERT INTO `image_product` VALUES (13, 66, '1628189649.1987.jpg', NULL);
INSERT INTO `image_product` VALUES (14, 66, '1628189649.2249.jpg', NULL);
INSERT INTO `image_product` VALUES (15, 67, '1628189698.8481.jpg', NULL);
INSERT INTO `image_product` VALUES (16, 67, '1628189698.8801.jpg', NULL);
INSERT INTO `image_product` VALUES (17, 68, '1628189748.0464.jpg', NULL);
INSERT INTO `image_product` VALUES (18, 68, '1628189748.0495.jpg', NULL);
INSERT INTO `image_product` VALUES (19, 68, '1628189748.076.jpg', NULL);
INSERT INTO `image_product` VALUES (20, 68, '1628189748.0782.jpg', NULL);
INSERT INTO `image_product` VALUES (21, 68, '1628189748.0805.jpg', NULL);
INSERT INTO `image_product` VALUES (22, 68, '1628189748.0824.jpg', NULL);
INSERT INTO `image_product` VALUES (23, 68, '1628189748.0844.jpg', NULL);
INSERT INTO `image_product` VALUES (24, 69, '1628189783.6818.jpg', NULL);
INSERT INTO `image_product` VALUES (25, 69, '1628189783.6839.jpg', NULL);
INSERT INTO `image_product` VALUES (26, 69, '1628189783.6866.jpg', NULL);
INSERT INTO `image_product` VALUES (27, 69, '1628189783.6889.jpg', NULL);
INSERT INTO `image_product` VALUES (28, 69, '1628189783.6914.jpg', NULL);
INSERT INTO `image_product` VALUES (29, 70, '1628189825.2556.jpg', NULL);
INSERT INTO `image_product` VALUES (30, 70, '1628189825.2578.jpg', NULL);
INSERT INTO `image_product` VALUES (31, 70, '1628189825.2598.jpg', NULL);
INSERT INTO `image_product` VALUES (32, 70, '1628189825.2636.jpg', NULL);
INSERT INTO `image_product` VALUES (33, 70, '1628189825.2871.jpg', NULL);
INSERT INTO `image_product` VALUES (34, 70, '1628189825.2924.jpg', NULL);
INSERT INTO `image_product` VALUES (35, 70, '1628189825.2953.jpg', NULL);
INSERT INTO `image_product` VALUES (36, 70, '1628189825.2977.jpg', NULL);
INSERT INTO `image_product` VALUES (37, 71, '1628189883.3194.jpg', NULL);
INSERT INTO `image_product` VALUES (38, 71, '1628189883.3215.jpg', NULL);
INSERT INTO `image_product` VALUES (39, 71, '1628189883.3246.jpg', NULL);
INSERT INTO `image_product` VALUES (40, 71, '1628189883.3275.jpg', NULL);
INSERT INTO `image_product` VALUES (41, 71, '1628189883.3295.jpg', NULL);
INSERT INTO `image_product` VALUES (42, 71, '1628189883.3312.jpg', NULL);
INSERT INTO `image_product` VALUES (43, 71, '1628189883.3339.jpg', NULL);
INSERT INTO `image_product` VALUES (44, 72, '1628189928.5141.jpg', NULL);
INSERT INTO `image_product` VALUES (45, 72, '1628189928.5161.jpg', NULL);
INSERT INTO `image_product` VALUES (46, 72, '1628189928.5182.jpg', NULL);
INSERT INTO `image_product` VALUES (47, 72, '1628189928.5207.jpg', NULL);
INSERT INTO `image_product` VALUES (48, 72, '1628189928.5495.jpg', NULL);
INSERT INTO `image_product` VALUES (49, 72, '1628189928.5515.jpg', NULL);

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_text` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_category_id` int UNSIGNED NOT NULL,
  `product_price` decimal(10, 0) UNSIGNED NOT NULL,
  `product_delete` int UNSIGNED NOT NULL,
  `product_change` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`product_id`) USING BTREE,
  INDEX `fk_product_category_id`(`product_category_id`) USING BTREE,
  CONSTRAINT `fk_product_category_id` FOREIGN KEY (`product_category_id`) REFERENCES `category` (`category_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (62, 'Divano Roma Sofa', 'About this item.\r\nSeating Capacity 5 seat, (3+1+1 Sofa Set).\r\nThe product requires basic self assembly at customers end and comes with self assembly instructions along with necessary accessories.\r\nPrimary Material- Solid Sheesham Wood,.\r\nColor Walnut Dark Brown Cushion Cream, Style Modern.\r\n3 Seater Size- Length (72.5 inch), Width (29.5 inch), Height (22 inch). One Seater Size- Length (31 inch), Width (29.5 inch), Height (22 inch).', 2, 350, 0, NULL);
INSERT INTO `product` VALUES (63, 'Coavas Computer Desk', 'About this item.\r\nCoavas Computer Desk - SIMPLEST INSTALLATION - 8 seconds to complete !.\r\nCoavas Computer Desk-- FOLDING AND PORTABLE :When not in use can be folded in the corner, save space; Also convenient to carry when going out for a picnic..\r\nCoavas Computer Desk-- APPLICABLE ROOM AND FUNCTION :Suitable for study, bedroom, living room, kitchen, children\'s room, office.Can be a computer desk, learning tables, game tables, picnic tables,secretarial desk..\r\nCoavas Computer Desk-- MATERIAL:MDF -Waterproof and No deformation, durable and solid, brown texture Desktop design is simple yet stylish..\r\nCoavas Computer Desk-- SIZE:100*50*72CM (L*W*H : 39.4 * 19.7 * 28.3 Inches).', 2, 200, 0, NULL);
INSERT INTO `product` VALUES (64, 'Multi-function Console Table', 'Multi-function Console Table: The clean-lined table is a perfect accent works as a console table, sofa table, entry/hallway table, even as a TV stand. 3 tier open shelves provide extra space for storing books, plants, decorations, etc. Simple industrial design makes this console sofa table perfect for any space, make your home/office in tidy condition..\r\nFashion Style Sofa Table: Modern minimalism and rustic character meet in this clean-lined console table, right at home in the farmhouse and industrial-inspired arrangements. Just decorated with framed family photos, plants, and artistic accents to bring a pop of personality to any room..\r\nMaterial & Structure Features: This sofa table crafted from durable premium MDF board and quality steel frame, the top shelf can hold 225 lbs and the lower shelves can hold 150 lbs, offers a long service life and very sturdy..\r\nEasy to Assembly: simple design makes assembly very easy, all hardware and detailed instruction are provided. The sofa table ', 2, 300, 0, NULL);
INSERT INTO `product` VALUES (65, 'Table - Sheesham Wood', 'Dimensions:- Table: Length 30 Inch x Width 45 Inch x Height 30 Inch, Chair: Length 18 IN x Width 18 IN x Height 35 IN\r\nProduct Material: Sheesham Wood, Seating Capacity: 4 Seat Colour\r\nThe dining table comes with a spacious square table and 4 chairs set. Stylish Small kitchen table set built from high quality Sheesham wood which is amazingly attractive and simple as well.\r\nPremium handcrafted construction by the skilled artisans from ratangarh Churu (Rajasthan)\r\nThis splendid style of wooden dining table set create a beautiful impression with perception of modernization. This piece is made of natural wood crafted by traditional expertise hand. These skills are combination of traditional with contemporary craftsmanship and procedure. As pieces are made and assembled by hand, it may contain bit variation from piece to piece or as shown in images but its beauty and functionality will remain same.', 2, 280, 0, NULL);
INSERT INTO `product` VALUES (66, 'Table with 4 Chairs  and Bench', 'Kendalwood - Manufacturing Since 1990 - Made In India Sheesham Wood Product\r\nProduct Dimensions:Table : H 30 x W 34 x D 34; Chair : H 34.4 x W 17.5 x D 17.5 ; Seating Height - 17 ; Bench : H 18 x W 23 x D 16.5 (all dimensions in inch )   Chair Weight - 8 Kg | Table Weight - 18 kg . Chair Weight Load Capacity - 120Kg | Table Weight Load Capacity - 300kg | Product Finish Color - Honey Finish \r\nMaterial : This Dining Dining Table Fully Made By Solid Wood , Table Top - Solid Wood | Chair - Solid Wood | This Dining set Available in 3 More Different Color - Walnut , Honey Teak and Mahogany , Visit our all listing and choose your Matching Color .\r\nMulti Purpose Dining Table Set - Your can Enjoy your Dinner with Family on this kendalwood Solid wood dining Set , this is a 4 Seater Dining set , Dining table with 3 chair and 1 Bench , Solid wood dining set | Also can use as Study Table | Working Table | Work From Home Table Kendalwood Dining table Set is Best Gift for Housewarming And Wedding.\r\nA', 2, 230, 0, NULL);
INSERT INTO `product` VALUES (67, 'Floor Lamp', 'This NAUTICAL HOME DECOR adjustable tripod floor lamp is a perfect blend of rustic, traditional, and artistic flair which can easily fit with a wide range of interiors from modern, mid-century, contemporary architecture to vintage, urban and retro style. Our standing sleek, elegant floor lamp can instantly upgrade the look and feel of any room design with modern and traditional fusion style.\r\nEasy installation\r\nMade with high-quality material\r\nHandmade in India', 2, 80, 0, NULL);
INSERT INTO `product` VALUES (68, 'Luxury Wooden House ', ' The delicate design offers intricacies imagined impossible in large-scale construction. This Luxury wooden house proves those theories wrong. Both inside and out, this modern home’s meticulous woodwork is simply spectacular, becoming a focal motive of the overall design. “There isn’t a whole lot of drywall in this place. Nature’s my artwork,” owner Julie Burnett told The Seattle Times. Windows appear at every turn, flooding the home with natural light. “During the day I don’t have to turn on the lights, even in winter,” said Burnett. From the grid-patterned exposed ceiling beams to the sleek and polished floors, throughout bedrooms, baths, the sprawling kitchen and all living spaces, wood in the king of this castle.', 1, 500000, 0, NULL);
INSERT INTO `product` VALUES (69, 'El Mirador House', 'The residence named El Mirador House is located on the 95-hectare El Eterno estate in Valle de Bravo with 459 square meters, on one corner of Lake Avándaro, approximately 150 kilometres southwest of Mexico City. CC Arquitectos designed the house so that its living areas are sunken down below the level of a road at the back of a plot. This means only the wooden shelter is visible from higher ground. El Mirador House was designed with maximum respect for the forest where it is located, anchored to its topography and reducing the constructive impact.\r\n\r\nThe architectural structure of the house opens to nature and offers a stunning panoramic view of the calm nature around it. In this way the interior and exterior subtly merged and become a unified whole. The structure is a combination of elements in steel and wood and retaining walls are made of local stone. The interior walls are made of white oak that gives a touch of warmth to the spaces.\r\nThe house has a large family room that connects', 1, 530000, 0, NULL);
INSERT INTO `product` VALUES (70, 'house with spiral stairs', 'This modern weekend 3,260square foot house in Asia, Peru designed by Jorge Marsino Prado was inspired by Le Corbusier’s Maison Domino. The building principles for the little semi separated part of 15×8 meters amidst a simulated desert spring, just permitted the development of single story private residence with floor to ceiling windows that reveal the home’s most interesting architectural element: a bright white spiral stairs leading to an amazing rooftop terrace with  plenty space for socializing and dining. A rooftop lounge provides the perfect refuge from the warm Peruvian sun in this modern villa and offers views of the beauty of Peru’s desert landscape between the Isle of Asia and the coastal foothills of the Andes.\r\n\r\nThis house is built for seasonal vacations for family and guests, needed outdoor entertainment areas for the summer and a high level of privacy in the winter. Looks simple and have very natural environment, suitable for everyone who like a cool environment and green', 1, 550000, 0, NULL);
INSERT INTO `product` VALUES (71, 'Open Spaces House', 'Cadence is a magnificent waterfront home in British Columbia, Canada. It is consists interconnecting pavilions which create a natural flow through its more than 4,000 square feet of space. The home uses distinctive radius roofing in a design reminiscent of relaxing ocean waves. This is outstanding on the breezeway that connects the home to its multi-car garage and over of its main entrance on the second floor.\r\nIn every room, large windows are providing natural light and ocean views. A sliding glass door of the dining room opens to a long patio with an outdoor kitchen and concrete fire pit.\r\nA curved walkway flows from the outdoor patio to a pool on the home’s lower level. In interior, a floating staircase connects the two floors, echoing modern design touches throughout the space.\r\nThe interior of the Cadence home makes the most harmonic configuration of Vancouver Island’s unusual environment.', 1, 550000, 0, NULL);
INSERT INTO `product` VALUES (72, 'British Columbia Waterfront Home', 'Latest project by award-winning Canadian architect Keith Baker (KB Design) is placed on the outskirts of Victoria, British Columbia. The plan of the waterfront home around it would be great. The entire body structure is distributed in outdoor living house plan.\r\n\r\nThe building is planning to be made with using of stone, steel, wood and glass. Ocean and forests have inspired this natural home by using natural materials at home visible through large windows and many outdoor entertainment areas of housing,\r\n\r\nOutside everything will be modern, but simple. The covers come with a terrace overlooking the sea front making a private piece of paradise.\r\n\r\nLarge windows provide the interior with sunlight, adding extra heat to the cherry wood everywhere. Exposed wooden posts and beams add a touch of elegant country house which is presented by a piece of furniture in every room\r\n\r\nHere, however, unusual to be both outside and inside of the Waterfront House Plans. This luxury British Columbia Water', 1, 560000, 0, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` enum('administrator','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_time` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `user_active` int UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `email_unique`(`user_email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (19, 'Milos', 'Djordjevic', 'milos@skola.com', '$2y$10$eYCFqAnY2WILsiPEH2hDruB79W28iLGcDLJLb7NRmrCkqSOehKXs.', 'administrator', '2021-08-05 19:58:47', 0);
INSERT INTO `user` VALUES (20, 'William', 'Cornelius', 'william@school.com', '$2y$10$qd3Rjhj661OS/IUKV2Vhv.U9aIEcvMA7n1agowLPskaF0IIASAutm', 'user', '2021-08-05 21:01:47', 0);

-- ----------------------------
-- View structure for basket_view
-- ----------------------------
DROP VIEW IF EXISTS `basket_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `basket_view` AS SELECT `housesfurniture`.`basket`.`basket_product_id` AS basket_product_id,
`housesfurniture`.`basket`.`basket_user_id` AS basket_user_id,
`housesfurniture`.`basket`.`basket_quantity` AS basket_quantity,
`housesfurniture`.`basket`.`basket_accepted` AS basket_accepted,
`housesfurniture`.`basket`.`basket_time` AS basket_time,
`housesfurniture`.`basket`.`basket_confirm` AS basket_confirm,
`housesfurniture`.`product`.`product_name` AS product_name,
`housesfurniture`.`product`.`product_text` AS product_text,
`housesfurniture`.`product`.`product_category_id` AS product_category_id,
`housesfurniture`.`product`.`product_price` AS product_price,
`housesfurniture`.`product`.`product_delete` AS product_delete,
`housesfurniture`.`product`.`product_change` AS product_change,
`housesfurniture`.`user`.`user_name` AS user_name,
`housesfurniture`.`user`.`user_lastname` AS user_lastname,
`housesfurniture`.`user`.`user_email` AS user_email
FROM
(`housesfurniture`.`basket` JOIN `housesfurniture`.`product` ON
(`housesfurniture`.`basket`.`basket_product_id` = `housesfurniture`.`product`.`product_id`) JOIN `housesfurniture`.`user` ON(`housesfurniture`.`basket`.`basket_user_id` = `housesfurniture`.`user`.`user_id`)) ;

SET FOREIGN_KEY_CHECKS = 1;
