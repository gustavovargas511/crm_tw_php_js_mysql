CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content VARCHAR(1000) NOT NULL,
    published_at DATETIME
);

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

INSERT INTO user username, password
VALUES ('gus', 'secret');
