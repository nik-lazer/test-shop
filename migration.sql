create table rubric (
	id int primary key auto_increment,
	parent_id int,
	name varchar(512)
);

create table goods (
	code char(5) not null primary key,
	name varchar(512)
);

create table goods2rubric (
	id int,
	code char(5)
);

create table facets (
	id int primary key auto_increment,
	rubric_id int not null,
	name varchar(512),
	unit varchar(100)
);

create table facets2goods(
	id int primary key auto_increment,
	code char(5) not null,
	facet_id int not null,
	val varchar(100)
);

insert into rubric(id, parent_id, name) values (1, null, 'Канцелярские товары');
insert into rubric(id, parent_id, name) values (2, null, 'Оргтехника');
insert into rubric(id, parent_id, name) values (3, null, 'Офисная мебель');
insert into rubric(id, parent_id, name) values (4, 1, 'Бумага');
insert into rubric(id, parent_id, name) values (5, 1, 'Линейки');
insert into rubric(id, parent_id, name) values (6, 1, 'Шариковые ручки');
insert into rubric(id, parent_id, name) values (7, 2, 'Принтеры');
insert into rubric(id, parent_id, name) values (8, 2, 'Сканеры');
insert into rubric(id, parent_id, name) values (9, 2, 'Факсы');

insert into rubric(id, parent_id, name) values (10, 3, 'Компьютерные столы');
insert into rubric(id, parent_id, name) values (11, 3, 'Офисные кресла');

insert into goods(code, name) values ('00001', 'Снежинка');
insert into goods(code, name) values ('00002', 'Perfect Print');
insert into goods(code, name) values ('00003', 'ГОЗНАК');

insert into goods2rubric(id, code) values (4,'00001');
insert into goods2rubric(id, code) values (4,'00002');
insert into goods2rubric(id, code) values (4,'00003');

create or replace view shop_view
(id, rname, name, unit, code, gname)
as 
select f.id, r.name as rname, f.name, f.unit, g.code, g.name as gname
from facets f
inner join facets2goods f2g on  f2g.facet_id=f.id
inner join goods g on g.code=f2g.code
inner join rubric r on r.id=f.rubric_id;