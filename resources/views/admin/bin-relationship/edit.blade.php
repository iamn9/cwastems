@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.bin-relationship.actions.edit', ['name' => $binRelationship->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <bin-relationship-form
                :action="'{{ $binRelationship->resource_url }}'"
                :data="{{ $binRelationship->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.bin-relationship.actions.edit', ['name' => $binRelationship->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.bin-relationship.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </bin-relationship-form>

        </div>
    
</div>

@endsection