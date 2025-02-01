<?php
namespace App\Models;

use App\Core\Database\QueryBuilder;


class User extends QueryBuilder
{
  protected $tableName = 'users';
  
}