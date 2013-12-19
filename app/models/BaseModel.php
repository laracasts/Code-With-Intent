<?php

class BaseModel extends Eloquent {

    /**
     * @var string
     */
    protected $class;
    
    /**
     * @var string
     */
    protected $path;
    
    /**
     * @var string
     */
    protected $validator;

    /**
     * @param array $attributes
     */
    public function  __construct(array $attributes = [])
    {
        $this->class = get_class($this);
        $this->path = "Acme\\Services\\Validation\\{$this->class}Validator";
        
        if(class_exists($this->path))
            $this->validator = App::make($this->path);

        parent::__construct();
    }

    /**
     * When creating, run the attributes
     * through a validator first.
     *
     * We could also use observers for this
     * sort of thing. However, this has a couple advantages.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function save(array $attributes = [])
    {
        $this->validator->validateForCreation($attributes);

        parent::create($attributes);
    }

    /**
     * When updating, run the attributes
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
        $this->validator->validateForUpdate($attributes);
        
        parent::update($attributes);
    }
}

