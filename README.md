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

Copyright (C) 2012 travelplanet24 S.A.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software 
and associated documentation files (the "Software"), to deal in the Software without restriction, 
including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, 
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or 
substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING 
BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH 
THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.