<?php namespace Arcanedev\LogViewer\Providers;

use Arcanedev\LogViewer\Utilities\Filesystem;
use Arcanedev\Support\ServiceProvider;

/**
 * Class     UtilitiesServiceProvider
 *
 * @package  Arcanedev\LogViewer\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UtilitiesServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerLogLevels();
        $this->registerStyler();
        $this->registerLogMenu();
        $this->registerFilesystem();
        $this->registerFactory();
        $this->registerChecker();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.log-viewer.levels',
            'Arcanedev\LogViewer\Contracts\LogLevelsInterface',
            'arcanedev.log-viewer.styler',
            'Arcanedev\LogViewer\Contracts\LogStylerInterface',
            'arcanedev.log-viewer.menu',
            'Arcanedev\LogViewer\Contracts\LogMenuInterface',
            'arcanedev.log-viewer.filesystem',
            'Arcanedev\LogViewer\Contracts\FilesystemInterface',
            'arcanedev.log-viewer.factory',
            'Arcanedev\LogViewer\Contracts\FactoryInterface',
            'arcanedev.log-viewer.checker',
            'Arcanedev\LogViewer\Contracts\LogCheckerInterface',
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  The LogViewer Utilities
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the log levels.
     */
    private function registerLogLevels()
    {
        $this->singleton(
            'arcanedev.log-viewer.levels',
            'Arcanedev\LogViewer\Utilities\LogLevels'
        );

        $this->bind(
            'Arcanedev\LogViewer\Contracts\LogLevelsInterface',
            'arcanedev.log-viewer.levels'
        );
    }

    /**
     * Register the log styler.
     */
    private function registerStyler()
    {
        $this->singleton(
            'arcanedev.log-viewer.styler',
            'Arcanedev\LogViewer\Utilities\LogStyler'
        );

        $this->bind(
            'Arcanedev\LogViewer\Contracts\LogStylerInterface',
            'arcanedev.log-viewer.styler'
        );
    }

    /**
     * Register the log menu builder.
     */
    private function registerLogMenu()
    {
        $this->singleton(
            'arcanedev.log-viewer.menu',
            'Arcanedev\LogViewer\Utilities\LogMenu'
        );

        $this->bind(
            'Arcanedev\LogViewer\Contracts\LogMenuInterface',
            'arcanedev.log-viewer.menu'
        );
    }

    /**
     * Register the log filesystem.
     */
    private function registerFilesystem()
    {
        $this->singleton('arcanedev.log-viewer.filesystem', function ($app) {
            /**
             * @var  \Illuminate\Filesystem\Filesystem  $files
             * @var  \Illuminate\Config\Repository      $config
             */
            $files  = $app['files'];
            $config = $app['config'];

            return new Filesystem($files, $config->get('log-viewer.storage-path'));
        });

        $this->bind(
            'Arcanedev\LogViewer\Contracts\FilesystemInterface',
            'arcanedev.log-viewer.filesystem'
        );
    }

    /**
     * Register the log factory.
     */
    private function registerFactory()
    {
        $this->singleton(
            'arcanedev.log-viewer.factory',
            'Arcanedev\LogViewer\Utilities\Factory'
        );

        $this->bind(
            'Arcanedev\LogViewer\Contracts\FactoryInterface',
            'arcanedev.log-viewer.factory'
        );
    }

    /**
     * Register the log checker.
     */
    private function registerChecker()
    {
        $this->singleton(
            'arcanedev.log-viewer.checker',
            'Arcanedev\LogViewer\Utilities\LogChecker'
        );

        $this->bind(
            'Arcanedev\LogViewer\Contracts\LogCheckerInterface',
            'arcanedev.log-viewer.checker'
        );
    }
}
