# Starship Stop in Distance Calculator (PHP Version)

![logo](docs/logo.png)

This command-line interface (CLI) allows you to calculate the number of stops required for a starship to travel a given distance based on its Maximum Megalights per Hour (MGLT) value.

## Warning

The `API` folder contains data for testing in Dev stage of CLI, and will be removed in production in this repository.

## Requirements

- PHP 8.3.3 or higher

## Download

Simply clone the repository:

```bash
git clone https://github.com/Diegiwg/SSDC-PHP.git
cd SSDC-PHP
```

## Usage

The CLI provides command: `local`.

### Local Command

The `local` command allows you to test calculations using locally stored data.

```bash
php .\SSDC.php local <distance>
```

- `<distance>`: The distance to be traveled by the starship in Megalights.

## Example

To calculate the number of stops needed for a starship to travel 1.000.000 MGLT using local data:

```bash
php .\SSDC.php local 1000000
```

## Contributing

Contributions to this project are welcome. Feel free to submit bug reports, feature requests, or pull requests via the repository's issue tracker and pull request system.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
