<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

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
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionProductList(){

        $product=new Product();
        $category=new Category();
        $total=$product->getArrayOfProducts($_GET['lastId']);
        if(!$_GET['lastId']){
            return $this->render('productList',[products=>$total,'categories'=>$category->find()->asArray()->all()]);
        }
        else{
            return json_encode($total);
        }
    }
    public function actionAddProduct(){
        $product=new Product();
        $category=new Category();
        if($_POST['category']){
            $values=[
                'name' => $_POST['name'],
                'category_id'=>$category->addElement($_POST['category']),
                'price' => $_POST['price'],
            ];
            return $product->addElement($values);
        }
        return $this->render('addProduct');
    }

}
