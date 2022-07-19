<?php

namespace Kirill\Edu\db;


use Kirill\Edu\debug\Debug;

/**
 * Model User.
 *
 * @author nilixin <nilixen@yandex.ru>
 * @version 1.0
 */
class User extends Model
{
    public $id;
    public $login;
    public $email;
    public $password;

    /**
     * @return string
     */
    public function table(): string
    {
        return 'user';
    }

    public function fields(): array
    {
        return [
            'login', 'email', 'password'
        ];
    }

    public function construct($login, $email, $password)
    {
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
    }

    public function constructWithId($id, $login, $email, $password): User
    {
        $new_user = new User($login, $email, $password);
        $new_user->id = $id;
        return $new_user;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * Checks if all of the properties are present and are full.
     * If they are, then returns true.
     */
    private function isFilled()
    {
        if ($this->login === null || trim($this->login) === '') {
            return false;
        }
        if ($this->email === null || trim($this->email) === '') {
            return false;
        }
        if ($this->password === null || trim($this->password) === '') {
            return false;
        }

        return true;
    }

    /**
     * Returns the object of the class that satisfies the set where condition.
     *
     * @param string $where Where condition.
     * @return User Instance of the class User.
     */
    public function get($where)
    {
        $table = $this->table();
        $res = Db::sql("SELECT * FROM $table WHERE $where")->one();
        $this->{$this->key()} = $res->{$this->key()};
        foreach ($this->fields() as $field) {
            $this->{$field} = $res->{$field};
        }

        if ($this->isFilled()) {
            return $this;
        }
    }

    /**
     * Adds user if the properties are present and filled.
     */
    public function add()
    {
        if ($this->isFilled()) {
            Db::insert("user", "login, email, password", "'$this->login', '$this->email', '$this->password'");
        }
    }

    /**
     * Edits user if the properties are present and filled.
     */
    public function edit()
    {
        if ($this->isFilled()) {
            Db::update("user", ["login" => "'$this->login'", "email" => "'$this->email'", "password" => "'$this->password'"], "id = $this->id");
        }
    }

}
