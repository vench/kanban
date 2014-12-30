<?php

 

/**
 * Description of MoneyModuleHandler
 *
 * @author vench
 */
class MoneyModuleHandler {
    
    public static function handler($constEvent, $dataContext = NULL) {
        $handler = new MoneyModuleHandler();
        if($constEvent == KModule::BEFORE_TASK_CONTENT) {
            $handler->beforeTaskContent($dataContext);
        }
    }
    
    /**
     * 
     * @param type $dataContext
     */
    protected function beforeTaskContent($dataContext) {
        extract($dataContext);
        $money = new Money('search');
        $money->task_id = $task->getPrimaryKey();
        $controller->tabs[$money->getHash()] = array(
                'title'=>Yii::t('MoneyModule.main', 'Money'),
                'view'=>'money.views._task_tab',
                'data'=>array('task'=>$task, 'money'=>$money,), 
        );
    }
}
