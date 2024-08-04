<?php
declare(strict_types=1);

function getTransactionFile(string $dir_path): array
{
     $files = [];
     foreach(scandir($dir_path) as $file)
     {
        if(is_dir($file))
        {
            continue;
        }
        $files[] = $dir_path.$file;
        
     }
     return $files;
}
function getTransactions($fileName, ?callable $bank = null)
{
    if(! file_exists($fileName))
    {
        trigger_error("file ". $fileName. " does not exist ", E_USER_ERROR);
    }
    $file = fopen($fileName, 'r');
    fgetcsv($file);
    $transactions = [];
    
    while(($transaction = fgetcsv($file)) !== false)
    {
        if($bank !== false)
        {
        $transaction = $bank($transaction);
        }
        $transactions[] = $transaction;
    }
    
    return $transactions;
}
function extractTransaction($transaction)
{
    [$date, $check, $description , $amount] = $transaction;
     $amount = str_replace([',','$'],'', $amount);
     (float) $amount;
    return 
    [
        'date' => $date,
        'check' => $check,
        'description' => $description,
        'amount' => $amount
    ];
}
function calculateTotal($transaction)
{   
    $total = ['NetTotal' => 0, 'Expense' => 0, 'NetIncome' => 0];
    foreach($transaction as $transaction)
    {
        $total['NetTotal'] +=  $transaction['amount'];
    
    if($transaction['amount'] > 0)
    {
        $total['NetIncome'] += $transaction['amount'];
    }else
    {
        $total['Expense'] += $transaction['amount'];
    }
    }
  return $total;
}
function formatAmount(float $amount):string
{
    $negletive = $amount < 0;
    return($negletive ? '-' : '') . "$" . number_format(abs($amount),2);
}
function formatDate(string $date):string
{
    return date('m/Y/D ', strtotime($date));
}
?>