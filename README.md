Clone Databases
===============

Clone Databases are helpfull scripts that help you clone a database along with the containing data.

Getting Started & Documentation
===============================

It's a set of scripts that, combined with Zend Framework, can clone and/or drop the database you have set on your 'database.ini' file.

Commands
========

Below you can find all the commands, which are available.

### Clone databases

Depending on the variable 'parallel_processes' you have set on your projects 'database.ini', running the following will clone the database.
<pre><code>$ php scripts/db/setup-multiple-test-databases.php
</code></pre>


### Clone databases

Run delete-test-database.sh with 3 params:
- database name
- from number
- to number
<pre><code>$ sh delete-test-database.sh dbname 1 10
</code></pre>

Contribution
===========

Updates and improvements are more than welcome!
