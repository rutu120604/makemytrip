drop table us;
create table us(id serial primary key , name varchar(100) not null,email varchar(255) unique  not null,password text not null);


INSERT INTO us(name,email,password)  values('NIKITA KANWAR','nikita@gmail.com','123');
