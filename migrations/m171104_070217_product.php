<?php

use yii\db\Migration;

/**
 * Class m171104_070217_product
 */
class m171104_070217_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('product',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
            'price' => $this->double()
        ]);
        $this->insert('product',[
            'name' => 'АИ-92',
            'category_id' => 1,
            'price' => 34.90
        ]);
        $this->insert('product',[
            'name' => 'АИ-95',
            'category_id' => 1,
            'price' => 36.40
        ]);
        $this->insert('product',[
            'name' => 'АИ-98',
            'category_id' => 1,
            'price' => 38.50
        ]);
        $this->insert('product',[
            'name' => 'ДТ Евро-5',
            'category_id' => 2,
            'price' => 34.50
        ]);
        $this->insert('product',[
            'name' => 'ДТ Евро-5 Зима',
            'category_id' => 2,
            'price' => 36.50
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('product',['id' => 1]);
        $this->delete('product',['id' => 2]);
        $this->delete('product',['id' => 3]);
        $this->delete('product',['id' => 4]);
        $this->delete('product',['id' => 5]);
        $this->dropTable('product');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171104_070217_product cannot be reverted.\n";

        return false;
    }
    */
}
