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
    titulo VARCHAR(255),
    respuesta VARCHAR(10000),
    contador INT,
    preg_contestada BOOLEAN
);
INSERT INTO consultas (pregunta, titulo, respuesta, contador, preg_contestada) VALUES
-- datos de la escuela
('4','Datos','¿Cual dato te interesa saber? <br>11🔹Instagram. <br>12🔹Facebook. <br>13🔹Ubicacion de la escuela.<br>14🔹Telefono. <br>15🔹Historia. <br>16🔹Email. <br>17🔹Curiosidades. <br>18🔹Eventos. <br>45🔹AIC.',0,true),
('11','Instagram de la escuela','El instagram de la escuela es la.senillosa.eestn2.tandil.',0,true),
('12','Facebook de la escuela','El facebook de la escuela es felipe senillosa.',0,true),
('13','Ubicacion de la escuela','La escuela se encuentra en alem 285-tandil.',0,true),
('14','Telefono de la escuela','El telefono de la escuela es 0249-4442637/33',0,true),
('15','Historia de la escuela','La <b>EESTN 2</b>, en su momento llamada <b>ENET N°1</b>, surge primeramente de la conformación de dos escuelas:<br>la Escuela de Aprendizaje Industrial, que funcionaba en las calles Alem y Maipú; la Escuela Técnica de Oficios de la Nación, ubicada en el antiguo edificio de Las Heras y 9 de Julio.<br>La denominación que tenía en aquel momento, <b>Escuela Nacional de Educacion Técnica N°1 (ENET N°1) "Ing. Felipe Senillosa"</b>, era en honor a un luchador que siendo extranjero, dejó su vida en nuestra patria trabajando en varios ámbitos de Técnica con proyectos, comisiones, y trabajos personales en distintos lugares, siendo uno de ellos el Fuerte Independencia (Tandil).<br>En 1994, se implementó la Ley Federal N°24.195/92 y debido a esto la escuela pasa a la jurisdicción provincial y recibe la denominación de <b>Escuela de Educación Técnica N°2 (EEST N°2) "Ing. Felipe Senillosa"</b>. Pasó de tener los tres años del Plan de Estudios de Polimodal en el Turno Diurno y se unificó el 7mo de la Escuela Primaria con el primer y segundo año del Ciclo Básico. En el año 2005 se instituyó un bloque técnico de seis años de duración incorporando el Tercer Ciclo, con el nombre de Escuela de Enseñanza Básica.<br>En la actualidad se han ido aplicando diferentes leyes como la Ley de Educación Nacional 26.206, la Ley de Educación Provincial N°13.688 y la Ley de Educación Técnico Profesional N°26.058, las cuales han permitido transformar la escuela permitiéndole recuperar su identidad como formadora de Técnicos.<br>La escuela cuenta con una estructura curricular de 7 años, en donde el último año de formación específica esta orientado a las Prácticas Profesionalizantes y a familiarizar a los alumnos con el entorno socio productivo local. Además, posee con una amplia oferta educativa que involucra distintas orientaciones: Técnico en Electromecánica, Técnico en Automotores, Técnico en Química, Técnico en Maestro Mayor de Obras, Técnico en Informática y Técnico en Programación en turno diurno, y Técnico en Electromecánica, Técnico en Electrónica y Técnico en Maestro Mayor de Obras en turno nocturno. La institucion cuenta con una planta permanente de 604 Docentes, y una matrícula aproximada de 1600 alumnos. Nos caracterizamos por ser una Institución abierta y en constante nexo con nuestra comunidad y con el ámbito socio productivo local, lo que convierte a la educación técnica en una oferta educativa única como herramienta de inclusión social.',0,true),
('16','Email de la escuela','El Email de la escuela es eestn2tandil@abc.gob.ar.',0,true),
('17','Curiosidades','¡Buena pregunta! en promedio a nuestra escuela asisten 1600 alumnos por año.',0,true),
('18','Eventos','Para saber de eventos de la escuela podes acceder a  <a href="https://www.tecnica2tandil.edu.ar/">eventos</a>.',0,true),
('45','AIC','Los acuerdos institucionales de convincia son <a href="https://docs.google.com/document/d/1EJvQubwWBxS9QKUejjeQpXxYILq6pb_e/edit?usp=sharing&ouid=104687024282677061291&rtpof=true&sd=true">AIC</a>.',0,true),
-- orientaciones
('orientaciones','Asignacion','las orientacion que hay son: <br>5🔹Programación. <br>6🔹Informatica. <br>7🔹Quimica. <br>8🔹Maestro mayor de obra. <br>9🔹Automotores. <br>10🔹Electrómecanica.',0,true),
('2','Orientaciones','las orientacion que se pueden estudiar aqui son: <br>5🔹Programación. <br>6🔹Informatica. <br>7🔹Quimica. <br>8🔹Maestro mayor de obra. <br>9🔹Automotores.<br>10🔹Electrómecanica.',0,true),
('carreras','Carreras','las carreras que podes elegir son:<br>5🔹Programación. <br>6🔹Informatica. <br>7🔹Quimica. <br>8🔹Maestro mayor de obra. <br>9🔹Automotores. <br>10🔹Electrómecanica.',0,true),
-- maestro mayor de obra (MMO)
('MMO',' Carrera MMO','La orientación en Maestro Mayor de Obra (MMO) tiene como objetivo formar profesionales competentes en la supervisión y coordinación de proyectos de construcción. A lo largo de su formación, los estudiantes adquieren conocimientos especializados en planificación, control de costos y gestión de recursos en el contexto de la construcción. ¿Te gustaria esta info. sobre la orientacion?: <br>19🔹Salidas laborales MMO. <br>20🔹Materias MMO.',0,true),
('8','MMO','La orientación en Maestro Mayor de Obra (MMO) tiene como objetivo formar profesionales competentes en la supervisión y coordinación de proyectos de construcción. A lo largo de su formación, los estudiantes adquieren conocimientos especializados en planificación, control de costos y gestión de recursos en el contexto de la construcción. ¿Te gustaria esta info. sobre la orientacion?: <br>19🔹Salidas laborales MMO. <br>20🔹Materias MMO.',0,true),
('19','Salidas laborales MMO','Las salidas laborales para los graduados de esta orientación son variadas. Pueden desempeñarse como supervisores de obras en estudios de arquitectura, trabajar en empresas constructoras liderando proyectos o establecerse como profesionales independientes en el ámbito de la construcción.',0,true),
('20','Materias MMO','Entre las materias destacadas en esta orientación se incluyen Planificación de Obras, que aborda la elaboración de cronogramas y presupuestos, Control de Costos, centrada en la gestión eficiente de los recursos financieros, y Gestión de Proyectos de Construcción, que prepara a los estudiantes para liderar proyectos desde su concepción hasta su finalización.',0,true),
-- quimica
('quimica','Carrera Quimica','La orientación en Química de nuestra escuela tiene como objetivo proporcionar a los estudiantes una sólida formación en química industrial y de laboratorio. A lo largo de su formación, los estudiantes exploran conceptos clave en química analítica, química orgánica y operaciones unitarias. Aqui te dejo un poco mas de info. por si te interesa: <br>21🔹Salidas laborales quimica. <br>22🔹Materias quimica.',0,true),
('7','Quimica','La orientación en Química de nuestra escuela tiene como objetivo proporcionar a los estudiantes una sólida formación en química industrial y de laboratorio. A lo largo de su formación, los estudiantes exploran conceptos clave en química analítica, química orgánica y operaciones unitarias. Aqui te dejo un poco mas de info. por si te interesa: <br>21🔹Salidas laborales quimica. <br>22🔹Materias quimica.',0,true),
('21','Salidas laborales quimica','Las salidas laborales son diversas y abarcan campos como la investigación, la producción de productos químicos y el control de calidad. Los graduados pueden encontrar empleo en laboratorios de investigación, plantas industriales químicas o empresas relacionadas con la química.',0,true),
('22','Materias quimica','Entre las materias destacadas en esta orientación se encuentran Química Analítica, que se centra en las técnicas analíticas y de medición, Química Orgánica, que explora los compuestos orgánicos y sus reacciones, y Operaciones Unitarias, que aborda los procesos químicos a nivel industrial.',0,true),
-- informatica
('informatica','Carrera Informatica','La orientación en Informática de nuestra escuelas ofrece a los estudiantes una formación integral en hardware, software y redes. A lo largo de su formación, los alumnos exploran temas clave como arquitectura de computadoras, redes de computadoras y sistemas operativos. ¿Te interesa esto?: <br>23🔹Salidas laborales informatica. <br>24🔹Materias informatica.',0,true),
('6','Informatica','La orientación en Informática de nuestra escuelas ofrece a los estudiantes una formación integral en hardware, software y redes. A lo largo de su formación, los alumnos exploran temas clave como arquitectura de computadoras, redes de computadoras y sistemas operativos. ¿Te interesa esto?: <br>23🔹Salidas laborales informatica. <br>24🔹Materias informatica.',0,true),
('23','Salidas laborales informatica','Las salidas laborales para los graduados de esta orientación son diversas y abarcan desde empresas de tecnología hasta departamentos de tecnología de la información (TI) en diversas organizaciones. Los profesionales pueden desempeñarse como técnicos de sistemas, administradores de redes, programadores o especialistas en seguridad informática.',0,true),
('24','Materias informatica','Entre las materias destacadas en esta orientación se encuentran Arquitectura de Computadoras, que explora los componentes y el diseño de sistemas informáticos, Redes de Computadoras que aborda la conectividad y comunicación entre dispositivos, y Sistemas Operativos, que se centra en el software que gestiona los recursos de un sistema informático.',0,true),
-- automotores
('automotores','Carrera Automotores','La orientación en Automotores de nuestra escuelas se centra en la formación de profesionales especializados en el mantenimiento y la reparación de vehículos. A lo largo de su formación, los estudiantes adquieren habilidades en el diagnóstico de fallas, la reparación de motores y sistemas eléctricos. ¿Te gustaria saber algo de esto?: <br>25🔹Salidas laborales automotor<br>26🔹Materias automotor.',0,true),
('9','Automotores','La orientación en Automotores de nuestra escuelas se centra en la formación de profesionales especializados en el mantenimiento y la reparación de vehículos. A lo largo de su formación, los estudiantes adquieren habilidades en el diagnóstico de fallas, la reparación de motores y sistemas eléctricos. ¿Te gustaria saber algo de esto?: <br>25🔹Salidas laborales automotor<br>26🔹Materias automotor.',0,true),
('25','Salidas laborales automotores','Las salidas laborales para los graduados de esta orientación son variadas y pueden incluir el trabajo en talleres mecánicos, concesionarios de automóviles o como emprendedores independientes en el sector automotriz. Los profesionales pueden ofrecer servicios de mantenimiento, reparación y asesoramiento técnico especializado.',0,true),
('26','Materias automotores','Entre las materias destacadas en esta orientación se encuentran Mecánica Automotriz, que aborda los principios fundamentales de la mecánica de vehículos, Sistemas de Transmisión, que explora los componentes relacionados con la transmisión de fuerza en los automóviles, y Electrónica Automotriz, que se centra en los sistemas eléctricos y electrónicos de los vehículos.',0,true),
-- programacion
('programacion','Carrera Programacion','La orientación en Programación de nuestra escuela se centra en proporcionar a los estudiantes habilidades avanzadas en el desarrollo de software. Durante el curso de sus estudios, los alumnos se sumergen en el aprendizaje de lenguajes de programación esenciales como Java, C++ y Python, así como en el diseño de algoritmos y estructuras de datos. Este enfoque exhaustivo permite a los estudiantes adquirir una comprensión profunda de los principios fundamentales de la programación.¿Te interesa esta otra informacion?: <br>27🔹Salidas laborales programacion. <br>28🔹Materias programacion.',0,true),
('5','Programacion','La orientación en Programación de nuestra escuela se centra en proporcionar a los estudiantes habilidades avanzadas en el desarrollo de software. Durante el curso de sus estudios, los alumnos se sumergen en el aprendizaje de lenguajes de programación esenciales como Java, C++ y Python, así como en el diseño de algoritmos y estructuras de datos. Este enfoque exhaustivo permite a los estudiantes adquirir una comprensión profunda de los principios fundamentales de la programación.¿Te interesa esta otra informacion?: <br>27🔹Salidas laborales programacion. <br>28🔹Materias programacion.',0,true),
('27','Salidas laborales programacion','Las salidas laborales para aquellos que eligen esta orientación son diversas. Los graduados pueden desempeñarse como programadores en empresas de tecnología, participar en proyectos de desarrollo de software o incluso emprender sus propios proyectos como desarrolladores independientes.',0,true),
('28','Materias programacion','Entre las materias destacadas en esta orientación se encuentran Programación Avanzada, donde se exploran conceptos más complejos y desafiantes, Diseño de Algoritmos, que enfatiza la importancia de estructuras de datos eficientes, y Desarrollo Web, que abarca la creación de aplicaciones y sitios web interactivos.',0,true),
-- electromecanica
('10','Electro','La orientación en Electromecánica de nuestra escuela tiene como objetivo formar profesionales capacitados en la integración de sistemas eléctricos y mecánicos. A lo largo de su formación, los estudiantes adquieren habilidades en el mantenimiento, reparación y diseño de sistemas electromecánicos. ¿Te interesa algo de esto?: <br>29🔹Salidas laborales electro. <br>30🔹Materias electro.',0,true),
('electro','Carrera Electro','La orientación en Electromecánica de nuestra escuela tiene como objetivo formar profesionales capacitados en la integración de sistemas eléctricos y mecánicos. A lo largo de su formación, los estudiantes adquieren habilidades en el mantenimiento, reparación y diseño de sistemas electromecánicos. ¿Te interesa algo de esto?: <br>29🔹Salidas laborales electro. <br>30🔹Materias electro.',0,true),
('29','Salidas laborales electro','Las salidas laborales para los graduados de esta orientación son diversas, abarcando la industria manufacturera, la automatización industrial y el mantenimiento de maquinaria. Los profesionales pueden desempeñarse como técnicos especializados en el área electromecánica, brindando soluciones a problemas complejos en sistemas integrados.',0,true),
('30','Materias electro','Entre las materias destacadas en esta orientación se incluyen Control Automático, que explora técnicas para la automatización de procesos, Máquinas y Equipos Eléctricos, que se centra en el funcionamiento de dispositivos electromecánicos, y Sistemas Hidráulicos y Neumáticos, que aborda la aplicación de fluidos en sistemas mecánicos.',0,true),
-- años y ciclos
('ciclo basico','Ciclo basico','El ciclo basico técnico tiene una duracion de tres años y tiene una Formación Técnica Específica la cual esta comprendida por los saberes del mundo del trabajo, el conocimiento del sistema socio-productivo local, la formacion ciudadana y la adquisicion de saberes en lo que respecta a la produccion de conocimientos cientificos y tecnologicos. Una de las características principales de la Formación Específica en el ciclo Básico es favorecer el desarrollo de capacidades que resultarán necesarias en las diferentes tecnicaturas que el alumno pueda elegir en el ciclo superior.',0,true),
('ciclo superior','Ciclo superior','El ciclo superior tiene una duracion de cuatro años y posee la modalidad de Educación Técnico Profesional en donde se definen las tecnicaturas. Cada una de estas orientaciones posee una Formacion cientifico-tecnologica, la cual tiene que ver con diferentes saberes que otorgan conocimientos, habilidades, destrezas y valores. Esta organizada en modulos y su funcion es comprender, integrar y profundizar los contenidos que introducen a los aspectos específicos de cada especialidad. El ciclo superior técnico cambia drásticamente su estructura curricular en las materias técnico-especificas, o talleres, dependiendo de la tecnicatura que te encuentres cursando.',0,true),
('1° año','Primer año','El primer año de la Educación Secundaria Técnica consta de formación general y formación científico tecnológica, y se divide en 8 materias: Ciencias Naturales, Ciencias Sociales, Educación Artística, Educación Física, Inglés, Matemática, Prácticas del Lenguaje y Construcción Ciudadana. La cantidad total de módulos semanales en el primer año es de 24. Dentro de la formación científico-tecnológica se dictan tres materias: Procedimientos Técnicos, Lenguajes Tecnológicos y Sistemas Tecnológicos, cada una con una carga horaria anual de 72 horas, y con 6 módulos semanales.',0,true),
('2° año','Segundo año','El segundo año de la Educación Secundaria Técnica incluye ocho asignaturas en el área de Formación General, con cuatro módulos semanales cada una, con materias como Biología, Construcción de Ciudadanía, Educación Artística, Educación Física, Físico Química, Geografía, Historia, Matemática, Prácticas del Lenguaje, e Inglés. La cantidad total de módulos semanales del segundo año es de 24. El segundo año de la Educación Secundaria Técnica incluye tres materias técnico-específicas: Procedimientos Técnicos, Lenguajes Tecnológicos y Sistemas Tecnológicos, con un total de ocho módulos semanales. Procedimientos Técnicos se vuelve el área con más horas con 144, el resto de materias continua con 72 horas.',0,true),
('3° año','Tercer año','El tercer año de la Educación Secundaria Técnica incluye ocho asignaturas en el área de Formación General, con cuatro módulos semanales cada una, con materias como Biología, Construcción de Ciudadanía, Educación Artística, Educación Física, Físico Química, Geografía, Historia, Inglés, Matemática, y Prácticas del Lenguaje. Dentro de la formación científico-tecnológica se repiten las tres materias: Procedimientos Técnicos, Lenguajes Tecnológicos y Sistemas Tecnológicos, en este año Sistemas Tecnológicos se amplía con 144 horas anuales, el resto se mantiene en 72. La cantidad total de módulos semanales es de 8.',0,true),
('4° año','Cuarto año','El cuarto año técnico contiene materias curriculares como Literatura, Ingles, Salud y Adolescencia, Historia, Geogafría, y Educación Física. Cada una de estas tiene una carga de 72 horas anuales. Siguiendo con las diferentes materias, debemos agregar las materias científico-tecnológicas: Matemática, Física, Química.',0,true),
('5° año','Quinto año','En el quinto año técnico podemos ver materias de formación general como Literatura, Inglés, Politica y Ciudadanía, Historia, Geografía, y Educación Física. Todas estas poseen una carga horaria de 72 horas anuales. Junto con estas, también apreciamos Análisis Matemático, como materia de formación científico-tecnológica, con una carga horaria de 144 horas.',0,true),
('6° año','Sexto año','En este sexto año técnico, veremos materias curriculares como Literatura, Inglés, Educación Física, Filosofía, y Arte. Todas estas cuentas con un total de 72 horas anuales. En este año contamos a su vez con una materia correspondiente a las materias científico-específicas: Matemática Aplicada. Con una carga de 72 horas.',0,true),
('7° año','Septimo año','Este séptimo año técnico, es, sin lugar a duda, el más importante que podemos apreciar. Ya que en este año se lleva a cabo el famoso "proyecto final", donde se ponen a prueba los contenidos aprendidos en cada tecnicatura. Los proyectos suelen hacerse, cómo máximo, de 4 personas, pero puede haber situaciones excepcionales donde se pueda extender el máximo por uno o dos integrantes más. La única materia curricular que vemos son las Prácticas Profesionalizantes, las cuales deben cumplir un total de 200 horas anuales.',0,true),
-- preguntas corrientes
('hola','Hola','Hola, mucho gusto, ¿en que te puedo ayudar hoy? si quieres revisa las preguntas mas frecuentes que los alumnos preguntan en el menu o escribi menu en el chat.',0,true),
('como estas','Como estas','¿Y tu?, recuerda que puedes ayudarte con las preguntas usando el buscador en la barra donde escribes.',0,true),
('buenos dias','Buenos dias','Buen dia a ti tambien, espero que tengas un excelente dia.',0,true),
('nos vemos','Nos vemos','gracias por consultar, vuelva pronto',0,true),
('adios','Adios','¡nos vemos!',0,true),
('gracias','Gracias','Gracias a ti por elegirme.',0,true),
('si','Si','Ok.',0,true),
('no','No','Ok.',0,true),
-- ubicaciones de la escuela
('ubicaciones','Ubicaciones','¿Que lugar estas buscando? <br>31🔹Baños. <br>32🔹Preceptoria. <br>33🔹Biblioteca. <br>34🔹Sala de proyecciones. <br>35🔹Laboratorios. <br>36🔹Direccion. <br>37🔹Taller.',0,true),
('3','Ubicaciones','¿Que lugar estas buscando? <br>31🔹Baños. <br>32🔹Preceptoria. <br>33🔹Biblioteca. <br>34🔹Sala de proyecciones. <br>35🔹Laboratorios. <br>36🔹Direccion. <br>37🔹Taller.',0,true),
('31','Baños','Los baños de hombres estan en la planta baja, entre la escaleras y el ascensor, otro esta en el segundo piso en frente de preceptoria, otro esta al fondo del zoom hacia la izquierda, al lado del patio y otro en el gimnasio y el de mujeres esta en el primer piso en frente de preceptoria.',0,true),
('32','Preceptoria','Hay una preceptoria en la esquina de el primer y segundo piso, una preceptoria de quimica en el pasillo interior del primer piso, junto a la sala de proyecciones y la preceptoria de taller en la planta baja, ubicada bajando las escaleras que estan al lado de la entrada principal.',0,true),
('33','Biblioteca','La biblioteca se ubica en la planta baja, a la izquierda de la entrada ¿Te gustaria leer un libro en especifico?.',0,true),
('34','Sala de proyecciones','La sala de proyecciones se encuentra en el pasillo interior(al fondo) en el primer piso junto a la preceptoria de quimica y los laboratorio. en ella se pueden mirar peliculas, documentales o alguna charla en especifico.',0,true),
('35','Laboratorios','Los laboratorios de quimica se encuentran, dos en el primer piso en el pasillo interno, y otro en la planta baja al lado de la biblioteca, ¡hora de hacer experimentos! y los de informatica estan todos en el segundo piso al lado de preceptoria.',0,true),
('36','Direccion','La sala de direccion se encuentra en la planta baja en el pasillo que esta al lado del ascensor, tambien esta la secretaria, la vicedireccion, etc.',0,true),
('37','Taller','¿Que salon de taller no encontras? <br>38🔹Gimnasio. <br>39🔹Fundicion. <br>40🔹Torneria. <br>41🔹Carpinteria. <br>42🔹Hojalateria. <br>43🔹Electricidad. <br>44🔹Dibujo tecnico.',0,true),
('38','Gimnasio','El gimnasio queda arriba del todo, subiendo las escaleras que estan al fondo del zoom. Mi deporte favorito es el futbol aunque no lo pueda jugar, es apasionante.',0,true),
('39','Fundicion','La sala de fundicion se ubica bajando las escaleras que se encuentran al fondo del zoom, junto a fundicion esta carpinteria y construccion. Aqui se funden metales y se crean piezas de metal que los alumnos se pueden llevar, solo esta en 1° año.',0,true),
('40','Torneria','Torneria se encuentra subiendo las escaleras al final del patio interior, junto a este esta hojalateria. Aqui los alumnos usan el torno y como proyecto haran un bate de baseball, ¿sabias que antes hacian un cañon en vez de un bate?.',0,true),
('41','Carpinteria','Carpinteria se encuentra bajando las escaleras en la zona de taller, esta al lado de construccion y fundicion. Aqui los chicos y chicas de 1°año van a poder crear un guarda llaves, una percha y con suerte una tabla de picar, en 2°año van a hacer un banco ¡que emocionante!',0,true),
('42','Hojalateria','Hojalateria se encuentra junto a torneria subiendo las escaleras de taller. Aqui los alumnos en 1°año trabajan haciendo una palita que se pueden llevar a casa, eso si se va a oxidar con los años, jaja y en 2°año van a crear una cajita de herramientas ¡que divertido!',0,true),
('43','Electricidad','La sala de electicidad queda subiendo las escaleras que se encuentran al fondo del zoom. Aqui las chicos y los chicos van a aprender teoria sobre la electricidad y a conectar cables, hacer funcionar focos y teclas y mucho mas, ¡electrizante!',0,true),
('44','Salones','Los salones de dibujo tecnico estan en el ultimo piso, a ellos se pueden acceder suubiendo las escaleras del sector de teoria. Aqui trabajaran en mesas de dibujo haciendo planos junto a sus escuadras y su regla T.',0,true),
-- otros
('1','menu','El menu que tenemos es: <br>2🔹Orientaciones. <br>3🔹Ubicaciones. <br>4🔹Datos.',0,true),
('menu','opciones','El menu que tenemos es: <br>2🔹Orientaciones. <br>3🔹Ubicaciones. <br>4🔹Datos.',0,true),
('tus Creadores','tus creadores','Los alumnos que programaron este proyecto fueron de 7°i programacion generacion 2025, Leonardo Ojeda, Alexis Mansilla y Andres Ojeda.',0,true),
('quienes te programaron','Tus programadores','Los alumnos que me programaron fueron de 7°i programacion generacion 2025, Leonardo Ojeda, Alexis Mansilla y Andres Ojeda.',0,true),
('año de tu creacion','Año de tu creacion','Mi año de crecion fue en 2025 por parte de unos alumnos para su proyecto final.',0,true);

CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT, 
    nombre VARCHAR (255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL
);
INSERT INTO usuarios (nombre, contraseña) VALUES
('admin','$2y$10$ii3gwTc.hAajUTXhNVtPrucn6VquM0a1sK5hLjJmeiDXvNZyDMqMO');

CREATE TABLE historial (
  id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT,
  id_consulta INT,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
  FOREIGN KEY (id_consulta) REFERENCES consultas(id_consulta)
);

ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;