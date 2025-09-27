create database dbappalojamientos

use dbappalojamientos

create table rol(
    idrol int PRIMARY key AUTO_INCREMENT,
    rol varchar(50)
    );
    
    create table usuario(
        idusuario int PRIMARY KEY AUTO_INCREMENT,
        nombre varchar(100),
        correo varchar(100),
        pwd varchar(200),
        idrol int,
        fecha_registro date,
        FOREIGN key (idrol) REFERENCES rol(idrol)
        );
        
    create table alojamientos(
    idalojamientos int primary key AUTO_INCREMENT,
    titulo varchar(100),
    descripcion text,
    img varchar(100),
    departamento varchar(100),
    direccion varchar(200),
    precio decimal(10,2),
    idusuario int,
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
    );

    create table cuentaalojamiento(
    idregistro int primary key AUTO_INCREMENt,
    idalojamiento int,
    idusuario int,
    fecha_registro date,
    FOREIGN KEY (idalojamiento) references alojamientos(idalojamientos),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
    );