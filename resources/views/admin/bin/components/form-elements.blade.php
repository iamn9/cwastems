<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address_1'), 'has-success': fields.address_1 && fields.address_1.valid }">
    <label for="address_1" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.bin.columns.address_1') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address_1" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address_1'), 'form-control-success': fields.address_1 && fields.address_1.valid}" id="address_1" name="address_1" placeholder="{{ trans('admin.bin.columns.address_1') }}">
        <div v-if="errors.has('address_1')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address_1') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address_2'), 'has-success': fields.address_2 && fields.address_2.valid }">
    <label for="address_2" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.bin.columns.address_2') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address_2" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address_2'), 'form-control-success': fields.address_2 && fields.address_2.valid}" id="address_2" name="address_2" placeholder="{{ trans('admin.bin.columns.address_2') }}">
        <div v-if="errors.has('address_2')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address_2') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('landmark'), 'has-success': fields.landmark && fields.landmark.valid }">
    <label for="landmark" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.bin.columns.landmark') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.landmark" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('landmark'), 'form-control-success': fields.landmark && fields.landmark.valid}" id="landmark" name="landmark" placeholder="{{ trans('admin.bin.columns.landmark') }}">
        <div v-if="errors.has('landmark')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('landmark') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('load_type'), 'has-success': fields.load_type && fields.load_type.valid }">
    <label for="load_type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.bin.columns.load_type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.load_type" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('load_type'), 'form-control-success': fields.load_type && fields.load_type.valid}" id="load_type" name="load_type" placeholder="{{ trans('admin.bin.columns.load_type') }}">
        <div v-if="errors.has('load_type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('load_type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('collection_frequency'), 'has-success': fields.collection_frequency && fields.collection_frequency.valid }">
    <label for="collection_frequency" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.bin.columns.collection_frequency') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.collection_frequency" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('collection_frequency'), 'form-control-success': fields.collection_frequency && fields.collection_frequency.valid}" id="collection_frequency" name="collection_frequency" placeholder="{{ trans('admin.bin.columns.collection_frequency') }}">
        <div v-if="errors.has('collection_frequency')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('collection_frequency') }}</div>
    </div>
</div>


