<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Класс отвечает за поведение загрузки файла через контроллер в модели File
 *
 * @author v.raskin
 */
class FileUploadCControllerBehavior extends CBehavior {
     
    
    /**
     * Выдает файл на скачивание
     * @param type $id  ID File
     */
    public function fileUpload($id) {
        $file = File::model()->findByPk($id);
        if(is_null($file) || !$file->fileExists('Path')) {
            throw new CHttpException(404, "Файл не существует");
        }
     
        $data = pathinfo($file->Path);
		
		if(in_array(strtolower($data['extension']), explode(', ', Yii::app()->params['extensions']['images']))) {
            header("Content-type: image/{$data['extension']}");
            echo file_get_contents($file->Path);
        } else {
           header("Content-disposition: attachment; filename=document.{$data['extension']}"); 
           header("Content-type: application/{$data['extension']}"); 
           readfile($file->Path);
        }
		
        Yii::app()->end();
    }
    
    
    /**
     * Пытается загрузить файл из параметров File и привязывает его к модели
     * @param CActiveRecord $model модель к которой будет привязан файл
     * @param string $field поле модели куда будет сохранен идентификатор файла
     * @return boolean 
     */
    public function tryLoadFile(CActiveRecord $model, $field) {
        if(isset($_POST['File'])) {
            $file = new File();
            $file->attributes = $_POST['File'];
            if(isset($_POST['File']['FileID']) && $_POST['File']['FileID'] > 0) {
                $file->setPrimaryKey($_POST['File']['FileID']);
                $file->setIsNewRecord(false);
            }
            if($file->validate() && $file->save()) {
                $model->{$field} = $file->getPrimaryKey();
                $model->setScenario('edit');
                return $model->save(TRUE, $model->getAttributesByValidate($field));
            } 
        }
        return false;
    }
}

 
