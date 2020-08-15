--CREAMOS LA BASE DE DATOS
CREATE DATABASE Sistema_Automatizado

-- CREAMOS LOS DOMINIOS 
CREATE DOMAIN aprob_comite as varchar(10)
CHECK (value='APROBADO' or value='REPROBADO' or value='NULL');

CREATE DOMAIN TipoPropuesta AS varchar(13)
CHECK (value='Instrumental' or value='Experimental')
NOT NULL;

CREATE DOMAIN Sexo as varchar(1)
CHECK (value='M' or value='F')
NOT NULL;

CREATE DOMAIN mail as varchar(30)
NOT NULL ;

CREATE DOMAIN CedulaP AS varchar(8);

CREATE DOMAIN Fecha AS date;

CREATE DOMAIN TextoL AS varchar(100);

CREATE DOMAIN TextoM AS varchar(30)
NOT NULL;

CREATE DOMAIN Nombres AS varchar(20)
NOT NULL;

CREATE DOMAIN Notas as int
CHECK (VALUE BETWEEN 0 AND 20);

CREATE DOMAIN TelefonoC as varchar(14);


-- CREAMOS TABLA PARA LOS USUARIOS QUE MANEJARAN EL SISTEMA
CREATE TABLE Usuarios_Pass(
	id_u serial not null primary key,
	usuario Nombres,
	pass varchar(20) not null
);

-- CREAMOS TABLA TESISTAS
CREATE TABLE Tesistas(
	cedula CedulaP unique NOT NULL,
	nombre Nombres,
	correo_ucab mail unique,
	correo_part mail unique,
	telefono TelefonoC not null,
	sexo Sexo,
	primary key(cedula)
);

--CREAMOS INDICES DE CORREO UCAB Y CORREO PARTICULAR
CREATE INDEX ID_Correo_ucab
On Tesistas(correo_ucab);

CREATE INDEX ID_Correo_part
On Tesistas(correo_part); 


--CREAMOS TABLA PROFESORES
CREATE TABLE Profesores(
	cedula_profe CedulaP NOT NULL,
	nombreProfe Nombres,
	direccionProfe TextoL,
	telefonoProfe varchar(12) unique not null,
	correoProfe mail unique,
	localidad TextoM,
	primary key(cedula_profe)
);

--CREAMOS INDICE DE TELEFONO DE PROFESOR
CREATE INDEX ID_Telf_Profe
On Profesores(telefonoProfe);

--CREAMOS LA TABLA DE PROFESORES INTERNOS
CREATE TABLE INTERNOS(
	cedula_Profe CedulaP, 
	primary key(cedula_Profe),
	
	FOREIGN KEY(cedula_Profe) 
	REFERENCES Profesores(cedula_profe) ON DELETE SET NULL ON UPDATE CASCADE
);



--CREAMOS TABLA DE PROFESORES EXTERNOS
CREATE TABLE EXTERNOS(
	cedula_Profe CedulaP,
	primary key(cedula_Profe),
	FOREIGN KEY(cedula_Profe) 
	REFERENCES Profesores(cedula_profe) ON DELETE SET NULL ON UPDATE CASCADE
);


--CREAMOS TABLA DE PROPUESTAS
CREATE TABLE Propuestas(
	num_correlativo serial unique not null,
	cedula_profe CedulaP,
	f_entrega_esc Fecha,
	f_presentacion_comite Fecha,
	aprobacionComite aprob_comite,
	f_aprobacion_comite Fecha,
	titulo TextoL,
	comentario TextoL,
	tipo_propuesta TipoPropuesta,
	primary key (num_correlativo),
	
	FOREIGN KEY(cedula_profe) 
	REFERENCES INTERNOS(cedula_Profe) ON DELETE SET NULL ON UPDATE CASCADE
);

--CREAMOS LA TABLA FORMATOS
CREATE TABLE Formatos(
	id_formato serial,
	nombre Nombres,
    tipo_formato varchar(15),
	primary key(id_formato)
);


--CREAMOS LA TABLA TRABAJOS
CREATE TABLE Trabajos(
	id_tg serial unique ,
	cedula_tutor CedulaP, 
	nroCorrelativo int not null,
	nroConsejo int,
	Fecha_presentacion Fecha,
	horaPresentacion time,
	fechaAprobacion	Fecha,
	tipo_formato int, 
	primary key(id_tg, nroCorrelativo),
	
	FOREIGN KEY(cedula_tutor) 
	REFERENCES INTERNOS(cedula_Profe) ON DELETE SET NULL ON UPDATE CASCADE,
	
	FOREIGN KEY(tipo_formato) 
	REFERENCES Formatos(id_formato) ON DELETE SET NULL ON UPDATE CASCADE,
	
	FOREIGN KEY(nroCorrelativo) 
	REFERENCES Propuestas(num_correlativo) ON DELETE SET NULL ON UPDATE CASCADE
);


-- CREAMOS TABLA DE PROPUESTAS INSTRUMENTALES
CREATE TABLE Instrumentales(
	Nro_correlativo int not null,
	nombreEmpresa  TextoM,
	tutorEmpresarial TextoM,
	primary key(Nro_correlativo),
	
	FOREIGN KEY(Nro_correlativo) 
	REFERENCES Propuestas(num_correlativo) ON DELETE SET NULL ON UPDATE CASCADE
);

-- CREAMOS LA TABLA DE PROPUESTAS EXPERIMENTALES
CREATE TABLE Experimentales(
	Numr_correlativo int not null,
	profesorAvala Nombres,
	primary key(numr_correlativo),
	
	FOREIGN KEY(Numr_correlativo) 
	REFERENCES Propuestas(num_correlativo) ON DELETE SET NULL ON UPDATE CASCADE
);

-- CREAMOS TABLA PARA LOS TRABAJOS INSTRUMENTALES
CREATE TABLE TIG(
	id_tg int not null primary key,
	FOREIGN KEY(id_tg) 
	REFERENCES Trabajos(id_tg) ON DELETE SET NULL ON UPDATE CASCADE
);

--CREAMOS TABLA PARA LOS TRABAJOS EXPERIMENTALES
CREATE TABLE TEG(
	id_tg int not null primary key,
	FOREIGN KEY(id_tg) 
	REFERENCES Trabajos(id_tg) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Especialidades(
	id_especialidad serial,
	nombreEspecialidad Nombres,
	primary key(id_especialidad)
);

--CREAMOS TABLA DE FORMATOS DE LOS TUTORES INSTRUMENTALES
CREATE TABLE formato_tutor_tig(
    id_formato int unique,
	FOREIGN KEY(id_formato) 
	REFERENCES Formatos(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

--CREAMOS TABLA DE FORMATOS DE LOS TUTORES EXPERIMENTALES
CREATE TABLE formato_tutor_teg(
    id_formato int unique,
	FOREIGN KEY(id_formato) 
	REFERENCES Formatos(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

--CREAMOS TABLA DE FORMATOS DE LOS REVISORES INSTRUMENTALES
CREATE TABLE formato_revisor_tig(
    id_formato int unique,
	FOREIGN KEY(id_formato) 
	REFERENCES Formatos(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

--CREAMOS TABLA DE FORMATOS DE LOS REVISORES EXPERIMENTALES
CREATE TABLE formato_revisor_teg(
    id_formato int unique,
	FOREIGN KEY(id_formato) 
	REFERENCES Formatos(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

--CREAMOS TABLA DE FORMATOS DE LOS JURADOS INSTRUMENTALES
CREATE TABLE formato_jurado_tig(
    id_formato int unique,
	FOREIGN KEY(id_formato) 
	REFERENCES Formatos(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

--CREAMOS TABLA DE FORMATOS DE LOS JURADOS EXPERIMENTALES
CREATE TABLE formato_jurado_teg(
    id_formato int unique,
	FOREIGN KEY(id_formato) 
	REFERENCES Formatos(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

-- CREAMOS TABLA DE LOS TESISTAS QUE PRESENTAN UNA PROPUESTA
CREATE TABLE Presentan(
	cedulaTesista CedulaP,
	nroCorrelativo int not null,
	primary key(cedulaTesista, nroCorrelativo),
	
	FOREIGN KEY(nroCorrelativo) 
	REFERENCES Propuestas(num_correlativo) ON DELETE SET NULL ON UPDATE CASCADE,
	
	FOREIGN KEY(cedulaTesista) 
	REFERENCES Tesistas(cedula) ON DELETE SET NULL ON UPDATE CASCADE
);

-- CREAMOS TABLA DE LA ESPECIALIDAD QUE POSEE UN PROFESOR
CREATE TABLE Tiene(
	cod_especialidad int not null,
	cedula_profe CedulaP,
	primary key(cod_especialidad,cedula_profe),
	
	FOREIGN KEY(cod_especialidad) 
	REFERENCES Especialidades(id_especialidad) ON DELETE SET NULL ON UPDATE CASCADE,
	
	FOREIGN KEY(cedula_profe) 
	REFERENCES Profesores(cedula_profe) ON DELETE SET NULL ON UPDATE CASCADE
);

-- CREAMOS TABLA DEL PROFESOR QUE ES JURADO
CREATE TABLE Es_Jurado(
	id_tg int not null,
	jurado_profe1 varchar(20),
	jurado_profe2 varchar(20),
	jurado_profe3 varchar(20),
	jurado_profe4 varchar(20),

	REFERENCES Profesores(cedula_profe) ON DELETE SET NULL ON UPDATE CASCADE,
	
	FOREIGN KEY(id_tg) 
	REFERENCES Trabajos(id_tg) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE criterios_tutor_tig(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato,criterios),
	FOREIGN KEY(id_formato) 
	REFERENCES formato_tutor_tig(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE criterios_tutor_teg(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato,criterios),
	
	FOREIGN KEY(id_formato) 
	REFERENCES formato_tutor_teg(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE criterios_revisor_tig(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato,criterios),
	
	FOREIGN KEY(id_formato) 
	REFERENCES formato_revisor_tig(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE criterios_revisor_teg(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato,criterios),
	
	FOREIGN KEY(id_formato) 
	REFERENCES formato_revisor_teg(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE criterios_jurado_tig(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato,criterios),
	
	FOREIGN KEY(id_formato) 
	REFERENCES formato_jurado_tig(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE criterios_jurado_teg(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato,criterios),
	
	FOREIGN KEY(id_formato) 
	REFERENCES formato_jurado_teg(id_formato) ON DELETE SET NULL ON UPDATE CASCADE
);