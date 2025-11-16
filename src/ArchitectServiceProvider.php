<?php

namespace Syndicate\Architect;

use Illuminate\Support\Facades\Route;
use InvalidArgumentException;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Syndicate\Architect\Commands\ArchitectSeedCommand;
use Syndicate\Architect\Contracts\BlueprintKey;
use Syndicate\Architect\Controllers\BlueprintController;
use Syndicate\Architect\Facades\Architect;
use Syndicate\Architect\Services\ArchitectService;

class ArchitectServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('syndicate-architect')
            ->hasMigration('create_blueprints_table')
            ->hasCommand(ArchitectSeedCommand::class);
    }

    public function packageBooted()
    {
        $this->app->singleton(ArchitectService::class);

        Route::macro('architect', function (string $blueprintKey) {
            if (!is_subclass_of($blueprintKey, BlueprintKey::class)) {
                throw new InvalidArgumentException("Class {$blueprintKey} must implement " . BlueprintKey::class);
            }

            Route::name($blueprintKey::getId() . '.' . app()->currentLocale() . '.')
                ->group(function () use ($blueprintKey) {
                    foreach ($blueprintKey::cases() as $key) {
                        $blueprint = $key->getBlueprint();

                        $path = Architect::getPath($blueprint);

                        Route::get($path, [BlueprintController::class, 'show'])
                            ->name($key->value)
                            ->middleware($blueprint->getMiddleware())
                            ->setDefaults(['key' => $key]);
                    }
                });
        });
    }
}
