<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Request as ModelsRequest; // Alias to avoid conflict
use App\Models\JobDraft;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.sidebar', function ($view) {
            $clientDraftCount = 0;
            $supervisorDraftCount = 0;
            $authuser = auth()->user();
            
            if (auth()->check()) {
                $clientDraftCount = JobDraft::where('client_id', auth()->user()->id)
                    ->where('status', 'Submitted to Client')
                    ->count();
                
                // Adjust this query according to your supervisor logic.
                $supervisorDraftCount = ModelsRequest::with('assignee')
                    ->count();

                // $supervisorDirectDraftCount = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner')
                //     ->count();

                $supervisorTaskCount = JobDraft::where(function ($query) use ($authuser) {
                    $query->where('content_writer_id', $authuser->id)
                        ->orWhere('graphic_designer_id', $authuser->id);
                })
                    ->where('status', 'pending')
                    ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client']) // Ensures relations are loaded
                    ->count();

                $supervisorRevisionCount = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client', 'revisions'])
                ->where('status', 'Revision')
                ->where(function ($query) {
                    $query->where('content_writer_id', auth()->user()->id)
                        ->orWhere('graphic_designer_id', auth()->user()->id);
                })
                ->count(); // Retrieve all records

                $supervisorApprovalCount = JobDraft::where('status', 'Submitted to Supervisor')
                ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->count();


                // ADMIN OPERATION
                $operationTaskCount = JobDraft::where(function ($query) use ($authuser) {
                    $query->where('content_writer_id', $authuser->id)
                        ->orWhere('graphic_designer_id', $authuser->id);
                })
                    ->where('status', 'pending')
                    ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client']) // Ensures relations are loaded
                    ->count();

                $operationIncomingRequestCount = ModelsRequest::where('assigned_to', auth()->user()->id)
                ->whereDoesntHave('jobOrders') // Exclude requests already assigned to JobOrders
                ->count();

                $operationApprovalCount = JobDraft::where('status', 'Submitted to Operations')
                ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->count();

                $operationRevisionCount = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client', 'revisions'])
                ->where('status', 'Revision')
                ->where(function ($query) {
                    $query->where('content_writer_id', auth()->user()->id)
                        ->orWhere('graphic_designer_id', auth()->user()->id);
                })
                ->count(); // Retrieve all records


                // Content Writer

                $contentDraftCount = JobDraft::where('content_writer_id', $authuser->id)
                ->where('status', 'pending')
                ->where('type', 'content_writer')
                ->with('jobOrder', 'contentWriter', 'graphicDesigner', 'client') // Corrected ->with() usage
                ->count();

                $contentRevisionCount = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client', 'revisions'])
                ->where('status', 'Revision')
                ->where('type', 'content_writer')
                ->where('content_writer_id', auth()->user()->id) // Cleaner way to get the authenticated user's ID
                ->count(); // Retrieve all records

                $graphicDraftCount = JobDraft::where('graphic_designer_id', $authuser->id)
                ->where('status', 'pending')
                ->where('type', 'graphic_designer')
                ->with('jobOrder', 'contentWriter', 'graphicDesigner', 'client') // Corrected ->with() usage
                ->count();

                $graphicRevisionCount = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client', 'revisions'])
                ->where('status', 'Revision')
                ->where('type', 'graphic_designer')
                ->where('graphic_designer_id', auth()->user()->id) // Cleaner way to get the authenticated user's ID
                ->count(); // Retrieve all records
            }
            
            $view->with(compact('clientDraftCount', 'supervisorDraftCount', 'supervisorTaskCount', 'supervisorRevisionCount', 'supervisorApprovalCount', 'operationTaskCount', 'operationIncomingRequestCount', 'operationApprovalCount', 'operationRevisionCount' , 'contentDraftCount', 'contentRevisionCount', 'graphicDraftCount', 'graphicRevisionCount'));
        });
    }
    
    

    
}
