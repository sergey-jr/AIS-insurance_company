<?

use app\models\Filial;
use app\models\Types;
use yii\db\Query;
?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            № п/п
        </th>
        <th>
            Сотрудник
        </th>
        <th>
            Клиент
        </th>
        <th>
            Вид договора
        </th>
        <th>
            Филиал
        </th>
        <th>
            Сумма страхования
        </th>
        <th>
            Дата заключения
        </th>
        <th>
            Дата окончания
        </th>
    </tr>
    </thead>
    <?
    $i = 1;
    foreach ($contracts as $contract){
        $worker = (new Query)
            ->select('last_name, first_name, patronymic_name')
            ->from('user, workers')
            ->where('user.id=user_id and workers.id='. $contract->worker_id)->one();
        $client = (new Query)
            ->select('last_name, first_name, patronymic_name')
            ->from('user, clients')
            ->where('user.id=user_id and clients.id='. $contract->client_id)->one();
        $type = Types::find()->where(['id' => $contract->type_id])->one();
        $filial = Filial::find()->where(['id' => $contract->filial_id])->one();
        echo  '<tr><td>'. $i .'</td><td>' . implode('<br>',
                [$worker['last_name'], $worker['first_name'], $worker['patronymic_name']]) . '</td>
                <td>' . implode('<br>',
                [$client['last_name'], $client['first_name'], $client['patronymic_name']]) . '</td>
                <td>' . $type['name'] . '</td>
                <td>' . $filial['name'] .'</td><td>' . $contract->price . '₽</td>
                <td>' . $contract->date. '</td><td>' . $contract->date_expired. '</td></tr>';
        $i++;
    }
    ?>
    <tr>
        <td>ΣИтого</td>
        <td><? echo $count;
        echo ($count%10>4 || (21> $count && $count>10) || !$count )?' записей': (($count%10 == 1)? ' запись': ' записи'); ?>
        </td><td></td><td></td><td></td><td><?echo $amount;?>₽</td><td></td><td></td></tr>
</table>