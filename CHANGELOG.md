# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 3.1.3 - 2019-11-27

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#452](https://github.com/zendframework/ZendSkeletonApplication/pull/452) provides a truly cross-platform approach to removing the `composer.lock` entry from the `.gitignore` file. The skeleton now provides a script for doing so that it invokes as part of its post-create-project-cmd event; the script removes itself on completion.

## 3.1.2 - 2019-11-21

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#451](https://github.com/zendframework/ZendSkeletonApplication/pull/451) provides compatibility on Windows for the script re-instating the composer.lock in the created project.

## 3.1.1 - 2019-11-15

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#449](https://github.com/zendframework/ZendSkeletonApplication/pull/449) fixes a syntax error in the post-create-project-cmd hook.

## 3.1.0 - 2019-11-15

### Added

- Nothing.

### Changed

- [#431](https://github.com/zendframework/ZendSkeletonApplication/pull/431) updates the skeleton to use Bootstrap 4.

- [#428](https://github.com/zendframework/ZendSkeletonApplication/pull/428) changes the default `module_listener_options` in the `config/application.config.php` file to remove the `module_paths` and set `use_zend_loader` to false.

- [#448](https://github.com/zendframework/ZendSkeletonApplication/pull/448) removes the `composer.lock` to ensure users creating a new project receive the latest versions of all dependencies as supported by their current PHP version.  Additionally, it adds an entry to the `post-create-project-cmd` Composer hook to remove the `composer.lock` entry from the `.gitignore` file, to promote checking in a `composer.lock` in user projects.

- [#448](https://github.com/zendframework/ZendSkeletonApplication/pull/448) bumps the version constraints of all optional packages to the latest versions supported by all PHP versions the skeleton supports.

- [#448](https://github.com/zendframework/ZendSkeletonApplication/pull/448) bumps the minimum supported version of zf-development-mode to 3.2

- [#448](https://github.com/zendframework/ZendSkeletonApplication/pull/448) bumps the minimum supported version of zend-mvc to 3.1.1.

- [#448](https://github.com/zendframework/ZendSkeletonApplication/pull/448) bumps the allowed versions of zend-component-installer to the 1.0 and 2.0 series.

- [#448](https://github.com/zendframework/ZendSkeletonApplication/pull/448) bumps the minimum supported version of zend-skeleton-installer to 0.1.7.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#430](https://github.com/zendframework/ZendSkeletonApplication/pull/430) updates the `serve` command to work cross-platform, and across all supported PHP versions.
