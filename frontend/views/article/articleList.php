<?php
/**
 * Created by PhpStorm.
 * User: MrSadrek
 * Date: 03.06.2018
 * Time: 12:54
 */

use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

 ?>
<div class="container">
    <div class="blog-header">
        <?php if(!yii::$app->user->isGuest): ?>
            <a class="btn btn-success" href="<?= Url::toRoute(['/article/article-form'])?>">Предложить новость</a>
        <?php endif;?>
    </div>

      <div class="row">

        <div class="col-sm-8 blog-main">
            <?php foreach ($model as $article):?>
          <div class="blog-post">
            <h2 class="blog-post-title"><?= htmlspecialchars($article->title) ?></h2>
            <p class="blog-post-meta"><?= $article->created_at; ?> by <?= $article->createdBy->username?></p>

            <p><?= htmlspecialchars($article->body) ?></p>
          </div><!-- /.blog-post -->
        <?php endforeach; ?>
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>


        </div><!-- /.blog-main -->



      </div><!-- /.row -->

    </div>