# Testing Infrastructure

Este documento explica cómo usar la infraestructura de testing configurada para el plugin WP Plugin TDD Boilerplate.

## Configuración

### Dependencias de Testing

El proyecto incluye las siguientes herramientas de testing:

- **PHPUnit 9.6**: Framework principal de testing
- **Brain Monkey**: Para hacer mocking de funciones de WordPress
- **Mockery**: Para crear mocks y stubs avanzados
- **Yoast PHPUnit Polyfills**: Para compatibilidad con versiones de PHPUnit

### Estructura de Tests

```
tests/
├── bootstrap.php              # Configuración inicial para tests
├── BaseTestCase.php          # Clase base para todos los tests
├── Unit/                     # Tests unitarios
│   └── PluginTest.php
└── Integration/             # Tests de integración
    └── PluginIntegrationTest.php
```

## Ejecutar Tests

### Comandos Disponibles

```bash
# Ejecutar todos los tests
composer test

# Ejecutar solo tests unitarios
composer test:unit

# Ejecutar solo tests de integración
composer test:integration

# Ejecutar tests con reporte de cobertura
composer test:coverage
```

### Desde VS Code

Puedes ejecutar los tests desde VS Code usando las tareas predefinidas:

1. `Ctrl+Shift+P` (o `Cmd+Shift+P` en Mac)
2. Escribir "Tasks: Run Task"
3. Seleccionar una de las siguientes opciones:
   - "Plugin: Ejecutar todos los tests"
   - "Plugin: Ejecutar tests unitarios"
   - "Plugin: Ejecutar tests de integración"
   - "Plugin: Tests con cobertura"

## Paradigma TDD (Test-Driven Development)

### Flujo de Trabajo TDD

1. **Red**: Escribir un test que falle
2. **Green**: Escribir el código mínimo para que pase
3. **Refactor**: Mejorar el código manteniendo los tests verdes

### Ejemplo de Workflow

```bash
# 1. Escribir un test que falle
composer test:unit

# 2. Implementar el código mínimo
# (editar src/)

# 3. Verificar que el test pasa
composer test:unit

# 4. Refactorizar si es necesario
# (editar src/)

# 5. Verificar que todos los tests siguen pasando
composer test
```

## Escribir Tests

### Tests Unitarios

Los tests unitarios van en `tests/Unit/` y prueban clases de forma aislada:

```php
<?php
namespace VendorName\PluginName\Tests\Unit;

use VendorName\PluginName\Tests\BaseTestCase;

class MyClassTest extends BaseTestCase {
    
    public function test_method_does_something(): void {
        // Arrange
        $instance = new MyClass();
        
        // Act
        $result = $instance->doSomething();
        
        // Assert
        $this->assertTrue($result);
    }
}
```

### Tests de Integración

Los tests de integración van en `tests/Integration/` y prueban la interacción entre componentes:

```php
<?php
namespace VendorName\PluginName\Tests\Integration;

use VendorName\PluginName\Tests\BaseTestCase;
use Brain\Monkey;

class MyIntegrationTest extends BaseTestCase {
    
    public function test_wordpress_integration(): void {
        // Mock WordPress functions
        Monkey\Functions\when('add_action')->justReturn(true);
        
        // Test integration
        $this->assertTrue(true);
    }
}
```

### Mocking de WordPress

Usa Brain Monkey para hacer mock de funciones de WordPress:

```php
// Mock una función simple
Monkey\Functions\when('get_option')->justReturn('default_value');

// Mock con expectativas
Monkey\Functions\expect('add_action')
    ->once()
    ->with('init', Mockery::type('callable'));

// Mock con alias (función personalizada)
Monkey\Functions\when('wp_parse_args')->alias(function($args, $defaults) {
    return is_array($defaults) ? array_merge($defaults, $args) : $args;
});
```

## Cobertura de Código

Para generar un reporte de cobertura:

```bash
composer test:coverage
```

Esto generará un reporte HTML en `coverage-report/index.html`.

## Mejores Prácticas

### Nomenclatura de Tests

- Usar `test_` como prefijo para métodos de test
- Nombres descriptivos: `test_user_can_save_preferences()`
- Un test por comportamiento específico

### Estructura AAA

Organizar tests usando el patrón Arrange-Act-Assert:

```php
public function test_method_behavior(): void {
    // Arrange: Preparar datos y mocks
    $instance = new MyClass();
    Monkey\Functions\when('get_option')->justReturn('test_value');
    
    // Act: Ejecutar el método a probar
    $result = $instance->methodToTest();
    
    // Assert: Verificar el resultado
    $this->assertEquals('expected_value', $result);
}
```

### Tests Independientes

- Cada test debe ser independiente
- No confiar en el orden de ejecución
- Limpiar estado en `tearDown()` si es necesario

## Configuración de PHPUnit

La configuración está en `phpunit.xml`:

- Bootstrap: `tests/bootstrap.php`
- Suites: `unit` e `integration`
- Cobertura: incluye `src/`, excluye `vendor/` y `tests/`
- Logs: genera `test-results.xml` para CI/CD

## Integración con CI/CD

Los tests están configurados para ejecutarse en pipelines de CI/CD:

- JUnit XML output en `test-results.xml`
- Reportes de cobertura en formato HTML
- Códigos de salida apropiados para pipelines

## Troubleshooting

### Errores Comunes

1. **"Brain Monkey not found"**: Ejecutar `composer install`
2. **"Class not found"**: Verificar autoload en `composer.json`
3. **"WordPress function undefined"**: Añadir mock en `bootstrap.php`

### Debug

Para debuggear tests, usar `var_dump()` o PHPUnit's `dump()`:

```php
public function test_debug_example(): void {
    $result = $this->methodUnderTest();
    dump($result); // PHPUnit dump helper
    $this->assertTrue(true);
}
```
