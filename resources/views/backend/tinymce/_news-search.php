<?php

use backend\services\BaseService;
?>

<table class="table table-condensed table-hover ajax_searchNews">
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td>
                    <div class="title"><a class="btn_insert" href="<?= BaseService::MakeLink($row)?>" title="<?= $row["title"] ?>" data-id="<?= $row['id'] ?>" data-image=""> <?= $row["title"] ?></a></div>
                </td>
                <td><span class="label label-success"><?= BaseService::GetAgoTime($row['date_public']); ?></span></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2" style="text-align: center;"><a class="btn_loadmore" data-page="1" href="#"><i class="fa fa-arrow-down"></i> Tải thêm</a></td>
        </tr>
    </tbody>
</table>