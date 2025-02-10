<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDraft extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'job_order_id',
        'type',
        'date_started',
        'date_target',
        'signature_admin',
        'signature_top_manager',
        'status',
        'draft',
        'admin_signed',
        'top_manager_signed',
        'content_writer_id',
        'graphic_designer_id',
        'client_id',
        'feedback',
        'date_completed'
    ];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class, 'job_order_id');
    }

    /**
     * Get the content writer assigned to this draft.
     */
    public function contentWriter()
    {
        return $this->belongsTo(User::class, 'content_writer_id');
    }

    /**
     * Get the graphic designer assigned to this draft.
     */
    public function graphicDesigner()
    {
        return $this->belongsTo(User::class, 'graphic_designer_id');
    }

    /**
     * Get the client assigned to this draft.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Get all revisions for this job draft.
     */
    public function revisions()
    {
        return $this->hasMany(Revision::class, 'job_draft_id');
    }
}
