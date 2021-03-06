<?php
/**
 * Created by PhpStorm.
 * User: Dmirtiy
 * Date: 04.11.2017
 * Time: 10:38
 */

namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public function getProducts(){
        return $this->hasMany(Product::className(),['category_id' => 'id']);
    }
    public function addElement($name){
        $category=$this->find()->where(['name' => $name])->one();
        if(!$category){
            $this->name=$name;
            $this->save();
            return $this->id;
        }
        return $category->id;
    }
}