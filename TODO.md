# TODO

This is a TODO list for the feature/zend-mvc-v3-minimal branch.

## Installer

- Prompt for caching
  - will install zend-cache
- Prompt for console
  - prompt should indicate users should migrate to zf-console
  - will install zend-mvc-console
- Prompt for database
  - will install zend-db
- Prompt for forms
  - will install zend-form
- Prompt for i18n
  - will install zend-mvc-i18n
- Prompt for JSON
  - will install zend-json
- Prompt for logging
  - will install zend-log
- Prompt for PSR-7 middleware dispatcher
  - will install zend-psr7bridge
- Prompt for sessions
  - will install zend-session
- Prompt for testing facilities
  - will install zend-test *as dev requirement*
- Prompt for plugins
  - will install zend-mvc-plugin-*
- Prompt for zend-di integration
  - will install zend-servicemanager-di

In each case, this should register the module(s) with the application, so that
the user does not need to be prompted twice.

## Documentation

- ModuleRouteListener is removed from the skeleton. This won't affect existing
  users, but *will* affect experienced users who originally relied on it being
  active in new skeleton projects.
- The `/[:controller][/:action]]` route was removed from the skeleton. Again, it
  will not affect existing users, but *will* affect experienced users who
  originally relied on it being active in new skeleton projects.
