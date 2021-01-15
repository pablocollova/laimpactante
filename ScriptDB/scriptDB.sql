DROP DATABASE laimpactantebd; 
 
 CREATE DATABASE IF NOT EXISTS laimpactantebd;
use laimpactantebd;

CREATE TABLE usuarios (
    id_usuario int unsigned AUTO_INCREMENT,
    nombre_usuario varchar(30),
    apellido_usuario varchar(30),
    razonSocial_usuario varchar(30),
    dni_usuario int,
    isAdmin int,
    email varchar(30),
    pass_usuario varchar(10),
    telefono_usuario varchar(15),
    domicilio_usuario varchar(20),
    altura_usuario varchar(8),
    piso_usuario varchar(3),
    dept_usuario varchar(3),
    constraint pk_usuario  PRIMARY KEY (id_usuario),
    constraint unq_dni_usuario UNIQUE (dni_usuario)
);

create table proveedores (
	id_proveedor smallint unsigned auto_increment,
	nombre_proveedor varchar(30),
	direccion_proveedor varchar(30),
	altura_proveedor varchar(30),
	telefono_proveedor varchar(30),
	constraint pk_proveedor primary key(id_proveedor)
);

CREATE TABLE categorias(	
	id_categoria smallint unsigned auto_increment,
	nombre_categoria varchar(30),
	descuento_categoria float,
	constraint pk_categoria primary key(id_categoria)
);

CREATE TABLE productos
(
	id_producto int unsigned AUTO_INCREMENT,
	codigo_produto varchar(30),
	nombre_producto varchar(50),
	descripcion_producto varchar(50),
	cantidad_producto smallint unsigned,
	precio_producto float,
	categoria_producto smallint unsigned,
	id_proveedor smallint unsigned,
	para_venta bool, #documentar potencial futuro
	minimo_unidades smallint,
	constraint pk_producto primary key (id_producto),
	constraint fk_proveedor foreign key (id_proveedor) references proveedores (id_proveedor),
	constraint fk_categoria foreign key (categoria_producto) references categorias (id_categoria)
);

CREATE TABLE estados_pedido
(
	id_estadopedido smallint unsigned auto_increment,
	descripcion varchar(50),
	constraint pk_idestadopedido primary key (id_estadopedido)
);

CREATE TABLE ventas
(
	id_venta int unsigned AUTO_INCREMENT,
	total float,
	#id_pedido INT,
	id_cliente INT unsigned,
	fecha date, 
	nro_factura_venta int,
	fecha_pedido date,

#procesando_pedido bool,
#listo_pedido bool,
#despachado_pedido bool,

	estado_pedido smallint unsigned, 
	descuento_venta float, 
	nro_remito int unsigned,
	constraint pk_venta primary key (id_venta),
	constraint fk_id_cliente foreign key (id_cliente) references usuarios(id_usuario),
	constraint unq_numero_factura UNIQUE (nro_factura_venta),
	constraint fk_estadopedido foreign key  (estado_pedido) references estados_pedido(id_estadopedido)
);

select * from usuarios u
inner join ventas v
on u.id_usuario = v.idCliente;

CREATE TABLE pedidos
(
	id_pedido int unsigned AUTO_INCREMENT,
	id_producto int unsigned,
	id_venta int unsigned,
    cantidad_producto int unsigned,
	descuento_producto float,
	nro_remito int unsigned,
	constraint pk_pedido primary key (id_pedido),
	constraint fk_producto FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE,
	constraint fk_venta FOREIGN KEY (id_venta) references ventas(id_venta) ON DELETE CASCADE
	#CONSTRAINT CHK_estadopedido CHECK (estadopedido<4 AND nro_factura_venta=NULL)  chequear...
);

CREATE TABLE compras
(
	id_compra INT UNSIGNED AUTO_INCREMENT,
	id_producto int unsigned,
	codigo_producto varchar(30),
	cantidad float,
	valor_unit_producto float,
	id_proveedor smallint unsigned,
	constraint pk_compra primary key (id_compra),
	constraint fk_proveedor_compras foreign key( id_proveedor) references proveedores(id_proveedor),
	constraint fk_producto_compras foreign key (id_producto) references productos(id_producto)
);

CREATE TABLE mediosdepago
(
	id_mediodepago smallint unsigned auto_increment,
	detalle varchar(50),
	constraint pk_idmediodepago primary key(id_mediodepago)
);

 CREATE TABLE pagos
 (
	id_pago int unsigned auto_increment,
	id_cliente int unsigned,
	monto float,
	fecha date,
	nro_recibo varchar(20),
	mediodepago smallint unsigned,
	constraint pk_pago primary key (id_pago),
	constraint fk_cliente FOREIGN KEY (id_cliente) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
	constraint fk_idmediodepago foreign key(mediodepago) references mediosdepago (id_mediodepago)
 );
 
 CREATE TABLE detalle_pagos
 (
	id_detalle int unsigned auto_increment,
	id_pago int unsigned,
	nro_factura int unsigned,
	monto float,
	constraint pk_detalle primary key(id_detalle),
	constraint fk_pago foreign key (id_pago) references pagos (id_pago)
 );