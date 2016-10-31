<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module\Db;

class Unit extends \Codeception\Module
{
    function truncateDb($table) {
        /** @var Db $dbh */
        $dbh = $this->getModule('Db');
        $dbh->driver->executeQuery('DELETE FROM tblcontact WHERE 1=1', []);
    }
}
