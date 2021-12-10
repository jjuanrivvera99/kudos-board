<template>
  <div>
    <Navigation />
    <div class="wrapper">
      <nuxt />
    </div>
    <Footer />
  </div>
</template>

<script>
import Navigation from "./partials/navigation";
import Footer from "./partials/footer";

export default {
  name: "Default",
  components: {
    Navigation,
    Footer
  }
}
</script>
