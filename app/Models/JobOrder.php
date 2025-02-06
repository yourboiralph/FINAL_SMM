<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'title',
        'description',
        'content_writer_id',
        'graphic_designer_id',
        'client_id',
        'issued_by',
        'renewable'
    ];

    // Relationships
    public function contentWriter()
    {
        return $this->belongsTo(User::class, 'content_writer_id');
    }

    public function graphicDesigner()
    {
        return $this->belongsTo(User::class, 'graphic_designer_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
    public function pendingJobDraft()
    {
        return $this->hasOne(JobDraft::class, 'job_order_id')->where('status', 'pending');
    }

    public function latest_job_draft()
    {
        return $this->hasOne(JobDraft::class)->orderByDesc('status');
    }
}
