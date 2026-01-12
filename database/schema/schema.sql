-- ====================================================================
-- SISTEMA DE GESTIÓN DE ESTANCIAS FORMATIVAS EN EMPRESA
-- Centro: Egibide
-- ====================================================================
-- Este archivo documenta la estructura completa de la base de datos.
-- Las migraciones individuales se encuentran en database/migrations/
-- ====================================================================

-- ====================================================================
-- 1. CICLOS FORMATIVOS
-- ====================================================================
CREATE TABLE `ciclos` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `codigo` VARCHAR(50) UNIQUE NOT NULL COMMENT 'Código del ciclo formativo',
  `nombre` VARCHAR(255) NOT NULL COMMENT 'Nombre del ciclo',
  `nivel` INT NOT NULL COMMENT 'Nivel del ciclo (Superior, Medio, etc)',
  `activo` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_codigo` (`codigo`)
) COMMENT='Ciclos formativos disponibles';

-- ====================================================================
-- 2. CURSOS
-- ====================================================================
CREATE TABLE `cursos` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_ciclo` INT NOT NULL COMMENT 'Ciclo al que pertenece',
  `numero_curso` INT NOT NULL COMMENT 'Número del curso: 1, 2, 3...',
  `nombre` VARCHAR(255) NOT NULL COMMENT 'Ej: 1º DAM, 2º DAM',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_ciclo`) REFERENCES `ciclos`(`id`) ON DELETE RESTRICT,
  UNIQUE KEY `uk_ciclo_numero` (`id_ciclo`, `numero_curso`),
  INDEX `idx_ciclo` (`id_ciclo`)
) COMMENT='Cursos dentro de cada ciclo formativo';

-- ====================================================================
-- 3. RESULTADOS DE APRENDIZAJE (RA)
-- ====================================================================
CREATE TABLE `resultados_aprendizaje` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `codigo` VARCHAR(50) UNIQUE NOT NULL COMMENT 'Código del RA',
  `descripcion` TEXT NOT NULL COMMENT 'Descripción del resultado de aprendizaje',
  `id_ciclo` INT NOT NULL COMMENT 'Ciclo al que pertenece',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_ciclo`) REFERENCES `ciclos`(`id`) ON DELETE RESTRICT,
  INDEX `idx_codigo` (`codigo`),
  INDEX `idx_ciclo` (`id_ciclo`)
) COMMENT='Resultados de aprendizaje por ciclo';

-- ====================================================================
-- 4. COMPETENCIAS
-- ====================================================================
CREATE TABLE `competencias` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `codigo` VARCHAR(50) UNIQUE NOT NULL COMMENT 'Código de la competencia',
  `descripcion` TEXT NOT NULL COMMENT 'Descripción de la competencia',
  `tipo` ENUM('TECNICA', 'TRANSVERSAL', 'PERSONAL') NOT NULL DEFAULT 'TECNICA',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_codigo` (`codigo`),
  INDEX `idx_tipo` (`tipo`)
) COMMENT='Competencias profesionales';

-- ====================================================================
-- 5. RELACIÓN: RESULTADOS DE APRENDIZAJE - COMPETENCIAS
-- ====================================================================
CREATE TABLE `competencia_ra` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_competencia` INT NOT NULL,
  `id_ra` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_competencia`) REFERENCES `competencias`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_ra`) REFERENCES `resultados_aprendizaje`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `uk_competencia_ra` (`id_competencia`, `id_ra`)
) COMMENT='Relación muchos a muchos entre competencias y RAs';

-- ====================================================================
-- 6. MÓDULOS FORMATIVOS
-- ====================================================================
CREATE TABLE `modulos` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `codigo` VARCHAR(50) UNIQUE NOT NULL COMMENT 'Código del módulo',
  `nombre` VARCHAR(255) NOT NULL COMMENT 'Nombre del módulo',
  `id_curso` INT NOT NULL COMMENT 'Curso al que pertenece',
  `horas_totales` INT COMMENT 'Total de horas del módulo',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_curso`) REFERENCES `cursos`(`id`) ON DELETE RESTRICT,
  INDEX `idx_codigo` (`codigo`),
  INDEX `idx_curso` (`id_curso`)
) COMMENT='Módulos formativos de cada curso';

-- ====================================================================
-- 7. RELACIÓN: MÓDULOS - COMPETENCIAS
-- ====================================================================
CREATE TABLE `modulo_competencia` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_modulo` INT NOT NULL,
  `id_competencia` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_modulo`) REFERENCES `modulos`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_competencia`) REFERENCES `competencias`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `uk_modulo_competencia` (`id_modulo`, `id_competencia`)
) COMMENT='Relación muchos a muchos entre módulos y competencias';

-- ====================================================================
-- 8. USUARIOS (Para autenticación)
-- ====================================================================
CREATE TABLE `users` (
  `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `apellidos` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `telefono` VARCHAR(20),
  `rol` ENUM('ADMIN', 'TUTOR_CENTRO', 'TUTOR_EMPRESA', 'ALUMNO') NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `activo` BOOLEAN DEFAULT TRUE,
  `email_verified_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL COMMENT 'Soft delete',
  INDEX `idx_email` (`email`),
  INDEX `idx_rol` (`rol`)
) COMMENT='Usuarios del sistema';

-- ====================================================================
-- 9. ALUMNOS
-- ====================================================================
CREATE TABLE `alumnos` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_user` BIGINT UNIQUE NOT NULL,
  `dni` VARCHAR(15) UNIQUE COMMENT 'DNI del alumno',
  `numero_cuaderno` VARCHAR(50) COMMENT 'Número de cuaderno/expediente',
  `id_ciclo` INT NOT NULL COMMENT 'Ciclo en el que está matriculado',
  `curso_actual` INT COMMENT 'Curso actual: 1, 2, 3...',
  `poblacion` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_ciclo`) REFERENCES `ciclos`(`id`) ON DELETE RESTRICT,
  INDEX `idx_dni` (`dni`),
  INDEX `idx_ciclo` (`id_ciclo`)
) COMMENT='Información de alumnos';

-- ====================================================================
-- 10. EMPRESAS
-- ====================================================================
CREATE TABLE `empresas` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `cif` VARCHAR(20) UNIQUE NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `localidad` VARCHAR(255),
  `provincia` VARCHAR(255),
  `codigo_postal` VARCHAR(10),
  `telefono` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `estado` ENUM('ACTIVA', 'INACTIVA', 'SUSPENDIDA') DEFAULT 'ACTIVA',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `uk_cif` (`cif`),
  INDEX `idx_nombre` (`nombre`),
  INDEX `idx_estado` (`estado`)
) COMMENT='Empresas colaboradoras';

-- ====================================================================
-- 10.1 CONTACTOS DE EMPRESA
-- ====================================================================
CREATE TABLE `contactos_empresa` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_empresa` INT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `apellidos` VARCHAR(255),
  `email` VARCHAR(255),
  `telefono` VARCHAR(20),
  `activo` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_empresa`) REFERENCES `empresas`(`id`) ON DELETE CASCADE,
  INDEX `idx_empresa` (`id_empresa`)
) COMMENT='Contactos asociados a cada empresa';

-- ====================================================================
-- 11. ESTANCIAS FORMATIVAS (Centro del sistema)
-- ====================================================================
CREATE TABLE `estancias_formativas` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_alumno` INT NOT NULL,
  `id_empresa` INT NOT NULL,
  `id_tutor_empresa` BIGINT NOT NULL COMMENT 'Usuario con rol TUTOR_EMPRESA',
  `id_tutor_centro` BIGINT NOT NULL COMMENT 'Usuario con rol TUTOR_CENTRO',
  `id_curso` INT NOT NULL COMMENT 'Curso en el que se realiza la estancia',
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `horas_totales` INT NOT NULL COMMENT 'Horas totales de la estancia',
  `horas_realizadas` INT DEFAULT 0 COMMENT 'Horas completadas hasta el momento',
  `estado` ENUM('PLANIFICADA', 'EN_CURSO', 'COMPLETADA', 'CANCELADA') DEFAULT 'PLANIFICADA',
  `observaciones` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_alumno`) REFERENCES `alumnos`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`id_empresa`) REFERENCES `empresas`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`id_tutor_empresa`) REFERENCES `users`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`id_tutor_centro`) REFERENCES `users`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`id_curso`) REFERENCES `cursos`(`id`) ON DELETE RESTRICT,
  INDEX `idx_alumno` (`id_alumno`),
  INDEX `idx_empresa` (`id_empresa`),
  INDEX `idx_curso` (`id_curso`),
  INDEX `idx_estado` (`estado`),
  INDEX `idx_fechas` (`fecha_inicio`, `fecha_fin`)
) COMMENT='Estancias formativas en empresa';

-- ====================================================================
-- 12. HORARIOS DE ESTANCIA
-- ====================================================================
CREATE TABLE `horarios_estancia` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_estancia` INT NOT NULL,
  `dia_semana` ENUM('LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO') NOT NULL,
  `turno` ENUM('MAÑANA', 'TARDE', 'NOCHE', 'CONTINUO') DEFAULT 'CONTINUO',
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_estancia`) REFERENCES `estancias_formativas`(`id`) ON DELETE CASCADE,
  INDEX `idx_estancia` (`id_estancia`),
  INDEX `idx_dia` (`dia_semana`)
) COMMENT='Horario semanal del alumno durante la estancia (permite horarios partidos)';

-- ====================================================================
-- 13. SEGUIMIENTO DE COMPETENCIAS POR SEMANA (Clave del sistema)
-- ====================================================================
CREATE TABLE `seguimiento_competencias` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_estancia` INT NOT NULL,
  `id_competencia` INT NOT NULL,
  `numero_semana` INT NOT NULL COMMENT 'Número de semana en la que se trabaja',
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_estancia`) REFERENCES `estancias_formativas`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_competencia`) REFERENCES `competencias`(`id`) ON DELETE RESTRICT,
  UNIQUE KEY `uk_estancia_competencia_semana` (`id_estancia`, `id_competencia`, `numero_semana`),
  INDEX `idx_estancia` (`id_estancia`),
  INDEX `idx_competencia` (`id_competencia`),
  INDEX `idx_semana` (`numero_semana`)
) COMMENT='Seguimiento semanal de competencias durante la estancia';

-- ====================================================================
-- 14. NOTAS/SEGUIMIENTO DEL ALUMNO
-- ====================================================================
CREATE TABLE `notas_seguimiento` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_estancia` INT NOT NULL,
  `id_alumno` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `accion` ENUM('PRESENTACION_ALUMNO', 'LLAMADA_SEGUIMIENTO', 'VISITA_CENTRO_TRABAJO', 'REUNION_PROFESORES', 'REUNION_TUTOR_PRACTICAS', 'INCIDENCIA', 'EVALUACION', 'OTRA') DEFAULT 'OTRA',
  `contenido` TEXT NOT NULL COMMENT 'Contenido de la nota o seguimiento',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_estancia`) REFERENCES `estancias_formativas`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_alumno`) REFERENCES `alumnos`(`id`) ON DELETE CASCADE,
  INDEX `idx_estancia` (`id_estancia`),
  INDEX `idx_alumno` (`id_alumno`),
  INDEX `idx_fecha` (`fecha`),
  INDEX `idx_accion` (`accion`)
) COMMENT='Notas y seguimiento del progreso del alumno durante la estancia';

-- ====================================================================
-- 15. EVALUACIONES/CALIFICACIONES
-- ====================================================================
CREATE TABLE `evaluaciones` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_estancia` INT NOT NULL,
  `id_modulo` INT NOT NULL COMMENT 'Módulo que se está evaluando',
  `nota_previa` DECIMAL(4,2) COMMENT 'Nota previa a FCT (80% de la nota final) - dato en duro',
  `nota_competencias_tecnicas` DECIMAL(4,2) COMMENT 'Evaluación de competencias técnicas por tutor empresa (0-10)',
  `nota_competencias_transversales` DECIMAL(4,2) COMMENT 'Evaluación de competencias transversales por tutor empresa (0-10)',
  `nota_cuaderno` DECIMAL(4,2) COMMENT 'Evaluación del cuaderno por tutor centro (0-10)',
  `nota_fct_calculada` DECIMAL(4,2) COMMENT 'Nota FCT calculada (20% de la nota final)',
  `nota_final` DECIMAL(4,2) COMMENT 'Nota final calculada (80% previa + 20% FCT)',
  `observaciones` TEXT,
  `fecha_evaluacion` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_estancia`) REFERENCES `estancias_formativas`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_modulo`) REFERENCES `modulos`(`id`) ON DELETE RESTRICT,
  UNIQUE KEY `uk_estancia_modulo` (`id_estancia`, `id_modulo`),
  INDEX `idx_estancia` (`id_estancia`),
  INDEX `idx_modulo` (`id_modulo`)
) COMMENT='Evaluaciones de módulos durante la estancia formativa';

-- ====================================================================
-- 16. LOGS DEL SISTEMA
-- ====================================================================
CREATE TABLE `logs` (
  `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
  `id_usuario` BIGINT COMMENT 'Usuario que generó el log (NULL para logs del sistema)',
  `nivel` ENUM('DEBUG', 'INFO', 'WARNING', 'ERROR', 'CRITICAL') DEFAULT 'INFO',
  `tipo` VARCHAR(100) COMMENT 'Tipo de evento: auth, database, api, email, file, etc.',
  `mensaje` TEXT NOT NULL COMMENT 'Descripción del evento',
  `contexto` JSON COMMENT 'Información adicional del evento',
  `tabla_afectada` VARCHAR(100) COMMENT 'Tabla de BD afectada (si aplica)',
  `registro_id` INT COMMENT 'ID del registro afectado (si aplica)',
  `ip` VARCHAR(45) COMMENT 'Dirección IP del cliente',
  `user_agent` TEXT COMMENT 'User agent del navegador',
  `url` VARCHAR(500) COMMENT 'URL de la petición',
  `metodo_http` VARCHAR(10) COMMENT 'GET, POST, PUT, DELETE, etc.',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_usuario`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  INDEX `idx_usuario` (`id_usuario`),
  INDEX `idx_nivel` (`nivel`),
  INDEX `idx_tipo` (`tipo`),
  INDEX `idx_tabla` (`tabla_afectada`),
  INDEX `idx_fecha` (`created_at`)
) COMMENT='Registro de logs y eventos del sistema';

-- ====================================================================
-- FIN DEL ESQUEMA
-- ====================================================================
