<?php

use backend\services\BaseService;
?>

<?php foreach ($data as $row) { ?>
    <tr>
        <td>
            <div class="title">
                <a class="btn_insert" href="<?= BaseService::MakeLink($row) ?>" title="<?= $row->title ?>" data-id="<?= $row->id ?>" data-image="/<?= $row->avatar ?>"><?= $row->title ?></a>
            </div>
        </td>
        <td>
            <span class="label label-success"><?= date('Y-m-d', strtotime($row->created_date)) ?></span>
        </td>
    </tr>
<?php } ?>