<style>
    th,table,tr
    {
        border:2px solid steelblue;
        border-collapse:collapse;
    }
    table
    {
        border-radius: 10px !important;
    }
    td
    {
        padding: 10px;
    }
    tr:nth-child(even) 
    {
        /* color: rgb(100, 221, 70); */
        /* background: steelblue; */
    }
    tr:hover 
    {
        background:rgb(214, 210, 210);
    }
    tr
    {
        cursor: pointer;
    }
</style>
<table>
<tr>
    <td>Date</td>
    <td>Cheque Number</td>
    <td>Description</td>
    <td>Amout</td>
</tr>
    
<?php if(!empty($transactions)): ?>
<?php foreach($transactions as $transaction):?>
    <tr>
    <td><?= formatDate($transaction['date'])?></td>
    <td><?= $transaction['check']?></td>
    <td><?= $transaction['description']?></td>
    <?php if($transaction['amount'] > 0): ?>
    <td style="color:green"><?= formatAmount($transaction['amount'])?></td>
    <?php elseif($transaction['amount'] < 0): ?>
    <td style="color:red"><?= formatAmount($transaction['amount'])?></td>
    <?php else: ?>
    <td><?= formatAmount($transaction['amount'])?></td>
    <?php endif ?>
    </tr>
<?php endforeach ?>
   <tr>
    <td colspan='3' style='text-align:right;'>Net Total:</td>
    <td> <?= formatAmount($total['NetTotal'])?></td>
   </tr>
   <tr>
   <td colspan='3' style='text-align:right;'>Net Income:</td>
   <td> <?=formatAmount($total['NetIncome'])?></td>
   </tr>
   <tr>
   <td  colspan='3' style='text-align:right;'>Net Expense:</td>
   <td style="color:red"><?=formatAmount($total['Expense'])?></td>
   </tr>
<?php endif?>
</table>