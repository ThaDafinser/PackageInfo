<?php
namespace PackageInfoTest\Unit;

use PHPUnit_Framework_TestCase;
use PackageInfo\Package;

/**
 * @covers \PackageInfo\Package
 */
class PackageTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \PackageInfo\Exception\PackageNotInstalledException
     * @expectedExceptionMessage Package "vendor/something" is not installed through composer, or you installed it with the flag --no-scripts
     */
    public function testConstruct()
    {
        $package = new Package('vendor/something');
    }
    
    public function testIsInstalled()
    {
        $bool = Package::isInstalled('vendor/something');
        
        $this->assertFalse($bool);
    }
}
