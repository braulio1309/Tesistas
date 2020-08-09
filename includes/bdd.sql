CREATE DATABASE Sistema_Automatizado;

CREATE DOMAIN aprob_comite as varchar(10)
CHECK (value='Aprobado' or value='Reprobado');

CREATE DOMAIN TipoPropuesta AS varchar(13)
CHECK (value='Instrumental' or value='Experimental')
NOT NULL;

CREATE DOMAIN mail as varchar(30)
NOT NULL ;

CREATE DOMAIN CedulaP AS varchar(8)
NOT NULL;

CREATE DOMAIN Fecha AS date;

CREATE DOMAIN TextoL AS varchar(50);

CREATE DOMAIN TextoM AS varchar(30)
NOT NULL;

CREATE DOMAIN Nombres AS varchar(20)
NOT NULL;

CREATE DOMAIN Notas as int
CHECK (VALUE BETWEEN 0 AND 20);

CREATE TABLE Usuarios_Pass(
	id_u int serial not null primary key,
	usuario Nombres,
	pass varchar(20) not null
);

CREATE TABLE Propuestas(
	num_correlativo int unique not null,
	cedula_profe CedulaP
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


CREATE TABLE Formatos(
	id_formato serial,
	nombre Nombres,
	tipo_formato_evaluacion int,
	primary key(id_formato)
);

CREATE TABLE Trabajos(
	id_tg serial unique ,
	cedula_tutor CedulaP,
	nroCorrelativo int not null,
	nroConsejo int,
	Fecha_presentacion Fecha,
	horaPresentacion time,
	fechaAprobacion	Fecha,
	primary key(id_tg, nroCorrelativo)
);

ALTER TABLE Trabajos
ADD CONSTRAINT FK_CedulaProfeTI
FOREIGN KEY (cedula_tutor)
REFERENCES INTERNOS(cedula_Profe);

ALTER TABLE Trabajos
ADD CONSTRAINT FK_Nro_Co
FOREIGN KEY (nroCorrelativo)
REFERENCES Propuestas(num_correlativo);


CREATE TABLE Instrumentales(
	Nro_correlativo int not null,
	nombreEmpresa  TextoM,
	tutorEmpresarial TextoM,
	primary key(Nro_correlativo)
);

ALTER TABLE Instrumentales
ADD CONSTRAINT FK_NroCorrel
FOREIGN KEY (Nro_correlativo)
REFERENCES Propuestas(num_correlativo);


CREATE TABLE Experimentales(
	Numr_correlativo int not null,
	profesorAvala Nombres,
	primary key(numr_correlativo)
);

ALTER TABLE Experimentales
ADD CONSTRAINT FK_NumrCorre
FOREIGN KEY (Numr_correlativo)
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

CREATE TABLE Tesistas(
	cedula CedulaP unique,
	nombre Nombres,
	correo_ucab mail unique,
	correo_part mail unique,
	telefono int not null,
	sexo char(1) not null,
	primary key(cedula)
);

CREATE INDEX ID_Correo_ucab
On Tesistas(correo_ucab);

CREATE INDEX ID_Correo_part
On Tesistas(correo_part); 

ALTER TABLE Tesistas
ADD CONSTRAINT CK_sexo
CHECK (sexo='M' or sexo='F');

CREATE TABLE Especialidades(
	id_especialidad serial,
	nombreEspecialidad Nombres,
	primary key(id_especialidad)
);

CREATE TABLE Formatos_TIG(
	id_formato int unique not null,
	num_correlativo int not null,
	resultado_revisor Notas,
	id_tg int not null,
	resul_jurado_tig1 Notas,
	resul_jurado_tig2 Notas,
	resul_tutor_tig Notas,
	resul_fina_tigl Notas
);

ALTER TABLE Formatos_TIG
ADD CONSTRAINT Fk_idformato
FOREIGN KEY(id_formato)
REFERENCES Formatos(id_formato);

ALTER TABLE Formatos_TIG
ADD CONSTRAINT Fk_numcorrelativo
FOREIGN KEY(num_correlativo)
REFERENCES Instrumentales(Nro_correlativo);

ALTER TABLE Formatos_TIG
ADD CONSTRAINT Fk_id_tg
FOREIGN KEY(id_tg)
REFERENCES TIG(id_tg);

CREATE TABLE Formatos_TEG(
	id_formato int unique not null,
	num_correlativo int not null,
	resultado_revisor Notas,
	id_tg int not null,
	resul_jurado_tig1 Notas,
	resul_jurado_tig2 Notas,
	resul_tutor_tig Notas,
	resul_fina_tigl Notas
);

ALTER TABLE Formatos_TEG
ADD CONSTRAINT Fk_idformato
FOREIGN KEY(id_formato)
REFERENCES Formatos(id_formato);

ALTER TABLE Formatos_TEG
ADD CONSTRAINT Fk_numcorrelativo
FOREIGN KEY(num_correlativo)
REFERENCES Experimentales(Numr_correlativo);

ALTER TABLE Formatos_TEG
ADD CONSTRAINT Fk_id_tg
FOREIGN KEY(id_tg)
REFERENCES TEG(id_tg);

CREATE TABLE Formato_Tutor_Tig(
    id_formato int
);

ALTER TABLE Formato_Tutor_Tig
ADD CONSTRAINT FK_IdformatoT
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE Formato_Tutor_Tig(
    id_formato int
);

ALTER TABLE Formato_Tutor_Tig
ADD CONSTRAINT FK_IdformatoTI
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE Formato_Tutor_Teg(
    id_formato int
);

ALTER TABLE Formato_Tutor_Teg
ADD CONSTRAINT FK_IdformatoTE
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE Formato_revisor_Tig(
    id_formato int
);

ALTER TABLE Formato_revisor_Tig
ADD CONSTRAINT FK_IdformatoTRI
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE Formato_revisor_Teg(
    id_formato int
);

ALTER TABLE Formato_revisor_Teg
ADD CONSTRAINT FK_IdformatoTRE
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE Formato_jurado_Tig(
    id_formato int
);

ALTER TABLE Formato_jurado_Tig
ADD CONSTRAINT FK_IdformatoTJI
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);

CREATE TABLE Formato_jurado_Teg(
    id_formato int
);

ALTER TABLE Formato_jurado_Teg
ADD CONSTRAINT FK_IdformatoTJE
FOREIGN KEY (id_formato)
REFERENCES Formatos(id_formato);



CREATE TABLE INTERNOS(
	cedula_Profe CedulaP,
	num_correlativo int not null,
	id_tg int not null,
	primary key(cedula_Profe)
);

ALTER TABLE INTERNOS
ADD CONSTRAINT FK_CedulaP
FOREIGN KEY(cedula_Profe)
REFERENCES Profesores(cedula_profe);

ALTER TABLE INTERNOS
ADD CONSTRAINT FK_NumCorrelativoP
FOREIGN KEY(num_correlativo)
REFERENCES Propuestas(num_correlativo);

ALTER TABLE INTERNOS
ADD CONSTRAINT FK_Idtg
FOREIGN KEY(id_tg)
REFERENCES Trabajos(id_tg);

CREATE TABLE EXTERNOS(
	cedula_Profe CedulaP,
	primary key(cedula_Profe)
);

ALTER TABLE EXTERNOS
ADD CONSTRAINT FK_CedulaP
FOREIGN KEY(cedula_Profe)
REFERENCES Profesores(cedula_profe);

CREATE TABLE Presentan(
	cedulaTesista CedulaP,
	nroCorrelativo int not null,
	primary key(cedulaTesista, nroCorrelativo)
);

ALTER TABLE Presentan
ADD CONSTRAINT FK_NroCorrel
FOREIGN KEY (nroCorrelativo)
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

CREATE TABLE Criterios_TIG(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato)
);

ALTER TABLE Criterios_TIG
ADD CONSTRAINT FK_Idformato
FOREIGN KEY (id_formato)
REFERENCES Formatos_TIG(id_formato);

CREATE TABLE Criterios_TEG(
	id_formato int not null,
	criterios TextoL,
	primary key(id_formato)
);

ALTER TABLE Criterios_TEG
ADD CONSTRAINT FK_Idformato
FOREIGN KEY (id_formato)
REFERENCES Formatos_TEG(id_formato);