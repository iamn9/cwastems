<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Bin\BulkDestroyBin;
use App\Http\Requests\Admin\Bin\DestroyBin;
use App\Http\Requests\Admin\Bin\IndexBin;
use App\Http\Requests\Admin\Bin\StoreBin;
use App\Http\Requests\Admin\Bin\UpdateBin;
use App\Models\Bin;
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

class BinsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBin $request
     * @return array|Factory|View
     */
    public function index(IndexBin $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Bin::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'address_1', 'address_2', 'landmark', 'load_type', 'collection_frequency'],

            // set columns to searchIn
            ['id', 'address_1', 'address_2', 'landmark', 'load_type', 'collection_frequency']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.bin.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.bin.create');

        return view('admin.bin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBin $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreBin $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Bin
        $bin = Bin::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/bins'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/bins');
    }

    /**
     * Display the specified resource.
     *
     * @param Bin $bin
     * @throws AuthorizationException
     * @return void
     */
    public function show(Bin $bin)
    {
        $this->authorize('admin.bin.show', $bin);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bin $bin
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Bin $bin)
    {
        $this->authorize('admin.bin.edit', $bin);


        return view('admin.bin.edit', [
            'bin' => $bin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBin $request
     * @param Bin $bin
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateBin $request, Bin $bin)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Bin
        $bin->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/bins'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/bins');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBin $request
     * @param Bin $bin
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyBin $request, Bin $bin)
    {
        $bin->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyBin $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyBin $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Bin::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
