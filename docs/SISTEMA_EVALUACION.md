# Sistema de Evaluación de Estancias Formativas (FCT)

## 📊 Estructura General de Notas

### Nota Final de un Módulo
```
Nota Final = (Nota Previa × 80%) + (Nota FCT × 20%)
```

---

## 🎯 Composición de la Nota FCT (20% de la nota final)

La nota de FCT se divide en **tres componentes**:

| Componente | Peso Base | Evaluador | Descripción |
|------------|-----------|-----------|-------------|
| **Técnico** | 60% | Tutor Empresa | Evaluación de competencias técnicas |
| **Transversal** | 20% | Tutor Empresa | Evaluación de competencias transversales |
| **Cuaderno** | 20% | Tutor Centro | Evaluación del cuaderno de prácticas |

### Fórmula Base (con competencias técnicas)
```
Nota FCT = (Nota Técnico × 0.60) + (Nota Transversal × 0.20) + (Nota Cuaderno × 0.20)
```

---

## ⚙️ Cálculo de Competencias Técnicas

### Caso 1: Módulo CON competencias técnicas asignadas

Las competencias técnicas están asociadas a módulos a través de:
```
modulo_competencia → competencias (tipo='TECNICA')
```

**Proceso:**
1. El tutor de empresa evalúa cada competencia técnica (0-10)
2. Si una competencia está en **varios módulos**, la nota se **reparte proporcionalmente**

**Ejemplo:**
```
Competencia "Programación OOP" → Nota: 8
  ├── Módulo 1: Programación (ponderación 50%)
  │   └── Contribuye con: 8 × 0.50 = 4 puntos
  └── Módulo 2: Bases de Datos (ponderación 50%)
      └── Contribuye con: 8 × 0.50 = 4 puntos
```

**Nota técnica del módulo:**
```
Nota Técnico = Promedio de todas las competencias técnicas asociadas al módulo
```

---

### Caso 2: Módulo SIN competencias técnicas asignadas

Si un módulo **NO tiene competencias técnicas**, el peso del 60% técnico se **redistribuye**:

| Componente | Peso Redistribuido |
|------------|-------------------|
| **Transversal** | 50% (antes 20%) |
| **Cuaderno** | 50% (antes 20%) |

**Fórmula ajustada:**
```
Nota FCT = (Nota Transversal × 0.50) + (Nota Cuaderno × 0.50)
```

---

## 📝 Flujo de Evaluación

### Paso 1: Entrada de Datos

| Campo | Tipo | Responsable | Descripción |
|-------|------|-------------|-------------|
| `nota_previa` | Decimal | Sistema/Admin | Nota previa a FCT (80% de la nota final) - **dato en duro** |
| `nota_competencias_tecnicas` | Decimal | Tutor Empresa | Evaluación de competencias técnicas (0-10) |
| `nota_competencias_transversales` | Decimal | Tutor Empresa | Evaluación de competencias transversales (0-10) |
| `nota_cuaderno` | Decimal | Tutor Centro | Evaluación del cuaderno (0-10) |

### Paso 2: Cálculos Automáticos

El sistema calcula automáticamente:

#### 2.1. Determinar si el módulo tiene competencias técnicas
```sql
SELECT COUNT(*) 
FROM modulo_competencia mc
JOIN competencias c ON mc.id_competencia = c.id
WHERE mc.id_modulo = ? AND c.tipo = 'TECNICA'
```

#### 2.2. Calcular Nota FCT

**SI tiene competencias técnicas:**
```php
$notaFCT = ($notaTecnicas * 0.60) + ($notaTransversales * 0.20) + ($notaCuaderno * 0.20);
```

**SI NO tiene competencias técnicas:**
```php
$notaFCT = ($notaTransversales * 0.50) + ($notaCuaderno * 0.50);
```

#### 2.3. Calcular Nota Final
```php
$notaFinal = ($notaPrevia * 0.80) + ($notaFCT * 0.20);
```

### Paso 3: Guardar en BD
```php
$evaluacion->nota_fct_calculada = $notaFCT;
$evaluacion->nota_final = $notaFinal;
$evaluacion->save();
```

---

## 🔄 Ponderación de Competencias Técnicas Multi-Módulo

Cuando una competencia técnica está asociada a **varios módulos**:

### Algoritmo de Distribución

```php
// 1. Obtener todos los módulos de la competencia
$modulos = DB::table('modulo_competencia')
    ->where('id_competencia', $competenciaId)
    ->get();

$totalModulos = count($modulos);

// 2. Calcular ponderación igual para cada módulo
$ponderacion = 1 / $totalModulos;

// 3. Aplicar a cada módulo
foreach ($modulos as $modulo) {
    $notaPonderada = $notaCompetencia * $ponderacion;
    // Guardar/usar en cálculo del módulo
}
```

### Ejemplo Completo

**Escenario:**
- Competencia "Desarrollo Web" → Nota: 9
- Asociada a:
  - Módulo A: Programación
  - Módulo B: Desarrollo Interfaces
  - Módulo C: Empresa

**Distribución:**
```
Ponderación por módulo = 1/3 = 33.33%

Módulo A recibe: 9 × 0.3333 = 3 puntos
Módulo B recibe: 9 × 0.3333 = 3 puntos
Módulo C recibe: 9 × 0.3333 = 3 puntos
```

**Cálculo final del Módulo A:**
```
Supongamos:
- Competencia "Desarrollo Web": 9 → Contribuye con 3 puntos (33%)
- Competencia "Bases de Datos": 7 → Contribuye con 7 puntos (100%)

Nota Técnico del Módulo A = Promedio(3, 7) = 5.0
```

---

## 🗄️ Estructura de Datos en BD

### Tabla `evaluaciones`

```sql
CREATE TABLE `evaluaciones` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_estancia` INT NOT NULL,
  `id_modulo` INT NOT NULL,
  `nota_previa` DECIMAL(4,2),                      -- Dato en duro (80%)
  `nota_competencias_tecnicas` DECIMAL(4,2),       -- Por tutor empresa
  `nota_competencias_transversales` DECIMAL(4,2),  -- Por tutor empresa
  `nota_cuaderno` DECIMAL(4,2),                    -- Por tutor centro
  `nota_fct_calculada` DECIMAL(4,2),               -- Calculado (20%)
  `nota_final` DECIMAL(4,2),                       -- Calculado (final)
  ...
);
```

### Relaciones Clave

```
Estancia → Evaluaciones (1:N)
Evaluación → Módulo (N:1)
Módulo → Competencias (N:M via modulo_competencia)
Competencias → tipo ENUM('TECNICA', 'TRANSVERSAL', 'PERSONAL')
```

---

## 💻 Pseudocódigo de Implementación

### Función: Calcular Nota FCT de un Módulo

```php
function calcularNotaFCT($idEstancia, $idModulo) {
    // 1. Obtener evaluación
    $evaluacion = Evaluacion::where('id_estancia', $idEstancia)
        ->where('id_modulo', $idModulo)
        ->first();
    
    // 2. Verificar si tiene competencias técnicas
    $tieneCompetenciasTecnicas = DB::table('modulo_competencia')
        ->join('competencias', 'modulo_competencia.id_competencia', '=', 'competencias.id')
        ->where('modulo_competencia.id_modulo', $idModulo)
        ->where('competencias.tipo', 'TECNICA')
        ->exists();
    
    // 3. Calcular según el caso
    if ($tieneCompetenciasTecnicas) {
        // Caso 1: Con competencias técnicas (60-20-20)
        $notaFCT = ($evaluacion->nota_competencias_tecnicas * 0.60) +
                   ($evaluacion->nota_competencias_transversales * 0.20) +
                   ($evaluacion->nota_cuaderno * 0.20);
    } else {
        // Caso 2: Sin competencias técnicas (50-50)
        $notaFCT = ($evaluacion->nota_competencias_transversales * 0.50) +
                   ($evaluacion->nota_cuaderno * 0.50);
    }
    
    // 4. Calcular nota final
    $notaFinal = ($evaluacion->nota_previa * 0.80) + ($notaFCT * 0.20);
    
    // 5. Guardar
    $evaluacion->nota_fct_calculada = round($notaFCT, 2);
    $evaluacion->nota_final = round($notaFinal, 2);
    $evaluacion->save();
    
    return $notaFinal;
}
```

### Función: Calcular Nota Técnica Ponderada

```php
function calcularNotaTecnicaModulo($idEstancia, $idModulo) {
    // 1. Obtener competencias técnicas del módulo
    $competencias = DB::table('modulo_competencia as mc')
        ->join('competencias as c', 'mc.id_competencia', '=', 'c.id')
        ->join('seguimiento_competencias as sc', function($join) use ($idEstancia) {
            $join->on('sc.id_competencia', '=', 'c.id')
                 ->where('sc.id_estancia', '=', $idEstancia);
        })
        ->where('mc.id_modulo', $idModulo)
        ->where('c.tipo', 'TECNICA')
        ->select('c.id', 'c.codigo', 'c.descripcion')
        ->distinct()
        ->get();
    
    if ($competencias->isEmpty()) {
        return null; // No hay competencias técnicas
    }
    
    $sumaNotas = 0;
    
    // 2. Para cada competencia, calcular su aporte ponderado
    foreach ($competencias as $competencia) {
        // Obtener nota de la competencia (podría venir de otra tabla o cálculo)
        $notaCompetencia = obtenerNotaCompetencia($idEstancia, $competencia->id);
        
        // Contar en cuántos módulos está esta competencia
        $totalModulos = DB::table('modulo_competencia')
            ->where('id_competencia', $competencia->id)
            ->count();
        
        // Calcular ponderación
        $ponderacion = 1 / $totalModulos;
        
        // Sumar el aporte ponderado
        $sumaNotas += ($notaCompetencia * $ponderacion);
    }
    
    // 3. Retornar promedio
    return $sumaNotas / count($competencias);
}
```

---

## 📋 Casos de Uso

### Caso A: Módulo con 2 competencias técnicas exclusivas

**Módulo:** Programación  
**Competencias técnicas:**
- POO → Nota: 8 (solo en este módulo)
- Estructuras de datos → Nota: 7 (solo en este módulo)

**Cálculo:**
```
Nota Técnico = (8 + 7) / 2 = 7.5

Nota FCT = (7.5 × 0.60) + (9 × 0.20) + (8 × 0.20)
         = 4.5 + 1.8 + 1.6
         = 7.9

Nota Final = (7.0 × 0.80) + (7.9 × 0.20)
           = 5.6 + 1.58
           = 7.18
```

---

### Caso B: Módulo con competencia compartida

**Módulo:** Programación  
**Competencias técnicas:**
- POO → Nota: 8 (en Programación + Interfaces)
- Testing → Nota: 9 (solo en Programación)

**Cálculo:**
```
POO aporta: 8 × 0.50 = 4 (compartida con otro módulo)
Testing aporta: 9 × 1.0 = 9 (exclusiva)

Nota Técnico = (4 + 9) / 2 = 6.5

Nota FCT = (6.5 × 0.60) + (8 × 0.20) + (7 × 0.20)
         = 3.9 + 1.6 + 1.4
         = 6.9

Nota Final = (6.5 × 0.80) + (6.9 × 0.20)
           = 5.2 + 1.38
           = 6.58
```

---

### Caso C: Módulo SIN competencias técnicas

**Módulo:** Formación en Centros de Trabajo  
**Competencias técnicas:** Ninguna

**Cálculo:**
```
Nota FCT = (8 × 0.50) + (7 × 0.50)
         = 4.0 + 3.5
         = 7.5

Nota Final = (7.0 × 0.80) + (7.5 × 0.20)
           = 5.6 + 1.5
           = 7.1
```

---

## ✅ Validaciones a Implementar

### 1. Validaciones de Entrada
- `nota_previa`: 0-10, 2 decimales
- `nota_competencias_tecnicas`: 0-10, 2 decimales (NULL si no aplica)
- `nota_competencias_transversales`: 0-10, 2 decimales
- `nota_cuaderno`: 0-10, 2 decimales

### 2. Validaciones de Negocio
- Una estancia solo puede tener **una evaluación por módulo**
- Las notas calculadas deben actualizarse si se modifican los componentes
- Si un módulo no tiene competencias técnicas, `nota_competencias_tecnicas` debe ser NULL

### 3. Trigger de Recalculo
Cuando se modifica:
- `nota_previa`
- `nota_competencias_tecnicas`
- `nota_competencias_transversales`
- `nota_cuaderno`

**→ Se debe recalcular automáticamente:**
- `nota_fct_calculada`
- `nota_final`

---

## 🔍 Consultas Útiles

### Obtener nota final de todos los módulos de una estancia
```sql
SELECT 
    m.nombre AS modulo,
    e.nota_previa,
    e.nota_fct_calculada,
    e.nota_final
FROM evaluaciones e
JOIN modulos m ON e.id_modulo = m.id
WHERE e.id_estancia = ?
ORDER BY m.nombre;
```

### Verificar si un módulo tiene competencias técnicas
```sql
SELECT COUNT(*) as tiene_tecnicas
FROM modulo_competencia mc
JOIN competencias c ON mc.id_competencia = c.id
WHERE mc.id_modulo = ? AND c.tipo = 'TECNICA';
```

### Listar competencias de un módulo con sus ponderaciones
```sql
SELECT 
    c.codigo,
    c.descripcion,
    COUNT(mc2.id_modulo) as total_modulos,
    (1.0 / COUNT(mc2.id_modulo)) as ponderacion
FROM competencias c
JOIN modulo_competencia mc ON c.id = mc.id_competencia
LEFT JOIN modulo_competencia mc2 ON c.id = mc2.id_competencia
WHERE mc.id_modulo = ?
GROUP BY c.id, c.codigo, c.descripcion;
```

---

## 📊 Resumen Visual

```
┌─────────────────────────────────────────────────────────────┐
│                    NOTA FINAL MÓDULO                        │
│                                                             │
│  ┌──────────────────────┐  ┌─────────────────────────────┐ │
│  │   Nota Previa (80%)  │  │    Nota FCT (20%)           │ │
│  │   [Dato en duro]     │  │                             │ │
│  └──────────────────────┘  │  ┌────────────────────────┐ │ │
│                            │  │ ¿Tiene comp. técnicas? │ │ │
│                            │  └───────┬────────────────┘ │ │
│                            │          │                  │ │
│                            │    ┌─────┴─────┐            │ │
│                            │    │           │            │ │
│                            │   SÍ          NO            │ │
│                            │    │           │            │ │
│                            │    │           │            │ │
│                            │  60-20-20   50-50          │ │
│                            │    │           │            │ │
│                            │  Técnico   Transv. +        │ │
│                            │  Transv.   Cuaderno         │ │
│                            │  Cuaderno                   │ │
│                            └─────────────────────────────┘ │
└─────────────────────────────────────────────────────────────┘
```

---

## 🚀 Roadmap de Implementación

### Fase 1: Modelo y Migraciones
- [ ] Crear migración de tabla `evaluaciones`
- [ ] Crear modelo `Evaluacion` con relaciones
- [ ] Implementar mutators para cálculos automáticos

### Fase 2: Lógica de Negocio
- [ ] Service `EvaluacionService` con métodos de cálculo
- [ ] Método `calcularNotaFCT()`
- [ ] Método `calcularNotaTecnicaPonderada()`
- [ ] Método `recalcularEvaluacion()`

### Fase 3: Validaciones
- [ ] FormRequest para validar entrada de notas
- [ ] Observer para recalcular automáticamente al modificar
- [ ] Tests unitarios de cálculos

### Fase 4: API/Controladores
- [ ] Endpoint para ingresar/actualizar evaluaciones
- [ ] Endpoint para obtener evaluaciones de una estancia
- [ ] Endpoint para recalcular evaluaciones

### Fase 5: Frontend
- [ ] Formulario de evaluación por módulo
- [ ] Vista de resumen de notas
- [ ] Indicadores visuales de ponderaciones

---

**Última actualización:** 12 de enero de 2026
