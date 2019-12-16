create table user (
    username varchar(256),
    user_id int(100),
    password_hash varchar(256),
    email varchar(256),
    user_level int(1)
);

alter table user
add primary key (user_id)