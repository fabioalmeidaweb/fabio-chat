<template>
  <div class="row">
    <div class="col s6 push-s3">
      <div class="card">
        <form @submit.prevent="register()">

          <div class="card-content">
            <span class="card-title">Cadastre-se</span>
            <br>
            <div class="input-field">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" required autofocus v-model="credentials.name">
            </div>
            <div class="input-field">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" required v-model="credentials.email">
            </div>
            <div class="input-field">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required v-model="credentials.password">
            </div>

            <div class="input-field">
              <label for="password_confirmation">Password Confirmation</label>
              <input type="password" id="password_confirmation" name="password_confirmation" required v-model="credentials.password_confirmation">
            </div>

          </div>

          <div class="card-action">
            <button type="submit" class="waves-effect waves-light btn">Register</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import swal from 'sweetalert'
  import axios from "axios"

  export default {
    data: () => {
      return {
        credentials: {}
      }
    },
    methods: {
      register() {

        axios.post('/register', this.credentials)
          .then((res) => {
            if (res.data.status === 'success') {
              swal('Registred with success', 'Redirecting to panel', 'success');
              this.$router.push({ path: '/'});
            } else {
              let validation = '';

              for (let error in res.data) {
                validation += res.data[error].join('\n') + '\n'
              }

              swal('Register fail!', validation ,'error');
            }
          }).catch(error => {
              console.log(error)
              swal('Register fail!', `${error}`, 'error');
          })
      }
    }
  }
</script>
