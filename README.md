ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.


Installation
------------
The easiest way to get a working copy of this project is to do a recursive
clone:

    git clone --recursive git://github.com/zendframework/ZendSkeletonApplication.git

After the clone is complete, set up a virtual host to point to the public/
directory of the project and you should be ready to go!

If you're wondering what the `--recursive` flag is, keep reading:

Git Submodules
--------------
This project makes use of [Git submodules](http://book.git-scm.com/5_submodules.html).
Utilizing Git submodules allows us to reference an exact commit in the upstream
[zendframework/zf2](https://github.com/zendframework/zf2) repository and ensure
that those who have cloned the project have that same commit checked out. This
provides several benefits:

* Developers do not have to worry about which commit of the zf2 project to have
  checked out for this project to work.
* No additional steps to "install" Zend Framework are needed; it "just works"
  after a cloning the project.

There are a couple of mild caveats to be aware of:

* Be sure to always run `git submodule update` after pulling, as merge/rebase
  does not automatically update the checked out commit in submodules if it has
  been changed.
* The initial clone will be a bit slower, due to it having to pull down a
  separate copy of ZF2 from what you already have.
