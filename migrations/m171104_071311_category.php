<?php

use yii\db\Migration;

/**
 * Class m171104_071311_category
 */
class m171104_071311_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('category',[
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);
        $this->insert('category',[
            'name' => 'Бензин',
        ]);
        $this->insert('category',[
            'name' => 'Дизельное топливо',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('category',['id' => 1]);
        $this->delete('category',['id' => 2]);
        $this->dropTable('category');
    }

}
