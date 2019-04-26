<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确认删除这篇文章吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'tags:ntext',
            // 'status',
            [
              'label'=>'状态',
              'value'=>$model->status0->name
            ],
            // 'create_time:datetime',
            // 'update_time:datetime',
            [
                'label'=>'创建时间',
                'value'=>date('Y-m-d H:i:s',$model->create_time)
            ],
            [
                'label'=>'修改时间',
                'value'=>date('Y-m-d H:i:s',$model->update_time)
            ],
            // 'author_id',
            [
                'attribute'=>'author_id',
                'value'=>$model->author->nickname,
                'label'=>'作者'
            ],
        ],
        'template'=>'<tr><th style="width:120px;">{label}</th><td>{value}</td></tr>',
        'options'=>['class'=>'table table-striped table-bordered detail-view'],
    ]) ?>

</div>
