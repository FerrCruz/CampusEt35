drop database if exists CampusEt35;

Create database CampusEt35;
use CampusEt35;

Create table registroAcciones(
id_accion int auto_increment,
usuario int,
accion varchar(50),
fecha date,
hora time,
constraint pk_acciones primary key(id_accion)
);


Create table materias(
id_materia int auto_increment,
nombre_mat varchar(30),
constraint PK_materias primary key(id_materia)
);

Create table usuarios(
id_usuario int auto_increment,	
nombre varchar(30),
apellido varchar(40),
user varchar(50),
tel int,
email varchar(80),
contrasena varchar(150),
intentos int,
codigo_recu varchar(10),
tiempo datetime,
constraint PK_usuarios primary key (id_usuario)
);

Create table permisos(
id_permiso int auto_increment,
descripcion varchar(50),
constraint PK_permisos primary key (id_permiso)
);

Create table usuario_permiso(
id_up  int auto_increment,
id_usuario  int,
id_permiso  int,
constraint PK_permiso_usuario primary key (id_up),
constraint FK_usu_usuario_permiso foreign key (id_usuario) references usuarios (id_usuario),
constraint FK_per_usuario_permiso foreign key (id_permiso) references permisos (id_permiso)
);

Create table grupos(
id_grupo int auto_increment,
nombre varchar(50),
constraint PK_grupos primary key (id_grupo)
);

Create table permiso_grupo(
id_pg  int auto_increment,
id_permiso  int,
id_grupo  int,
constraint PK_grupo_permiso primary key (id_pg),
constraint FK_per_permiso_grupo foreign key (id_permiso) references permisos (id_permiso),
constraint FK_gru_permiso_grupo foreign key (id_grupo) references grupos (id_grupo)
);

Create table faltas(
id_falta int auto_increment,
id_alumno int,
fecha date,
turno varchar(20),
gravedad float,
constraint PK_faltas primary key(id_falta),
constraint FK_usu_faltas foreign key (id_alumno) references usuarios(id_usuario)
);

/*INGRESO DE DATOS*/


insert into materias values
("","Matematica"),
("","Lengua y literatura"),
("","Ingles"),
("","Biologia"),
("","Historia"),
("","Geografia"),
("","Educacion Ciudadana"),
("","Tecnologia de la Representacion"),
("","Educacion Artistica"),
("","Tutoria"),
("","Fisica"),
("","Quimica"),
("","Logica"),
("","Economia"),
("","Base de Datos"),
("","Algoritmos y Estructura de datos"),
("","Aleman"),
("","Proyecto Informatico I"),
("","Analisis de Sistemas"),
("","LPOO"),
("","Agestion"),
("","Redes"),
("","Economia"),
("","Proyecto Informatico II"),
("","Organizacion de la Computadora"),
("","Mecanica"),
("","Estatica y Resistencia de Materiales"),
("","Electricidad del Automotor"),
("","Mecanismo del Automotor y Fluidica"),
("","Elementos de Maquinas"),
("","Tecnologia de Materiales"),
("","Termodinamica"),
("","Motor de Combustion Interna"),
("","Electronica del Automotor"),
("","Dinamica del Automotor"),
("","Taller de Automotores I"),
("","Taller de Automotores II"),
("","Educacion Fisica"),
("","Ciencia y Tecnologia"),
("","Ciudadania y Trabajo"),
("","GPP"),
("","Administracion de Sistemas y Redes "),
("","Analisis Matematico"),
("","Desarrollo de Sistemas"),
("","Practicas Profesionalizantes"),
("","Programacion sobre Redes"),
("","Economia y la Gestion de Organizaciones"),
("","Higiene y Seguridad Laboral"),
("","Dinamica de los Motores de Combustion Interna"),
("","Laboratorio de Ensallo de Motores"),
("","Diagnotsico de Sistemas del Automotor"),
("","Calculo de Estructura y Mecanismo del Automotor"),
("","Vehiculos Especiales"),
("","Taller de Automotores III"),
("","Taller I"),
("","Taller II"),
("","Taller III");

insert into usuarios values
("","Manuel","Dallagioconde","admin","785644322","dalas@gmail.com",'admin',0,NULL,NULL),
("","Nicolas","Ahumagiovvanna","admin2","88976302","condes@yahoo.net.ven",'admin',0, NULL,NULL),
("","Rita","Fasotecome","admin3","99997777","fasotecome@coldmail.org",'admin',1,NULL,NULL);

insert into permisos values
("","Alumno"),
("","Profesor"),
("","Regente");

insert into usuario_permiso values
("","1","1"),
("","2","2"),
("","3","3");

insert into grupos values
("","Alumno"),
("","Profesor"),
("","Regente");

insert into permiso_grupo values
("","1","1"),
("","2","2"),
("","3","3");

/*VISTAS Y USUARIOS*/


-- create view login as select dni,contraseña, intentos,codigo_recu,tiempo,email
-- from usuarios u; 

-- create view ver_usuarios as select u.dni, u.nombre,u.apellido,u.dni,u.tel,u.email,u.contraseña; 

/*PROCEDIMIENTOS Y TRIGGER*/

/*Al agregar un usuario a un grupo se le asignan todos los permisos de ese grupo*/

-- drop trigger actualizar_permisos;
-- delimiter //

-- create trigger actualizar_permisos after insert on grupo_usuario for each row
-- begin
-- 	declare var boolean default false;
-- 	declare permiso int;
-- 	declare existe int;

-- 	declare curs cursor for select id_permiso from permiso_grupo pg where pg.id_grupo=new.id_grupo;
-- 	declare continue handler for not found set var = true;
-- 	open curs;
-- 	fetch curs into permiso;
-- 	while (var = false) do
	
-- 	set existe=(select count(*) from usuario_permiso where permiso=id_permiso and id_usuario=new.id_usuario);
	
--    if(existe=0) then
-- 	insert into usuario_permiso values("",new.id_usuario,permiso);
-- 	end if;
	
-- 	fetch curs into permiso;
-- 	end while;
	
-- 	close curs;
-- end//

-- delimiter ;

-- /*Al eliminar un usuario de un grupo se le quitan todos los permisos de ese grupo*/

-- drop trigger borrar_permisos;
-- delimiter //

-- create trigger borrar_permisos after delete on grupo_usuario for each row
-- begin

-- 	delete from usuario_permiso where id_usuario = old.id_usuario and id_permiso in (select id_permiso from permiso_grupo where id_grupo = old.id_grupo);

-- end//

-- delimiter ;




