<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            // 'access'=>[
            //     // 'class'=>AccessControl::className(),
            //     // 'rules'=>[
            //     //     [
            //     //         'actions'=> ['index'],
            //     //         'allow'=> true,
            //     //         'roles'=> ['?'] //未认证用户
            //     //     ],
            //     //     [
            //     //         'actions'=>['index','view','create','update','delete'],
            //     //         'allow'=> true,
            //     //         'roles'=>['@']//认证用户
            //     //     ],
            //         //特殊事例：只能在10月31号当天访问
            //         // [
            //         //     'actions'=>['special-callback'],
            //         //     'allow'=> true,
            //         //     'matchCallback'=>function($rule,$action)
            //         //     {
            //         //         return date('d-m'==='31-10');
            //         //     }
            //         // ]
                    
            //     ],
           // ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // $posts=Yii::$app->db->createCommand('select * from post 
        //         where id=:id and status=:status')
        //         ->bindValue(':id',$id)
        //         ->bindValue(':status',1)
        //         ->queryOne();
        // var_dump($posts);
        // exit(0);
        // $post=Post::find()->where(['id'=>32])->one();
        // var_dump($post);
        // exit(0);
        // $posts=Post::find()->where(['status'=>2])->all();
        // var_dump($posts);
        // exit(0);
        //  $post=Post::findAll(['status'=>2]);
        //  var_dump($post);
        //  exit(0);
        // $post=Post::find()->where(['AND',['status'=>2],['author_id'=>1],['like','title','yii2']])
        //     ->orderBy('id')->all();
        // var_dump($post);
        // exit(0);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // if(!Yii::$app->user->can('createPost'))
        // {
        //     throw new ForbiddenHttpException('对不起，你没有进行该操作的权限');
        // }

        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
