<?php

 

/**
 * Description of CHandlerEvent
 *
 * @author vench
 */
class CHandlerEvent extends CComponent {
       /**
         * 
         * @param type $constEvent
         * @param type $dataContext
         */
       public function handlerEvent($constEvent, $dataContext = NULL) { 
            switch($constEvent){
                case GModule::BEFORE_RENDER_MAIN_MENU: 
                    call_user_func_array(array($this, 'beforeRenderMainMenu'), $dataContext); 
                    break; 
                case KModule::AFTER_TASK_SEND_EMAIL:
                    call_user_func_array(array($this, 'afterTaskSendEmail'), $dataContext);
                    break;  
                case KModule::AFTER_TASK_ADD_COMMENT:
                    call_user_func_array(array($this, 'afterTaskAddComment'), $dataContext);
                    break;  
            }
        }
        
        /**
         * 
         * @param TaskComment $taskComment
         * @param Task $task
         * @param type $user_id
         * @param Project $project
         */
       protected function  afterTaskAddComment(TaskComment $taskComment, Task $task, $user_id, Project $project) {
            $notification = new Notification();  
            $notification->uto = $user_id;
            $notification->timecreate = time();
            $notification->message = $taskComment->comment.'<hr>'.CHtml::link($task->getShortName(), array('/task/view', 'id'=>$task->id));
            $notification->is_new = 1;
            $notification->save(); 
       }
        
       /**
        * 
        * @param type $users
        * @param Task $task
        * @param Project $project
        */
       protected function  afterTaskSendEmail($users, Task $task, Project $project) {
             foreach($users as $user) {
                 $notification = new Notification();  
                 $notification->uto = $user->id;
                 $notification->timecreate = time();
                 $notification->message = Yii::t('UserSettingsModule.main','To your email zob, the message was sent to change jobs: {taskname}.', array(
                     '{taskname}'=>CHtml::link($task->getShortName(), Yii::app()->createAbsoluteUrl('/task/view',  array( 'id'=>$task->getPrimaryKey(), ))),
                 ));
                 $notification->is_new = 1;
                 $notification->save();
             }   
                
             
       }
        
       protected function beforeRenderMainMenu($menu, $controller) {
            if(!Yii::app()->user->isGuest) {
                $controller->mainMenu[] = array(
                    'label'=>Yii::t('UserSettingsModule.main','User settings'), 
                    'url'=>array('/userSettings'),
                    'itemOptions'=>array('style'=>'float:right',)
                ); 
            }
       }
}
