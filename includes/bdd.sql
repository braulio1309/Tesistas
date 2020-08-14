CREATE DATABASE Sistema_Automatizado;

CREATE DOMAIN aprob_comite as varchar(10)
CHECK (value='Aprobado' or value='Reprobado');

CREATE DOMAIN TipoPropuesta AS varchar(13)
CHECK (value='Instrumental' or value='Experimental')
NOT NULL;

CREATE DOMAIN Sexo as varchar(1)
CHECK (value='M' or value='F')
NOT NULL;


CREATE DOMAIN mail as varchar(30)
NOT NULL ;

CREATE DOMAIN CedulaP AS varchar(8)
NOT NULL;

CREATE DOMAIN Fecha AS date;

CREATE DOMAIN TextoL AS varchar(100);

CREATE DOMAIN TextoM AS varchar(30)
NOT NULL;

CREATE DOMAIN Nombres AS varchar(20)
NOT NULL;

CREATE DOMAIN Notas as int
CHECK (VALUE BETWEEN 0 AND 20);

CREATE TABLE Usuarios_Pass(
	id_u serial not null primary key,
	usuario Nombres,
	pass varchar(20) not null
);

CREATE TABLE Tesistas(
	cedula CedulaP unique,
	nombre Nombres,
	correo_ucab mail unique,
	correo_part mail unique,
	telefono varchar(10) not null,
	sexo Sexo,
	primary key(cedula)
);

CREATE INDEX ID_Correo_ucab
On Tesistas(correo_ucab);

CREATE INDEX ID_Correo_part
On Tesistas(correo_part); 

CREATE TABLE Profesores(
	cedula_profe CedulaP UNIQUE,
	nombreProfe Nombres,
	direccionProfe TextoL,
	telefonoProfe int unique not null,
	correoProfe mail unique,
	localidad TextoM,
	primary key(cedula_profe)
);

CREATE INDEX ID_Telf_Profe
On Profesores(telefonoProfe);

CREATE TABLE INTERNOS(
	cedula_Profe CedulaP,
	primary key(cedula_Profe)
);

ALTER TABLE INTERNOS
ADD CONSTRAINT FK_CedulaP
FOREIGN KEY(cedula_Profe)
REFERENCES Profesores(cedula_profe);

CREATE TABLE EXTERNOS(
	cedula_Profe CedulaP,
	primary key(cedula_Profe)
);

ALTER TABLE EXTERNOS
ADD CONSTRAINT FK_CedulaP
FOREIGN KEY(cedula_Profe)
REFERENCES Profesores(cedula_profe);

CREATE TABLE Propuestas(
	num_correlativo int unique not null,
	cedula_profe CedulaP,
	f_entrega_esc Fecha,
	f_presentacion_comite Fecha,
	aprobacionComite aprob_comite,
	f_aprobacion_comite Fecha,
	titulo TextoL,
	comentario TextoL,
	tipo_propuesta TipoPropuesta,
	primary key (num_correlativo)
);

ALTER TABLE Propuestas
ADD CONSTRAINT FK_CedulaProfeI
FOREIGN KEY (cedula_profe)
REFERENCES INTERNOS(cedula_Profe);


CREATE TABLE Formatos(
	id_formato serial,
	nombre Nombres,
    tipo_formato varchar(15),
	primary key(id_formato)
);

CREATE TABLE Trabajos(
	id_tg serial unique ,
	cedula_tutor CedulaP,
	num_correlativo int not null,
	nroConsejo int,
	Fecha_presentacion Fecha,
	horaPresentacion time,
	fechaAprobacion	Fecha,
	primary key(id_tg, num_correlativo)
);

ALTER TABLE Trabajos
ADD CONSTRAINT FK_CedulaProfeTI
FOREIGN KEY (cedula_tutor)
REFERENCES INTERNOS(cedula_Profe);

ALTER TABLE Trabajos
ADD CONSTRAINT FK_Nro_Co
FOREIGN KEY (num_correlativo)
REFERENCES Propuestas(num_correlativo);


CREATE TABLE Instrumentales(
	num_correlativo int not null,
	nombreEmpresa  TextoM,
	tutorEmpresarial TextoM,
	primary key(num_correlativo)
);

ALTER TABLE Instrumentales
ADD CONSTRAINT FK_NroCorrel
FOREIGN KEY (num_correlativo)
REFERENCES Propuestas(num_correlativo);


CREATE TABLE Experimentales(
	num_correlativo int not null,
	profesorAvala Nombres,
	primary key(num_correlativo)
);

ALTER TABLE Experimentales
ADD CONSTRAINT FK_NumrCorre
FOREIGN KEY (num_correlativo)
REFERENCES Propuestas(num_correlativo);

CREATE TABLE TIG(
	id_tg int not null primary key
);

ALTER TABLE TIG
ADD CONSTRAINT Fk_id_tg
FOREIGN KEY (id_tg)
REFERENCES Trabajos(id_tg);

CREATE TABLE TEG(
	id_tg int not null primary key
);

ALTER TABLE TEG
ADD CONSTRAINT Fk_id_tg
FOREIGN KEY (id_tg)
REFERENCES Trabajos(id_tg);

CREATE TABLE Especialidades(
	id_especialidad serial,
	nombreEspecialidad Nombres,
	primary key(id_especialidad)
);

CREATE TABLE formato_tutor_tig(
    id_formato int unique
);

ALTER TABLE formato_tutor_tig
ADD CONSTRAINT FK_IdformatoT
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE formato_tutor_teg(
    id_formato int unique
);

ALTER TABLE formato_tutor_teg
ADD CONSTRAINT FK_IdformatoTI
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE formato_revisor_tig(
    id_formato int unique
);

ALTER TABLE formato_revisor_tig
ADD CONSTRAINT FK_IdformatoTRI
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE formato_revisor_teg(
    id_formato int unique
);

ALTER TABLE formato_revisor_teg
ADD CONSTRAINT FK_IdformatoTRE
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE formato_jurado_tig(
    id_formato int unique
);

ALTER TABLE formato_jurado_tig
ADD CONSTRAINT FK_IdformatoTJI
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE formato_jurado_teg(
    id_formato int unique
);

ALTER TABLE formato_jurado_teg
ADD CONSTRAINT FK_IdformatoTJE
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);


CREATE TABLE Presentan(
	cedulaTesista CedulaP,
	num_correlativo int not null,
	primary key(cedulaTesista, num_correlativo)
);

ALTER TABLE Presentan
ADD CONSTRAINT FK_NroCorrel
FOREIGN KEY (num_correlativo)
REFERENCES Propuestas(num_correlativo);

ALTER TABLE Presentan
ADD CONSTRAINT FK_CedulaTesista
FOREIGN KEY (cedulaTesista)
REFERENCES Tesistas(cedula);

CREATE TABLE Tiene(
	cod_especialidad int not null,
	cedula_profe CedulaP,
	primary key(cod_especialidad,cedula_profe)
);

ALTER TABLE Tiene
ADD CONSTRAINT FK_especialidad
FOREIGN KEY (cod_especialidad)
REFERENCES Especialidades(id_especialidad);

ALTER TABLE Tiene
ADD CONSTRAINT FK_cedulaP
FOREIGN KEY (cedula_profe)
REFERENCES Profesores(cedula_profe);

CREATE TABLE Es_Jurado(
	cedula_profe CedulaP,
	id_tg int not null
);

ALTER TABLE Es_Jurado
ADD CONSTRAINT FK_CedulaP
FOREIGN KEY(cedula_profe)
REFERENCES Profesores(cedula_profe);

ALTER TABLE Es_Jurado
ADD CONSTRAINT FK_IDTr
FOREIGN KEY(id_tg)
REFERENCES Trabajos(id_tg);

CREATE TABLE criterios_tutor_tig(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato)
);

ALTER TABLE criterios_tutor_tig
ADD CONSTRAINT FK_IdformatoCTTIG
FOREIGN KEY (id_formato)
REFERENCES formato_tutor_tig(id_formato);

CREATE TABLE criterios_tutor_teg(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato)
);

ALTER TABLE criterios_tutor_teg
ADD CONSTRAINT FK_IdformatoCTTEG
FOREIGN KEY (id_formato)
REFERENCES formato_tutor_teg(id_formato);

CREATE TABLE criterios_revisor_tig(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato)
);

ALTER TABLE criterios_revisor_tig
ADD CONSTRAINT FK_IdformatoCRTIG
FOREIGN KEY (id_formato)
REFERENCES formato_revisor_tig(id_formato);

CREATE TABLE criterios_revisor_teg(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato)
);

ALTER TABLE criterios_revisor_teg
ADD CONSTRAINT FK_IdformatoCRTEG
FOREIGN KEY (id_formato)
REFERENCES formato_revisor_teg(id_formato);

CREATE TABLE criterios_jurado_tig(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato)
);

ALTER TABLE criterios_jurado_tig
ADD CONSTRAINT FK_IdformatoCJTIG
FOREIGN KEY (id_formato)
REFERENCES formato_jurado_tig(id_formato);

CREATE TABLE criterios_jurado_teg(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato)
);

ALTER TABLE criterios_jurado_teg
ADD CONSTRAINT FK_IdformatoCJTEG
FOREIGN KEY (id_formato)
REFERENCES formato_jurado_teg(id_formato);

