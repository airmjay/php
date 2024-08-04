<?php
declare(strict_types=1);

$root = dirname(__DIR__). DIRECTORY_SEPARATOR;
define('APP_PATH' , $root . 'app' . DIRECTORY_SEPARATOR);
define('TRANSACTION_PATH', $root. 'transaction'. DIRECTORY_SEPARATOR);
define('VIEW_PATH', $root. 'view'. DIRECTORY_SEPARATOR );
require APP_PATH.'app.php';
$path = getTransactionFile(TRANSACTION_PATH);
$transactions = [];
foreach($path as $path)
{
    $transactions = array_merge($transactions, getTransactions($path,'extractTransaction'));
}
$total = calculateTotal($transactions);
require VIEW_PATH.'view.php';

?>