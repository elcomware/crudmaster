<?php


use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


beforeEach(function () {
    File::deleteDirectory(base_path('app/Models'));
    File::ensureDirectoryExists(base_path('app/Models'));

    File::ensureDirectoryExists(base_path('stubs'));
    File::put(base_path('stubs/model.stub'), <<<PHP
<?php

namespace {{ namespace }};

use Illuminate\Database\Eloquent\Model;

class {{ class }} extends Model
{
    protected \$fillable = {{ fillable }};
}
PHP);
});

it('can boot a Laravel application', function () {
    // This should not be null if Testbench is working
    expect(app())->toBeInstanceOf(\Illuminate\Foundation\Application::class);
});

it('generates a model file with correct class and fillable fields', function () {



    $this->artisan('crudmaster:generate', [
        'name' => 'Post',
        '--fields' => 'title:string,body:text'
    ])->assertExitCode(0);
    $modelPath = base_path('app/Models/Post.php');

    expect(File::exists($modelPath))->toBeTrue();

    $content = File::get($modelPath);

    expect($content)->toContain('class Post')
        ->toContain("protected \$fillable = ['title', 'body']");
});

it('does not overwrite existing model unless forced', function () {
    $modelPath = base_path('app/Models/Post.php');
    File::put($modelPath, '// Existing model content');

    $this->artisan('crudmaster:generate', [
        'name' => 'Post',
        '--fields' => 'name:string'
    ])->assertExitCode(0);

    expect(File::get($modelPath))->toBe('// Existing model content');
});

it('overwrites model file when --force is provided', function () {
    $modelPath = base_path('app/Models/Post.php');
    File::put($modelPath, '// Old content');

    $this->artisan('crudmaster:generate', [
        'name' => 'Post',
        '--fields' => 'title:string',
        '--force' => true
    ])->assertExitCode(0);

    $content = File::get($modelPath);

    expect($content)->toContain('class Post')
        ->toContain("protected \$fillable = ['title']");
});


