<template>
  <div>
    <!-- Section Cards -->
    <section class="authentication">
      <div class="auth-body">
        <h1 class="text-uppercase fw-500 mb-4 text-center font-22">
          Login
        </h1>
        <form class="auth-form" @submit.prevent="submit">
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
          <div class="form-group">
            <input
              v-model="form.password"
              type="password"
              name="password"
              :class="{'is-invalid': form.errors.has('password')}"
              class="form-control form-control-lg font-14 fw-300"
              placeholder="Password"
            />
            <has-error :form="form" field="password" ></has-error>
          </div>
          <div class="mt-4 mb-4 clearfix">
            <nuxt-link :to="{ name: 'forgot-password'}" class="forgot-pass color-blue font-14 fw-400" href="#"> Forgot password? </nuxt-link>
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
              Login
            </button>
          </div>
          <p class="font-14 fw-400 text-center mt-4">
            Don't have an account yet?
            <nuxt-link :to="{ name: 'register'}" class="color-blue"> Create an account</nuxt-link>
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
        email: '',
        password: ''
      })
    }
  },
  methods: {
    submit(){
      this.$auth
        .loginWith('laravelSanctum', {
          data: this.form
        }).catch(e => {
          this.form.errors.set(e.response.data.errors);
        });
    }
  }
}
</script>
