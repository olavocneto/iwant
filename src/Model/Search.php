<?php

namespace Core\Model;

use Illuminate\Database\Eloquent;

/**
 * Description of Search
 *
 * @author Olavo Neto <olavocn.neto@gmail.com>
 */
class Search extends Eloquent
{
    protected $table = '';

    protected $fillable = [
        'user_id',
        'string',
        'told'
    ];

    protected $guarded = [
        'id'
    ];

    public function scopeNotReported($query) {
        return $query->where('told', 0);
    }
}
