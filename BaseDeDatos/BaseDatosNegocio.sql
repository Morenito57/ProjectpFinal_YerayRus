DROP DATABASE IF EXISTS LegendaryMotorsport;
create DATABASE if not exists LegendaryMotorsport;
USE LegendaryMotorsport;

CREATE TABLE DatosPersonales(
    Id INT auto_increment primary key,
	Nombre varchar(10),
	Apellidos varchar(15),
	FechaNacimiento date,
	Direccion varchar(50),
	DNI varchar(9)
);

CREATE TABLE DatosContacto(
    Id INT auto_increment primary key,
	Telefono int(9),
	Email varchar(30),
	Otro varchar(30)
);

CREATE TABLE Cargo(
    Id INT auto_increment primary key,
	FechaDevuelto date,
	TotalCargo int
);

CREATE TABLE TipoVehiculo(
    Id INT auto_increment primary key,
	TipoVehiculo varchar(20)
);

CREATE TABLE TipoTransaccion(
    Id INT auto_increment primary key,
	TipoTransaccion varchar(20)
);

CREATE TABLE Usuario(
    Id INT auto_increment primary key,
	IdDatosContacto INT,
	IdDatosPersonales INT,
	NombreUsuario varchar(12),
	Contraseña varchar(12),
	TipoDeUsuario boolean,
	Saldo int,
	FOREIGN KEY (IdDatosContacto)
    	REFERENCES DatosContacto (Id),
	FOREIGN KEY (IdDatosPersonales)
    	REFERENCES DatosPersonales (Id)
);

CREATE TABLE Vehiculo(
    Id INT auto_increment primary key,
	IdTipoVehiculo int,
	IdTipoTransaccion int,
	Nombre varchar(50),
	Matricula varchar(7),
	Caballos int,
	Kilometros int,
	NºPasajeros int,
	Año int,
	Precio int,
	FOREIGN KEY (IdTipoVehiculo)
    	REFERENCES TipoVehiculo (Id),
	FOREIGN KEY (IdTipoTransaccion)
    	REFERENCES TipoTransaccion (Id)
);

CREATE TABLE Compras(
    Id INT auto_increment primary key,
	IdUsuario int,
	IdVehiculo int,
	Fecha date,
	PrecioTotal int,
	FOREIGN KEY (IdUsuario)
    	REFERENCES Usuario (Id),
	FOREIGN KEY (IdVehiculo)
    	REFERENCES Vehiculo (Id)
);

CREATE TABLE Alquiler(
    Id INT auto_increment primary key,
	IdUser int,
	IdVehiculo int,
	IdCargos int,
	Disponibilidad boolean,
	FechaInicio date,
	FechaFinal date,
	TotalDelPrecio int,
	FOREIGN KEY (IdUser)
    	REFERENCES Usuario (Id),
	FOREIGN KEY (IdVehiculo)
    	REFERENCES Vehiculo (Id),
	FOREIGN KEY (IdCargos)
    	REFERENCES Cargo (Id)
);