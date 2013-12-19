<?php

class BaseModel extends Eloquent {

    /**
     * When updating a user, run the attributes
     * through a validator first.
     *
     * We could also use observers for this
     * sort of thing. However, this has a couple advantages.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function update(array $attributes = [])
    {
        // Here, we determine the validator path dynamically.
        // Alternative, you can set a validator prop on your model
        // and remove this portion. Either works.
        $class = get_class($this);
        $path = "Acme\\Services\\Validation\\{$class}Validator";

        if (class_exists($path))
        {
            App::make($path)->validateForUpdate($attributes);
        }

        parent::update($attributes);
    }

}

