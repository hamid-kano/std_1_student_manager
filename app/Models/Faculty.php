<?php
class Faculty extends BaseModel
{
    protected string $table    = 'faculties';
    protected array  $fillable = ['name','dean'];
}
