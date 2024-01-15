<?php

/** @var yii\web\View $this
 *  @var array $array
 *  @var int $count
 */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="mx-2 ms-0 mb-3">
        <button type="button" class="btn btn-secondary">
            Кнопка
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Кнопка
        </button>
        <button type="button" class="btn btn-secondary">
            Кнопка
        </button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Количество ячеек, содержащих в себе значение 0, и имеющие рядом с собой больше двух ячеек содержащих значение 1 - <?php echo $count ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <?php foreach ($array as $row) { ?>
            <tr>
                <?php foreach ($row as $cell) { ?>
                    <th class="text-center"><?php echo $cell ?></th>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
    $this->registerJs(
        "$('.btn').on('click', function() { $('th').addClass('bg-warning') });",
        $this::POS_READY,
        'my-button-handler'
    );
?>
