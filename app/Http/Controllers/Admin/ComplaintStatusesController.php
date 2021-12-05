<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ComplaintStatus\BulkDestroyComplaintStatus;
use App\Http\Requests\Admin\ComplaintStatus\DestroyComplaintStatus;
use App\Http\Requests\Admin\ComplaintStatus\IndexComplaintStatus;
use App\Http\Requests\Admin\ComplaintStatus\StoreComplaintStatus;
use App\Http\Requests\Admin\ComplaintStatus\UpdateComplaintStatus;
use App\Models\ComplaintStatus;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ComplaintStatusesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexComplaintStatus $request
     * @return array|Factory|View
     */
    public function index(IndexComplaintStatus $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ComplaintStatus::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'complaint_id', 'user_id', 'status'],

            // set columns to searchIn
            ['id', 'status', 'remarks']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.complaint-status.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.complaint-status.create');

        return view('admin.complaint-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreComplaintStatus $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreComplaintStatus $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ComplaintStatus
        $complaintStatus = ComplaintStatus::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/complaint-statuses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/complaint-statuses');
    }

    /**
     * Display the specified resource.
     *
     * @param ComplaintStatus $complaintStatus
     * @throws AuthorizationException
     * @return void
     */
    public function show(ComplaintStatus $complaintStatus)
    {
        $this->authorize('admin.complaint-status.show', $complaintStatus);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ComplaintStatus $complaintStatus
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ComplaintStatus $complaintStatus)
    {
        $this->authorize('admin.complaint-status.edit', $complaintStatus);


        return view('admin.complaint-status.edit', [
            'complaintStatus' => $complaintStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateComplaintStatus $request
     * @param ComplaintStatus $complaintStatus
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateComplaintStatus $request, ComplaintStatus $complaintStatus)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ComplaintStatus
        $complaintStatus->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/complaint-statuses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/complaint-statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyComplaintStatus $request
     * @param ComplaintStatus $complaintStatus
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyComplaintStatus $request, ComplaintStatus $complaintStatus)
    {
        $complaintStatus->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyComplaintStatus $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyComplaintStatus $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ComplaintStatus::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
