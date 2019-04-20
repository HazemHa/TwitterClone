<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input v-model="form.email" type="email" required placeholder="Enter email"></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your name:" label-for="input-2">
        <b-form-input type="text" v-model="form.name" required placeholder="Enter name"></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your username:" label-for="input-2">
        <b-form-input type="text" v-model="form.username" required placeholder="Enter username"></b-form-input>
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
            <b-img
              size="120px"
              width="120px"
              height="120px"
              v-if="!form.avatar"
              class="grey lighten-3 mb-3"
            >
              <span>Click to add avatar</span>
            </b-img>
            <b-img size="120px" width="120px" height="120px" v-else class="mb-3">
              <img :src="form.avatar.imageURL" alt="avatar">
            </b-img>
          </div>
        </image-input>
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

      <b-button type="submit" variant="primary">update</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ this.form }}</pre>
    </b-card>
  </div>
</template>

<script>
import ImageInput from "../../image/imageUpload.vue";

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
      show: true
    };
  },
  created() {
    this.form.email = this.$store.getters["users/getCurrentUser"].email;
    this.form.password = this.$store.getters["users/getCurrentUser"].password;
    this.form.name = this.$store.getters["users/getCurrentUser"].name;
    this.form.username = this.$store.getters["users/getCurrentUser"].username;
    this.form.cover.imageURL =
      this.$store.getters.url +
      this.$store.getters["users/getCurrentUser"].avatar;
    this.form.avatar.imageURL =
      this.$store.getters.url +
      this.$store.getters["users/getCurrentUser"].cover;
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.updateProfile();
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
    updateProfile() {
      let dataForm = new FormData();

      dataForm.append("id", this.$store.getters["users/getCurrentUser"].id);
      dataForm.append("email", this.form.email);
      dataForm.append("password", this.form.password);
      dataForm.append("name", this.form.name);
      dataForm.append("username", this.form.username);
      dataForm.append("cover", this.ImageCover);
      dataForm.append("avatar", this.ImageAvatar);

      console.log(dataForm);
      let data = {
        data: dataForm,
        id: this.$store.getters["users/getCurrentUser"].id
      };

      this.$store
        .dispatch("users/UpdateUser", data)
        .then(res => {
          if (res.data.update) {
            this.$toaster.success("Updated Complete");

            this.$nextTick();
          }
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
