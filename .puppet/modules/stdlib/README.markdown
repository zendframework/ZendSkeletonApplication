# Puppet Labs Standard Library #

This module provides a "standard library" of resources for developing Puppet
Modules.  This modules will include the following additions to Puppet

 * Stages
 * Facts
 * Functions
 * Defined resource types
 * Types
 * Providers

This module is officially curated and provided by Puppet Labs.  The modules
Puppet Labs writes and distributes will make heavy use of this standard
library.

# Versions #

This module follows semver.org (v1.0.0) versioning guidelines.  The standard
library module is released as part of [Puppet
Enterprise](http://puppetlabs.com/puppet/puppet-enterprise/) and as a result
older versions of Puppet Enterprise that Puppet Labs still supports will have
bugfix maintenance branches periodically "merged up" into master.  The current
list of integration branches are:

 * v2.1.x (v2.1.1 released in PE 1.2, 1.2.1, 1.2.3, 1.2.4)
 * v2.2.x (Never released as part of PE, only to the Forge)
 * v2.3.x (Scheduled for next PE feature release)
 * master (mainline development branch)

The first Puppet Enterprise version including the stdlib module is Puppet
Enterprise 1.2.

# Compatibility #

## stdlib v2.1.x, v2.2.x ##

v2.1.x and v2.2.x of this module are designed to work with Puppet versions
2.6.x and 2.7.x.  There are currently no plans for a Puppet 0.25 standard
library module.

## stdlib v2.3.x ##

While not yet released, the standard library may only work with Puppet 2.7.x.

# Functions #

  Please see `puppet doc -r function` for documentation on each function.  The
  current list of functions is:

 * getvar
 * has\_key
 * loadyaml
 * merge.rb
 * validate\_array
 * validate\_bool
 * validate\_hash
 * validate\_re
 * validate\_string

## validate\_hash ##

    $somehash = { 'one' => 'two' }
    validate\_hash($somehash)

## getvar() ##

This function aims to look up variables in user-defined namespaces within
puppet.  Note, if the namespace is a class, it should already be evaluated
before the function is used.

    $namespace = 'site::data'
    include "${namespace}"
    $myvar = getvar("${namespace}::myvar")

## Facts ##

Facts in `/etc/facter/facts.d` and `/etc/puppetlabs/facter/facts.d` are now loaded
automatically.  This is a direct copy of R.I. Pienaar's custom facter fact
located at:
[https://github.com/ripienaar/facter-facts/tree/master/facts-dot-d](https://github.com/ripienaar/facter-facts/tree/master/facts-dot-d)

