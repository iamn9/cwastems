@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.complaint-status.actions.edit', ['name' => $complaintStatus->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <complaint-status-form
                :action="'{{ $complaintStatus->resource_url }}'"
                :data="{{ $complaintStatus->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.complaint-status.actions.edit', ['name' => $complaintStatus->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.complaint-status.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </complaint-status-form>

        </div>
    
</div>

@endsection