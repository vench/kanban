<?php

class BoxButton extends CWidget {

	public $createButtonLabel;
	
	public $createButtonImageUrl;
	
	public $createButtonUrl='Yii::app()->controller->createUrl("create",array("id"=>$data->primaryKey))';
	
	public $createButtonOptions=array('class'=>'create');
	
	public $emailButtonLabel;
	
	public $emailButtonImageUrl;
	
	public $emailButtonUrl='Yii::app()->controller->createUrl("email",array("id"=>$data->primaryKey))';
	
	public $emailButtonOptions=array('class'=>'email');

	public $viewButtonLabel;
	/**
	 * @var string the image URL for the view button. If not set, an integrated image will be used.
	 * You may set this property to be false to render a text link instead.
	 */
	public $viewButtonImageUrl;
	/**
	 * @var string a PHP expression that is evaluated for every view button and whose result is used
	 * as the URL for the view button. In this expression, you can use the following variables:
	 * <ul>
	 *   <li><code>$row</code> the row number (zero-based)</li>
	 *   <li><code>$data</code> the data model for the row</li>
	 *   <li><code>$this</code> the column object</li>
	 * </ul>
	 * The PHP expression will be evaluated using {@link evaluateExpression}.
	 *
	 * A PHP expression can be any PHP code that has a value. To learn more about what an expression is,
	 * please refer to the {@link http://www.php.net/manual/en/language.expressions.php php manual}.
	 */
	public $viewButtonUrl='Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))';
	/**
	 * @var array the HTML options for the view button tag.
	 */
	public $viewButtonOptions=array('class'=>'view');

	/**
	 * @var string the label for the update button. Defaults to "Update".
	 * Note that the label will not be HTML-encoded when rendering.
	 */
	public $updateButtonLabel;
	/**
	 * @var string the image URL for the update button. If not set, an integrated image will be used.
	 * You may set this property to be false to render a text link instead.
	 */
	public $updateButtonImageUrl;
	/**
	 * @var string a PHP expression that is evaluated for every update button and whose result is used
	 * as the URL for the update button. In this expression, you can use the following variables:
	 * <ul>
	 *   <li><code>$row</code> the row number (zero-based)</li>
	 *   <li><code>$data</code> the data model for the row</li>
	 *   <li><code>$this</code> the column object</li>
	 * </ul>
	 * The PHP expression will be evaluated using {@link evaluateExpression}.
	 *
	 * A PHP expression can be any PHP code that has a value. To learn more about what an expression is,
	 * please refer to the {@link http://www.php.net/manual/en/language.expressions.php php manual}.
	 */
	public $updateButtonUrl='Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))';
	/**
	 * @var array the HTML options for the update button tag.
	 */
	public $updateButtonOptions=array('class'=>'update');

	/**
	 * @var string the label for the delete button. Defaults to "Delete".
	 * Note that the label will not be HTML-encoded when rendering.
	 */
	public $deleteButtonLabel;
	/**
	 * @var string the image URL for the delete button. If not set, an integrated image will be used.
	 * You may set this property to be false to render a text link instead.
	 */
	public $deleteButtonImageUrl;
	/**
	 * @var string a PHP expression that is evaluated for every delete button and whose result is used
	 * as the URL for the delete button. In this expression, you can use the following variables:
	 * <ul>
	 *   <li><code>$row</code> the row number (zero-based)</li>
	 *   <li><code>$data</code> the data model for the row</li>
	 *   <li><code>$this</code> the column object</li>
	 * </ul>
	 * The PHP expression will be evaluated using {@link evaluateExpression}.
	 *
	 * A PHP expression can be any PHP code that has a value. To learn more about what an expression is,
	 * please refer to the {@link http://www.php.net/manual/en/language.expressions.php php manual}.
	 */
	public $deleteButtonUrl='Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))';
	/**
	 * @var array the HTML options for the delete button tag.
	 */
	public $deleteButtonOptions=array('class'=>'delete');
	/**
	 * @var string the confirmation message to be displayed when delete button is clicked.
	 * By setting this property to be false, no confirmation message will be displayed.
	 * This property is used only if <code>$this->buttons['delete']['click']</code> is not set.
	 */
	public $deleteConfirmation;
	
	/**
	* boolean
	*/
	public $viewButtonVisible = true;
	
	/**
	* boolean
	*/
	public $deleteButtonVisible = true;
	
	/**
	* boolean
	*/
	public $updateButtonVisible = true;
	/**
	* boolean
	*/
	public $createButtonVisible = true;
	
	/**
	* boolean
	*/
	public $emailButtonVisible = false;
	
	public function run() {
		if($this->createButtonVisible) {
			 if(!isset($this->createButtonOptions['title'])) 
					$this->createButtonOptions['title'] = $this->createButtonLabel;
			echo  CHtml::link(CHtml::image($this->createButtonImageUrl, $this->createButtonLabel),$this->createButtonUrl,$this->createButtonOptions);		 
		}
	
		if($this->viewButtonVisible){
			if(!isset($this->viewButtonOptions['title'])) 
				$this->viewButtonOptions['title'] = $this->viewButtonLabel;
			echo  CHtml::link(CHtml::image($this->viewButtonImageUrl, $this->viewButtonLabel),$this->viewButtonUrl,$this->viewButtonOptions);
		}
		
		if($this->updateButtonVisible) {
			if(!isset($this->updateButtonOptions['title'])) 
				$this->updateButtonOptions['title'] = $this->updateButtonLabel;
			echo  CHtml::link(CHtml::image($this->updateButtonImageUrl, $this->updateButtonLabel),$this->updateButtonUrl,$this->updateButtonOptions);
		}
		
		if($this->deleteButtonVisible) {
			if($this->deleteConfirmation) {
				$this->deleteButtonOptions['onclick'] = 'return confirm("'.$this->deleteConfirmation.'");';
			}
			if(!isset($this->deleteButtonOptions['title'])) 
				$this->deleteButtonOptions['title'] = $this->deleteButtonLabel;
			echo  CHtml::link(CHtml::image($this->deleteButtonImageUrl, $this->deleteButtonLabel),$this->deleteButtonUrl,$this->deleteButtonOptions);
		}
		if($this->emailButtonVisible) {  
			 if(!isset($this->emailButtonOptions['title'])) 
					$this->emailButtonOptions['title'] = $this->emailButtonLabel;
			echo  CHtml::link(CHtml::image($this->emailButtonImageUrl, $this->emailButtonLabel),$this->emailButtonUrl,$this->emailButtonOptions);		 
		}
	}

	public function init() {
		$this->registerClientScript();
	}
	
	protected function registerClientScript() {
		$baseScriptUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.widgets.assets')).'/boxbutton';
		if($this->viewButtonLabel===null)
			$this->viewButtonLabel=Yii::t('zii','View');
		if($this->updateButtonLabel===null)
			$this->updateButtonLabel=Yii::t('zii','Update');
		if($this->deleteButtonLabel===null)
			$this->deleteButtonLabel=Yii::t('zii','Delete');
		if($this->createButtonLabel===null)
			$this->createButtonLabel=Yii::t('zii','Create');
		if($this->viewButtonImageUrl===null)
			$this->viewButtonImageUrl=$baseScriptUrl.'/view.png';
		if($this->updateButtonImageUrl===null)
			$this->updateButtonImageUrl=$baseScriptUrl.'/update.png';
		if($this->deleteButtonImageUrl===null)
			$this->deleteButtonImageUrl=$baseScriptUrl.'/delete.png';
		if($this->deleteConfirmation===null)
			$this->deleteConfirmation=Yii::t('zii','Are you sure you want to delete this item?');
		if($this->createButtonImageUrl===null)
			$this->createButtonImageUrl=$baseScriptUrl.'/add.png';
		if($this->emailButtonImageUrl===null)
			$this->emailButtonImageUrl=$baseScriptUrl.'/mail.png';
			
		$cssFile=$baseScriptUrl.'/styles.css';
			Yii::app()->getClientScript()->registerCssFile($cssFile);
	}
	
}