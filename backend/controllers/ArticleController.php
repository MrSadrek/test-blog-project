<?php
namespace backend\controllers;

use common\models\Article;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


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
    public function actionArticleForm($id = null)
    {
        if(isset($id)) {
            $model = Article::find()->where(['id' => $id])->one();
            $type = 'update';
        }else {
            $model = new Article();
            $type = 'create';

        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {


            if ($model->pushArticle($type)) {
                Yii::$app->session->setFlash('success', 'Статья была изменена');
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
        $statusActive = [0,1,2];
        $model = new Article();

        $articleList =  $model->getListArticles($statusActive);

            return $this->render('articleList', [
                'model' => $articleList['models'],
                'pages' => $articleList['pages'],
            ]);
//        }
    }

}
