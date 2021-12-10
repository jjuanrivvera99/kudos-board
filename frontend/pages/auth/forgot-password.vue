<template>
  <div>
    <!-- Section Cards -->
    <section class="authentication">
      <div class="auth-body">
        <h1 class="text-uppercase fw-500 mb-4 text-center font-22">
          Forgot Password
        </h1>
        <form v-if="!sent" class="auth-form" @submit.prevent="submit">
          <alert-error v-if="form.errors.has('message')" :form="form">
            {{ form.errors.get('message') }}
          </alert-error>
          <div class="form-group">
            <input
              v-model="form.email"
              type="text"
              name="email"
              :class="{ 'is-invalid': form.errors.has('email') }"
              class="form-control form-control-lg font-14 fw-300"
              placeholder="Email"
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
              Submit
            </button>
          </div>
        </form>
        <div v-else>
          <div class="alert alert-success text-center">
            <h4 class="fw-500">
              <i class="fas fa-check-circle"></i>
              Success!
            </h4>
            <p>
              We have sent you an email with a link to reset your password.
            </p>
          </div>
          <nuxt-link :to="{ name: 'login'}" class="btn btn-primary primary-bg-color font-16 fw-500 text-uppercase form-control">
            Go back
          </nuxt-link>
        </div>
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
        email: ''
      }),
      message: '',
      sent: false
    }
  },
  methods: {
    async submit() {
      try {
        await this.$axios.$get('sanctum/csrf-cookie');
        const response = await this.form.post('/api/forgot-password');
        this.message = response.message;
        this.sent = true;
      } catch (error) {
        this.form.errors.set(error.response?.data.errors);
      }
    }
  }
}
</script>
