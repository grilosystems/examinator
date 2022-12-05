-- Cambios en la base de datos por Marco Puga 10/Junio/2014
-- GriloSystems.com

-- Modificación para el largo de preguntas en la base de datos
alter table examinator.pregunta change column pregunta `pregunta` varchar(5000) NOT NULL;

-- Tabla para modificación del slogan
use examinator;
create table `Configsystem`
(
	idConfig integer unique primary key not null auto_increment,
    descripcion VARCHAR(100),
    titulo VARCHAR(500) not null,
	slogantxt VARCHAR(100) not null,
	imagenjpg VARCHAR(100) not null
);

-- Modificación para el largo de correo electronico
alter table examinator.usuarios change column correo_usuario `correo_usuario` varchar(300) NOT NULL;

-- Modificación para agregar bit de super usuario
-- Donde los usuarios con el bit en 1 en este campo es superusuario
ALTER TABLE examinator.usuarios ADD tipo_usuario int not null; 

-- Agregación de la columna respuestas a la tabla respexam
alter table examinator.respexam add column respuestas varchar(100) not null;

-- Cambio a de tipo Time a varchar a la columna tiempo_final
alter table examinator.respexam change column tiempo_final `tiempo_final` varchar(10) not null;

-- Agregación de la columna status_examinado en la tabla examinado para baja logica
alter table examinator.examinado add column status_examinado int not null default 1;

-- Modificación a el campo curp_examinado que sea unico
ALTER TABLE examinator.examinado ADD UNIQUE INDEX `curp_examinado_UNIQUE` (`curp_examinado` ASC);