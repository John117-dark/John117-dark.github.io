create database computersdb;

use computersdb;

drop table if exists users;
create table users(
	id integer not null auto_increment,
	name varchar(30),
	email varchar(50),
	password varchar(100),
	img varchar(100),
	level TINYINT,
	telefono varchar(15),
	direccion varchar(255),
	primary key (id)
);
select * from users;

insert into users values (0,'JuanitoBanana','admin@gmail.com','123','default.jpg',1,'6361234567','Calle Imaginaria #123');
select * from users where email='admin@gmail.com' and password='123';
select img, name from users;

update users set name='prueba', email='prueba@gmail.com', telefono='098765432', direccion='calle tal#123' where id=7;

drop table if exists products;
create table products(
	product_id integer not null auto_increment,
	nombre varchar(100),
	descripcion varchar(255),
	precio decimal(10,2),
	stock int,
	marca varchar(50),
	modelo varchar(50),
	img varchar(100),
	categoria_id int,
	proveedor_id int,
	primary key (product_id),
	CONSTRAINT fk_proveedor foreign key (proveedor_id) references proveedores(proveedor_id),
	CONSTRAINT fk_cateogrie FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
);

select * from products;
select * from products where categoria_id = 1 order by product_id desc;
insert into products (nombre,descripcion,precio,stock,marca,modelo,img,categoria_id) 
	values ('Lapotp HP','Laptop marca HP',7999.99,10,'HP','14-dk-1000 Series','default.jpg',1);

drop table if exists ordenes;
create table ordenes(
	orden_id integer not null auto_increment,
	usuario_id int,
	product_id int,
	fecha date,
	estado varchar(15),
	total decimal(10,2),
	primary key (orden_id),
	CONSTRAINT fk_users FOREIGN KEY (usuario_id) REFERENCES users(id)  ON DELETE cascade
	CONSTRAINT fk_product FOREIGN KEY (product_id) REFERENCES products(product_id)  ON DELETE CASCADE

);

CREATE TRIGGER Restar_Stock
AFTER INSERT ON ordenes
FOR EACH ROW
BEGIN
    UPDATE products 
    SET stock = stock - NEW.stock
    WHERE product_id = NEW.product_id;
END 

create trigger Sumar_Stock
AFTER INSERT ON ordenes
FOR EACH ROW
BEGIN
 UPDATE products 
    SET stock = stock + NEW.stock
    WHERE product_id = NEW.product_id;
end

drop table if exists categorias;
create table categorias(
	categoria_id integer not null auto_increment,
	nombre varchar(30),
	primary key (categoria_id)
);
insert into categorias (nombre)
values ('All Uses');
insert into categorias (nombre)
values ('Desktop');
insert into categorias (nombre)
values ('Work');
insert into categorias (nombre)
values ('Gaming');
select * from categorias;

drop table if exists proveedor;
create table proveedores(
	proveedor_id integer not null auto_increment,
	nombre varchar(100),
	email varchar(50),
	telefono varchar(10),
	direccion varchar(100),
	primary key (proveedor_id)
);



insert into ordenes (usuario_id, fecha, estado, total)
values (9, '2024/12/08', 'Pendiente', 6999);
	
drop table if exists detalles_orden;
create table detalles_orden(
	detalle_id integer not null auto_increment,
	orden_id int,
	product_id int,
	cantidad double,
	primary key (detalle_id),
	CONSTRAINT fk_orden FOREIGN KEY (orden_id) REFERENCES ordenes(orden_id)  ON DELETE CASCADE,

);

drop table if exists opiniones;
create table opiniones(
	opinion_id integer not null auto_increment,
	product_id int,
	user_id int,
	calificacion int,
	comentario varchar(255),
	fecha date,
	primary key (opinion_id),
	CONSTRAINT fk_product FOREIGN KEY (product_id) REFERENCES products(product_id)  ON DELETE CASCADE,
	CONSTRAINT fk_user_u FOREIGN KEY (user_id) REFERENCES users(id)  ON DELETE CASCADE
);

drop table if exists metodo_pago;
create table metodo_pago(
	metodo_id integer not null auto_increment,
	nombre varchar(50),
	numero varchar(16),
	fecha_exp date,
	codigo_seg varchar(4),
	titular varchar(100),
	user_id int,
	orden_id int,
	primary key (metodo_id),
	CONSTRAINT fk_user_m FOREIGN KEY (user_id) REFERENCES users(id)  ON DELETE cascade,
	CONSTRAINT fk_orden_m FOREIGN KEY (orden_id) REFERENCES ordenes(orden_id)  ON DELETE CASCADE
);

/*datos por defecto*/
insert into categories (0, 'Desayunos','desayuno.jpg');
insert into categories (0, 'Comidas','comida.jpg');
insert into categories (0, 'Cenas','cena.jpg');
insert into categories (0, 'Snacks','snack.jpg');


