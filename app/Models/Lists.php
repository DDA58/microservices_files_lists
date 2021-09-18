<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property int file_id
 * @property string filename
 * @property string link
 * @property string creator_email
 * @property int creator_id
 * @property int download_count
 *
 * @method Builder filter
 */
class Lists extends Model
{
    use Filterable;

    public $table = 'lists';

    protected $primaryKey = 'file_id';

    public $incrementing = false;

    protected $hidden = [
        'file_id',
        'creator_id',
        'created_at',
        'updated_at'
    ];
}
