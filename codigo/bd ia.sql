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
    respuesta VARCHAR(10000),
    contador INT,
    preg_contestada BOOLEAN
);
INSERT INTO consultas (pregunta, respuesta, contador, preg_contestada) VALUES
-- datos de la escuela
('instagram de la escuela','la.senillosa.eestn2.tandil, ¿sabias que la escuela tambien tiene facebook?',0,true),
('facebook de la escuela','felipe senillosa',0,true),
('ubicacion de la escuela', 'La escuela se encuentra en alem 285-tandil',0,true),
('telefono de la escuela','0249-4442637/33',0,true),
('cuantos alumnos van a la escuela','!buena pregunta¡ en promedio a nuestra escuela asisten 1700 alumnos por año',0,true),
('email de la escuela','eestn2tandil@abc.gob.ar',0,true),
('historia de la escuela','La EESTN 2, en su momento llamada ENET N°1, surge primeramente de la conformación de dos escuelas: la Escuela de Apredizaje Industrial, que funcionaba en las calles Alem y Maipú; la Escuela Técnica de Oficios de la Nación, ubicada en el antiguo edificio de Las Heras y 9 de Julio. La denominación que tenía en aquel momento, Escuela Nacional Técnica N°1 "Ing. Felipe Senillosa", era en honor a un luchador que siendo extranjero, dejó su vida en nuestra patria trabajando en varios ámbitos de Técnica con proyectos, comisiones, y trabajos personales en distintos lugares, siendo uno de ellos el Fuerte Independencia (Tandil). En 1994, se impplementó la Ley Federal N°24.195/92 y debido a esto la escuela pasa a la jurisdicción provincial y recibe la denominación de Escuela de Educación Técnica N°2 "Ing. Felipe Senillosa". Pasó de tener los tres años del Plan de Estudios de Polimodal en el Turno Diurno y se unificó el 7mo de la Escuela Primaria con el primer y segundo año del Ciclo Básico. En el año 2005 se instituyó un bloque técnico de seis años de duración incorporando el Tercer Ciclo, con el nombre de Escuela de Enseñanza Básica. En la actualidad se han ido aplicando diferentes leyes como la Ley de Educación Nacional 26.206, la Ley de Educación Provincial N°13.688 y la Ley de Educación Técnico Profesional N°26.058, las cuales han permitido transformar la escuela permitiéndole recuperar su identidad como formadora de Técnicos. La escuela cuenta con una estructura curricular de 7 años, en donde el último año de formación específica esta orientado a las Prácticas Profesionalizantes y a familiarizar a los alumnos con el entorno socio productivo local. Además, posee con una amplia oferta educativa que involucra distintas orientaciones: Técnico en Electromecánica, Técnico en Automotores, Técnico en Química, Técnico en Maestro Mayor de Obras, Técnico en Informática y Técnico en Programación en turno diurno, y Técnico en Electromecánica, Técnico en Electrónica y Técnico en Maestro Mayor de Obras en turno nocturno. La institucion cuenta con una planta permanente de 604 Docentes, y una matrícula aproximada de 1600 alumnos. Nos caracterizamos por ser una Institución abierta y en constante nexo con nuestra comunidad y con el ámbito socio productivo local, lo que convierte a la educación técnica en una oferta educativa única como herramienta de inclusión social.',0,true),
-- orientaciones
('orientaciones','las orientacion que hay son:<br>.Electrómecanica <br>.Programación <br>.informatica <br>.quimica <br>.maestro mayor de obra <br>.automotores.',0,true),
('carreras','las orientacion que hay son:<br>.Electrómecanica <br>.Programación, .informatica <br>.quimica <br>.maestro mayor de obra <br>automotores.',0,true),
('maestro mayor de obra','La orientación en Maestro Mayor de Obra (MMO) tiene como objetivo formar profesionales competentes en la supervisión y coordinación de proyectos de construcción. A lo largo de su formación, los estudiantes adquieren conocimientos especializados en planificación, control de costos y gestión de recursos en el contexto de la construcción. Las salidas laborales para los graduados de esta orientación son variadas. Pueden desempeñarse como supervisores de obras en estudios de arquitectura, trabajar en empresas constructoras liderando proyectos o establecerse como profesionales independientes en el ámbito de la construcción. Entre las materias destacadas en esta orientación se incluyen Planificación de Obras, que aborda la elaboración de cronogramas y presupuestos, Control de Costos, centrada en la gestión eficiente de los recursos financieros, y Gestión de Proyectos de Construcción, que prepara a los estudiantes para liderar proyectos desde su concepción hasta su finalización.',0,true),
('quimica','La orientación en Química de nuestra escuela tiene como objetivo proporcionar a los estudiantes una sólida formación en química industrial y de laboratorio. A lo largo de su formación, los estudiantes exploran conceptos clave en química analítica, química orgánica y operaciones unitarias. Las salidas laborales son diversas y abarcan campos como la investigación, la producción de productos químicos y el control de calidad. Los graduados pueden encontrar empleo en laboratorios de investigación, plantas industriales químicas o empresas relacionadas con la química. Entre las materias destacadas en esta orientación se encuentran Química Analítica, que se centra en las técnicas analíticas y de medición, Química Orgánica, que explora los compuestos orgánicos y sus reacciones, y Operaciones Unitarias, que aborda los procesos químicos a nivel industrial.',0,true),
('informatica','La orientación en Informática de nuestra escuelas ofrece a los estudiantes una formación integral en hardware, software y redes. A lo largo de su formación, los alumnos exploran temas clave como arquitectura de computadoras, redes de computadoras y sistemas operativos. Las salidas laborales para los graduados de esta orientación son diversas y abarcan desde empresas de tecnología hasta departamentos de tecnología de la información (TI) en diversas organizaciones. Los profesionales pueden desempeñarse como técnicos de sistemas, administradores de redes, programadores o especialistas en seguridad informática. Entre las materias destacadas en esta orientación se encuentran Arquitectura de Computadoras, que explora los componentes y el diseño de sistemas informáticos, Redes de Computadoras que aborda la conectividad y comunicación entre dispositivos, y Sistemas Operativos, que se centra en el software que gestiona los recursos de un sistema informático.',0,true),
('automotores','La orientación en Automotores de nuestra escuelas se centra en la formación de profesionales especializados en el mantenimiento y la reparación de vehículos. A lo largo de su formación, los estudiantes adquieren habilidades en el diagnóstico de fallas, la reparación de motores y sistemas eléctricos. Las salidas laborales para los graduados de esta orientación son variadas y pueden incluir el trabajo en talleres mecánicos, concesionarios de automóviles o como emprendedores independientes en el sector automotriz. Los profesionales pueden ofrecer servicios de mantenimiento, reparación y asesoramiento técnico especializado. Entre las materias destacadas en esta orientación se encuentran Mecánica Automotriz, que aborda los principios fundamentales de la mecánica de vehículos, Sistemas de Transmisión, que explora los componentes relacionados con la transmisión de fuerza en los automóviles, y Electrónica Automotriz, que se centra en los sistemas eléctricos y electrónicos de los vehículos.',0,true),
-- programacion
('programacion','La orientación en Programación de nuestra escuela se centra en proporcionar a los estudiantes habilidades avanzadas en el desarrollo de software. Durante el curso de sus estudios, los alumnos se sumergen en el aprendizaje de lenguajes de programación esenciales como Java, C++ y Python, así como en el diseño de algoritmos y estructuras de datos. Este enfoque exhaustivo permite a los estudiantes adquirir una comprensión profunda de los principios fundamentales de la programación. .',0,true),
('salidas laborales programacion','Las salidas laborales para aquellos que eligen esta orientación son diversas. Los graduados pueden desempeñarse como programadores en empresas de tecnología, participar en proyectos de desarrollo de software o incluso emprender sus propios proyectos como desarrolladores independientes.',0,true),
('materias programacion','Entre las materias destacadas en esta orientación se encuentran Programación Avanzada, donde se exploran conceptos más complejos y desafiantes, Diseño de Algoritmos, que enfatiza la importancia de estructuras de datos eficientes, y Desarrollo Web, que abarca la creación de aplicaciones y sitios web interactivos.',0,true),
-- electromecanica
('electromecanica','La orientación en Electromecánica de nuestra escuela tiene como objetivo formar profesionales capacitados en la integración de sistemas eléctricos y mecánicos. A lo largo de su formación, los estudiantes adquieren habilidades en el mantenimiento, reparación y diseño de sistemas electromecánicos.',0,true),
('salida laboral electro','Las salidas laborales para los graduados de esta orientación son diversas, abarcando la industria manufacturera, la automatización industrial y el mantenimiento de maquinaria. Los profesionales pueden desempeñarse como técnicos especializados en el área electromecánica, brindando soluciones a problemas complejos en sistemas integrados.',0,true),
('materias electro','Entre las materias destacadas en esta orientación se incluyen Control Automático, que explora técnicas para la automatización de procesos, Máquinas y Equipos Eléctricos, que se centra en el funcionamiento de dispositivos electromecánicos, y Sistemas Hidráulicos y Neumáticos, que aborda la aplicación de fluidos en sistemas mecánicos.',0,true),
-- años y ciclos
('ciclo basico','El ciclo basico técnico tiene una duracion de tres años y tiene una Formación Técnica Específica la cual esta comprendida por los saberes del mundo del trabajo, el conocimiento del sistema socio-productivo local, la formacion ciudadana y la adquisicion de saberes en lo que respecta a la produccion de conocimientos cientificos y tecnologicos. Una de las características principales de la Formación Específica en el ciclo Básico es favorecer el desarrollo de capacidades que resultarán necesarias en las diferentes tecnicaturas que el alumno pueda elegir en el ciclo superior.',0,true),
('ciclo superior','El ciclo superior tiene una duracion de cuatro años y posee la modalidad de Educación Técnico Profesional en donde se definen las tecnicaturas. Cada una de estas orientaciones posee una Formacion cientifico-tecnologica, la cual tiene que ver con diferentes saberes que otorgan conocimientos, habilidades, destrezas y valores. Esta organizada en modulos y su funcion es comprender, integrar y profundizar los contenidos que introducen a los aspectos específicos de cada especialidad. El ciclo superior técnico cambia drásticamente su estructura curricular en las materias técnico-especificas, o talleres, dependiendo de la tecnicatura que te encuentres cursando.',0,true),
('1° año','El primer año de la Educación Secundaria Técnica consta de formación general y formación científico tecnológica, y se divide en 8 materias: Ciencias Naturales, Ciencias Sociales, Educación Artística, Educación Física, Inglés, Matemática, Prácticas del Lenguaje y Construcción Ciudadana. La cantidad total de módulos semanales en el primer año es de 24. Dentro de la formación científico-tecnológica se dictan tres materias: Procedimientos Técnicos, Lenguajes Tecnológicos y Sistemas Tecnológicos, cada una con una carga horaria anual de 72 horas, y con 6 módulos semanales',0,true),
('2° año','El segundo año de la Educación Secundaria Técnica incluye ocho asignaturas en el área de Formación General, con cuatro módulos semanales cada una, con materias como Biología, Construcción de Ciudadanía, Educación Artística, Educación Física, Físico Química, Geografía, Historia, Matemática, Prácticas del Lenguaje, e Inglés. La cantidad total de módulos semanales del segundo año es de 24. El segundo año de la Educación Secundaria Técnica incluye tres materias técnico-específicas: Procedimientos Técnicos, Lenguajes Tecnológicos y Sistemas Tecnológicos, con un total de ocho módulos semanales. Procedimientos Técnicos se vuelve el área con más horas con 144, el resto de materias continua con 72 horas.',0,true),
('3° año','El tercer año de la Educación Secundaria Técnica incluye ocho asignaturas en el área de Formación General, con cuatro módulos semanales cada una, con materias como Biología, Construcción de Ciudadanía, Educación Artística, Educación Física, Físico Química, Geografía, Historia, Inglés, Matemática, y Prácticas del Lenguaje. Dentro de la formación científico-tecnológica se repiten las tres materias: Procedimientos Técnicos, Lenguajes Tecnológicos y Sistemas Tecnológicos, en este año Sistemas Tecnológicos se amplía con 144 horas anuales, el resto se mantiene en 72. La cantidad total de módulos semanales es de 8.',0,true),
('4° año','El cuarto año técnico contiene materias curriculares como Literatura, Ingles, Salud y Adolescencia, Historia, Geogafría, y Educación Física. Cada una de estas tiene una carga de 72 horas anuales. Siguiendo con las diferentes materias, debemos agregar las materias científico-tecnológicas: Matemática, Física, Química',0,true),
('5° año','En el quinto año técnico podemos ver materias de formación general como Literatura, Inglés, Politica y Ciudadanía, Historia, Geografía, y Educación Física. Todas estas poseen una carga horaria de 72 horas anuales. Junto con estas, también apreciamos Análisis Matemático, como materia de formación científico-tecnológica, con una carga horaria de 144 horas.',0,true),
('6° año','En este sexto año técnico, veremos materias curriculares como Literatura, Inglés, Educación Física, Filosofía, y Arte. Todas estas cuentas con un total de 72 horas anuales. En este año contamos a su vez con una materia correspondiente a las materias científico-específicas: Matemática Aplicada. Con una carga de 72 horas.',0,true),
('7° año','Este séptimo año técnico, es, sin lugar a duda, el más importante que podemos apreciar. Ya que en este año se lleva a cabo el famoso "proyecto final", donde se ponen a prueba los contenidos aprendidos en cada tecnicatura. Los proyectos suelen hacerse, cómo máximo, de 4 personas, pero puede haber situaciones excepcionales donde se pueda extender el máximo por uno o dos integrantes más. La única materia curricular que vemos son las Prácticas Profesionalizantes, las cuales deben cumplir un total de 200 horas anuales.',0,true),
-- preguntas corrientes
('hola','Hola, mucho gusto, ¿en que te puedo ayudar hoy? si quieres revisa las preguntas mas frecuentes que los alumnos preguntan por aqui en el menu',0,true),
('como estas','¿y tu?, recuerda que puedes ayudarte con las preguntas usando el buscador en la barra donde escribes',0,true),
('buenos dias','buen dia a ti tambien, espero que tengas un excelente dia',0,true),
('nos vemos','gracias por consultar, vuelva pronto',0,true),
('adios','¡nos vemos!, si dios lo permite',0,true),
('4x4','Camioneta',0,true),
('gracias','gracias a ti por elegirme',0,true),
('si','ok',0,true),
('no','ok',0,true),
-- ubicaciones de la escuela
('baños','los baños de hombres estan en la planta baja, entre la escaleras y el ascensor, otro esta en el segundo piso en frente de preceptoria, otro esta al fondo del zoom hacia la izquierda, al lado del patio y otro en el gimnasio y el de mujeres esta en el primer piso en frente de preceptoria.',0,true),
('preceptoria','hay una preceptoria en la esquina de el primer y segundo piso, una preceptoria de quimica en el pasillo interior del primer piso, junto a la sala de proyecciones y la preceptoria de taller en la planta baja, ubicada bajando las escaleras que estan al lado de la entrada principal',0,true),
('zoom','el zoom es el patio de interior que se ubica al entrar a la escuela',0,true),
('biblioteca','la biblioteca se ubica en la planta baja, a la izquierda de la entrada ¿te gustaria leer un libro en especifico?.',0,true),
('sala de proyecciones','la sala de proyecciones se encuentra en el pasillo interior(al fondo) en el primer piso junto a la preceptoria de quimica y los laboratorio. en ella se pueden mirar peliculas, documentales o alguna charla en especifico',0,true),
('laboratorios de quimica','los laboratorios de quimica se encuentran, dos en el primer piso en el pasillo interno, y otro en la planta baja al lado de la biblioteca, ¡hora de hacer experimentos!',0,true),
('gimnasio','el gimnasio queda arriba del todo, subiendo las escaleras que estan al fondo del zoom. mi deporte favorito es el futbol aunque no lo pueda jugar, es apasionante',0,true),
('fundicion','la sala de fundicion se ubica bajando las escaleras que se encuentran al fondo del zoom, junto a fundicion esta carpinteria y construccion. aqui se funden metales y se crean piezas de metal que los alumnos se pueden llevar, solo esta en 1° año.',0,true),
('torneria','torneria se encuentra subiendo las escaleras al final del patio interior, junto a este esta hojalateria. aqui los alumnos usan el torno y como proyecto haran un bate de baseball, ¿sabias que antes hacian un cañon en vez de un bate?.',0,true),
('carpinteria','carpinteria se encuentra bajando las escaleras en la zona de taller, esta al lado de construccion y fundicion. aqui los chicos y chicas de 1°año van a poder crear un guarda llaves, una percha y con suerte una tabla de picar, en 2°año van a hacer un banco ¡que emocionante!',0,true),
('hojalateria','hojalateria se encuentra junto a torneria subiendo las escaleras de taller. aqui los alumnos en 1°año trabajan haciendo una palita que se pueden llevar a casa, eso si se va a oxidar con los años, jaja y en 2°año van a crear una cajita de herramientas ¡que divertido!',0,true),
('electricidad','la sala de electicidad queda subiendo las escaleras que se encuentran al fondo del zoom. aqui las chicos y los chicos van a aprender teoria sobre la electricidad y a conectar cables, hacer funcionar focos y teclas y mucho mas, ¡electrizante!',0,true),
('dibujo tecnico','los salones de dibujo tecnico estan en el ultimo piso, a ellos se pueden acceder suubiendo las escaleras del sector de teoria.
 aqui trabajaran en mesas de dibujo haciendo planos junto a sus escuadras y su regla T.',0,true),
-- otros
('tus creadores','los alumnos que programaron este proyecto fueron de 7°i programacion generacion 2025, leonardo ojeda, alexis mansilla y andres ojeda',0,true),
('quienes te programaron','los alumnos que me programaron fueron de 7°i programacion generacion 2025, leonardo ojeda, alexis mansilla y andres ojeda',0,true),
('año de tu creacion','2025',0,true);

CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT, 
    nombre VARCHAR (255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL
);

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