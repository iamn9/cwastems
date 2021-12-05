<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientComplaint\BulkDestroyClientComplaint;
use App\Http\Requests\Admin\ClientComplaint\DestroyClientComplaint;
use App\Http\Requests\Admin\ClientComplaint\IndexClientComplaint;
use App\Http\Requests\Admin\ClientComplaint\StoreClientComplaint;
use App\Http\Requests\Admin\ClientComplaint\UpdateClientComplaint;
use App\Models\ClientComplaint;
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

class ClientComplaintsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexClientComplaint $request
     * @return array|Factory|View
     */
    public function index(IndexClientComplaint $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ClientComplaint::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'user_id', 'bin_id', 'title'],

            // set columns to searchIn
            ['id', 'title', 'description', 'address_1', 'address_2']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.client-complaint.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.client-complaint.create');

        return view('admin.client-complaint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientComplaint $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreClientComplaint $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ClientComplaint
        $clientComplaint = ClientComplaint::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/client-complaints'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/client-complaints');
    }

    /**
     * Display the specified resource.
     *
     * @param ClientComplaint $clientComplaint
     * @throws AuthorizationException
     * @return void
     */
    public function show(ClientComplaint $clientComplaint)
    {
        $this->authorize('admin.client-complaint.show', $clientComplaint);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClientComplaint $clientComplaint
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ClientComplaint $clientComplaint)
    {
        $this->authorize('admin.client-complaint.edit', $clientComplaint);


        return view('admin.client-complaint.edit', [
            'clientComplaint' => $clientComplaint,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientComplaint $request
     * @param ClientComplaint $clientComplaint
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateClientComplaint $request, ClientComplaint $clientComplaint)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ClientComplaint
        $clientComplaint->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/client-complaints'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/client-complaints');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyClientComplaint $request
     * @param ClientComplaint $clientComplaint
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyClientComplaint $request, ClientComplaint $clientComplaint)
    {
        $clientComplaint->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyClientComplaint $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyClientComplaint $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ClientComplaint::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
