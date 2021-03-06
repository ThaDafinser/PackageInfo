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
    const PACKAGES = %s;

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
