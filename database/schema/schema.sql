USE dkapp

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
-- Almacena los ciclos formativos disponibles (DAM, ASIR, etc.)
-- Cada ciclo agrupa cursos y tiene un código único, nombre y nivel
CREATE TABLE `ciclos` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `codigo` VARCHAR(50) UNIQUE NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `nivel` INT NOT NULL,
  `activo` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_codigo` (`codigo`)
);

-- ====================================================================
-- 2. CURSOS
-- ====================================================================
-- Almacena los cursos dentro de cada ciclo (1º DAM, 2º DAM, etc.)
-- Cada curso pertenece a un ciclo y tiene un número de curso asociado
CREATE TABLE `cursos` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_ciclo` INT NOT NULL,
  `numero_curso` INT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_ciclo`) REFERENCES `ciclos`(`id`) ON DELETE RESTRICT,
  UNIQUE KEY `uk_ciclo_numero` (`id_ciclo`, `numero_curso`),
  INDEX `idx_ciclo` (`id_ciclo`)
);

-- ====================================================================
-- 3. RESULTADOS DE APRENDIZAJE (RA)
-- ====================================================================
-- Define los resultados de aprendizaje esperados para cada ciclo formativo
-- Cada RA tiene un código único y una descripción detallada
CREATE TABLE `resultados_aprendizaje` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `codigo` VARCHAR(50) UNIQUE NOT NULL,
  `descripcion` TEXT NOT NULL,
  `id_ciclo` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_ciclo`) REFERENCES `ciclos`(`id`) ON DELETE RESTRICT,
  INDEX `idx_codigo` (`codigo`),
  INDEX `idx_ciclo` (`id_ciclo`)
);

-- ====================================================================
-- 4. COMPETENCIAS
-- ====================================================================
-- Almacena todas las competencias profesionales (técnicas, transversales, personales)
-- Cada competencia tiene un código único y descripción
CREATE TABLE `competencias` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `codigo` VARCHAR(50) UNIQUE NOT NULL,
  `descripcion` TEXT NOT NULL,
  `tipo` ENUM('TECNICA', 'TRANSVERSAL', 'PERSONAL') NOT NULL DEFAULT 'TECNICA',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_codigo` (`codigo`),
  INDEX `idx_tipo` (`tipo`)
);

-- ====================================================================
-- 5. RELACIÓN: RESULTADOS DE APRENDIZAJE - COMPETENCIAS
-- ====================================================================
-- Tabla de relación muchos a muchos que vincula cada RA con las competencias asociadas
CREATE TABLE `competencia_ra` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_competencia` INT NOT NULL,
  `id_ra` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_competencia`) REFERENCES `competencias`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_ra`) REFERENCES `resultados_aprendizaje`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `uk_competencia_ra` (`id_competencia`, `id_ra`)
);

-- ====================================================================
-- 6. MÓDULOS FORMATIVOS
-- ====================================================================
-- Almacena los módulos formativos de cada curso con información de horas totales
-- Cada módulo pertenece a un curso específico
CREATE TABLE `modulos` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `codigo` VARCHAR(50) UNIQUE NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `id_curso` INT NOT NULL,
  `horas_totales` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_curso`) REFERENCES `cursos`(`id`) ON DELETE RESTRICT,
  INDEX `idx_codigo` (`codigo`),
  INDEX `idx_curso` (`id_curso`)
);

-- ====================================================================
-- 7. RELACIÓN: MÓDULOS - COMPETENCIAS
-- ====================================================================
-- Tabla de relación muchos a muchos que vincula cada módulo con las competencias que trabaja
CREATE TABLE `modulo_competencia` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_modulo` INT NOT NULL,
  `id_competencia` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_modulo`) REFERENCES `modulos`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_competencia`) REFERENCES `competencias`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `uk_modulo_competencia` (`id_modulo`, `id_competencia`)
);

-- ====================================================================
-- 8. USUARIOS (Para autenticación)
-- ====================================================================
-- Almacena todos los usuarios del sistema con sus datos básicos y roles
-- Roles: ADMIN, TUTOR_CENTRO, TUTOR_EMPRESA, ALUMNO
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
  `deleted_at` TIMESTAMP NULL,
  INDEX `idx_email` (`email`),
  INDEX `idx_rol` (`rol`)
);

-- ====================================================================
-- 9. ALUMNOS
-- ====================================================================
-- Almacena información específica de los alumnos vinculados a usuarios
-- Contiene datos personales, ciclo matriculado y curso actual
CREATE TABLE `alumnos` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_user` BIGINT UNIQUE NOT NULL,
  `dni` VARCHAR(15) UNIQUE,
  `numero_cuaderno` VARCHAR(50),
  `id_ciclo` INT NOT NULL,
  `curso_actual` INT,
  `poblacion` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_ciclo`) REFERENCES `ciclos`(`id`) ON DELETE RESTRICT,
  INDEX `idx_dni` (`dni`),
  INDEX `idx_ciclo` (`id_ciclo`)
);

-- ====================================================================
-- 10. EMPRESAS
-- ====================================================================
-- Almacena información de las empresas colaboradoras en prácticas
-- Contiene datos fiscales, contacto y estado de actividad
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
);

-- ====================================================================
-- 10.1 CONTACTOS DE EMPRESA
-- ====================================================================
-- Almacena los contactos asociados a cada empresa (personas de contacto)
-- Permite tener múltiples contactos por empresa
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
);

-- ====================================================================
-- 11. ESTANCIAS FORMATIVAS (Centro del sistema)
-- ====================================================================
-- Tabla central que registra las estancias formativas de los alumnos en empresas
-- Vincula alumno, empresa, tutores, curso y seguimiento de horas y estado
CREATE TABLE `estancias_formativas` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_alumno` INT NOT NULL,
  `id_empresa` INT NOT NULL,
  `id_tutor_empresa` BIGINT NOT NULL,
  `id_tutor_centro` BIGINT NOT NULL,
  `id_curso` INT NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `horas_totales` INT NOT NULL,
  `horas_realizadas` INT DEFAULT 0,
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
);

-- ====================================================================
-- 12. HORARIOS DE ESTANCIA
-- ====================================================================
-- Define el horario semanal (con posibilidad de horarios partidos) del alumno durante la estancia
-- Permite registrar diferentes turnos para cada día de la semana
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
);

-- ====================================================================
-- 13. SEGUIMIENTO DE COMPETENCIAS POR SEMANA (Clave del sistema)
-- ====================================================================
-- Registra qué competencias se trabajan cada semana durante la estancia formativa
-- Es clave para el seguimiento y evaluación del alumno semana a semana
CREATE TABLE `seguimiento_competencias` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_estancia` INT NOT NULL,
  `id_competencia` INT NOT NULL,
  `numero_semana` INT NOT NULL,
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
);

-- ====================================================================
-- 14. NOTAS/SEGUIMIENTO DEL ALUMNO
-- ====================================================================
-- Registra notas y eventos de seguimiento del alumno durante la estancia
-- Incluye presentaciones, llamadas, visitas, reuniones e incidencias
CREATE TABLE `notas_seguimiento` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_estancia` INT NOT NULL,
  `id_alumno` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `accion` ENUM('PRESENTACION_ALUMNO', 'LLAMADA_SEGUIMIENTO', 'VISITA_CENTRO_TRABAJO', 'REUNION_PROFESORES', 'REUNION_TUTOR_PRACTICAS', 'INCIDENCIA', 'EVALUACION', 'OTRA') DEFAULT 'EVALUACION',
  `contenido` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_estancia`) REFERENCES `estancias_formativas`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_alumno`) REFERENCES `alumnos`(`id`) ON DELETE CASCADE,
  INDEX `idx_estancia` (`id_estancia`),
  INDEX `idx_alumno` (`id_alumno`),
  INDEX `idx_fecha` (`fecha`),
  INDEX `idx_accion` (`accion`)
);

-- ====================================================================
-- 15. EVALUACIONES/CALIFICACIONES
-- ====================================================================
-- Registra las evaluaciones y calificaciones de los módulos durante la estancia
-- Incluye notas previas, técnicas, transversales, cuaderno y cálculo de nota final
CREATE TABLE `evaluaciones` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_estancia` INT NOT NULL,
  `id_modulo` INT NOT NULL,
  `nota_previa` DECIMAL(4,2),
  `nota_competencias_tecnicas` DECIMAL(4,2),
  `nota_competencias_transversales` DECIMAL(4,2),
  `nota_cuaderno` DECIMAL(4,2),
  `nota_fct_calculada` DECIMAL(4,2),
  `nota_final` DECIMAL(4,2),
  `observaciones` TEXT,
  `fecha_evaluacion` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_estancia`) REFERENCES `estancias_formativas`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_modulo`) REFERENCES `modulos`(`id`) ON DELETE RESTRICT,
  UNIQUE KEY `uk_estancia_modulo` (`id_estancia`, `id_modulo`),
  INDEX `idx_estancia` (`id_estancia`),
  INDEX `idx_modulo` (`id_modulo`)
);

-- ====================================================================
-- 16. INCIDENCIAS
-- ====================================================================
-- Almacena las incidencias, reportes y sugerencias de los usuarios
-- Permite a los usuarios reportar problemas, solicitar mejoras y otros problemas del sistema
CREATE TABLE `incidencias` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_usuario` BIGINT NOT NULL,
  `tipo` ENUM('MEJORA', 'NO FUNCIONA', 'PROBLEMA', 'OTRO') NOT NULL DEFAULT 'OTRO',
  `descripcion` TEXT NOT NULL,
  `estado` ENUM('ACTIVA', 'INACTIVA', 'CERRADA') DEFAULT 'ACTIVA',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_usuario`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  INDEX `idx_usuario` (`id_usuario`),
  INDEX `idx_tipo` (`tipo`),
  INDEX `idx_estado` (`estado`),
  INDEX `idx_fecha` (`created_at`)
);

-- ====================================================================
-- 17. LOGS DEL SISTEMA
-- ====================================================================
-- Registra todos los eventos y logs del sistema con información de usuario, acción y contexto
-- Permite auditoría completa de todas las operaciones realizadas
CREATE TABLE `logs` (
  `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
  `id_usuario` BIGINT,
  `nivel` ENUM('DEBUG', 'INFO', 'WARNING', 'ERROR', 'CRITICAL') DEFAULT 'INFO',
  `tipo` VARCHAR(100),
  `mensaje` TEXT NOT NULL,
  `contexto` JSON,
  `tabla_afectada` VARCHAR(100),
  `registro_id` INT,
  `ip` VARCHAR(45),
  `user_agent` TEXT,
  `url` VARCHAR(500),
  `metodo_http` VARCHAR(10),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_usuario`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  INDEX `idx_usuario` (`id_usuario`),
  INDEX `idx_nivel` (`nivel`),
  INDEX `idx_tipo` (`tipo`),
  INDEX `idx_tabla` (`tabla_afectada`),
  INDEX `idx_fecha` (`created_at`)
);

-- ====================================================================
-- FIN DEL ESQUEMA
-- ====================================================================
