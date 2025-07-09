-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2025 a las 23:30:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS ia;
USE ia;

CREATE TABLE consultas (
    id_consulta INT PRIMARY KEY AUTO_INCREMENT,
    pregunta VARCHAR(255),
    respuesta VARCHAR(10000)
);
INSERT INTO consultas (pregunta, respuesta) VALUES
('ubicacion de la escuela', 'La escuela se encuentra en alem'),
('orientaciones', 'las orientacion que hay son Electrómecanica, Programación, informatica, quimica, maestro mayor de obra y automotores'),
('historia de la escuela','La EESTN 2, en su momento llamada ENET N°1, surge primeramente de la conformación de dos escuelas: la Escuela de Apredizaje Industrial, que funcionaba en las calles Alem y Maipú; la Escuela Técnica de Oficios de la Nación, ubicada en el antiguo edificio de Las Heras y 9 de Julio. La denominación que tenía en aquel momento, Escuela Nacional Técnica N°1 "Ing. Felipe Senillosa", era en honor a un luchador que siendo extranjero, dejó su vida en nuestra patria trabajando en varios ámbitos de Técnica con proyectos, comisiones, y trabajos personales en distintos lugares, siendo uno de ellos el Fuerte Independencia (Tandil). En 1994, se impplementó la Ley Federal N°24.195/92 y debido a esto la escuela pasa a la jurisdicción provincial y recibe la denominación de Escuela de Educación Técnica N°2 "Ing. Felipe Senillosa". Pasó de tener los tres años del Plan de Estudios de Polimodal en el Turno Diurno y se unificó el 7mo de la Escuela Primaria con el primer y segundo año del Ciclo Básico. En el año 2005 se instituyó un bloque técnico de seis años de duración incorporando el Tercer Ciclo, con el nombre de Escuela de Enseñanza Básica. En la actualidad se han ido aplicando diferentes leyes como la Ley de Educación Nacional 26.206, la Ley de Educación Provincial N°13.688 y la Ley de Educación Técnico Profesional N°26.058, las cuales han permitido transformar la escuela permitiéndole recuperar su identidad como formadora de Técnicos. La escuela cuenta con una estructura curricular de 7 años, en donde el último año de formación específica esta orientado a las Prácticas Profesionalizantes y a familiarizar a los alumnos con el entorno socio productivo local. Además, posee con una amplia oferta educativa que involucra distintas orientaciones: Técnico en Electromecánica, Técnico en Automotores, Técnico en Química, Técnico en Maestro Mayor de Obras, Técnico en Informática y Técnico en Programación en turno diurno, y Técnico en Electromecánica, Técnico en Electrónica y Técnico en Maestro Mayor de Obras en turno nocturno. La institucion cuenta con una planta permanente de 604 Docentes, y una matrícula aproximada de 1600 alumnos. Nos caracterizamos por ser una Institución abierta y en constante nexo con nuestra comunidad y con el ámbito socio productivo local, lo que convierte a la educación técnica en una oferta educativa única como herramienta de inclusión social.'),
('tus creadores','los alumnos leonaro ojeda, alexis mansilla y el honorable andres ojeda'),
('año de tu creacion','2025');



CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255),
    email VARCHAR(255),
    contraseña VARCHAR(255)
);
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;