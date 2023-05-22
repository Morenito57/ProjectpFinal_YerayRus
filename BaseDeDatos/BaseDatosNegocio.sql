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

CREATE TABLE TipoVehiculo(
    Id INT auto_increment primary key,
	TipoVehiculo varchar(20)
);

CREATE TABLE Seguros(
    Id INT auto_increment primary key,
	Seguro varchar(50),
	Precio int
);

CREATE TABLE Extras(
    Id INT auto_increment primary key,
	Extra varchar(50),
	Precio int
);

CREATE TABLE Usuario(
    NombreUsuario varchar(50) primary key,
	IdDatosContacto INT,
	IdDatosPersonales INT,
	Saldo int,
	Clave varchar(255) not null,
	TipoDeUsuario varchar(20),
	FOREIGN KEY (IdDatosContacto)
    	REFERENCES DatosContacto (Id),
	FOREIGN KEY (IdDatosPersonales)
    	REFERENCES DatosPersonales (Id)
);


CREATE TABLE Vehiculo(
    Id INT auto_increment primary key,
	IdTipoVehiculo int,
    Imagen varchar(50),
    Marca varchar(20),
	Nombre varchar(50),
	Matricula varchar(15),
	Caballos int,
	Kilometros int,
	Plazas int,
	Año int,
	Precio int,
    Estado boolean,
    Descripcion varchar(500),
	FOREIGN KEY (IdTipoVehiculo)
    	REFERENCES TipoVehiculo (Id)
);

CREATE TABLE Alquiler(
    Id INT auto_increment primary key,
	IdUser varchar(50),
	IdVehiculo int,
	FechaInicio date,
	FechaFinal date,
	TotalDelPrecio int,
	FOREIGN KEY (IdUser)
    	REFERENCES Usuario (NombreUsuario),
	FOREIGN KEY (IdVehiculo)
		REFERENCES Vehiculo (Id)
);

CREATE TABLE Cargo(
    Id INT auto_increment primary key,
	Alquiler_id INT,
	FechaDevuelto date,
	TotalCargo int,
    Pagado int,
    Activo boolean,
	FOREIGN KEY (Alquiler_id) 
		REFERENCES Alquiler(Id)
);

CREATE TABLE Alquiler_Seguro (
    Alquiler_id INT,
    Seguro_id INT,
    PRIMARY KEY (Alquiler_id, Seguro_id),
    FOREIGN KEY (Alquiler_id) REFERENCES Alquiler(Id),
    FOREIGN KEY (Seguro_id) REFERENCES Seguros(Id)
);

CREATE TABLE Alquiler_Extra (
    Alquiler_id INT,
    Extra_id INT,
    PRIMARY KEY (Alquiler_id, Extra_id),
    FOREIGN KEY (Alquiler_id) REFERENCES Alquiler(Id),
    FOREIGN KEY (Extra_id) REFERENCES Extras(Id)
);

insert into Seguros (Seguro,Precio) VALUES ('Ninguno', 0);
insert into Seguros (Seguro,Precio) VALUES ('Responsabilidad civil', 40);
insert into Seguros (Seguro,Precio) VALUES ('Colisión', 55);
insert into Seguros (Seguro,Precio) VALUES ('Robo', 15);
insert into Seguros (Seguro,Precio) VALUES ('Daños Vandalismo', 25);
insert into Seguros (Seguro,Precio) VALUES ('Protección Lesiones', 20);

insert into Extras (Extra,Precio) VALUES ('Ninguno', 0);
insert into Extras (Extra,Precio) VALUES ('Combustible lleno', 100);
insert into Extras (Extra,Precio) VALUES ('Conductor adicional', 75);
insert into Extras (Extra,Precio) VALUES ('Wi-Fi', 35);
insert into Extras (Extra,Precio) VALUES ('Baca', 25);
insert into Extras (Extra,Precio) VALUES ('Silla de bebé', 25);
insert into Extras (Extra,Precio) VALUES ('GPS', 20);

insert into TipoVehiculo (TipoVehiculo) VALUES ('Superdeportivo');
insert into TipoVehiculo (TipoVehiculo) VALUES ('Moto Deportiva');
insert into TipoVehiculo (TipoVehiculo) VALUES ('Todoterreno');
insert into TipoVehiculo (TipoVehiculo) VALUES ('Compacto de carreras');
insert into TipoVehiculo (TipoVehiculo) VALUES ('Deportivo');
insert into TipoVehiculo (TipoVehiculo) VALUES ('Fúnebre');
insert into TipoVehiculo (TipoVehiculo) VALUES ('Autobus');
/*insert into TipoVehiculo (TipoVehiculo) VALUES ('');*/

insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (1,'Virtue','Ocelot','1071 FKN', 650, 20000, 2, 2020, 1000, true, 'Te presentamos el hipercoche eléctrico que viene preparado para los circuitos y la ciudad, con el que podrás demostrar tu compromiso con el cambio climático y tu situación de exiliado fiscal conduciendo el mismo vehículo. Y si te cansas de los marisabidillos que te señalan la contradicción, equípalo con accesorios dignos de aplauso (inhibidor de fijación de misiles, unidad de control remoto, minas resbaladizas y blindaje) para zanjar de un plumazo cualquier discusión.', 'img1');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (2,'Shinobi','Nagasaki','4711-FJN', 500, 25000, 1, 2018, 600, true, 'La última novedad de la siempre magnífica Nagasaki. Con esta potencia, de lo único que tienes que preocuparte es de contar con un buen sistema de lubricación por cárter húmedo. La moto estará bien.', 'img2');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (3,'Freecrawler','Canis','5241-GYJ', 400, 30000, 4, 2021, 1500, true, 'El Freecrawler es el primer vehículo todoterreno diseñado para que las familias modernas disfruten de lo mejor de la guerra acorazada. Tiene tracción a las cuatro ruedas, suspensión pesada y carrocería modelada directamente de un bloque de hormigón, porque no hay que aceptar los límites. También cuenta con asientos acolchados y puertas eléctricas, porque en el fondo todos somos débiles y tenemos miedo. Venga, súbete.', 'img3');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (4,'Flash GT','Vapid','6432-HNW', 550, 15000, 2, 2017, 400, true, 'Ya sabes cómo funciona esto: vas a la tienda con el coche y de repente sucumbes a un abrumador deseo de dejar el asfalto como un colador. El médico te dice que necesitas ir urgentemente a un psiquiatra, pero en Vapid entendemos que lo único que necesitas es el coche adecuado; básicamente, uno que sea veloz y ligero, pero también un utilitario compacto y demencial que siempre esté a punto de hacerse mil pedazos. Que empiece la terapia.', 'img4');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (5,'Windsor','Ocelot','5678 JKF', 520, 95000, 2, 2014, 600, true, 'Al desdibujar los límites entre un automóvil y una mansión de un aristócrata inglés, este coche podría darle un aura de clase y buen gusto hasta a un fan del nu metal. El inútil fabricante creó una aerodinámica tan patética y un chasis tan pesado que este motor de doble turbo apenas da para manejar despacio mientras eliges a una prostituta, pero eso es parte de (o todo) su encanto británico.', 'img5');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (5,'Feltzer','Benefactor','7834 HZX', 700, 110000, 2, 2016, 450, true, 'Este coche de lujo es para principiantes: comerciales, pringados de marketing, empleados de empresas tecnológicas que quieren sentirse como triunfadores, aunque nunca lo serán... Demuestra a la gente el tipo de persona que quieres ser.', 'img6');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (3,'Patriot','Mammoth','8623-KLG', 300, 80000, 5, 2018, 350, true, 'El Patriot es tan estadounidense como el pastel de manzana y los hot dogs.', 'img7');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');

insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (6,'Romeros Hearse','Declasse','8321 HGG', 120, 75000, 5, 2005, 35, true, 'Vehículo del director de la funeraria. Posiblemente utilizado como tapadera.', 'img8');

insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');
insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (7,'Autobús del festival','Brute','1287-GKL', 190, 400000, 26, 2000, 100, true, 'Seguro que oyes voces que te susurran "es una idea espantosa". Pero ¿sabes qué? En cuanto sintonices nerviosamente Worldwide FM y revientes todas las ventanas en una radio de diez manzanas dejarás de oír esas voces... y todo lo demás.', 'img9');

/*insert into Vehiculo (IdTipoVehiculo,Nombre,Marca,Matricula,Caballos,Kilometros,Plazas,Año,Precio,Estado,Descripcion,Imagen) VALUES (2,'','','', , , , , , true, '', 'img');*/












