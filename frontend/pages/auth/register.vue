<template>
  <div>
    <!-- Section Cards -->
    <section class="authentication">
      <div class="auth-body">
        <h1 class="text-uppercase fw-500 mb-4 text-center font-22">
          Register
        </h1>
        <form class="auth-form" @submit.prevent="register">
          <alert-success :form="form">
            We have sent you an email with a link to verify your account.
          </alert-success>
          <div class="form-group">
            <input
              v-model.trim="form.name"
              type="text"
              name="name"
              class="form-control form-control-lg font-14 fw-300"
              :class="{ 'is-invalid': form.errors.has('name') }"
              placeholder="Full Name"
            />
            <has-error :form="form" field="name" ></has-error>
          </div>
          <div class="form-group">
            <input
              v-model.trim="form.username"
              type="text"
              name="username"
              class="form-control form-control-lg font-14 fw-300"
              :class="{ 'is-invalid': form.errors.has('username') }"
              placeholder="Username"
            />
            <has-error :form="form" field="username" ></has-error>
          </div>
          <div class="form-group">
            <input
              v-model.trim="form.email"
              type="text"
              name="email"
              class="form-control form-control-lg font-14 fw-300"
              :class="{ 'is-invalid': form.errors.has('email') }"
              placeholder="Email"
            />
            <has-error :form="form" field="email" ></has-error>
          </div>
          <div class="form-group">
            <input
              v-model.trim="form.password"
              type="password"
              name="password"
              class="form-control form-control-lg font-14 fw-300"
              :class="{ 'is-invalid': form.errors.has('password') }"
              placeholder="Password"
            />
            <has-error :form="form" field="password" ></has-error>
          </div>
          <div class="form-group">
            <input
              v-model.trim="form.password_confirmation"
              type="password"
              name="password_confirmation"
              class="form-control form-control-lg font-14 fw-300"
              :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
              placeholder="Confirm Password"
            />
            <has-error :form="form" field="password_confirmation" ></has-error>
          </div>

          <div class="text-right">
            <button
              type="submit"
              class="btn btn-primary primary-bg-color font-16 fw-500 text-uppercase"
              :disabled="form.busy"
            >
              <span v-if="form.busy">
                <i class="fas fa spinner fa-spin"></i>
              </span>
              Register
            </button>
          </div>
          <p class="font-14 fw-400 text-center mt-4">
            Already have an account?
            <nuxt-link :to="{ name: 'login'}" class="color-blue"> Login</nuxt-link>
          </p>
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
        name: '',
        username: '',
        email: '',
        password: '',
        password_confirmation: '',
      }),
    };
  },
  mounted() {
    // this.$toast.success('Logged In!')
  },
  methods: {
    async register() {
      try {
        await this.$axios.$get('sanctum/csrf-cookie');
        await this.form.post('/api/register');
        this.form.reset();
        this.$router.push({ name: 'login' });
      } catch (error) {
        this.form.errors.set(error.response.data.errors);
      }
    },
  }
}
</script>
