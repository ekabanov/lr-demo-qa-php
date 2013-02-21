#!/bin/sh

set -e

cd $appHome/app/protected/tests
phpunit functional/SiteTest.php