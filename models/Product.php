<?php

namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name', 'category_id', 'price'],
        ];
    }
    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'category_id']);
    }
    public function getArrayOfProducts($lastId){
        if(!$lastId){
            $lastId=0;
        }

        $products=Product::find()->joinWith('category')->where('product.id > :lastId', [':lastId' => $lastId])
            ->orderBy('id')->limit(20)->all();

        $total=[];
        foreach($products as $i=>$item){
            $total[$i]=[name=>$item->name,category=>$item->category->name, price=> $item->price,id=>$item->id];
        }
        return $total;
    }
    public function addElement($values){
        $this->attributes=$values;
        $this->save();
        return $this->id;
    }
}