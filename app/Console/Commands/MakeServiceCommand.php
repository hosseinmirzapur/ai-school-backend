<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Symfony\Component\Console\Input\InputArgument;

class MakeServiceCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Define the type of class being generated
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/service.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }

    /**
     * @return array[]
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the service class.'],
        ];
    }

    /**
     * Build the class with the given name and replace the placeholders in the stub.
     *
     * @param string $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        // Get the stub content
        $stub = $this->files->get($this->getStub());

        // Replace the namespace and class placeholders
        return $this->replaceNamespace($stub, 'App')->replaceClass($stub, $name);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name): static
    {
        // Replace the namespace placeholder with the actual namespace
        $stub = str_replace(
            '{{ namespace }}',
            $this->getDefaultNamespace($name),
            $stub
        );

        return $this;
    }

    public function handle(): bool|int|null
    {
        // Get the name of the service class from the argument
        $name = $this->getNameInput();

        // Determine the fully qualified path for the service class
        $path = $this->getPath($this->qualifyClass($name));

        // Check if the file already exists
        if ($this->alreadyExists($name)) {
            $this->error($this->type . ' already exists!');
            return false;
        }

        // Make the directory if it doesn't exist
        $this->makeDirectory($path);

        // Create the service file from the stub and insert it into the path
        $this->files->put($path, $this->buildClass($name));

        // Output success message to console
        $this->info($this->type . ' created successfully.');

        return CommandAlias::SUCCESS;
    }
}
