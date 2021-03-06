<?php
namespace System\CLI\Commands;

use System\Console;
use System\CLI\Config;
use System\CLI\Command;

class BuildApplication extends Command
{
    /**
     * {@inheritDoc}
     */
    public function execute()
    {
        $appName = array_shift($this->optionsList) ?: Config::get('baseApp');

        if (!$appName) {
            return static::error('Please write down the application name!');
        }

        $config = $this->jsonFile('config.json');

        if (! isset($config->apps->$appName)) {
            return static::error(sprintf('%s does not exists!', $appName));
        }

        static::yellow('Building application...');
        
        static::build($appName);

        if (! static::flag('withoutSmartViews')) {
            exec('php visualize build:smartViews');
        }

        static::green('Application Build has been completed successfully!');
    }

    /**
     * Build the given application name
     * 
     * @param  string $appName
     * @return  void
     */
    public static function build(string $appName)
    {
        app()->ui->buildApp($appName)->env('development')->forceRebuild(true)->run();
    }
}
