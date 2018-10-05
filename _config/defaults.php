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
            $vendorName  = Util::toHyphenLowerCase($placeholders['vendorName']['value']);
            $packageName = Util::toHyphenLowerCase($placeholders['packageName']['value']);
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
    'vendorNameHyphenLowerCase'          => function($placeholders) {
        return Util::toHyphenLowerCase($placeholders['vendorName']);
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
    'packageNameHyphenLowerCase'         => function($placeholders) {
        return Util::toHyphenLowerCase($placeholders['packageName']);
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
    'codeStandardName'                   => function($placeholders, $settings) {
        if ($settings['codeStandard'] === 'wordpress') {
            return 'WordPress';
        }
        return 'PSR-2';
    },
    'codeStandardUrl'                    => function($placeholders, $settings) {
        if ($settings['codeStandard'] === 'wordpress') {
            return 'https://make.wordpress.org/core/handbook/best-practices/coding-standards/';
        }
        return 'https://www.php-fig.org/psr/psr-2/';
    },
    'latestPHPTravisEnvironment'         => function($placeholders, $settings) {
        $env = [];
        if ($settings['setupUnitTests']) {
            $env[] = 'UNIT=1';
        }
        $env[] = 'PHPLINT=1';
        if ($settings['setupCodeStandards']) {
            $env[] = 'PHPCS=1';
        }
        if ($settings['setupUnitTests']) {
            $env[] = 'COVERAGE=1';
        }
        return implode(' ', $env);
    },
    'minimumPHPTravisEnvironment'        => function($placeholders, $settings) {
        if ($settings['setupUnitTests']) {
            return 'UNIT=1 PHPLINT=1';
        }
        return 'PHPLINT=1';
    },
    'minimumPHPTravisDistribution'       => function($placeholders, $settings) {
        if (version_compare($settings['minimumPHP'], '5.4', '<')) {
            return 'precise';
        }
        return 'trusty';
    },
    'wordPressContributorsList'          => function($placeholders, $settings) {
        return str_replace(',', ', ', $settings['wordPressContributors']);
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
    'wordPressContributors' => [
        'name'        => 'WordPress.org contributors',
        'description' => 'WordPress.org usernames of the contributors to this package, separated by comma.',
        'validation'  => function($placeholder) {
            return Validation::validateSlugList($placeholder);
        },
        'default'     => 'flixos90',
        'skip'        => function($settings) {
            if (!$settings['prepareWordPressOrg']['value']) {
                return true;
            }
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
        'name'         => $placeholders['vendorNameHyphenLowerCase'] . '/' . $placeholders['packageNameHyphenLowerCase'],
        'description'  => $placeholders['packageDescription'],
        'version'      => '1.0.0',
        'license'      => 'GPL-2.0-or-later',
        'type'         => $type,
        'keywords'     => explode(',', $placeholders['packageKeywords']),
        'homepage'     => $placeholders['packageUrl'],
        'authors'      => [
            [
                'name'     => $placeholders['authorName'],
                'email'    => $placeholders['authorEmail'],
                'homepage' => $placeholders['authorUrl'],
            ],
        ],
        'support'      => [
            'issues' => rtrim($placeholders['packageVcsUrl'], '/') . '/issues',
        ],
        'autoload'     => [],
        'autoload-dev' => [],
        'require'      => [
            'php' => '>=' . $settings['minimumPHP'],
        ],
        'require-dev'  => [],
        'scripts'      => [],
        'extra'        => [],
    ];

    // Setup autoloading.
    if (version_compare($settings['minimumPHP'], '5.3', '>=')) {
        $namespace = $placeholders['codeVendorNamespace'] . '\\'
            . $placeholders['codePackageNamespace'] . '\\';

        $data['autoload']['psr-4'] = [$namespace => 'src'];

        // For WordPress plugins and themes, setup dependency scoping.
        if (in_array($settings['packageType'], ['plugin', 'theme'], true) && $settings['prepareWordPressOrg']) {
            $data['require-dev']['coenjacobs/mozart'] = '^0.2';

            $mozartCommand = '"vendor/bin/mozart" compose';

            $data['scripts']['post-install-cmd'] = [$mozartCommand];
            $data['scripts']['post-update-cmd']  = [$mozartCommand];

            $data['extra'] = [
                'mozart' => [
                    'dep_namespace' => $namespace . 'Dependencies\\',
                    'dep_directory' => '/dependencies/',
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

        $data['scripts']['phplint'] = 'find -L .  -path ./vendor -prune -o -name \'*.php\' -print0 | xargs -0 -n 1 -P 4 php -l';
        $data['scripts']['phpcs']   = '@php ./vendor/bin/phpcs';
    }

    // Require necessary tools for quality assurance setup.
    if ($settings['setupQualityAssurance']) {
        $data['require-dev']['phpmd/phpmd'] = '^2.6';

        $data['scripts']['phpmd'] = '@php ./vendor/bin/phpmd src text phpmd.xml.dist';
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

        // Setup tests autoloading.
        if (version_compare($settings['minimumPHP'], '5.3', '>=')) {
            $namespace = $placeholders['codeVendorNamespace'] . '\\'
            . $placeholders['codePackageNamespace'] . '\\Tests\\PHPUnit\\Framework\\';

            $data['autoload-dev']['psr-4'] = [$namespace => 'tests/phpunit/framework'];
        }

        $data['scripts']['phpunit']     = '@php ./vendor/bin/phpunit';
        $data['scripts']['phpunit-cov'] = '@php ./vendor/bin/phpunit --coverage-clover tests/logs/clover.xml';

        if (in_array($settings['packageType'], ['plugin', 'theme'], true) && $settings['setupIntegrationTests']) {
            $data['scripts']['phpunit-integration']     = '@php ./vendor/bin/phpunit -c phpunit-integration.xml.dist';
            $data['scripts']['phpunit-integration-cov'] = '@php ./vendor/bin/phpunit -c phpunit-integration.xml.dist --coverage-clover tests/logs/clover.xml';
        }
    }

    return array_filter($data);
};

$templatePicker = function($settings) {
    $templates = ['.gitignore' => '.gitignore'];

    $templates['.editorconfig-' . $settings['codeStandard']] = '.editorconfig';

    $templates['LICENSE.md']                                 = 'LICENSE.md';
    $templates['README-' . $settings['packageType'] . '.md'] = 'README.md';

    $templates['CONTRIBUTING-' . $settings['packageType'] . '.md']                  = 'CONTRIBUTING.md';
    $templates['.github/ISSUE_TEMPLATE-' . $settings['packageType'] . '.md']        = '.github/ISSUE_TEMPLATE.md';
    $templates['.github/PULL_REQUEST_TEMPLATE-' . $settings['packageType'] . '.md'] = '.github/PULL_REQUEST_TEMPLATE.md';

    if (version_compare($settings['minimumPHP'], '5.3', '<')) {
        $phpSuffix = '52';
    } elseif (version_compare($settings['minimumPHP'], '5.3', '<')) {
        $phpSuffix = '53';
    } else {
        $phpSuffix = '70';
    }

    $templates['src/' . ucfirst($settings['packageType']) . '-' . $settings['codeStandard'] . '-' . $phpSuffix . '.php'] = ucfirst($settings['packageType']) . '.php';

    if ($settings['packageType'] === 'plugin') {
        $templates['plugin-' . $settings['codeStandard'] . '-' . $phpSuffix . '.php'] = $placeholders['packageNameHyphenLowerCase'] . '.php';
    }

    if (in_array($settings['packageType'], ['plugin', 'theme'], true) && $settings['prepareWordPressOrg']) {
        $templates['license.txt']                                 = 'license.txt';
        $templates['readme-' . $settings['packageType'] . '.txt'] = 'readme.txt';
        $templates['deploy-' . $settings['packageType'] . '.sh']  = 'deploy.sh';
    }

    if ($settings['setupCodeStandards']) {
        $templates['phpcs-' . $settings['packageType'] . '-' . $settings['codeStandard'] . '.xml.dist'] = 'phpcs.xml.dist';
    }

    if ($settings['setupQualityAssurance']) {
        $templates['phpmd.xml.dist'] = 'phpmd.xml.dist';
    }

    if ($settings['setupUnitTests']) {
        $templates['phpunit.xml.dist'] = 'phpunit.xml.dist';

        // Setting up unit tests is currently not compatible with PHP 5.2.
        if (version_compare($settings['minimumPHP'], '5.3', '>=')) {
            $templates['tests/phpunit/phpunit-compat-' . $settings['codeStandard'] . '.php']                             = 'tests/phpunit/phpunit-compat.php';
            $templates['tests/phpunit/bootstrap-' . $settings['packageType'] . '-' . $settings['codeStandard'] . '.php'] = 'tests/phpunit/bootstrap.php';

            if ($settings['codeStandard'] === 'wordpress') {
                $templates['tests/phpunit/framework/UnitTestCase-' . $settings['packageType'] . '-wordpress.php'] = 'tests/phpunit/framework/Unit_Test_Case.php';
                $templates['tests/phpunit/unit/SampleTests-wordpress.php']                                        = 'tests/phpunit/unit/Sample_Tests.php';
            } else {
                $templates['tests/phpunit/framework/UnitTestCase-' . $settings['packageType'] . '-psr2.php'] = 'tests/phpunit/framework/UnitTestCase.php';
                $templates['tests/phpunit/unit/SampleTests-psr2.php']                                        = 'tests/phpunit/unit/SampleTests.php';
            }
        }

        if (in_array($settings['packageType'], ['plugin', 'theme'], true) && $settings['setupIntegrationTests']) {
            $templates['phpunit-integration.xml.dist'] = 'phpunit-integration.xml.dist';

            // Setting up integration tests is currently not compatible with PHP 5.2.
            if (version_compare($settings['minimumPHP'], '5.3', '>=')) {
                $templates['tests/phpunit/bootstrap-integration-' . $settings['packageType'] . '-' . $settings['codeStandard'] . '.php'] = 'tests/phpunit/bootstrap-integration.php';

                if ($settings['codeStandard'] === 'wordpress') {
                    $templates['tests/phpunit/framework/IntegrationTestCase-' . $settings['packageType'] . '-wordpress.php'] = 'tests/phpunit/framework/Integration_Test_Case.php';
                    $templates['tests/phpunit/integration/SampleTests-wordpress.php']                                        = 'tests/phpunit/integration/Sample_Tests.php';
                } else {
                    $templates['tests/phpunit/framework/IntegrationTestCase-' . $settings['packageType'] . '-psr2.php'] = 'tests/phpunit/framework/IntegrationTestCase.php';
                    $templates['tests/phpunit/integration/SampleTests-psr2.php']                                        = 'tests/phpunit/integration/SampleTests.php';
                }
            }
        }
    }

    if (($settings['setupCodeStandards'] || $settings['setupUnitTests']) && $settings['integrateTravisCI']) {
        $templates['.travis-' . $settings['packageType'] . '.yml'] = '.travis.yml';
    }

    if (($settings['setupCodeStandards'] || $settings['setupQualityAssurance'] || $settings['setupUnitTests']) && $settings['integrateCodeClimate']) {
        $templates['.codeclimate.yml'] = '.codeclimate.yml';
    }

    return $templates;
};

return [
    'placeholders'          => $placeholders,
    'generatedPlaceholders' => $generatedPlaceholders,
    'settings'              => $settings,
    'composerGenerator'     => $composerGenerator,
];
