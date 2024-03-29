<?php

namespace TheBachtiarz\Toolkit\Helper\App\Patch;

use Illuminate\Database\Eloquent\Factories\Factory;

trait AppPatcher
{
    /**
     * Factory namespace resolver
     *
     * @return void
     */
    private static function factoryNamespaceResolver(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            $modelUse = str_replace('Models\\', '', $modelName);
            return "Factories\\{$modelUse}Factory";
        });
    }
}
