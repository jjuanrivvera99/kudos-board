<template>
  <div>
    <!-- Section Cards -->
    <section class="authentication">
      <div class="auth-body">
        <h1 class="text-uppercase fw-500 mb-4 text-center font-22">
          Reset Password
        </h1>
        <form class="auth-form" @submit.prevent="submit">
          <alert-error v-if="form.errors.has('message')" :form="form">
            {{ form.errors.get('message') }}
          </alert-error>
          <div class="form-group">
            <input
              v-model="form.password"
              type="password"
              name="password"
              :class="{ 'is-invalid': form.errors.has('password') }"
              class="form-control form-control-lg font-14 fw-300"
              placeholder="Password"
            />
            <has-error :form="form" field="email" ></has-error>
          </div>
          <div class="form-group">
            <input
              v-model="form.password_confirmation"
              type="password"
              name="password_confirmation"
              :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
              class="form-control form-control-lg font-14 fw-300"
              placeholder="Password Confirmation"
            />
            <has-error :form="form" field="email" ></has-error>
          </div>
          <div class="text-right">
            <button
              type="submit"
              class="btn btn-primary primary-bg-color font-16 fw-500 text-uppercase form-control"
              :disabled="form.busy"
            >
              <span v-if="form.busy">
                <i class="fas fa spinner fa-spin"></i>
              </span>
              Reset
            </button>
          </div>
        </form>
      </div>
    </section>
    <!-- End Cards -->
  </div>
</template>

<script>
import { Form } from 'vform'

export default {
  middleware: 'guest',
  data() {
    return {
      form: new Form({
        email: '',
        token: '',
        password: '',
        password_confirmation: ''
      }),
      message: ''
    }
  },
  mounted() {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },
  methods: {
    async submit() {
      try {
        await this.$axios.$get('sanctum/csrf-cookie');
        const response = await this.form.post('/api/reset-password');
        this.message = response.message;
        this.$router.replace({ name: 'login' });
      } catch (error) {
        this.form.errors.set(error.response?.data.errors);
      }
    }
  }
}
</script>
