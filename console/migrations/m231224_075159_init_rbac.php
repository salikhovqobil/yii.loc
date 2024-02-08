<?php

use yii\db\Migration;

/**
 * Class m231224_075159_init_rbac
 */
class m231224_075159_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $createCustomer = $auth->createPermission('createCustomer');
        $createCustomer->description = 'Create new customer';
        $auth->add($createCustomer);

        $updateCustomer = $auth->createPermission('updateCustomer');
        $updateCustomer->description = ' Update customer';
        $auth->add($updateCustomer);

        $deleteCustomer = $auth->createPermission('deleteCustomer');
        $deleteCustomer->description = 'Delete customer';
        $auth->add($deleteCustomer);

        $listCustomer = $auth->createPermission('listCustomer');
        $listCustomer->description = 'List customer';
        $auth->add($listCustomer);

        $viewCustomer = $auth->createPermission('viewCustomer');
        $viewCustomer->description = 'View customer';
        $auth->add($viewCustomer);

        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);

        $auth->addChild($moderator, $viewCustomer);
        $auth->addChild($moderator, $listCustomer);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($admin, $createCustomer);
        $auth->addChild($admin, $updateCustomer);
        $auth->addChild($admin, $deleteCustomer);
        $auth->addChild($admin, $viewCustomer);
        $auth->addChild($admin, $listCustomer);

        $auth->assign($admin, 1);
        $auth->assign($moderator, 3);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231224_075159_init_rbac cannot be reverted.\n";

        return false;
    }
}
