<?php


namespace app\core;


class FormFieldHtml
{
    private string $id;
    private string $name;
    private string $class;
    private string $labelName;
    private array $param;
    private string $type = 'text';
    private string $require;

    public function __construct(string $id, string $name, string $class, string $labelName, string $type = 'text', string $require, array $param = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
        $this->labelName = $labelName;
        $this->param = $param;
        $this->type = $type;
        $this->require = $require;
    }

    public function __toString(): string
    {
        $validClass = !empty($this->param['errors'][$this->name . "Err"]) ? "is-invalid" : '';
        $invalidFeedbackText = $this->param['errors'][$this->name . "Err"];
        $requireStar = !empty($this->require) ? '*' : '';
        return <<<STRING
        <div class="form-group">
            <label for="$this->id">$this->labelName:<sup>$requireStar</sup></label>
            <input type="$this->type" name="$this->name" id="$this->id" class="$validClass form-control form-control-lg" value="{$this->param['name']}">
            <span class='invalid-feedback'>$invalidFeedbackText</span>
        </div>
STRING;
    }


}