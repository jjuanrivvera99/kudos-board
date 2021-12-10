import Vue from 'vue';
import { Form } from 'vform';
import { HasError, AlertError, AlertSuccess } from 'vform/src/components/bootstrap5';

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertSuccess.name, AlertSuccess);
// Vue.use(Form);

export default ({ $axios }) => {
  Form.axios = $axios
}
