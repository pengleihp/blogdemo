<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '权限管理';
$this->params['breadcrumbs'][] = ['label' => '权限管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="privilege-update">

<h1><?= Html::encode($this->title) ?></h1>

<div class="privilege-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::checkboxList('newPri',$authAssigmentArray,$allPrivilegeArray) ?>
   
  
    <div class="form-group">
        <?= Html::submitButton( '设置', ['class' =>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
