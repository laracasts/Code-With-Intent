<?php namespace Acme\Services\Validation;

class UserValidator extends Validator {

    /**
     * Default rules
     *
     * @var array
     */
    protected $rules = [
        'email' => 'required|email',
        'role_id' => 'required|integer'
    ];

    /**
     * Rules for updating a user
     *
     * @var array
     */
    protected $updateRules = [
        'email' => 'required|email',
        'password' => 'confirmed'
    ];
}
