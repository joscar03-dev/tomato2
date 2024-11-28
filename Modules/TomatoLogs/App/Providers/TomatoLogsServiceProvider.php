<?php

namespace Modules\TomatoLogs\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoRoles\App\Services\Permission;
use Modules\TomatoRoles\App\Services\TomatoRoles;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoLogsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoLogs';

    protected string $moduleNameLower = 'tomato-logs';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'tomato-logs');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../../resources/lang' => app_path('lang/vendor/tomato-logs'),
        ], 'tomato-logs-lang');

        TomatoMenu::register([
            Menu::make()
                ->group(trans('tomato-logs::global.group'))
                ->label(trans('tomato-logs::global.title'))
                ->icon("bx bxs-bug-alt")
                ->route("admin.logs.index"),
        ]);


        $this->registerPermissions();
    }

    /**
     * @return void
     */
    private function registerPermissions(): void
    {
        if(class_exists(TomatoRoles::class)){
            TomatoRoles::register(Permission::make()
                ->name('admin.logs.index')
                ->guard('web')
                ->group('logs')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.logs.file')
                ->guard('web')
                ->group('logs')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.logs.show')
                ->guard('web')
                ->group('logs')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.logs.destroy')
                ->guard('web')
                ->group('logs')
            );
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower.'.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace').'\\'.$this->moduleName.'\\'.config('modules.paths.generator.component-class.path'));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }
}
