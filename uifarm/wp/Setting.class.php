<?php

namespace uifarm\wp;
	
class Setting {

	private $section;
	private $settingLabel;
	private $settingFieldName;
	private $inputSize;
	private $inputPrependText;

	function __construct($section, $settingLabel, $settingFieldName) {
        $this->section = $section;
        $this->settingLabel = $settingLabel;
        $this->settingFieldName = $settingFieldName;
    }

    public function getSection() {
        return $this->section;
    }

    public function setSection($section='general') { 
        $this->section = $section; 
    } 

    public function getSettingLabel() {
        return $this->settingLabel;
    }

    public function setSettingLabel($settingLabel=null) { 
        $this->settingLabel = $settingLabel; 
    } 

    public function getSettingFieldName() {
        return $this->settingFieldName;
    }

    public function setSettingFieldName($settingFieldName=null) { 
        $this->settingFieldName = $settingFieldName; 
    } 

    public function getInputSize() {
        return $this->inputSize;
    }

    public function setInputSize($inputSize='100') { 
        $this->inputSize = $inputSize; 
    } 

    public function getInputPrependText() {
        return $this->inputPrependText;
    }

    public function setInputPrependText($inputPrependText=null) { 
        $this->inputPrependText = $inputPrependText; 
    } 

    public function registerSetting( ) {
    	add_filter( 'admin_init' , array( &$this , 'registerFields' ) );
    }
    
    public function registerFields() {
    	register_setting( $this->getSection(), $this->getSettingFieldName(), 'esc_attr' );
        add_settings_field($this->getSettingFieldName(), '<label for="' . $this->getSettingFieldName() . '">'.__($this->getSettingLabel() , $this->getSettingFieldName() ).'</label>' , array(&$this, 'fieldsHtml') , $this->getSection() );
    }
        
    public function fieldsHtml() {
    	$value = get_option( $this->getSettingFieldName(), '' );
        echo $this->getInputPrependText() . '&nbsp;<input type="text" id="' . $this->getSettingFieldName() .'" name="' . $this->getSettingFieldName() . '" value="' . $value . '" size="' . $this->getInputSize() .'" />';
    }

    public function create() {
    	$this->registerSetting();
    }

}

?>