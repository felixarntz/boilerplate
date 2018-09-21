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
    'vendorName'         => [
        'name'        => 'Vendor name',
        'description' => 'The vendor name of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => 'Felix Arntz',
    ],
    'codeVendorName'     => [
        'name'        => 'Code vendor name',
        'description' => 'The vendor name of the package, for use within the source code, if different.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => function($placeholders) {
            return $placeholders['vendorName']['value'];
        },
    ],
    'packageName'        => [
        'name'        => 'Package name',
        'description' => 'The name of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => 'Package Name',
    ],
    'codePackageName'    => [
        'name'        => 'Code package name',
        'description' => 'The name of the package, for use within the source code, if different.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => function($placeholders) {
            return $placeholders['packageName']['value'];
        },
    ],
    'packageDescription' => [
        'name'        => 'Package description',
        'description' => 'The description of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateDescription($placeholder);
        },
        'default'     => 'The package description.',
    ],
    'packageKeywords'    => [
        'name'        => 'Package keywords',
        'description' => 'The keywords of the package, separated by comma.',
        'validation'  => function($placeholder) {
            return Validation::validateSlugList($placeholder);
        },
        'default'     => 'keyword1,keyword2',
    ],
    'packageVcsUrl'      => [
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
    'packageUrl'         => [
        'name'        => 'Package URL',
        'description' => 'The website URL of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateURL($placeholder);
        },
        'default'     => function($placeholders) {
            return $placeholders['packageVcsUrl']['value'];
        },
    ],
    'authorName'         => [
        'name'        => 'Author name',
        'description' => 'The name of the author of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateName($placeholder);
        },
        'default'     => 'Felix Arntz',
    ],
    'authorEmail'        => [
        'name'        => 'Author email',
        'description' => 'The email address of the author of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateEmail($placeholder);
        },
        'default'     => 'felix-arntz@leaves-and-love.net',
    ],
    'authorUrl'          => [
        'name'        => 'Author URL',
        'description' => 'The website URL of the author of the package.',
        'validation'  => function($placeholder) {
            return Validation::validateURL($placeholder);
        },
        'default'     => 'https://felix-arntz.me',
    ],
];

$generatedPlaceholders = [
    'vendorNameHyphenCase'               => function($placeholders) {
        return Util::toHyphenCase($placeholders['vendorName']);
    },
    'codeVendorNameHyphenCase'           => function($placeholders) {
        return Util::toHyphenCase($placeholders['codeVendorName']);
    },
    'codeVendorNameHyphenLowerCase'      => function($placeholders) {
        return Util::toHyphenLowerCase($placeholders['codeVendorName']);
    },
    'codeVendorNameUnderscoreCase'       => function($placeholders) {
        return Util::toUnderscoreCase($placeholders['codeVendorName']);
    },
    'codeVendorNameUnderscoreLowerCase'  => function($placeholders) {
        return Util::toUnderscoreLowerCase($placeholders['codeVendorName']);
    },
    'codeVendorNamePascalCase'           => function($placeholders) {
        return Util::toPascalCase($placeholders['codeVendorName']);
    },
    'codeVendorNameCamelCase'            => function($placeholders) {
        return Util::toCamelCase($placeholders['codeVendorName']);
    },
    'codeVendorNameConstantCase'         => function($placeholders) {
        return Util::toConstantCase($placeholders['codeVendorName']);
    },
    'codeVendorNamespace'                => function($placeholders, $settings) {
        if ($settings['codeStandard'] === 'wordpress') {
            return $placeholders['codeVendorNameUnderscoreCase'];
        }
        return $placeholders['codeVendorNamePascalCase'];
    },
    'packageNameHyphenCase'              => function($placeholders) {
        return Util::toHyphenCase($placeholders['packageName']);
    },
    'codePackageNameHyphenCase'          => function($placeholders) {
        return Util::toHyphenCase($placeholders['codePackageName']);
    },
    'codePackageNameHyphenLowerCase'     => function($placeholders) {
        return Util::toHyphenLowerCase($placeholders['codePackageName']);
    },
    'codePackageNameUnderscoreCase'      => function($placeholders) {
        return Util::toUnderscoreCase($placeholders['codePackageName']);
    },
    'codePackageNameUnderscoreLowerCase' => function($placeholders) {
        return Util::toUnderscoreLowerCase($placeholders['codePackageName']);
    },
    'codePackageNamePascalCase'          => function($placeholders) {
        return Util::toPascalCase($placeholders['codePackageName']);
    },
    'codePackageNameCamelCase'           => function($placeholders) {
        return Util::toCamelCase($placeholders['codePackageName']);
    },
    'codePackageNameConstantCase'        => function($placeholders) {
        return Util::toConstantCase($placeholders['codePackageName']);
    },
    'codePackageNamespace'               => function($placeholders, $settings) {
        if ($settings['codeStandard'] === 'wordpress') {
            return $placeholders['codePackageNameUnderscoreCase'];
        }
        return $placeholders['codePackageNamePascalCase'];
    },
    'packageKeywordsList'                => function($placeholders) {
        return str_replace(',', ', ', $placeholders['packageKeywords']);
    },
];

$settings = [
    'packageType'           => [
        'name'        => 'Package type',
        'description' => 'The type of the package.',
        'choices'     => ['library', 'plugin'], // Add 'theme' in here once supported.
        'default'     => 'library',
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
    'codeStandard'          => [
        'name'        => 'Code standard',
        'description' => 'The code standard of the package.',
        'choices'     => ['psr2', 'wordpress'],
        'default'     => 'psr2',
    ],
    'setupCodeStandards'    => [
        'name'        => 'Setup code standards?',
        'description' => 'Whether to setup code standards for the package with PHPCodeSniffer.',
        'confirm'     => true,
        'default'     => true,
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
    'preparePackagist'      => [
        'name'        => 'Prepare for Packagist?',
        'description' => 'Whether to prepare the package for release on Packagist.',
        'confirm'     => true,
        'default'     => true,
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
];

$composerGenerator = function($placeholders, $settings) {
    switch ($settings['packageType']) {
        case 'plugin':
            $type = 'wordpress-plugin';
            break;
        case 'theme':
            $type = 'wordpress-theme';
            break;
        default:
            $type = 'library';
    }

    $data = [
        'name'        => $placeholders['vendorNameHyphenLowerCase'] . '/' . $placeholders['packageNameHyphenLowerCase'],
        'description' => $placeholders['packageDescription'],
        'version'     => '1.0.0',
        'license'     => 'GPL-2.0-or-later',
        'type'        => $type,
        'keywords'    => explode(',', $placeholders['packageKeywords']),
        'homepage'    => $placeholders['packageUrl'],
        'authors'     => [
            [
                'name'     => $placeholders['authorName'],
                'email'    => $placeholders['authorEmail'],
                'homepage' => $placeholders['authorUrl'],
            ],
        ],
        'support'     => [
            'issues' => rtrim($placeholders['packageVcsUrl'], '/') . '/issues',
        ],
        'autoload'    => [],
        'require'     => [
            'php' => '>=' . $settings['minimumPHP'],
        ],
        'require-dev' => [],
        'scripts'     => [],
        'extra'       => [],
    ];

    // Setup autoloading.
    if (version_compare($settings['minimumPHP'], '5.3', '>=')) {
        $namespace = $placeholders['codeVendorNamespace'] . '\\'
            . $placeholders['codePackageNamespace'] . '\\';

        $data['autoload']['psr-4'] = [$namespace => 'src'];

        // For WordPress plugins and themes, setup dependency scoping.
        if (in_array($settings['packageType'], ['plugin', 'theme'], true)) {
            $data['require-dev']['coenjacobs/mozart'] = '^0.2';

            $mozartCommand = '"vendor/bin/mozart" compose';

            $data['scripts']['post-install-cmd'] = [$mozartCommand];
            $data['scripts']['post-update-cmd']  = [$mozartCommand];

            $data['extra'] = [
                'mozart' => [
                    'dep_namespace' => $namespace . 'Dependencies\\',
                    'dep_directory' => '/src/Dependencies/',
                    'packages'      => [],
                ],
            ];
        }
    }

    // Require 'composer/installers' if necessary.
    if (in_array($settings['packageType'], ['plugin', 'theme'], true)) {
        $data['require']['composer/installers'] = '^1';
    }

    // Require necessary tools for coding standards setup.
    if ($settings['setupCodeStandards']) {
        $data['require-dev']['squizlabs/php_codesniffer']                      = '^3.3';
        $data['require-dev']['dealerdirect/phpcodesniffer-composer-installer'] = '^0.4';
        $data['require-dev']['wp-coding-standards/wpcs']                       = '^1';
    }

    // Require necessary tools for unit tests setup.
    if ($settings['setupUnitTests']) {
        if (in_array($settings['packageType'], ['plugin', 'theme'], true)) {
            if (version_compare($settings['minimumPHP'], '7.0', '>=')) {
                $phpunitVersion = '^6';
            } else {
                $phpunitVersion = '>4.8.20 <6.0';
            }
            $data['require-dev']['phpunit/phpunit'] = $phpunitVersion;
            $data['require-dev']['brain/monkey']    = '^2';
        } else {
            if (version_compare($settings['minimumPHP'], '7.1', '>=')) {
                $phpunitVersion = '^7';
            } elseif (version_compare($settings['minimumPHP'], '7.0', '>=')) {
                $phpunitVersion = '^6';
            } else {
                $phpunitVersion = '>=4 <6';
            }
            $data['require-dev']['phpunit/phpunit'] = $phpunitVersion;
        }
    }

    return array_filter($data);
};

return [
    'placeholders'          => $placeholders,
    'generatedPlaceholders' => $generatedPlaceholders,
    'settings'              => $settings,
    'composerGenerator'     => $composerGenerator,
];
