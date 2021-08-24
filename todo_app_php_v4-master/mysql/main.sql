DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
  id INT NOT NULL AUTO_INCREMENT,
  message VARCHAR(140), 
  PRIMARY KEY (id)
);

CREATE TABLE comments (
  id INT NOT NULL AUTO_INCREMENT,
  post_id INT,
  comment VARCHAR(140), 
  parent_id int,
  PRIMARY KEY (id),
  foreign key (post_id) references posts(id)
    on delete cascade
    on update cascade
);


INSERT INTO posts (message) VALUES 
  ('post-1'),
  ('post-2'),
  ('post-3')
  ;

INSERT INTO comments (post_id, comment, parent_id) VALUES 
  (1, 'post-1-1', NULL),
  (1, 'post-1-2', NULL),
  (3, 'post-1-1', NULL),
  (1, 'post-1-2-1', 2),
  (1, 'post-1-2-2', 2),
  (1, 'post-1-2-1-1', 4)
  ;



select * from posts;
select * from comments;


with recursive t as (
  select * from comments where parent_id = 2
  union all
  select 
    comments.*
  from 
    comments join t
  on
    comments.parent_id = t.id
)
select * from t;