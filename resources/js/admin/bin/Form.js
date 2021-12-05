import AppForm from '../app-components/Form/AppForm';

Vue.component('bin-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                address_1:  '' ,
                address_2:  '' ,
                landmark:  '' ,
                load_type:  '' ,
                collection_frequency:  '' ,
                
            }
        }
    }

});