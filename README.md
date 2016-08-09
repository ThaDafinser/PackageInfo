# PackageInfo

[![Build Status](https://travis-ci.org/ThaDafinser/PackageInfo.svg)](https://travis-ci.org/ThaDafinser/PackageInfo)
[![Code Coverage](https://scrutinizer-ci.com/g/ThaDafinser/PackageInfo/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ThaDafinser/PackageInfo/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ThaDafinser/PackageInfo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ThaDafinser/PackageInfo/?branch=master)

[![Latest Stable Version](https://poser.pugx.org/thadafinser/package-info/v/stable)](https://packagist.org/packages/thadafinser/package-info)
[![Latest Unstable Version](https://poser.pugx.org/thadafinser/package-info/v/unstable)](https://packagist.org/packages/thadafinser/package-info) 
[![License](https://poser.pugx.org/thadafinser/package-info/license)](https://packagist.org/packages/thadafinser/package-info)
[![Total Downloads](https://poser.pugx.org/thadafinser/package-info/downloads)](https://packagist.org/packages/thadafinser/package-info) 

This package was highly inspired from [ocramius/package-versions](https://github.com/Ocramius/PackageVersions/)

I needed some methods to read data from the `composer.lock` file fast...this is the result

```php
$bool = \PackageInfo\Package::isInstalled('vendor/package-name'); // return true/false

// may throw PackageNotInstalledException if the package is not installed
$package = new \PackageInfo\Package('vendor/package-name');
$package->getName();
$package->getDescription();
$package->getVersion();
$package->getType();
$package->getKeywords();
// ...
```
