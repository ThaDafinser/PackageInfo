<?php
$lockData = [
    'packages' => [
        array(
            'name' => 'composer/ca-bundle',
            'version' => '1.0.3',
            'source' => array(
                'type' => 'git',
                'url' => 'https://github.com/composer/ca-bundle.git',
                'reference' => '5df9ed0ed0c9506ea6404a23450854e5df15cc12'
            ),
            'dist' => array(
                'type' => 'zip',
                'url' => 'https://api.github.com/repos/composer/ca-bundle/zipball/5df9ed0ed0c9506ea6404a23450854e5df15cc12',
                'reference' => '5df9ed0ed0c9506ea6404a23450854e5df15cc12',
                'shasum' => ''
            ),
            'require' => array(
                'ext-openssl' => '*',
                'ext-pcre' => '*',
                'php' => '^5.3.2 || ^7.0'
            ),
            'require-dev' => array(
                'symfony/process' => '^2.5 || ^3.0'
            ),
            'suggest' => array(
                'symfony/process' => 'This is necessary to reliably check whether openssl_x509_parse is vulnerable on older php versions, but can be ignored on PHP 5.5.6+'
            ),
            'type' => 'library',
            'extra' => array(
                'branch-alias' => array(
                    'dev-master' => '1.x-dev'
                )
            ),
            'autoload' => array(
                'psr-4' => array(
                    'Composer\\CaBundle\\' => 'src'
                )
            ),
            'notification-url' => 'https://packagist.org/downloads/',
            'license' => array(
                0 => 'MIT'
            ),
            'authors' => array(
                0 => array(
                    'name' => 'Jordi Boggiano',
                    'email' => 'j.boggiano@seld.be',
                    'homepage' => 'http://seld.be'
                )
            ),
            'description' => 'Lets you find a path to the system CA bundle, and includes a fallback to the Mozilla CA bundle.',
            'keywords' => array(
                0 => 'cabundle',
                1 => 'cacert',
                2 => 'certificate',
                3 => 'ssl',
                4 => 'tls'
            ),
            'time' => '2016-07-18 23:07:53'
        ),
        
        array(
            'name' => 'composer/composer',
            'version' => '1.2.0',
            'source' => array(
                'type' => 'git',
                'url' => 'https://github.com/composer/composer.git',
                'reference' => 'b49a006748a460f8dae6500ec80ed021501ce969'
            ),
            'dist' => array(
                'type' => 'zip',
                'url' => 'https://api.github.com/repos/composer/composer/zipball/b49a006748a460f8dae6500ec80ed021501ce969',
                'reference' => 'b49a006748a460f8dae6500ec80ed021501ce969',
                'shasum' => ''
            ),
            'require' => array(
                'composer/ca-bundle' => '^1.0',
                'composer/semver' => '^1.0',
                'composer/spdx-licenses' => '^1.0',
                'justinrainbow/json-schema' => '^1.6 || ^2.0',
                'php' => '^5.3.2 || ^7.0',
                'psr/log' => '^1.0',
                'seld/cli-prompt' => '^1.0',
                'seld/jsonlint' => '^1.4',
                'seld/phar-utils' => '^1.0',
                'symfony/console' => '^2.5 || ^3.0',
                'symfony/filesystem' => '^2.5 || ^3.0',
                'symfony/finder' => '^2.2 || ^3.0',
                'symfony/process' => '^2.1 || ^3.0'
            ),
            'require-dev' => array(
                'phpunit/phpunit' => '^4.5 || ^5.0.5',
                'phpunit/phpunit-mock-objects' => '^2.3 || ^3.0'
            ),
            'suggest' => array(
                'ext-openssl' => 'Enabling the openssl extension allows you to access https URLs for repositories and packages',
                'ext-zip' => 'Enabling the zip extension allows you to unzip archives',
                'ext-zlib' => 'Allow gzip compression of HTTP requests'
            ),
            'bin' => array(
                0 => 'bin/composer'
            ),
            'type' => 'library',
            'extra' => array(
                'branch-alias' => array(
                    'dev-master' => '1.2-dev'
                )
            ),
            'autoload' => array(
                'psr-4' => array(
                    'Composer\\' => 'src/Composer'
                )
            ),
            'notification-url' => 'https://packagist.org/downloads/',
            'license' => array(
                0 => 'MIT'
            ),
            'authors' => array(
                0 => array(
                    'name' => 'Nils Adermann',
                    'email' => 'naderman@naderman.de',
                    'homepage' => 'http://www.naderman.de'
                ),
                1 => array(
                    'name' => 'Jordi Boggiano',
                    'email' => 'j.boggiano@seld.be',
                    'homepage' => 'http://seld.be'
                )
            ),
            'description' => 'Composer helps you declare, manage and install dependencies of PHP projects, ensuring you have the right stack everywhere.',
            'homepage' => 'https://getcomposer.org/',
            'keywords' => array(
                0 => 'autoload',
                1 => 'dependency',
                2 => 'package'
            ),
            'time' => '2016-07-18 23:28:52'
        )
    ]
];

$expectedSource = <<<'PHP'
<?php
namespace PackageInfo;

use DateTime;
use DateTimeZone;
use PackageInfo\Exception\PackageNotInstalledException;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Package
{
    const PACKAGES = array (
  'composer/ca-bundle' => 
  array (
    'name' => 'composer/ca-bundle',
    'version' => '1.0.3',
    'source' => 
    array (
      'type' => 'git',
      'url' => 'https://github.com/composer/ca-bundle.git',
      'reference' => '5df9ed0ed0c9506ea6404a23450854e5df15cc12',
    ),
    'dist' => 
    array (
      'type' => 'zip',
      'url' => 'https://api.github.com/repos/composer/ca-bundle/zipball/5df9ed0ed0c9506ea6404a23450854e5df15cc12',
      'reference' => '5df9ed0ed0c9506ea6404a23450854e5df15cc12',
      'shasum' => '',
    ),
    'require' => 
    array (
      'ext-openssl' => '*',
      'ext-pcre' => '*',
      'php' => '^5.3.2 || ^7.0',
    ),
    'require-dev' => 
    array (
      'symfony/process' => '^2.5 || ^3.0',
    ),
    'suggest' => 
    array (
      'symfony/process' => 'This is necessary to reliably check whether openssl_x509_parse is vulnerable on older php versions, but can be ignored on PHP 5.5.6+',
    ),
    'type' => 'library',
    'extra' => 
    array (
      'branch-alias' => 
      array (
        'dev-master' => '1.x-dev',
      ),
    ),
    'autoload' => 
    array (
      'psr-4' => 
      array (
        'Composer\\CaBundle\\' => 'src',
      ),
    ),
    'notification-url' => 'https://packagist.org/downloads/',
    'license' => 
    array (
      0 => 'MIT',
    ),
    'authors' => 
    array (
      0 => 
      array (
        'name' => 'Jordi Boggiano',
        'email' => 'j.boggiano@seld.be',
        'homepage' => 'http://seld.be',
      ),
    ),
    'description' => 'Lets you find a path to the system CA bundle, and includes a fallback to the Mozilla CA bundle.',
    'keywords' => 
    array (
      0 => 'cabundle',
      1 => 'cacert',
      2 => 'certificate',
      3 => 'ssl',
      4 => 'tls',
    ),
    'time' => '2016-07-18 23:07:53',
  ),
  'composer/composer' => 
  array (
    'name' => 'composer/composer',
    'version' => '1.2.0',
    'source' => 
    array (
      'type' => 'git',
      'url' => 'https://github.com/composer/composer.git',
      'reference' => 'b49a006748a460f8dae6500ec80ed021501ce969',
    ),
    'dist' => 
    array (
      'type' => 'zip',
      'url' => 'https://api.github.com/repos/composer/composer/zipball/b49a006748a460f8dae6500ec80ed021501ce969',
      'reference' => 'b49a006748a460f8dae6500ec80ed021501ce969',
      'shasum' => '',
    ),
    'require' => 
    array (
      'composer/ca-bundle' => '^1.0',
      'composer/semver' => '^1.0',
      'composer/spdx-licenses' => '^1.0',
      'justinrainbow/json-schema' => '^1.6 || ^2.0',
      'php' => '^5.3.2 || ^7.0',
      'psr/log' => '^1.0',
      'seld/cli-prompt' => '^1.0',
      'seld/jsonlint' => '^1.4',
      'seld/phar-utils' => '^1.0',
      'symfony/console' => '^2.5 || ^3.0',
      'symfony/filesystem' => '^2.5 || ^3.0',
      'symfony/finder' => '^2.2 || ^3.0',
      'symfony/process' => '^2.1 || ^3.0',
    ),
    'require-dev' => 
    array (
      'phpunit/phpunit' => '^4.5 || ^5.0.5',
      'phpunit/phpunit-mock-objects' => '^2.3 || ^3.0',
    ),
    'suggest' => 
    array (
      'ext-openssl' => 'Enabling the openssl extension allows you to access https URLs for repositories and packages',
      'ext-zip' => 'Enabling the zip extension allows you to unzip archives',
      'ext-zlib' => 'Allow gzip compression of HTTP requests',
    ),
    'bin' => 
    array (
      0 => 'bin/composer',
    ),
    'type' => 'library',
    'extra' => 
    array (
      'branch-alias' => 
      array (
        'dev-master' => '1.2-dev',
      ),
    ),
    'autoload' => 
    array (
      'psr-4' => 
      array (
        'Composer\\' => 'src/Composer',
      ),
    ),
    'notification-url' => 'https://packagist.org/downloads/',
    'license' => 
    array (
      0 => 'MIT',
    ),
    'authors' => 
    array (
      0 => 
      array (
        'name' => 'Nils Adermann',
        'email' => 'naderman@naderman.de',
        'homepage' => 'http://www.naderman.de',
      ),
      1 => 
      array (
        'name' => 'Jordi Boggiano',
        'email' => 'j.boggiano@seld.be',
        'homepage' => 'http://seld.be',
      ),
    ),
    'description' => 'Composer helps you declare, manage and install dependencies of PHP projects, ensuring you have the right stack everywhere.',
    'homepage' => 'https://getcomposer.org/',
    'keywords' => 
    array (
      0 => 'autoload',
      1 => 'dependency',
      2 => 'package',
    ),
    'time' => '2016-07-18 23:28:52',
  ),
  'root/package' => 
  array (
    'name' => 'root/package',
    'version' => '1.3.5',
    'version_normalized' => '1.3.5',
  ),
);

    /**
     * 
     * @var string
     */
    private $name;
    
    /**
     * 
     * @param string $name
     * @throws PackageNotInstalledException
     */
    public function __construct($name)
    {
        $this->name = $name;
        
        if (! $this->isInstalled($name)) {
            throw new PackageNotInstalledException('Package "'.$name.'" is not installed through composer, or you installed it with the flag --no-scripts');
        }
    }
    
    /**
     * Check if the given package is installed
     * 
     * @return boolean
     */
    public static function isInstalled($name)
    {
        if (array_key_exists($name, self::PACKAGES)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @return mixed
     */
    public function getValue($key)
    {
        $values = $this->getValues();
        
        if(array_key_exists($key, $values)){
            return $values[$key];
        }
        
        return null;
    }
    
    /**
     * @return array
     */
    public function getValues()
    {
        if(array_key_exists($this->getName(), self::PACKAGES)){
            return self::PACKAGES[$this->getName()];
        }
        
        return [];
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getValue('description');
    }
    
    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->getValue('version');
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->getValue('type');
    }
    
    /**
     * @return array
     */
    public function getKeywords()
    {
        return $this->getValue('keywords');
    }
    
    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->getValue('homepage');
    }
    
    /**
     * Return the release date of the current installed version
     * 
     * @return DateTime
     */
    public function getVersionReleaseDate()
    {
        return new DateTime($this->getValue('time'), new DateTimeZone('UTC'));
    }
    
    /**
     * @return string|array
     */
    public function getLicense()
    {
        return $this->getValue('license');
    }
    

    /**
     * @return array
     */
    public function getAuthors()
    {
        return $this->getValue('authors');
    }
}

PHP;

return [
    $lockData,
    $expectedSource
];