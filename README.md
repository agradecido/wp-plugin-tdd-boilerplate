# WordPress Plugin TDD Boilerplate

A boilerplate for WordPress plugin development using Test-Driven Development (TDD) principles.

## Features

- PSR-4 autoloading for classes
- PHPUnit for unit and integration testing
- PHP_CodeSniffer with WordPress Coding Standards for code linting
- PHPStan for static analysis

## Getting Started

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/agradecido/wp-plugin-tdd-boilerplate.git your-plugin-name
    ```
2.  **Navigate to the plugin directory:**
    ```bash
    cd your-plugin-name
    ```
3.  **Update `composer.json`:**
    - Change the `name`, `description`, and `authors`.
    - Update the PSR-4 namespace in the `autoload` and `autoload-dev` sections.
4.  **Run `composer install`:**
    ```bash
    composer install
    ```
5.  **Search and replace:**
    - `plugin-name` with your plugin's slug (e.g., `your-plugin-name`).
    - `Plugin_Name` with your plugin's name in PascalCase (e.g., `Your_Plugin_Name`).
    - `plugin_name` with your plugin's name in snake_case (e.g., `your_plugin_name`).
    - `VendorName\\PluginName` with your chosen namespace (e.g., `YourVendor\\YourPlugin`).
6.  **Activate the plugin in WordPress and start developing!**

## Available Commands

- `composer test`: Run all tests (unit and integration).
- `composer test:unit`: Run unit tests only.
- `composer test:integration`: Run integration tests only.
- `composer test:coverage`: Run tests and generate a code coverage report.
- `composer phpcs`: Run PHP_CodeSniffer to check for coding standards violations.
- `composer phpcbf`: Automatically fix coding standards violations.
- `composer phpstan`: Run PHPStan for static analysis.

## ToDo

- Pre-configured for GitHub Actions to automate testing and linting

## Contributing

Contributions are welcome! Please open an issue or submit a pull request.

## License

This project is licensed under the MIT License.