<?
use yii\db\Query;
?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            № п/п
        </th>
        <th>
            Клиент
        </th>
        <th>
            № договора
        </th>
        <th>
            Сумма платежа
        </th>
        <th>
            Дата
        </th>
    </tr>
    </thead>
    <?
    $i = 1;
    foreach ($payments as $payment){
        $client = (new Query)
            ->select('last_name, first_name, patronymic_name')
            ->from('user, clients')
            ->where('user.id=user_id and clients.id='. $payment->client_id)->one();
        echo  '<tr><td>'. $i .'</td>
                <td>' . implode('<br>',
                [$client['last_name'], $client['first_name'], $client['patronymic_name']]) . '</td>
                <td>' . $payment->contract_id . '</td>
                <td>' . $payment->amount . '₽</td>
                <td>' . $payment->date. '</td></tr>';
        $i++;
    }
    ?>
    <tr>
        <td>ΣИтого</td>
        <td><? echo $count;
            echo ($count%10>4 || (21> $count && $count>10) || !$count )?' записей': (($count%10 == 1)? ' запись': ' записи'); ?>
        <td></td><td><?echo $amount;?>₽</td><td></tr>
</table>
