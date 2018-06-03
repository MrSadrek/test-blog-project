<?php
namespace frontend\controllers;

use common\models\Article;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Displays article form page.
     *
     * @return mixed
     */
    public function actionArticleForm()
    {
        $model = new Article();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = 2;
            if ($model->pushArticle()) {
                Yii::$app->session->setFlash('success', 'В скором времени статья будет проверена и добавлена.');
            } else {
                Yii::$app->session->setFlash('error', 'Возникла ошибка при отправке. Попробуйте снова.');
            }

            return $this->refresh();
        } else {
            return $this->render('articleForm', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays article form page.
     *
     * @return mixed
     */
    public function actionArticleList()
    {
        $statusActive = 1;
        $model = new Article();

        $articleList =  $model->getListArticles($statusActive);

            return $this->render('articleList', [
                'model' => $articleList['models'],
                'pages' => $articleList['pages'],
            ]);
//        }
    }

}
