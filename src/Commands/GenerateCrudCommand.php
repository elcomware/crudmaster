<?php

declare(strict_types=1);

namespace Elcomware\CrudMaster\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

/**
 * Artisan command to generate a full CRUD setup.
 *
 * Supports:
 * - Model
 * - Migration
 * - Controller
 * - Form Request
 * - Resource (optional)
 * - Route registration snippet
 *
 * Designed for Laravel projects using either API or web routes.
 */
#[AsCommand(name: 'crudmaster:generate', description: 'Generate a CRUD scaffold for a given resource')]
final class GenerateCrudCommand extends Command
{
    protected $signature = 'crudmaster:generate
                            {name : The name of the resource (e.g. Post)}
                            {--fields= : Comma-separated list of fields (e.g. title:string,body:text)}
                            {--force : Overwrite existing files}
                            {--api : Generate API controller and routes}
                            {--resource : Include Laravel API resource class}';

    protected $description = 'Generate model, migration, controller, request and optionally resource for a CRUD module.';

     protected Filesystem $files;


    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle(): int
    {

        $name = Str::studly($this->argument('name'));

        $fields = $this->option('fields') ?? '';
        $parsedFields = $this->parseFields($fields);

        $this->info("Generating CRUD for: {$name}");

        // Generate components
        $this->generateModel($name, $parsedFields);
        $this->generateMigration($name, $parsedFields);
        $this->generateRequest($name);
        $this->generateController($name);

        if ($this->option('resource')) {
            $this->generateResource($name);
        }

        // $this->info("\nCRUD for {$name} created successfully.");

        return self::SUCCESS;
    }

    /**
     * Parse the fields string into structured array.
     */
    protected function parseFields(string $fields): array
    {
        return collect(explode(',', $fields))
            ->filter()
            ->mapWithKeys(function ($field) {
                [$name, $type] = explode(':', $field) + [null, 'string'];

                return [$name => $type];
            })->toArray();
    }

    /**
     * Generate Eloquent model class using stub.
     * Supports fillable property based on fields.
     */
    protected function generateModel(string $name, array $fields): void
    {
        $stubPath = __DIR__.'/../../stubs/model.stub';
        $outputPath = base_path("app/Models/{$name}.php");

        if ($this->files->exists($outputPath) && ! $this->option('force')) {
            $this->components->warn("Model already exists: {$outputPath}");

            return;
        }

        try {
            $stub = $this->files->get($stubPath);
        } catch (FileNotFoundException $e) {
            $this->error("Failed to get stubs for: {$name} Model Error: {$e->getMessage()}");
        }

        $stub = Str::replace([
            '{{ namespace }}',
            '{{ class }}',
            '{{ fillable }}',
        ], [
            'App\\Models',
            $name,
            $this->formatFillable($fields),
        ], $stub);

        $this->files->ensureDirectoryExists(dirname($outputPath));
        $this->files->put($outputPath, $stub);
        $this->components->info("Model created: {$outputPath}");
    }

    /**
     * Generate Laravel fillable array string from fields.
     */
    protected function formatFillable(array $fields): string
    {
        return '['.implode(', ', collect(array_keys($fields))->map(fn ($f) => "'{$f}'")->toArray()).']';
    }

    protected function generateMigration(string $name, array $fields): void
    {
        // TODO: generate migration file with table name and fields
    }

    protected function generateController(string $name): void
    {
        // TODO: generate controller based on --api flag
    }

    protected function generateRequest(string $name): void
    {
        // TODO: generate form request for validation
    }

    protected function generateResource(string $name): void
    {
        // TODO: generate Laravel JsonResource
    }
}
