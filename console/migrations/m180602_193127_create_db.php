<?php

use yii\db\Migration;

/**
 * Class m180602_193127_create_db
 */
class m180602_193127_create_db extends Migration
{
//    /**
//     * {@inheritdoc}
//     */
//    public function safeUp()
//    {

//    }

//    /**
//     * {@inheritdoc}
//     */
//    public function safeDown()
//    {
//        echo "m180602_193127_create_db cannot be reverted.\n";

//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB';


        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'body' => $this->text()->notNull(),
            'category_id' => $this->integer(11)->defaultValue(1),
            'status' => $this->smallInteger(1)->notNull(),
            'created_by' => $this->integer(11)->notNull(),
            'updated_by' => $this->integer(11)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'deleted_at' => $this->dateTime()->null(),
        ], $tableOptions);

        $this->addColumn('user','admin',$this->tinyInteger(1)->defaultValue(0));

    }

    public function down()
    {
        $this->dropTable('article');
        $this->dropColumn('user','admin');
        return true;
    }

}
