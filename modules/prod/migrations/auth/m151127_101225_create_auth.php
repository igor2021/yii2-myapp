<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\web\ConflictHttpException;
use common\models\User;

class m151127_101225_create_auth extends Migration
{
    public function up()
    {
		$rbac = \Yii::$app->authManager;
		
 		$role['guest'] = $rbac->createRole('guest');
 		$rbac->add($role['guest']);
		
 		$role['user'] = $rbac->createRole('user');
 		$rbac->add($role['user']);

 		$role['manager'] = $rbac->createRole('manager');
 		$rbac->add($role['manager']);

 		$role['admin'] = $rbac->createRole('admin');
 		$rbac->add($role['admin']);

 		$rbac->addChild($role['admin'], $role['manager']);
 		$rbac->addChild($role['manager'], $role['user']);
 		$rbac->addChild($role['user'], $role['guest']);
		
        do {
            $transaction = Yii::$app->db->beginTransaction();
            
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@localhost.localdomain';
            $user->setPassword('123456');
            $user->generateAuthKey();
            if ($user->save()) {
                $rbac->assign($role['admin'], $user->id);
            } else {
                throw new ConflictHttpException;
            }
            
            $transaction->commit();
        } while(0);
        
        do {
            $transaction = Yii::$app->db->beginTransaction();
        
            $user = new User();
            $user->username = 'manager';
            $user->email = 'manager@localhost.localdomain';
            $user->setPassword('123456');
            $user->generateAuthKey();
            if ($user->save()) {
                $rbac->assign($role['manager'], $user->id);
            } else {
                throw new ConflictHttpException;
            }
        
            $transaction->commit();
        } while(0);		
    }

    public function down()
    {
        echo "m151127_101225_create_auth_roles cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
