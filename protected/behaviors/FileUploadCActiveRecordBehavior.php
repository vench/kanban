<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Данный класс задает поведение для загрузки файлов в определенные поля
 *
 * @author v.raskin
 */
class FileUploadCActiveRecordBehavior extends CActiveRecordBehavior {
    
    /**
     * Список полей модели в которые будут сохранятся пути к файлам на диске.
     * @var array 
     */
    public $fileFields = array();
    
    /** 
     * Список полей имен для файла которые нужно установить в модель из файла в случаи если имя не задоно
     * @var array 
     */
    public $fileNameAs = array();
    
    /**
     * Максимальный размер файла (в мегабайтах)
     * @var int 
     */
    public $maxSizeFile = 4;
    
    /**
     * Список допустимых расширений файла
     * @var array 
     */
    public $extensions = array();
    
    
    /**
     * Список замененных файлов которе быдут удалены после сохранения
     * @var array 
     */
    private $oldPaths = array();
    
    /** 
     * Коллекция загружаемых файлов CUploadedFile
     * @var array 
     */
    private $uploadedFiles = array();
    
    
    public function beforeValidate($event) {
         foreach($this->fileFields as $field) {
             $uploadedFile = CUploadedFile::getInstance($this->owner, $field); 
             if(!is_null($uploadedFile)) { 
                 
                 if($uploadedFile->getHasError()) { 
                     
                     $text = $uploadedFile->getError(); 
                     switch($uploadedFile->getError()) {
                         case UPLOAD_ERR_INI_SIZE: $text = 'UPLOAD_ERR_INI_SIZE: '.  ini_get('upload_max_filesize');
                     }
                     $this->owner->addError($field, $text);
                     return;
                 }
                  
                 if($uploadedFile->size > (1024 * 1024 * $this->maxSizeFile)) {
                     $this->owner->addError($field, 'Загружаемый файл больше допустимого размера {'.$this->maxSizeFile.' mb}');
                     return;
                 }
                 if(sizeof($this->extensions) > 0 && !in_array(strtolower($uploadedFile->extensionName), array_map('strtolower',$this->extensions))) {
                     $this->owner->addError($field, 'Загружаемый файл не соответствует допустимым форматам {'.join(', ', $this->extensions).' }');
                     return;
                 }
                 
                 $this->oldPaths[$field] =  $this->owner->{$field}; 
                 
                 $this->owner->{$field} = Yii::getPathOfAlias('webroot.uploads').DIRECTORY_SEPARATOR.$this->getRandomText(2); 
                 $this->owner->{$field} .= DIRECTORY_SEPARATOR.$this->getRandomText(12).'.'.$uploadedFile->extensionName;
                 
                 if(isset($this->fileNameAs[$field]) && empty($this->owner->{$this->fileNameAs[$field]})) {
                     $this->owner->{$this->fileNameAs[$field]} = $uploadedFile->name;
                 }
                 $this->uploadedFiles[$field] = $uploadedFile;
             }
            // var_dump($uploadedFile);   print_r($_FILES);  exit();
         }
    }
    
     
    
    public function afterSave($event) {
        foreach($this->fileFields as $field) {
            $uploadedFile = isset($this->uploadedFiles[$field]) ? $this->uploadedFiles[$field] : NULL;
            if(!is_null($uploadedFile)) {
                $dir = dirname($this->owner->{$field});
                if(!is_dir($dir)) {
                    mkdir($dir, 0777);
                }
                $uploadedFile->saveAs($this->owner->{$field}); 
            }
            if(isset($this->oldPaths[$field])) {
                $this->removeFile($this->oldPaths[$field]);
            }
        }
         
    }
    
    protected function afterDelete($event) {
        foreach($this->fileFields as $field) {
            $this->removeFile($this->owner->{$field});
        }
    }
    
    protected function removeFile($path) { 
        if(file_exists($path)) {
            unlink($path);
        }
    }
    
    /**
     * Проверить файл на существование.
     * @param string $field
     * @return boolean 
     */
    public function fileExists($field) {
        return isset($this->owner->{$field}) && file_exists($this->owner->{$field});
    }
	
	/**
	* @param int $size
	* @param string $hash
	* @return string
	*/
	protected function getRandomText($size, $hash = NULL) {
        if(is_null($hash)) {
                $hash = join('',range('a', 'b')).join('',range('1', '9'));
            }
            $str = '';  
            while($size -- > 0) { 
			$str .= substr($hash, mt_rand(1, strlen($hash) -1), 1);			
	    }
        return $str;
	}
}

 
