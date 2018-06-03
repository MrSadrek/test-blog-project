<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Article */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Предложить новость';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="form-group">
        <?= Html::a('Вернуться к списку', Url::toRoute(['article/article-list']),['class' => 'btn btn-primary' ]) ?>
    </div>
    <p>
        Чтобы опубликовать новость, заполните все поля и нажмите отправить. Когда администратор проверить новость, она
        появится на сайте.
    </p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'article-form']); ?>

                <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 10]) ?>




                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success', 'name' => 'article-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
