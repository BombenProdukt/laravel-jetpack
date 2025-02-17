<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\PackagePowerPack\Package;

use BaseCodeOy\PackagePowerPack\Package\Concerns\HasAutomaticConfiguration;
use BaseCodeOy\PackagePowerPack\Package\Concerns\HasBootableTraits;
use BaseCodeOy\PackagePowerPack\Package\Concerns\HasComposerJson;
use Spatie\LaravelPackageTools\PackageServiceProvider;

abstract class AbstractServiceProvider extends PackageServiceProvider
{
    use HasAutomaticConfiguration;
    use HasBootableTraits;
    use HasComposerJson;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->bootTraits();
    }

    protected function getPackageBaseDirectory(): string
    {
        $fileName = (new \ReflectionClass(\get_class($this)))->getFileName();

        if (\is_string($fileName)) {
            return \dirname($fileName);
        }

        throw new \RuntimeException('Could not determine the base directory of the package.');
    }
}
