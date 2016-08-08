<?php
namespace PackageInfoTest\Unit;

use Composer\Composer;
use Composer\Config;
use Composer\IO\IOInterface;
use Composer\Package\Locker;
use Composer\Package\RootPackageInterface;
use Composer\Script\Event;
use PackageInfo\Installer;
use PHPUnit_Framework_TestCase;
use Composer\Repository\RepositoryManager;
use Composer\Installer\InstallationManager;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Package\RootPackage;
use Composer\Package\RootAliasPackage;

/**
 * @covers \PackageInfo\Installer
 */
class InstallerTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getIO()
    {
        return $this->createMock(IOInterface::class);
    }

    /**
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getComposer()
    {
        $composer = $this->createMock(Composer::class);
        
        /*
         * $composer->getConfig()
         */
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $composer->expects(self::any())
            ->method('getConfig')
            ->willReturn($config);
        
        /*
         * $composer->getLocker()
         */
        $locker = $this->getMockBuilder(Locker::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $composer->expects(self::any())
            ->method('getLocker')
            ->willReturn($locker);
        
        return $composer;
    }

    public function testActivate()
    {
        $installer = new Installer();
        $return = $installer->activate($this->getComposer(), $this->getIO());
        
        $this->assertNull($return);
    }

    public function testGetSubscribedEvents()
    {
        $events = Installer::getSubscribedEvents();
        
        self::assertSame([
            'post-install-cmd' => 'dumpAll',
            'post-update-cmd' => 'dumpAll'
        ], $events);
        
        foreach ($events as $callback) {
            self::assertInternalType('callable', [
                new Installer(),
                $callback
            ]);
        }
    }

    /**
     * @dataProvider dumpAllProvider
     */
    public function testDumpAll(array $lockData, $expectedResult)
    {
        /*
         * Mocks
         */
        $composer = $this->getComposer();
        
        /*
         * $composer->getLocker()
         */
        $locker = $composer->getLocker();
        
        $locker->expects(self::any())
            ->method('getLockData')
            ->willReturn($lockData);
        
        /*
         * $composer->getPackage()
         */
        $rootPackage = $this->createMock(RootPackageInterface::class);
        
        $rootPackage->expects(self::any())
            ->method('getName')
            ->willReturn('root/package');
        $rootPackage->expects(self::any())
            ->method('getPrettyName')
            ->willReturn('root/package');
        
        $rootPackage->expects(self::any())
            ->method('getVersion')
            ->willReturn('1.3.5');
        $rootPackage->expects(self::any())
            ->method('getPrettyVersion')
            ->willReturn('1.3.5');
        
        $rootPackage->expects(self::any())
            ->method('getSourceReference')
            ->willReturn('aaabbbcccddd');
        
        $composer->expects(self::any())
            ->method('getPackage')
            ->willReturn($rootPackage);
        
        $io = $this->getIO();
        
        /*
         * Paths
         */
        $vendorDir = sys_get_temp_dir() . '/' . uniqid('InstallerTest', true);
        
        $expectedPath = $vendorDir . '/thadafinser/package-info/src';
        
        mkdir($expectedPath, 0777, true);
        
        $config = $composer->getConfig();
        $config->expects(self::any())
            ->method('get')
            ->with('vendor-dir')
            ->willReturn($vendorDir);
        
        /*
         * Execute
         */
        Installer::dumpAll(new Event('post-install-cmd', $composer, $io));
        
        /*
         * Test
         */
        self::assertSame($expectedResult, file_get_contents($expectedPath . '/Package.php'));
        
        $this->rmDir($vendorDir);
    }

    public function dumpAllProvider()
    {
        $examples = [];
        foreach (new \DirectoryIterator('tests/resources') as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            
            $examples[$fileInfo->getFilename()] = include $fileInfo->getPathname();
        }
        
        return $examples;
    }

    /**
     * @dataProvider rootPackageProvider
     *
     * @param RootPackageInterface $rootPackage            
     * @param bool $inVendor            
     *
     * @throws \RuntimeException
     */
    public function testDumpsVersionsClassToSpecificLocation(RootPackageInterface $rootPackage, $inVendor)
    {
        /*
         * Mocks
         */
        $composer = $this->getComposer();
        
        /*
         * root package
         */
        $composer->expects(self::any())
            ->method('getPackage')
            ->willReturn($rootPackage);
        
        /*
         * lock data
         */
        $locker = $composer->getLocker();
        
        $locker->expects(self::any())
            ->method('getLockData')
            ->willReturn([
            'packages' => [],
            'packages-dev' => []
        ]);
        
        $repository = $this->createMock(InstalledRepositoryInterface::class);
        
        $repositoryManager = $this->getMockBuilder(RepositoryManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $repositoryManager->expects(self::any())
            ->method('getLocalRepository')
            ->willReturn($repository);
        
        $composer->expects(self::any())
            ->method('getRepositoryManager')
            ->willReturn($repositoryManager);
        
        $installManager = $this->getMockBuilder(InstallationManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $composer->expects(self::any())
            ->method('getInstallationManager')
            ->willReturn($installManager);
        
        /*
         * Paths
         */
        $tmpDir = sys_get_temp_dir() . '/' . uniqid('InstallerTest', true);
        
        $vendorDir = $tmpDir . '/vendor';
        
        if ($inVendor) {
            $expectedPath = $vendorDir . '/thadafinser/package-info/src';
        } else {
            $expectedPath = $tmpDir . '/src';
        }
        
        mkdir($expectedPath, 0777, true);
        
        $config = $composer->getConfig();
        $config->expects(self::any())
            ->method('get')
            ->with('vendor-dir')
            ->willReturn($vendorDir);
        
        Installer::dumpAll(new Event('post-install-cmd', $composer, $this->getIO()));
        
        self::assertStringMatchesFormat('%Aclass Package%A1.2.3%A', file_get_contents($expectedPath . '/Package.php'));
        
        $this->rmDir($tmpDir);
    }

    /**
     *
     * @return bool[][]|RootPackageInterface[][] the root package and whether the versions class is to be generated in
     *         the vendor dir or not
     */
    public function rootPackageProvider()
    {
        $baseRootPackage = new RootPackage('root/package', '1.2.3', '1.2.3');
        $aliasRootPackage = new RootAliasPackage($baseRootPackage, '1.2.3', '1.2.3');
        $indirectAliasRootPackage = new RootAliasPackage($aliasRootPackage, '1.2.3', '1.2.3');
        $packageVersionsRootPackage = new RootPackage('thadafinser/package-info', '1.2.3', '1.2.3');
        $aliasPackageVersionsRootPackage = new RootAliasPackage($packageVersionsRootPackage, '1.2.3', '1.2.3');
        $indirectAliasPackageVersionsRootPackage = new RootAliasPackage($aliasPackageVersionsRootPackage, '1.2.3', '1.2.3');
        
        return [
            'root package is not thadafinser/package-info' => [
                $baseRootPackage,
                true
            ],
            'alias root package is not othadafinser/package-info' => [
                $aliasRootPackage,
                true
            ],
            'indirect alias root package is not thadafinser/package-info' => [
                $indirectAliasRootPackage,
                true
            ],
            
            'root package is thadafinser/package-info' => [
                $packageVersionsRootPackage,
                false
            ],
            'alias root package is thadafinser/package-info' => [
                $aliasPackageVersionsRootPackage,
                false
            ],
            'indirect alias root package is thadafinser/package-info' => [
                $indirectAliasPackageVersionsRootPackage,
                false
            ]
        ];
    }

    /**
     *
     * @param string $directory            
     *
     * @return void
     */
    private function rmDir($directory)
    {
        if (! is_dir($directory)) {
            unlink($directory);
            return;
        }
        
        array_map(function ($item) use($directory) {
            $this->rmDir($directory . '/' . $item);
        }, array_filter(scandir($directory), function ($dirItem) {
            return ! in_array($dirItem, [
                '.',
                '..'
            ], true);
        }));
        
        rmdir($directory);
    }
}
