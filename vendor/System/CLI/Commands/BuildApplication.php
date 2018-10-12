<?php
namespace System\CLI\Commands;

use System\Console;
use System\CLI\Command;

class BuildApplication extends Command
{
    /**
     * {@inheritDoc}
     */
    public function execute()
    {
        $appName = array_shift($this->optionsList);

        if (!$appName) {
            return static::error('Please write down the application name!');
        }

        static::build($appName);
    }

    /**
     * Build the given application name
     * 
     * @param  string $appName
     * @return  void
     */
    public static function build(string $appName)
    {
        static::yellow('Building application...');
        
        app()->ui->buildApp($appName)->env('development')->forceRebuild(true)->run();

        static::green('Application Build has been completed successfully!');
    }
}
