<?php

/**
 * Created by PhpStorm.
 * User: sjon
 * Date: 19-4-17
 * Time: 14:14
 */
class Form
{
    private $fields = [];
    private $action;
    private $method;

    public function __construct($action = null, $method = "POST")
    {
        $this->action = $action;
        $this->method = $method;
    }

    public function addField($field){
        array_push($this->fields, $field);
    }

    public function getHTML(){
        $html = "<form method='$this->method'";
        if($this->action) $html .= " action='$this->action'";
        $html .= ">";

        foreach ($this->fields as $field){
            $html .= $field->getHTML();
        }

        $html .= "<input type='submit' value='save'>";

        $html .= "</form>";
        return $html;
    }
}