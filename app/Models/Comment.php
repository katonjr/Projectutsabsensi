<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const READ = 1;
    public const UNREAD = 0;
    public const APPROVED = 1;
    public const PENDING = 0;

    // Method untuk mendapatkan komentar yang disetujui
    public static function approved()
    {
        return self::where('status', self::APPROVED)->get();
    }

}
