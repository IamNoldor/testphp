<?php

namespace app\controllers;

use app\models\Contactpost;
use app\models\Descriptivepost;
use app\models\Post;
use app\models\Postqueue;
use Yii;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $now = new \DateTime();
        if (Yii::$app->request->isAjax) {
            $errors = array();
            $data = $this->request->post();
            $post_model = new Post();
            $post_queue_model = new Postqueue();
            $post_model->company_name = $data['company_name'];
            $post_model->position = $data['position'];
            $post_queue_model->post_at = $data['post_at'];
            if ($data['company_name'] == '') {
                array_push($errors, 'Error 01');
            }
            if ($data['position'] == '') {
                array_push($errors, 'Error 02');
            }
            if ($data['form_type'] == 1) {
                $post_model->type = 'Descriptive';
                $post_model->save();
                $posts = Post::find()->all();
                $post_id = 0;
                foreach ($posts as $post) {
                    if ($post->id >= $post_id) {
                        $post_id = $post->id;
                    }
                }
                $post_queue_model->post_id = $post_id;
                $descriptive_post_model = new Descriptivepost();
                $descriptive_post_model->post_id = $post_id;
                $descriptive_post_model->position_description = $data['position_description'];
                $descriptive_post_model->salary = $data['salary'];
                if ($descriptive_post_model->salary == '') {
                    $descriptive_post_model->salary = 0;
                }
                $descriptive_post_model->starts_at = $data['starts_at'];
                $descriptive_post_model->ends_at = $data['ends_at'];
                if ($descriptive_post_model->starts_at == '') {
                    $descriptive_post_model->starts_at = $now->format('Y-m-d');
                }
                $starts_at = new \DateTime($descriptive_post_model->starts_at);
                $ends_at = new \DateTime($descriptive_post_model->ends_at);
                $starts_at = $starts_at->modify('+3 month');
                $starts_at = $starts_at->format('Y-m-d');
                $ends_at = $ends_at->format('Y-m-d');
                if ($starts_at > $ends_at) {
                    array_push($errors, 'Error 03');
                }
                if ($post_queue_model->post_at == '') {
                    $post_queue_model->post_at = $now->format('Y-m-d H:i:s');
                } else {
                    $post_at = date_create($post_queue_model->post_at);
                    $post_at = $post_at->format('Y-m-d H:i:s');
                    $now = $now->format('Y-m-d H:i:s');
                    if ($post_at < $now) {
                        array_push($errors, 'Error 04');
                    }
                }
                if (!empty($errors)) {
                    $this->deletePost($post_id);
                    return json_encode($errors);
                }
                if ($post_model->save() && $descriptive_post_model->save() && $post_queue_model->save()) {
                    return 'SUCCESS';
                }

            }
            if ($data['form_type'] == 2) {
                $post_model->type = 'Contact';
                $post_model->save();
                $posts = Post::find()->all();
                $post_id = 0;
                foreach ($posts as $post) {
                    if ($post->id >= $post_id) {
                        $post_id = $post->id;
                    }
                }
                $post_queue_model->post_id = $post_id;
                if ($post_queue_model->post_at == '') {
                    $post_queue_model->post_at = $now->format('Y-m-d H:i:s');
                } else {
                    $post_at = date_create($post_queue_model->post_at);
                    $post_at = $post_at->format('Y-m-d H:i:s');
                    $now = $now->format('Y-m-d H:i:s');
                    if ($post_at < $now) {
                        array_push($errors, 'Error 04');
                    }
                }
                $contact_post_model = new Contactpost();
                $contact_post_model->post_id = $post_id;
                if ($data['contact_email'] == '' || !filter_var($data['contact_email'], FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, 'Error 05');
                } else {
                    $contact_post_model->contact_email = $data['contact_email'];
                }
                $contact_post_model->contact_name = $data['contact_name'];
                if (!empty($errors)) {
                    $this->deletePost($post_id);
                    return json_encode($errors);
                }
                if ($post_model->save() && $contact_post_model->save() && $post_queue_model->save()) {
                    return 'SUCCESS';
                }

            }
        }
        return $this->render('index');
    }
    public function deletePost($id) {
        $post = Post::find()
            ->where(['id' => $id])
            ->one();
        $post->delete();
    }
}
