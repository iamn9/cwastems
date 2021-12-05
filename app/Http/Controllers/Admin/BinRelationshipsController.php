<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BinRelationship\BulkDestroyBinRelationship;
use App\Http\Requests\Admin\BinRelationship\DestroyBinRelationship;
use App\Http\Requests\Admin\BinRelationship\IndexBinRelationship;
use App\Http\Requests\Admin\BinRelationship\StoreBinRelationship;
use App\Http\Requests\Admin\BinRelationship\UpdateBinRelationship;
use App\Models\BinRelationship;
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

class BinRelationshipsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBinRelationship $request
     * @return array|Factory|View
     */
    public function index(IndexBinRelationship $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(BinRelationship::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [''],

            // set columns to searchIn
            ['']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.bin-relationship.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.bin-relationship.create');

        return view('admin.bin-relationship.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBinRelationship $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreBinRelationship $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the BinRelationship
        $binRelationship = BinRelationship::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/bin-relationships'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/bin-relationships');
    }

    /**
     * Display the specified resource.
     *
     * @param BinRelationship $binRelationship
     * @throws AuthorizationException
     * @return void
     */
    public function show(BinRelationship $binRelationship)
    {
        $this->authorize('admin.bin-relationship.show', $binRelationship);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BinRelationship $binRelationship
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(BinRelationship $binRelationship)
    {
        $this->authorize('admin.bin-relationship.edit', $binRelationship);


        return view('admin.bin-relationship.edit', [
            'binRelationship' => $binRelationship,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBinRelationship $request
     * @param BinRelationship $binRelationship
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateBinRelationship $request, BinRelationship $binRelationship)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values BinRelationship
        $binRelationship->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/bin-relationships'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/bin-relationships');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBinRelationship $request
     * @param BinRelationship $binRelationship
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyBinRelationship $request, BinRelationship $binRelationship)
    {
        $binRelationship->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyBinRelationship $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyBinRelationship $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    BinRelationship::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
