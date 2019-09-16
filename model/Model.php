<?php

namespace JBlog\Model;

class Model
{
    //目前只有integer :)
    //b: bool
    //i: int
    //d: double
    public function setType(string $types)
    {
        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties();

        $count = count($props);
        if ($count !== strlen($types)) {
            return;
        }

        for ($i = 0; $i < count($props); $i++) {
            $value = $props[$i]->getValue($this);
            switch ($types[$i]) {
                case "b":
                    $props[$i]->setValue($this, (bool) $value);
                    break;
                case "i":
                    $props[$i]->setValue($this, (int) $value);
                    break;
                case "d":
                    $props[$i]->setValue($this, (float) $value);
                    break;
            }
        }
    }
}
