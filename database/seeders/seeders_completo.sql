USE dkapp;

-- ====================================================================
-- SEEDERS - DATOS DE PRUEBA COMPLETOS
-- ====================================================================

-- ====================================================================
-- 1. CICLOS FORMATIVOS
-- ====================================================================
INSERT INTO `ciclos` (`codigo`, `nombre`, `nivel`, `activo`) VALUES
('DAM', 'Desarrollo de Aplicaciones Multiplataforma', 2, 1),
('ASIR', 'Administración de Sistemas Informáticos en Red', 2, 1),
('DAW', 'Desarrollo de Aplicaciones Web', 2, 1),
('CFGM_INF', 'Sistemas Microinformáticos y Redes', 1, 1),
('CFGS_AI', 'Inteligencia Artificial', 2, 1);

-- ====================================================================
-- 2. CURSOS
-- ====================================================================
INSERT INTO `cursos` (`id_ciclo`, `numero_curso`, `nombre`) VALUES
(1, 1, '1º DAM'),
(1, 2, '2º DAM'),
(2, 1, '1º ASIR'),
(2, 2, '2º ASIR'),
(3, 1, '1º DAW'),
(3, 2, '2º DAW'),
(4, 1, '1º SMR'),
(4, 2, '2º SMR'),
(5, 1, '1º IA'),
(5, 2, '2º IA');

-- ====================================================================
-- 3. RESULTADOS DE APRENDIZAJE
-- ====================================================================
INSERT INTO `resultados_aprendizaje` (`codigo`, `descripcion`, `id_ciclo`) VALUES
('RA1-DAM', 'Reconoce la estructura de una aplicación informática identificando y relacionando los elementos propios del lenguaje de programación.', 1),
('RA2-DAM', 'Escribe y prueba programas sencillos realizando pruebas.', 1),
('RA3-DAM', 'Escribe programas que utilicen sentencias de decisión identificando patrones de decisión y asignando valores.', 1),
('RA4-ASIR', 'Reconoce la estructura y características fundamentales de una red de computadores.', 2),
('RA5-ASIR', 'Instala y configura sistemas operativos monousuario determinando opciones básicas y particiones de disco.', 2),
('RA1-DAW', 'Selecciona arquitecturas y patrones arquitectónicos aplicando criterios de sostenibilidad.', 3),
('RA2-DAW', 'Desarrolla aplicaciones web con acceso a datos utilizando lenguajes, librerías y marcos de trabajo.', 3);

-- ====================================================================
-- 4. COMPETENCIAS
-- ====================================================================
INSERT INTO `competencias` (`codigo`, `descripcion`, `tipo`) VALUES
('PROG-JAVA', 'Programación en Java y orientación a objetos', 'TECNICA'),
('PROG-WEB', 'Programación web (HTML, CSS, JavaScript, PHP)', 'TECNICA'),
('BD-SQL', 'Bases de datos SQL y diseño relacional', 'TECNICA'),
('SIST-LINUX', 'Administración de sistemas Linux', 'TECNICA'),
('REDES', 'Configuración y administración de redes', 'TECNICA'),
('COMUNICACION', 'Comunicación efectiva y presentación', 'TRANSVERSAL'),
('TRABAJO-EQUIPO', 'Trabajo en equipo y colaboración', 'TRANSVERSAL'),
('RESOLUCION-PROB', 'Resolución de problemas y pensamiento crítico', 'PERSONAL'),
('APRENDIZAJE-CONT', 'Aprendizaje continuo y adaptación', 'PERSONAL'),
('RESPONSABILIDAD', 'Responsabilidad y compromiso', 'PERSONAL');

-- ====================================================================
-- 5. RELACIÓN: RESULTADOS DE APRENDIZAJE - COMPETENCIAS
-- ====================================================================
INSERT INTO `competencia_ra` (`id_competencia`, `id_ra`) VALUES
(1, 1), (1, 2), (1, 3), (3, 1), (3, 2), (7, 1), (7, 2),
(4, 4), (5, 4), (5, 5), (7, 4), (7, 5),
(2, 6), (2, 7), (3, 6), (3, 7), (7, 6), (7, 7);

-- ====================================================================
-- 6. MÓDULOS FORMATIVOS
-- ====================================================================
INSERT INTO `modulos` (`codigo`, `nombre`, `id_curso`, `horas_totales`) VALUES
-- 1º DAM
('0482-PROG', 'Programación Estructurada', 1, 240),
('0483-BD', 'Bases de Datos', 1, 100),
('0484-ENTORNO', 'Entornos de Desarrollo', 1, 60),
('0485-LENG', 'Lenguajes de Marcas', 1, 50),
('0487-FCTI', 'Formación en Centros de Trabajo I', 1, 80),
-- 2º DAM
('0491-PROG-OOP', 'Programación Orientada a Objetos', 2, 200),
('0493-APPS-MOBIL', 'Aplicaciones Móviles', 2, 120),
('0498-FCTII', 'Formación en Centros de Trabajo II', 2, 400),
-- 1º ASIR
('0369-SIST-INFO', 'Sistemas Informáticos', 3, 150),
('0370-SOFT', 'Aplicaciones Ofimáticas', 3, 100),
('0371-BD-ASIR', 'Bases de Datos', 3, 80),
('0372-LENG-MARK', 'Lenguajes de Marcas', 3, 60),
('0373-FOL', 'Formación y Orientación Laboral', 3, 100),
-- 2º ASIR
('0374-SIST-OPER', 'Sistemas Operativos', 4, 200),
('0375-SERV-RED', 'Servicios en Red', 4, 150),
('0376-SEGUR', 'Seguridad Informática', 4, 120),
('0377-FCTASIR', 'Formación en Centros de Trabajo', 4, 400);

-- ====================================================================
-- 7. RELACIÓN: MÓDULOS - COMPETENCIAS
-- ====================================================================
INSERT INTO `modulo_competencia` (`id_modulo`, `id_competencia`) VALUES
(1, 1), (1, 7), (1, 9),
(2, 3), (2, 7), (2, 9),
(3, 1), (3, 7),
(4, 2), (4, 7),
(5, 7), (5, 8),
(6, 1), (6, 7), (6, 9),
(7, 2), (7, 7), (7, 9),
(8, 7), (8, 10),
(9, 4), (9, 7),
(10, 4), (10, 7),
(11, 3), (11, 7),
(12, 2), (12, 7),
(13, 7), (13, 6),
(14, 4), (14, 7), (14, 9),
(15, 5), (15, 7), (15, 9),
(16, 5), (16, 8), (16, 10),
(17, 7), (17, 10);

-- ====================================================================
-- 8. USUARIOS - ADMINISTRADOR
-- ====================================================================
INSERT INTO `users` (`nombre`, `apellidos`, `email`, `telefono`, `rol`, `password`, `activo`, `email_verified_at`) VALUES
('Admin', 'Sistema', 'admin@dkapp.local', '943123456', 'ADMIN', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW());

-- ====================================================================
-- 9. USUARIOS - TUTORES DE CENTRO
-- ====================================================================
INSERT INTO `users` (`nombre`, `apellidos`, `email`, `telefono`, `rol`, `password`, `activo`, `email_verified_at`) VALUES
('María', 'García López', 'maria.garcia@egibide.org', '943111111', 'TUTOR_CENTRO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Juan', 'Martínez Pérez', 'juan.martinez@egibide.org', '943111112', 'TUTOR_CENTRO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Elena', 'Rodríguez García', 'elena.rodriguez@egibide.org', '943111113', 'TUTOR_CENTRO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Carlos', 'Fernández López', 'carlos.fernandez@egibide.org', '943111114', 'TUTOR_CENTRO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW());

-- ====================================================================
-- 10. USUARIOS - TUTORES DE EMPRESA
-- ====================================================================
INSERT INTO `users` (`nombre`, `apellidos`, `email`, `telefono`, `rol`, `password`, `activo`, `email_verified_at`) VALUES
('Roberto', 'Sánchez Torres', 'rsanchez@tecnosoluciones.es', '943211111', 'TUTOR_EMPRESA', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Amaia', 'Etxebarria Ruiz', 'aetxebarria@datainnovate.es', '943211112', 'TUTOR_EMPRESA', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Jorge', 'Gómez Díaz', 'jgomez@cloudtech.es', '943211113', 'TUTOR_EMPRESA', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Sofía', 'Blanco Moreno', 'sblanco@systeam.es', '943211114', 'TUTOR_EMPRESA', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Mikel', 'Ibáñez García', 'mibañez@networkpro.es', '943211115', 'TUTOR_EMPRESA', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW());

-- ====================================================================
-- 11. USUARIOS - ALUMNOS
-- ====================================================================
INSERT INTO `users` (`nombre`, `apellidos`, `email`, `telefono`, `rol`, `password`, `activo`, `email_verified_at`) VALUES
('David', 'Jiménez Martínez', 'david.jimenez@egibide.org', '639111111', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Laura', 'Sanz García', 'laura.sanz@egibide.org', '639111112', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Andrés', 'López Ruiz', 'andres.lopez@egibide.org', '639111113', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Marta', 'Hernández García', 'marta.hernandez@egibide.org', '639111114', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Pablo', 'Navarro López', 'pablo.navarro@egibide.org', '639111115', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Sandra', 'Iglesias Martín', 'sandra.iglesias@egibide.org', '639111116', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Víctor', 'Romero García', 'victor.romero@egibide.org', '639111117', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Raquel', 'Morales López', 'raquel.morales@egibide.org', '639111118', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Miguel', 'Vázquez Fernández', 'miguel.vazquez@egibide.org', '639111119', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW()),
('Nuria', 'Ortiz García', 'nuria.ortiz@egibide.org', '639111120', 'ALUMNO', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7Atz.AzVgMXbSTYZCrVEJYvO', 1, NOW());

-- ====================================================================
-- 12. ALUMNOS
-- ====================================================================
INSERT INTO `alumnos` (`id_user`, `dni`, `numero_cuaderno`, `id_ciclo`, `curso_actual`, `poblacion`) VALUES
(8, '12345678A', 'EXP001', 1, 2, 'Bilbao'),
(9, '87654321B', 'EXP002', 1, 2, 'Bilbao'),
(10, '11223344C', 'EXP003', 1, 2, 'Bilbao'),
(11, '44332211D', 'EXP004', 2, 2, 'Bilbao'),
(12, '55667788E', 'EXP005', 2, 2, 'Bilbao'),
(13, '88776655F', 'EXP006', 3, 1, 'Bilbao'),
(14, '99001122G', 'EXP007', 3, 1, 'Bilbao'),
(15, '22110099H', 'EXP008', 4, 1, 'Bilbao'),
(16, '33445566I', 'EXP009', 1, 1, 'Bilbao'),
(17, '66554433J', 'EXP010', 2, 1, 'Bilbao');

-- ====================================================================
-- 13. EMPRESAS
-- ====================================================================
INSERT INTO `empresas` (`nombre`, `cif`, `direccion`, `localidad`, `provincia`, `codigo_postal`, `telefono`, `email`, `estado`) VALUES
('TecnoSoluciones S.L.', 'B98123456', 'Avenida Lehendakari Aguirre 10', 'Bilbao', 'Bizkaia', '48009', '943456789', 'info@tecnosoluciones.es', 'ACTIVA'),
('DataInnovate Systems', 'B98234567', 'Calle Iparraguirre 45', 'Bilbao', 'Bizkaia', '48008', '943567890', 'contacto@datainnovate.es', 'ACTIVA'),
('CloudTech Solutions', 'B98345678', 'Plazuela San Vicente Abando 3', 'Bilbao', 'Bizkaia', '48010', '943678901', 'info@cloudtech.es', 'ACTIVA'),
('SysTeam Consultoría', 'B98456789', 'Gran Vía 35', 'Bilbao', 'Bizkaia', '48011', '943789012', 'contacto@systeam.es', 'ACTIVA'),
('NetworkPro Infraestructura', 'B98567890', 'Alameda de Urquijo 50', 'Bilbao', 'Bizkaia', '48008', '943890123', 'info@networkpro.es', 'ACTIVA'),
('WebDevelop Studio', 'B98678901', 'Calle Autonomía 10', 'Bilbao', 'Bizkaia', '48009', '943901234', 'hola@webdevelop.es', 'ACTIVA'),
('DevOps España', 'B98789012', 'Paseo de la Castellana 200', 'Bilbao', 'Bizkaia', '48012', '943012345', 'contacto@devops.es', 'ACTIVA');

-- ====================================================================
-- 14. CONTACTOS DE EMPRESA
-- ====================================================================
INSERT INTO `contactos_empresa` (`id_empresa`, `nombre`, `apellidos`, `email`, `telefono`, `activo`) VALUES
(1, 'Roberto', 'Sánchez Torres', 'rsanchez@tecnosoluciones.es', '943456789', 1),
(1, 'Carmen', 'García Ruiz', 'cgarcia@tecnosoluciones.es', '943456790', 1),
(2, 'Amaia', 'Etxebarria Ruiz', 'aetxebarria@datainnovate.es', '943567890', 1),
(2, 'Javier', 'Fernández López', 'jfernandez@datainnovate.es', '943567891', 1),
(3, 'Jorge', 'Gómez Díaz', 'jgomez@cloudtech.es', '943678901', 1),
(3, 'Patricia', 'Martínez Blanco', 'pmartinez@cloudtech.es', '943678902', 1),
(4, 'Sofía', 'Blanco Moreno', 'sblanco@systeam.es', '943789012', 1),
(4, 'Miguel', 'López García', 'mlopez@systeam.es', '943789013', 1),
(5, 'Mikel', 'Ibáñez García', 'mibañez@networkpro.es', '943890123', 1),
(5, 'Lorea', 'Martínez Pérez', 'lmartinez@networkpro.es', '943890124', 1),
(6, 'Xabier', 'Ruiz López', 'xruiz@webdevelop.es', '943901234', 1),
(7, 'Erika', 'García Sánchez', 'egarcia@devops.es', '943012345', 1);

-- ====================================================================
-- 15. ESTANCIAS FORMATIVAS
-- ====================================================================
INSERT INTO `estancias_formativas` (`id_alumno`, `id_empresa`, `id_tutor_empresa`, `id_tutor_centro`, `id_curso`, `fecha_inicio`, `fecha_fin`, `horas_totales`, `horas_realizadas`, `estado`, `observaciones`) VALUES
-- Alumnos 2º DAM en empresas
(1, 1, 5, 2, 2, '2026-02-01', '2026-06-30', 400, 380, 'EN_CURSO', 'Alumno muy motivado, buen progreso en desarrollo'),
(2, 2, 6, 2, 2, '2026-02-01', '2026-06-30', 400, 350, 'EN_CURSO', 'Muestra interés en arquitectura de datos'),
(3, 3, 7, 3, 2, '2026-02-01', '2026-06-30', 400, 390, 'EN_CURSO', 'Excelente desempeño en cloud computing'),
-- Alumnos 2º ASIR en empresas
(4, 4, 8, 4, 4, '2026-02-01', '2026-06-30', 400, 370, 'EN_CURSO', 'Buen conocimiento en sistemas operativos'),
(5, 5, 9, 4, 4, '2026-02-01', '2026-06-30', 400, 360, 'EN_CURSO', 'Demuestra capacidad en administración de redes'),
-- Alumnos 1º DAW en empresa
(6, 6, 10, 3, 5, '2026-02-01', '2026-04-30', 200, 180, 'EN_CURSO', 'Alumna con buen potencial en desarrollo web'),
(7, 6, 10, 3, 5, '2026-05-01', '2026-06-30', 200, 150, 'PLANIFICADA', 'Próxima rotación en el mismo centro'),
-- Alumnos 1º SMR en empresa
(8, 7, 11, 2, 7, '2026-02-01', '2026-04-30', 200, 190, 'EN_CURSO', 'Buen progreso en infraestructura'),
(9, 1, 5, 2, 7, '2026-05-01', '2026-06-30', 200, 0, 'PLANIFICADA', 'Próxima rotación'),
-- Alumno con estancia completada
(10, 3, 7, 3, 1, '2025-11-01', '2025-12-20', 100, 100, 'COMPLETADA', 'Estancia completada satisfactoriamente');

-- ====================================================================
-- 16. HORARIOS DE ESTANCIA
-- ====================================================================
INSERT INTO `horarios_estancia` (`id_estancia`, `dia_semana`, `turno`, `hora_inicio`, `hora_fin`) VALUES
-- Estancia 1
(1, 'LUNES', 'CONTINUO', '08:00', '16:00'),
(1, 'MARTES', 'CONTINUO', '08:00', '16:00'),
(1, 'MIERCOLES', 'CONTINUO', '08:00', '16:00'),
(1, 'JUEVES', 'CONTINUO', '08:00', '16:00'),
(1, 'VIERNES', 'CONTINUO', '08:00', '14:00'),
-- Estancia 2
(2, 'LUNES', 'CONTINUO', '09:00', '17:00'),
(2, 'MARTES', 'CONTINUO', '09:00', '17:00'),
(2, 'MIERCOLES', 'CONTINUO', '09:00', '17:00'),
(2, 'JUEVES', 'CONTINUO', '09:00', '17:00'),
(2, 'VIERNES', 'MAÑANA', '09:00', '13:00'),
-- Estancia 3
(3, 'LUNES', 'CONTINUO', '08:00', '16:00'),
(3, 'MARTES', 'CONTINUO', '08:00', '16:00'),
(3, 'MIERCOLES', 'CONTINUO', '08:00', '16:00'),
(3, 'JUEVES', 'CONTINUO', '08:00', '16:00'),
(3, 'VIERNES', 'CONTINUO', '08:00', '16:00'),
-- Estancia 4
(4, 'LUNES', 'CONTINUO', '07:30', '15:30'),
(4, 'MARTES', 'CONTINUO', '07:30', '15:30'),
(4, 'MIERCOLES', 'CONTINUO', '07:30', '15:30'),
(4, 'JUEVES', 'CONTINUO', '07:30', '15:30'),
(4, 'VIERNES', 'MAÑANA', '07:30', '12:00'),
-- Estancia 5
(5, 'LUNES', 'CONTINUO', '08:00', '16:00'),
(5, 'MARTES', 'CONTINUO', '08:00', '16:00'),
(5, 'MIERCOLES', 'CONTINUO', '08:00', '16:00'),
(5, 'JUEVES', 'CONTINUO', '08:00', '16:00'),
(5, 'VIERNES', 'CONTINUO', '08:00', '16:00'),
-- Estancia 6
(6, 'LUNES', 'CONTINUO', '09:00', '17:00'),
(6, 'MARTES', 'CONTINUO', '09:00', '17:00'),
(6, 'MIERCOLES', 'CONTINUO', '09:00', '17:00'),
(6, 'JUEVES', 'CONTINUO', '09:00', '17:00'),
(6, 'VIERNES', 'MAÑANA', '09:00', '13:00'),
-- Estancia 7
(7, 'LUNES', 'CONTINUO', '09:00', '17:00'),
(7, 'MARTES', 'CONTINUO', '09:00', '17:00'),
(7, 'MIERCOLES', 'CONTINUO', '09:00', '17:00'),
(7, 'JUEVES', 'CONTINUO', '09:00', '17:00'),
(7, 'VIERNES', 'MAÑANA', '09:00', '13:00'),
-- Estancia 8
(8, 'LUNES', 'CONTINUO', '08:00', '16:00'),
(8, 'MARTES', 'CONTINUO', '08:00', '16:00'),
(8, 'MIERCOLES', 'CONTINUO', '08:00', '16:00'),
(8, 'JUEVES', 'CONTINUO', '08:00', '16:00'),
(8, 'VIERNES', 'CONTINUO', '08:00', '16:00'),
-- Estancia 9
(9, 'LUNES', 'CONTINUO', '08:00', '16:00'),
(9, 'MARTES', 'CONTINUO', '08:00', '16:00'),
(9, 'MIERCOLES', 'CONTINUO', '08:00', '16:00'),
(9, 'JUEVES', 'CONTINUO', '08:00', '16:00'),
(9, 'VIERNES', 'CONTINUO', '08:00', '16:00'),
-- Estancia 10 (completada)
(10, 'LUNES', 'CONTINUO', '08:00', '16:00'),
(10, 'MARTES', 'CONTINUO', '08:00', '16:00'),
(10, 'MIERCOLES', 'CONTINUO', '08:00', '16:00'),
(10, 'JUEVES', 'CONTINUO', '08:00', '16:00'),
(10, 'VIERNES', 'CONTINUO', '08:00', '14:00');

-- ====================================================================
-- 17. SEGUIMIENTO DE COMPETENCIAS
-- ====================================================================
INSERT INTO `seguimiento_competencias` (`id_estancia`, `id_competencia`, `numero_semana`, `fecha_inicio`, `fecha_fin`) VALUES
-- Estancia 1 (DAM)
(1, 1, 1, '2026-02-01', '2026-02-07'),
(1, 1, 2, '2026-02-08', '2026-02-14'),
(1, 1, 3, '2026-02-15', '2026-02-21'),
(1, 3, 4, '2026-02-22', '2026-02-28'),
(1, 3, 5, '2026-03-01', '2026-03-07'),
(1, 3, 6, '2026-03-08', '2026-03-14'),
(1, 2, 7, '2026-03-15', '2026-03-21'),
(1, 2, 8, '2026-03-22', '2026-03-28'),
-- Estancia 2 (DAM)
(2, 1, 1, '2026-02-01', '2026-02-07'),
(2, 1, 2, '2026-02-08', '2026-02-14'),
(2, 3, 3, '2026-02-15', '2026-02-21'),
(2, 3, 4, '2026-02-22', '2026-02-28'),
(2, 3, 5, '2026-03-01', '2026-03-07'),
-- Estancia 3 (DAM)
(3, 2, 1, '2026-02-01', '2026-02-07'),
(3, 2, 2, '2026-02-08', '2026-02-14'),
(3, 2, 3, '2026-02-15', '2026-02-21'),
(3, 2, 4, '2026-02-22', '2026-02-28'),
-- Estancia 4 (ASIR)
(4, 4, 1, '2026-02-01', '2026-02-07'),
(4, 4, 2, '2026-02-08', '2026-02-14'),
(4, 5, 3, '2026-02-15', '2026-02-21'),
(4, 5, 4, '2026-02-22', '2026-02-28'),
-- Estancia 5 (ASIR)
(5, 5, 1, '2026-02-01', '2026-02-07'),
(5, 5, 2, '2026-02-08', '2026-02-14'),
(5, 4, 3, '2026-02-15', '2026-02-21'),
-- Estancia 6 (DAW)
(6, 2, 1, '2026-02-01', '2026-02-07'),
(6, 2, 2, '2026-02-08', '2026-02-14'),
(6, 2, 3, '2026-02-15', '2026-02-21'),
-- Estancia 10 (completada)
(10, 1, 1, '2025-11-01', '2025-11-07'),
(10, 1, 2, '2025-11-08', '2025-11-14'),
(10, 3, 3, '2025-11-15', '2025-11-21'),
(10, 3, 4, '2025-11-22', '2025-11-28'),
(10, 3, 5, '2025-11-29', '2025-12-05'),
(10, 3, 6, '2025-12-06', '2025-12-12'),
(10, 3, 7, '2025-12-13', '2025-12-20');

-- ====================================================================
-- 18. NOTAS/SEGUIMIENTO DEL ALUMNO
-- ====================================================================
INSERT INTO `notas_seguimiento` (`id_estancia`, `id_alumno`, `fecha`, `accion`, `contenido`) VALUES
-- Estancia 1
(1, 1, '2026-02-01', 'PRESENTACION_ALUMNO', 'David se presenta en TecnoSoluciones. Buen clima de acogida. Se integra rápidamente en el equipo.'),
(1, 1, '2026-02-08', 'LLAMADA_SEGUIMIENTO', 'Llamada a Roberto (tutor empresa). Todo va bien, David está aprendiendo mucho sobre arquitectura de aplicaciones.'),
(1, 1, '2026-02-15', 'VISITA_CENTRO_TRABAJO', 'Visita realizada por María (tutora centro). Observa buen ambiente de trabajo y compromiso del alumno.'),
(1, 1, '2026-03-01', 'REUNION_TUTOR_PRACTICAS', 'Reunión con tutor empresa. Progreso excelente, participa en proyectos reales.'),
-- Estancia 2
(2, 2, '2026-02-01', 'PRESENTACION_ALUMNO', 'Laura comienza en DataInnovate. Ambiente acogedor, presenta especial interés en bases de datos.'),
(2, 2, '2026-02-10', 'LLAMADA_SEGUIMIENTO', 'Llamada a Amaia. Reporte positivo. Laura está integrándose bien en el equipo de datos.'),
(2, 2, '2026-02-18', 'VISITA_CENTRO_TRABAJO', 'Visita de María. Laura muestra buen desempeño técnico.'),
-- Estancia 3
(3, 3, '2026-02-01', 'PRESENTACION_ALUMNO', 'Andrés se presenta en CloudTech. Muy motivado en cloud computing.'),
(3, 3, '2026-02-05', 'INCIDENCIA', 'Andrés tuvo dificultades iniciales con Docker, pero se resolvieron rápidamente con ayuda del tutor.'),
(3, 3, '2026-02-20', 'REUNION_PROFESORES', 'Reunión con el tutor empresa. Excelente adaptación, trabaja en contenedores de producción.'),
-- Estancia 4
(4, 4, '2026-02-01', 'PRESENTACION_ALUMNO', 'Marta inicia en SysTeam. Buena integración inicial.'),
(4, 4, '2026-02-09', 'LLAMADA_SEGUIMIENTO', 'Sofía reporta que Marta progresa adecuadamente en administración de sistemas.'),
-- Estancia 5
(5, 5, '2026-02-01', 'PRESENTACION_ALUMNO', 'Pablo comienza su estancia en NetworkPro. Buen ambiente de integración.'),
(5, 5, '2026-02-12', 'REUNIÓN_TUTOR_PRACTICAS', 'Reunión con Mikel. Pablo está aprendiendo mucho sobre infraestructuras de red.'),
-- Estancia 6
(6, 6, '2026-02-01', 'PRESENTACION_ALUMNO', 'Sandra inicia en WebDevelop. Excelente primer día.'),
(6, 6, '2026-02-15', 'VISITA_CENTRO_TRABAJO', 'Visita de Elena. Sandra muestra gran motivación en desarrollo web.'),
-- Estancia 10 (completada)
(10, 10, '2025-11-01', 'PRESENTACION_ALUMNO', 'Nuria se presenta en CloudTech. Buena acogida del equipo.'),
(10, 10, '2025-11-15', 'REUNION_TUTOR_PRACTICAS', 'Reunión con tutor empresa. Nuria progresa satisfactoriamente.'),
(10, 10, '2025-12-10', 'EVALUACION', 'Evaluación final positiva. Nuria ha completado todos los objetivos de aprendizaje.');

-- ====================================================================
-- 19. EVALUACIONES/CALIFICACIONES
-- ====================================================================
INSERT INTO `evaluaciones` (`id_estancia`, `id_modulo`, `nota_previa`, `nota_competencias_tecnicas`, `nota_competencias_transversales`, `nota_cuaderno`, `nota_fct_calculada`, `nota_final`, `observaciones`, `fecha_evaluacion`) VALUES
-- Estancia completada (10) - todos los módulos evaluados
(10, 1, 8.50, 8.25, 8.00, 8.50, 8.25, 8.43, 'Excelente desempeño en programación estructurada', '2025-12-20'),
(10, 2, 8.00, 7.75, 8.25, 8.00, 7.88, 7.97, 'Buen conocimiento en diseño de bases de datos', '2025-12-20'),
(10, 3, 9.00, 8.50, 9.00, 9.00, 8.70, 8.94, 'Muy bueno en entornos de desarrollo', '2025-12-20'),
-- Estancia 1 (en curso, sin evaluación final)
(1, 6, 8.75, 8.50, 8.25, 8.75, NULL, NULL, 'Evaluación parcial positiva', '2026-03-28'),
-- Estancia 2 (en curso)
(2, 6, 8.50, 8.00, 8.50, 8.25, NULL, NULL, 'Evaluación parcial', '2026-03-28'),
-- Estancia 3 (en curso)
(3, 7, 8.25, 8.75, 8.00, 8.50, NULL, NULL, 'Evaluación parcial en desarrollo web', '2026-04-15');

-- ====================================================================
-- 20. LOGS DEL SISTEMA
-- ====================================================================
INSERT INTO `logs` (`id_usuario`, `nivel`, `tipo`, `mensaje`, `tabla_afectada`, `registro_id`, `ip`, `metodo_http`, `url`) VALUES
(1, 'INFO', 'auth', 'Admin ha iniciado sesión', 'users', 1, '192.168.1.100', 'POST', '/api/auth/login'),
(2, 'INFO', 'auth', 'Tutor María ha iniciado sesión', 'users', 2, '192.168.1.101', 'POST', '/api/auth/login'),
(5, 'INFO', 'auth', 'Tutor empresa ha iniciado sesión', 'users', 5, '192.168.1.102', 'POST', '/api/auth/login'),
(8, 'INFO', 'auth', 'Alumno David ha iniciado sesión', 'users', 8, '192.168.1.103', 'POST', '/api/auth/login'),
(1, 'INFO', 'database', 'Se creó nueva estancia formativa', 'estancias_formativas', 1, '192.168.1.100', 'POST', '/api/estancias'),
(2, 'INFO', 'database', 'Se registró nota de seguimiento', 'notas_seguimiento', 1, '192.168.1.101', 'POST', '/api/notas'),
(1, 'INFO', 'database', 'Se registraron horas de estancia', 'estancias_formativas', 1, '192.168.1.100', 'PUT', '/api/estancias/1'),
(5, 'INFO', 'database', 'Se creó evaluación de alumno', 'evaluaciones', 1, '192.168.1.102', 'POST', '/api/evaluaciones'),
(2, 'INFO', 'database', 'Se añadió horario a estancia', 'horarios_estancia', 1, '192.168.1.101', 'POST', '/api/horarios'),
(1, 'WARNING', 'system', 'Intento de acceso con credenciales inválidas', NULL, NULL, '192.168.1.105', 'POST', '/api/auth/login'),
(1, 'INFO', 'email', 'Email de confirmación enviado a alumno', 'users', 8, '192.168.1.100', 'POST', '/api/auth/send-verification'),
(1, 'INFO', 'database', 'Se completó estancia formativa', 'estancias_formativas', 10, '192.168.1.100', 'PUT', '/api/estancias/10/complete');

-- ====================================================================
-- RESUMEN DE DATOS CREADOS
-- ====================================================================
-- ✓ 5 Ciclos formativos
-- ✓ 10 Cursos
-- ✓ 7 Resultados de aprendizaje
-- ✓ 10 Competencias
-- ✓ 18 Relaciones RA-Competencias
-- ✓ 17 Módulos formativos
-- ✓ Múltiples relaciones Módulos-Competencias
-- ✓ 1 Admin + 4 Tutores de Centro + 5 Tutores de Empresa + 10 Alumnos
-- ✓ 10 Alumnos (tabla alumnos)
-- ✓ 7 Empresas colaboradoras
-- ✓ 12 Contactos de empresa
-- ✓ 10 Estancias formativas (9 en curso/planificada, 1 completada)
-- ✓ Horarios completos para todas las estancias
-- ✓ Seguimiento de competencias por semana
-- ✓ Notas de seguimiento y registros de eventos
-- ✓ Evaluaciones de alumnos
-- ✓ Logs del sistema
