import AppForm from '../app-components/Form/AppForm';

Vue.component('complaint-status-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                complaint_id:  '' ,
                user_id:  '' ,
                status:  '' ,
                remarks:  '' ,
                
            }
        }
    }

});