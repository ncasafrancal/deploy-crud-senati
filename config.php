<?php

#namespace DevCoder;

class DotEnv
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected $path;


    public function __construct(string $path)
    {
        if(!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        $this->path = $path;
    }

    public function load() :void
    {
        if (!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

?>

<?php

# Usar variables de entorno
#use DevCoder\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

$host=getenv('HOST');
#$user="admin_ncasafranca";
$user=getenv('USER');
#$password="Peru2025"; //Xampp = "" | Workbench = 1234
$password=getenv('PASSWORD'); //Xampp = "" | Workbench = 1234
$db=getenv('DB');
$port=getenv('PORT');

$conexion = new mysqli($host, $user, $password, $db, $port);

if ($conexion->connect_error) {
    die("Connection failed!" . $conexion->connect_error);
}

?>