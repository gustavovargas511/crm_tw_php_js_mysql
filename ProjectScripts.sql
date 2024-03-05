/*******************
 * ARTICLE queries *
 *******************/ 
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content VARCHAR(1000) NOT NULL,
    published_at DATETIME
);

ALTER TABLE articles 
ADD COLUMN (
image_file varchar(400) )



ALTER TABLE articles
ADD COLUMN category_id INT,
ADD INDEX idx_category_id (category_id);
 
 SHOW CREATE TABLE articles;

/*CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image_file` varchar(400) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_category_id` (`category_id`),
  CONSTRAINT `fk_articles_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
*/

INSERT INTO articles (title, content, published_at) VALUES
('Article 1', 'Content of Article 1', '2024-02-05 10:30:00'),
('Article 2', 'Content of Article 2', '2024-02-05 11:45:00'),
('Article 3', 'Content of Article 3', '2024-02-05 13:15:00'),
('Article 4', 'Content of Article 4', '2024-02-05 14:20:00'),
('Article 5', 'Content of Article 5', '2024-02-05 15:40:00'),
('Article 6', 'Content of Article 6', '2024-02-05 16:55:00'),
('Article 7', 'Content of Article 7', '2024-02-05 18:10:00'),
('Article 8', 'Content of Article 8', '2024-02-05 19:25:00'),
('Article 9', 'Content of Article 9', '2024-02-05 20:45:00'),
('Article 10', 'Content of Article 10', '2024-02-05 22:00:00');

INSERT INTO articles (title, content, published_at) VALUES
('Article 1', 'Content of Article 1', NOW());


SELECT *
  FROM articles a
 ORDER BY published_at DESC;

SELECT COUNT(1)
  FROM articles a 
 ORDER BY published_at DESC;

/****************
 * USER queries *
 ****************/

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) UNIQUE NOT NULL
  
)

SELECT *
  FROM user u 
 #ORDER BY published_at DESC
;

#testing data

INSERT INTO user (username, password)
VALUES ('gus', 'secret');

update user SET password = '$2y$10$4rXGhi4ZziOFZYC3cMqDNuDBKh9UtE9JKSbr6brgSdcizeELAGQxy'
where username = 'gus';


/********************
 * Category queries *
 ********************/

CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) UNIQUE NOT NULL,
  INDEX idx_name (name)
);

INSERT INTO category (name) VALUES
('Sports'),
('Technology'),
('Fashion'),
('Food'),
('Travel'),
('Health and Fitness'),
('Art and Design'),
('Music'),
('Comedy'),
('Personal Development');



SELECT id,
name
  FROM category c
ORDER BY name
;

/****************************
 * ARTICLE-CATEGORY queries *
 ****************************/

CREATE TABLE article_category (
	article_id INT NOT NULL,
	category_id INT NOT NULL
)

ALTER TABLE article_category
ADD PRIMARY KEY (category_id, article_id);

#CASCADE added for, if a category/article is deleted all records in join table gets deleted too
ALTER TABLE article_category
ADD FOREIGN KEY (category_id) REFERENCES category(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE article_category
ADD FOREIGN KEY (article_id) REFERENCES articles(id) ON UPDATE CASCADE ON DELETE CASCADE;

INSERT INTO article_category (category_id, article_id)
VALUES
(3, 7)
;



select *
from article_category ac;

SELECT *
FROM articles a 
JOIN article_category ac 
ON a.id = ac.article_id 
JOIN category c 
ON ac.category_id  = c.id
;

SELECT *
FROM articles a 
LEFT JOIN article_category ac 
ON a.id = ac.article_id 
LEFT JOIN category c 
ON ac.category_id  = c.id
#WHERE a.id = 35
;


/***********
 * Queries *
 ***********/


SELECT a.title, a.content, c.name
  FROM articles a, category c
 WHERE a.category_id = c.id
 ORDER BY published_at DESC;

SELECT a.title, a.content, c.name
  FROM articles a
  LEFT JOIN category c
    ON a.category_id = c.id
 ORDER BY published_at DESC;

