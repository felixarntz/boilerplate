<?php
/**
 * Default boilerplate configuration.
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate;

$placeholders = [
    'vendorName'           => [
        'name'        => 'Vendor name',
        'description' => 'The vendor name of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => 'Felix Arntz',
    ],
    'namespaceVendorName'  => [
        'name'        => 'Namespace vendor name',
        'description' => 'The vendor name of the package, for use within the source code, if different.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => function($placeholders) {
            return $placeholders['vendorName']['value'];
        },
    ],
    'packageName'          => [
        'name'        => 'Package name',
        'description' => 'The name of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => 'Package Name',
    ],
    'namespacePackageName' => [
        'name'        => 'Namespace package name',
        'description' => 'The name of the package, for use within the source code, if different.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => function($placeholders) {
            return $placeholders['packageName']['value'];
        },
    ],
    'packageDescription'   => [
        'name'        => 'Package description',
        'description' => 'The description of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateDescription($placeholder);
        },
        'default'     => 'The package description.',
    ],
    'packageKeywords'      => [
        'name'        => 'Package keywords',
        'description' => 'The keywords of the package, separated by comma.',
        'validation'  => function($placeholder) {
            return Validation::validateSlugList($placeholder);
        },
        'default'     => 'keyword1,keyword2',
    ],
    'packageVcsUrl'        => [
        'name'        => 'Package VCS URL',
        'description' => 'The version control system URL of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateURL($placeholder);
        },
        'default'     => function($placeholders) {
            $vendorName  = Util::toHyphenCase($placeholders['vendorName']['value']);
            $packageName = Util::toHyphenCase($placeholders['packageName']['value']);
            return 'https://github.com/' . $vendorName . '/' . $packageName;
        },
    ],
    'packageUrl'           => [
        'name'        => 'Package URL',
        'description' => 'The website URL of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateURL($placeholder);
        },
        'default'     => function($placeholders) {
            return $placeholders['packageVcsUrl']['value'];
        },
    ],
    'authorName'           => [
        'name'        => 'Author name',
        'description' => 'The name of the author of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => 'Felix Arntz',
    ],
    'authorEmail'          => [
        'name'        => 'Author email',
        'description' => 'The email address of the author of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateEmail($placeholder);
        },
        'default'     => 'felix-arntz@leaves-and-love.net',
    ],
    'authorUrl'            => [
        'name'        => 'Author URL',
        'description' => 'The website URL of the author of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateURL($placeholder);
        },
        'default'     => 'https://felix-arntz.me',
    ],
];

$settings = [
    'packageType'           => [
        'name'        => 'Package type',
        'description' => 'The type of the package.',
        'choices'     => ['library', 'plugin', 'theme'],
        'default'     => 'library',
    ],
    'prepareWordPressOrg'   => [
        'name'        => 'Prepare for wordpress.org?',
        'description' => 'Whether to prepare the package for release on wordpress.org.',
        'confirm'     => true,
        'default'     => true,
        'skip'        => function($settings) {
            return !in_array($settings['packageType']['value'], ['plugin', 'theme'], true);
        },
    ],
    'minimumPHP'            => [
        'name'        => 'Minimum PHP version',
        'description' => 'The minimum required PHP version of the package.',
        'choices'     => array_merge(Util::versionRange('5.2', '5.6'), Util::versionRange('7.0', '7.2')),
        'default'     => '7.0',
    ],
    'minimumWordPress'      => [
        'name'        => 'Minimum WordPress version',
        'description' => 'The minimum required WordPress version of the package.',
        'choices'     => array_merge(Util::versionRange('3.7', '4.9'), Util::versionRange('4.9.1', '4.9.9', 'patch')),
        'default'     => '4.7',
        'skip'        => function($settings) {
            return !in_array($settings['packageType']['value'], ['plugin', 'theme'], true);
        },
    ],
    'setupCodeStandards'    => [
        'name'        => 'Setup code standards?',
        'description' => 'Whether to setup code standards for the package with PHPCodeSniffer.',
        'confirm'     => true,
        'default'     => true,
    ],
    'codeStandard'          => [
        'name'        => 'Code standard',
        'description' => 'The code standard of the package.',
        'choices'     => ['psr2', 'wordpress'],
        'default'     => 'psr2',
        'skip'        => function($settings) {
            return ! $settings['setupCodeStandards']['value'];
        },
    ],
    'setupQualityAssurance' => [
        'name'        => 'Setup quality assurance?',
        'description' => 'Whether to set up quality assurance for the package with PHP Mess Detector.',
        'confirm'     => true,
        'default'     => true,
    ],
    'setupUnitTests'        => [
        'name'        => 'Setup unit tests?',
        'description' => 'Whether to set up unit tests for the package with PHPUnit.',
        'confirm'     => true,
        'default'     => true,
    ],
    'setupIntegrationTests' => [
        'name'        => 'Setup integration tests?',
        'description' => 'Whether to also set up WordPress integration tests for the package.',
        'confirm'     => true,
        'default'     => true,
        'skip'        => function($settings) {
            if (!$settings['setupUnitTests']['value']) {
                return true;
            }
            return !in_array($settings['packageType']['value'], ['plugin', 'theme'], true);
        },
    ],
    'integrateCodeClimate'  => [
        'name'        => 'Integrate with CodeClimate?',
        'description' => 'Whether to set up an integration with CodeClimate.',
        'confirm'     => true,
        'default'     => true,
        'skip'        => function($settings) {
            if ($settings['setupUnitTests']['value']) {
                return false;
            }
            if ($settings['setupQualityAssurance']['value']) {
                return false;
            }
            return !$settings['setupCodeStandards']['value'];
        },
    ],
    'integrateTravisCI'     => [
        'name'        => 'Integrate with Travis-CI?',
        'description' => 'Whether to set up an integration with Travis-CI.',
        'confirm'     => true,
        'default'     => true,
        'skip'        => function($settings) {
            if ($settings['setupUnitTests']['value']) {
                return false;
            }
            return !$settings['setupCodeStandards']['value'];
        },
    ],
];

return [
    'placeholders' => $placeholders,
    'settings'     => $settings,
];
