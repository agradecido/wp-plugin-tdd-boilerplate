# Ejemplo de Workflow TDD

Este archivo documenta un ejemplo práctico de cómo seguir el paradigma TDD (Test-Driven Development) en este proyecto.

## Caso de Ejemplo: Clase Config

### 1. RED - Escribir Tests que Fallen

Primero escribimos los tests que describen el comportamiento esperado de la clase `Config`:

```bash
# Crear el archivo de test primero
# tests/Unit/ConfigTest.php

# Ejecutar tests y ver que fallan
composer test:unit
```

**Resultado**: Error - Class "VendorName\PluginName\Utils\Config" not found

### 2. GREEN - Escribir Código Mínimo para Pasar Tests

Creamos la implementación mínima necesaria para que todos los tests pasen:

```bash
# Crear la clase src/Utils/Config.php
# con la implementación mínima

# Ejecutar tests nuevamente
composer test:unit
```

**Resultado**: OK (10 tests, 20 assertions)

### 3. REFACTOR - Mejorar el Código

Una vez que todos los tests pasan, podemos refactorizar el código para mejorarlo sin romper la funcionalidad:

- Mejorar nombres de variables
- Optimizar performance
- Agregar documentación
- Restructurar código

```bash
# Después de cada cambio, ejecutar tests
composer test:unit
```

## Comandos Útiles para TDD

### Flujo de Trabajo Típico

```bash
# 1. Escribir un test que falle
vim tests/Unit/MiClaseTest.php

# 2. Ejecutar test y verificar que falla
composer test:unit

# 3. Escribir código mínimo para pasar
vim src/MiClase.php

# 4. Ejecutar test y verificar que pasa
composer test:unit

# 5. Refactorizar si es necesario
vim src/MiClase.php

# 6. Ejecutar todos los tests
composer test

# 7. Repetir para siguiente funcionalidad
```

### Tests Específicos

```bash
# Ejecutar test específico
vendor/bin/phpunit tests/Unit/ConfigTest.php

# Ejecutar método específico
vendor/bin/phpunit --filter test_config_can_be_instantiated

# Ejecutar tests con verbose
vendor/bin/phpunit --verbose
```

### Debugging

```bash
# Tests con más información de errores
vendor/bin/phpunit --testdox

# Tests con stack trace completo
vendor/bin/phpunit --debug
```

## Principios TDD Aplicados

### 1. Red-Green-Refactor

- **Red**: Test falla (implementación no existe)
- **Green**: Test pasa (implementación mínima)
- **Refactor**: Mejorar código (mantener tests verdes)

### 2. YAGNI (You Aren't Gonna Need It)

Solo implementamos lo que los tests requieren. No añadimos funcionalidad extra "por si acaso".

### 3. KISS (Keep It Simple, Stupid)

La implementación más simple que haga pasar los tests es la correcta.

### 4. Tests como Documentación

Los tests describen el comportamiento esperado y sirven como documentación viva del código.

## Beneficios Observados

1. **Código más limpio**: Solo escribimos lo necesario
2. **Mayor confianza**: Los tests garantizan que el código funciona
3. **Refactoring seguro**: Podemos cambiar implementación sin miedo
4. **Detección temprana de errores**: Los tests fallan inmediatamente si algo se rompe
5. **Mejor diseño**: Pensar en tests primero lleva a mejor arquitectura

## Próximos Pasos TDD

Para continuar con TDD en el proyecto:

1. **Escribir tests para funcionalidades existentes** que no tienen cobertura
2. **Seguir el ciclo Red-Green-Refactor** para nuevas funcionalidades
3. **Mantener alta cobertura de tests** (objetivo: >80%)
4. **Ejecutar tests frecuentemente** en desarrollo
5. **Integrar tests en CI/CD** para prevenir regresiones
