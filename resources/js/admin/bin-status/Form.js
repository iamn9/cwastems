import AppForm from '../app-components/Form/AppForm';

Vue.component('bin-status-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                bin_id:  '' ,
                status:  '' ,
                remarks:  '' ,
                
            }
        }
    }

});