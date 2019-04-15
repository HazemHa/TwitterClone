<template>

        <image-input v-model="avatar" @input="ReceiveImage">
          <div slot="activator">
            <v-avatar size="280px" v-ripple v-if="!avatar" class="grey lighten-3 mb-3">
              <span>Click to add avatar</span>
            </v-avatar>
            <v-avatar size="280px" v-ripple v-else class="mb-3">
              <img :src="avatar.imageURL" alt="avatar">
            </v-avatar>
          </div>
        </image-input>

</template>
<script>
import Vue from "vue";
import VeeValidate from "vee-validate";
import ImageInput from "../image/imageUpload.vue";
Vue.use(VeeValidate);
export default {
  $_veeValidate: {
    validator: "new"
  },
  components: {
    ImageInput: ImageInput
  },

  data: () => ({
    valid: true,
    name: "",
    avatar: { imageURL: "" },
    tempImageAsFile: null,
    show1: false,
    nameRules: [
      v => !!v || "Name is required",
      v => (v && v.length <= 30) || "Name must be less than 30 characters"
    ],
    email: "",
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+/.test(v) || "E-mail must be valid"
    ],
    password: "",
    password_confirmation: "",
    passwordRule: [
      v => !!v || "Password is required",
      v => (v && v.length >= 6) || "Password must be more than 6 character"
    ],
    password_confirmationRule: [
      v => !!v || "password is required "
      //  v=> (v && this.password === v ) || 'the confirm password does not match with password',
    ]
  }),
  created() {},
  mounted() {
    this.avatar.imageURL = this.imguserProfile.imageURL;
    this.name = this.$store.getters["users/getCurrentUser"].name;
    this.email = this.$store.getters["users/getCurrentUser"].email;
    this.password = this.$store.getters["users/getCurrentUser"].password;
    this.password_confirmation = this.$store.getters[
      "users/getCurrentUser"
    ].password;

  },
  computed: {
    nameUser: function() {
      return this.$store.getters["users/getCurrentUser"].name;
    },
    imguserProfile: function() {
      return {
        imageURL:
          this.$store.getters["users/getCurrentUser"].image
      };
    }
  },
  watch: {
    avatar: {
      handler: function() {
        this.saved = false;
      },
      deep: true
    }
  },

  methods: {
    submit() {
      this.$validator.validateAll().then(() => {
        const formData = new FormData();
        formData.append("id", this.$store.getters["users/getCurrentUser"].id);
        formData.append("name", this.name);
        formData.append("email", this.email);
        formData.append("password", this.password);
        formData.append("password_confirmation", this.password_confirmation);
        formData.append("image", this.tempImageAsFile);

        this.$store
          .dispatch("users/updateProfile", formData)
          .then(res => {
            if (res.data.success) {
              this.$toaster.success("update done :D");
            } else if (res.data.error) {
              this.$toaster.error(res.data.error);
            } else {
              Object.values(res.data).forEach(element => {
                for (let index = 0; index < element.length; index++) {
                  this.$toaster.error(element[index]);
                }
              });
            }
          })
          .catch(err => {
            this.$toaster.error(
              "Something happened error, try again or contact the support"
            );
          });
      });
    },
    clear() {
      this.$refs.form.reset();
      this.avatar.imageURL = this.imguserProfile.imageURL;
    },
    ReceiveImage(file) {
      this.tempImageAsFile = file.file;
    }
  }
};
</script>
<style>
.rounded-card {
  border-radius: 50%;
}
</style>
