<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Timesheet */

$this->title = Yii::t('app', 'Create Timesheet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timesheets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timesheet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
