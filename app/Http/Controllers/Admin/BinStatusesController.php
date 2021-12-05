<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BinStatus\BulkDestroyBinStatus;
use App\Http\Requests\Admin\BinStatus\DestroyBinStatus;
use App\Http\Requests\Admin\BinStatus\IndexBinStatus;
use App\Http\Requests\Admin\BinStatus\StoreBinStatus;
use App\Http\Requests\Admin\BinStatus\UpdateBinStatus;
use App\Models\BinStatus;
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

class BinStatusesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBinStatus $request
     * @return array|Factory|View
     */
    public function index(IndexBinStatus $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(BinStatus::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'bin_id', 'status'],

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

        return view('admin.bin-status.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.bin-status.create');

        return view('admin.bin-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBinStatus $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreBinStatus $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the BinStatus
        $binStatus = BinStatus::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/bin-statuses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/bin-statuses');
    }

    /**
     * Display the specified resource.
     *
     * @param BinStatus $binStatus
     * @throws AuthorizationException
     * @return void
     */
    public function show(BinStatus $binStatus)
    {
        $this->authorize('admin.bin-status.show', $binStatus);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BinStatus $binStatus
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(BinStatus $binStatus)
    {
        $this->authorize('admin.bin-status.edit', $binStatus);


        return view('admin.bin-status.edit', [
            'binStatus' => $binStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBinStatus $request
     * @param BinStatus $binStatus
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateBinStatus $request, BinStatus $binStatus)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values BinStatus
        $binStatus->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/bin-statuses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/bin-statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBinStatus $request
     * @param BinStatus $binStatus
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyBinStatus $request, BinStatus $binStatus)
    {
        $binStatus->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyBinStatus $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyBinStatus $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    BinStatus::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
