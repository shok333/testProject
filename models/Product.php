<?php

namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'category_id']);
    }
    public function getArrayOfProducts($lastId){
        if(!$lastId){
            $lastId=0;
        }

        $products=Product::find()->joinWith('category')->where('product.id > :lastId', [':lastId' => $lastId])
            ->orderBy('id')->limit(10)->all();

        $total=[];
        foreach($products as $i=>$item){
            $total[$i]=[name=>$item->name,category=>$item->category->name, price=> $item->price,id=>$item->id];
        }
        return $total;
    }
}