DROP TABLE IF EXISTS posts;

CREATE TABLE posts (
  id INT NOT NULL AUTO_INCREMENT,
  message VARCHAR(140), 
  likes INT,
  area VARCHAR(20),
  PRIMARY KEY (id)
);

load data local infile 'data.csv' into table posts
  fields terminated by ', '
  lines terminated by '\n'
  (message, likes, area)
  ;

select * from posts;