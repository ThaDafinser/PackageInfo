<?php
namespace PackageInfo;

use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;
use Composer\Script\Event;
use Composer\Package\Locker;
use Composer\Composer;
use Composer\Config;
use Composer\Package\RootPackageInterface;
use Composer\Package\AliasPackage;
use Composer\Package\Dumper\ArrayDumper;

class Installer implements PluginInterface, EventSubscriberInterface
{

    public function activate(Composer $composer, IOInterface $io)
    {
        // Nothing to do here, as all features are provided through event listeners
    }

    public static function getSubscribedEvents()
    {
        return [
            ScriptEvents::POST_INSTALL_CMD => 'dumpAll',
            ScriptEvents::POST_UPDATE_CMD => 'dumpAll'
        ];
    }

    public static function dumpAll(Event $composerEvent)
    {
        $io = $composerEvent->getIO();
        
        /*
         * Packages info (from composer.lock)
         */
        $io->write('<info>thadafinser/package-info:</info>  Generating class...');
        
        $composer = $composerEvent->getComposer();
        self::writePackageClass(self::getClassString($composer), $composer->getConfig(), $composer->getPackage());
        
        $io->write('<info>thadafinser/package-info:</info> ...generating class');
    }

    private static function getClassString(Composer $composer)
    {
        $packages = self::getPackages($composer);
        
        $template = file_get_contents(__DIR__ . '/PackageTemplate.tpl');
        
        return sprintf($template, var_export($packages, true));
    }

    private static function writePackageClass($classString, Config $composerConfig, RootPackageInterface $rootPackage)
    {
        file_put_contents(self::locateRootPackageInstallPath($composerConfig, $rootPackage) . '/src/Package.php', $classString, 0664);
    }

    /**
     * build the package array, with the package name as key
     *
     * @param Composer $composer            
     * @return array
     */
    private static function getPackages(Composer $composer)
    {
        $locker = $composer->getLocker();
        
        $lockData = $locker->getLockData();
        if (! array_key_exists('packages-dev', $lockData)) {
            $lockData['packages-dev'] = [];
        }
        
        /*
         * all installed packages
         */
        $packages = [];
        foreach (array_merge($lockData['packages'], $lockData['packages-dev']) as $package) {
            $packages[$package['name']] = $package;
        }
        
        /*
         * root package itself
         */
        /* @var $rootPackage \Composer\Package\RootPackage */
        $rootPackage = $composer->getPackage();
        
        $dumper = new ArrayDumper();
        $packages[$rootPackage->getName()] = $dumper->dump($rootPackage);
        
        return $packages;
    }

    private static function locateRootPackageInstallPath(Config $composerConfig, RootPackageInterface $rootPackage)
    {
        if ('thadafinser/package-info' === self::getRootPackageAlias($rootPackage)->getName()) {
            return dirname($composerConfig->get('vendor-dir'));
        }
        
        return $composerConfig->get('vendor-dir') . '/thadafinser/package-info';
    }

    private static function getRootPackageAlias(RootPackageInterface $rootPackage)
    {
        $package = $rootPackage;
        
        while ($package instanceof AliasPackage) {
            $package = $package->getAliasOf();
        }
        
        return $package;
    }
}
