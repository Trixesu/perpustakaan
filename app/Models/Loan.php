<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['book_id', 'member_id', 'loan_date', 'due_date', 'return_date', 'status'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }
}
