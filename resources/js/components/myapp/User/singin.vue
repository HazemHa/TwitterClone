<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="input-1"
          v-model="form.email"
          type="email"
          required
          placeholder="Enter email"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your password:" label-for="input-2">
        <b-form-input
          id="input-2"
          type="password"
          v-model="form.password"
          required
          placeholder="Enter password"
        ></b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Login</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: ""
      },
      show: true
    };
  },

  created() {},
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.login();
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.email = "";
      this.form.password = "";
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
    login() {
      let data = {
        url: "api/login",
        email: this.form.email,
        password: this.form.password
      };

      this.$authLaravel
        .login(data)
        .then(res => {
            if (res.data.auth) {
            this.$store.dispatch("users/PutCurrentUser",res.data.user);
            this.$router.push({ path: "/", name: 'home' });
            this.$nextTick();
          }
        })
        .catch(err => {
          if (err.response) this.$toaster.error(err.response.data.message);
        });

/*
      this.$store
        .dispatch("users/Login", {
          email: this.form.email,
          password: this.form.password
        })
        .then(res => {
          if (res.data.auth == true) {
            this.$router.push({ name: "home" });
            this.$nextTick();
          } else {
            this.$toaster.success("Please check form your credentials");
          }
        })
        .catch(err => {
          console.log(err);
          if (err.response) this.$toaster.error(err.response.data.message);
        });
        */

    }
  }
};
</script>

