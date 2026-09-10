<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users_tbl';
    protected $primaryKey = 'u_empno'; // Change if your primary key is different
    protected $allowedFields = ['u_email', 'u_password', 'u_empno']; // Add other database columns you want to allow for mass assignment
    // Add other database columns you might need to insert/update later
}
