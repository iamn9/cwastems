import AppForm from '../app-components/Form/AppForm';

Vue.component('client-complaint-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                user_id:  '' ,
                bin_id:  '' ,
                title:  '' ,
                description:  '' ,
                address_1:  '' ,
                address_2:  '' ,
                
            }
        }
    }

});