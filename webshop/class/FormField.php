<?php

/**
 * Created by PhpStorm.
 * User: sjon
 * Date: 19-4-17
 * Time: 14:17
 */
class FormField
{
    private $type;
    private $name;
    private $placeholder;
    private $value;
    private $required;

    public function __construct($name, $type = "text", $placeholder = "", $value = "")
    {
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }


    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }


    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function required()
    {
        $this->required = true;
        return $this;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getHTML(){
        if($this->type == "checkbox"){
            $html = $this->placeholder . "<";
        }
        else {
            $html = "<";
        }
        switch ($this->type){
            case "textarea":
                $html .= $this->type . " ";
                break;
            default:
                $html .= "input type='$this->type' ";
                break;
        }

        $html .= "name='$this->name' ";
        $html .= "placeholder='$this->placeholder' ";

        if($this->value) $html .= "value='$this->value' ";
        if($this->required) $html .= "required ";
        switch ($this->type){
            case "textarea":
                $html .= "></" . $this->type;
                break;
            default:
                break;
        }

        $html .= ">";
        if($this->type != "hidden") $html .= "<br>";
        return $html;
    }
}