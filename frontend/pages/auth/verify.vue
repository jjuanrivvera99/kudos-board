<template>
  <section class="verification">
    <div class="verify-body">
      <h1 class="text-uppercase fw-500 mb-4 text-center font-22">
        Verify
      </h1>

      <b-alert v-if="message" variant="success" class="text-center" show>{{ message }}</b-alert>

      <div v-else class="card">
        <div class="card-body">
          <div class="text-center" style="margin-bottom: 10px">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
          </div>
          <form @submit.prevent="resend">
            <div class="form-group">
              <button class="btn btn-primary text-uppercase btn-block">Resend</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </section>
</template>

<script>
import { Form } from 'vform'

export default {
  middleware: 'unverified',
  data() {
    return {
      form: new Form(),
      message: false
    }
  },
  methods: {
    async resend() {
      try {
        await this.$axios.$get('sanctum/csrf-cookie');
        const response = await this.form.post('/api/email/verification-notification');
        this.message = response.data.message;
      } catch (error) {
        this.form.errors.set(error.response.data.errors);
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.verification {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  -ms-flex-pack: center;
  justify-content: center;
  padding: 0 15px;
  margin: 100px 0px;
  width: 100%;
}

.verify-body {
  flex-basis: auto;
  flex-grow: 1;
  max-width: 600px;
  padding: 40px;
  box-sizing: border-box;
  background-color: #ffffff;
  border-radius: 3px;
  box-shadow: 0 10px 40px 0 rgba(18, 106, 211, 0.07),
      0 2px 9px 0 rgba(18, 106, 211, 0.06);
}
</style>
