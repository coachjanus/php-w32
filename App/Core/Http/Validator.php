<?php
namespace App\Core;

class Validator
{
    protected $rules = [];
    protected $isError = false;

    public function __construct(protected array $data = [])
    {
        $this->data = $data;
        
    }

    public function addRule(Rule $rule)
    {
        $this->rules[$rule->getFieldName()] = $rule;
    }

    public function check()
    {
        foreach ($this->data as $field => $value) {
            if($this->rules[$field]->validate($value) === false) {
                $this->isError = true;
            }
        }
        return !$this->isError;
    }

    public function getErrors($key=null)
    {
        if(!$this->isError) {
            return [];
        }
        $errors = [];
        $keys = [$key];

        if(is_null($key)) {
            $keys = array_keys(($this->rules));
        }

        foreach ($keys as $key) {
            $rule = $this->rules[$key];

            foreach ($rule->getConstraints() as $constraint) {
                if($constraint->hasError()) {
                    $errors[$key][strtolower($this->get_class_name(get_class($constraint)))] = $constraint->getError();
                }
            }

        }
        return $errors;
    }

    public function firstError($key)
    {
        $errors = $this->getErrors($key);
        
        $arr = array_values($errors);
        // var_dump(array_values($arr[0])[0]);
        // exit();
        return array_values($arr[0])[0];
    }
    private function get_class_name($constraint)
    {
        if ($pos = strpos($constraint, '\\')) {
            return substr($constraint, $pos + 1);
        }
        return $pos;
    }
}