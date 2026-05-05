<?php
class Staff extends BaseModel
{
    protected string $table    = 'staff';
    protected array  $fillable = ['name','university','experience'];
}
