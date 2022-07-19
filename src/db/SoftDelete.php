<?php

namespace Kirill\Edu\db;

trait SoftDelete
{

    /**
     * Soft delete method.
     * 
     * Soft delete method replaces the hard one in the parent class.
     * 
     * @param string $table Table name.
     * @param string $where Where condition.
     */
    public static function delete($table, $where)
    {
        parent::$conn->query("UPDATE $table SET deleted_at = now() WHERE $where");
    }
    
}

?>