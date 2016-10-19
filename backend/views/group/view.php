<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать ', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!--<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>-->
        <button class="btn btn-danger delete-group" >
            Удалить
        </button>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'date',
        ],
    ]) ?>

    <h1><?= Html::encode("Пользователи в группе") ?></h1>

    <p>
        <button class="btn btn-success add-user-for-group-btn" data-toggle="modal" data-target="#add-user-for-group">
            Добавить пользователя в группу
        </button>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="user-for-group">
        <?php foreach ($users as $user):  ?>

        <tr class="user-for-group-item-<?=$user->id?>">
            <td class="col-md-1 " ><?=$user->id?></td>
            <td class="col-md-8"><?=$user->name?></td>
            <td class="col-md-1">
                <a href="#" class="delete-user-for-group" id="<?=$user->id?>">
                    <span class="glyphicon glyphicon-trash" ></span>
                </a>


        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

</div>
<div class="modal fade" id="add-user-for-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить пользователя в группу</h4>
            </div>
            <div class="modal-body">
                <select class="form-control select-add-user">

                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-close" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary add-new-user-btn">Добавить</button>
            </div>
        </div>
    </div>
</div>
