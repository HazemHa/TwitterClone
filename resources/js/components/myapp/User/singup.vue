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

      <b-form-group id="input-group-2" label="Your name:" label-for="input-2">
        <b-form-input
          id="input-2"
          type="text"
          v-model="form.name"
          required
          placeholder="Enter name"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your username:" label-for="input-2">
        <b-form-input
          id="input-3"
          type="text"
          v-model="form.username"
          required
          placeholder="Enter username"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your cover:" label-for="input-2">
        <image-input v-model="form.cover" @input="ReceiveImageCover">
          <div slot="activator">
            <b-img
              :src="form.cover.imageURL == null?'http://127.0.0.1:8000/storage/upload.png':form.cover.imageURL"
              fluid
              alt="Responsive image"
            ></b-img>

            <b-img size="280px" v-if="!form.cover" class="grey lighten-3 mb-3">
              <span>Click to add Cover</span>
            </b-img>
            <b-img size="280px" v-else class="mb-3">
              <img :src="form.cover.imageURL" alt="avatar">
            </b-img>
          </div>
        </image-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your avatar:" label-for="input-2">
        <image-input v-model="form.avatar" @input="ReceiveImageAvatar">
          <div slot="activator">
            <b-img
              :src="form.avatar.imageURL == null?'http://127.0.0.1:8000/storage/upload.png':form.avatar.imageURL"
              fluid
              alt="Responsive image"
            ></b-img>
            <b-img size="280px" v-if="!form.avatar" class="grey lighten-3 mb-3">
              <span>Click to add avatar</span>
            </b-img>
            <b-img size="280px" v-else class="mb-3">
              <img :src="form.avatar.imageURL" alt="avatar">
            </b-img>
          </div>
        </image-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your password:" label-for="input-2">
        <b-form-input
          id="input-4"
          type="password"
          v-model="form.password"
          required
          placeholder="Enter password"
        ></b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Register</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ dataForm }}</pre>
    </b-card>
  </div>
</template>

<script>
import ImageInput from "../image/imageUpload.vue";

export default {
  components: {
    ImageInput: ImageInput
  },
  data() {
    return {
      form: {
        name: "",
        username: "",
        avatar: { imageURL: null },
        cover: { imageURL: null },
        ImageCover: null,
        ImageAvatar: null,
        email: "",
        password: ""
      },
      dataForm: null,
      show: true
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.singup();
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.email = "";
      this.form.password = "";
      this.form.name = "";
      this.form.username = "";
      this.form.cover = null;
      this.form.avatar = null;
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
    singup() {
      this.dataForm = new FormData();
      this.dataForm.append("email", this.form.email);
      this.dataForm.append("password", this.form.password);
      this.dataForm.append("name", this.form.name);
      this.dataForm.append("username", this.form.username);
      this.dataForm.append("cover", this.ImageCover);
      this.dataForm.append("avatar", this.ImageAvatar);

      this.$store
        .dispatch("users/singup", this.dataForm)
        .then(res => {
          console.log(res);
          if (res.data.auth) {
            this.$router.push({ name: "home" });
            this.$nextTick();
          } else {
            this.$toaster.success("Please check form your credentials");
          }
          console.log(res);
        })
        .catch(err => {
          if (err.response.data.errors) {
            let Obj = Object.keys(err.response.data.errors);
            for (const error of Obj) {
              for (const errorMessage of err.response.data.errors[error]) {
                this.$toaster.error(errorMessage);
              }
            }
          }
        });
    },
    ReceiveImageCover(data) {
      this.ImageCover = data.file;
      this.form.cover.imageURL = data.imageURL;
    },
    ReceiveImageAvatar(data) {
      this.ImageAvatar = data.file;
      this.form.avatar.imageURL = data.imageURL;
    }
  }
};
</script>
