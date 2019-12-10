create table user (
    username varchar(256),
    password_hash varchar(256),
    email varchar(256)
);

alter table user
add primary key (username)