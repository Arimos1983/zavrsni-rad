create table comments (
id int unique NOT NULL AUTO_INCREMENT,
Author varchar(100) NOT NULL,
Text TEXT NOT NULL,
Post_id int,
primary key (id),
foreign key (Post_id) references posts(id)
);