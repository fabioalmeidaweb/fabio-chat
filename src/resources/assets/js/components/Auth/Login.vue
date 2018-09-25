<template>
  <div class="row">
    <div class="col s6 push-s3">
      <div class="card">
        <form @submit.prevent="login()">
          <div class="card-content">
            <span class="card-title">Acessar</span>
            <br>
            <div class="input-field">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" required autofocus v-model="credentials.email">
            </div>
            <div class="input-field">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required v-model="credentials.password">
            </div>
            <div>
              <input id="remember" type="checkbox" name="rememeber" v-model="credentials.remember">
              <label for="remember">Lembrar de mim</label>
            </div>
          </div>

          <div class="card-action">
            <button type="submit" class="waves-effect waves-light btn">Login</button>

          <a href="#/register" class="btn light-green">Register</a>
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
      login() {
        axios.post('/login', this.credentials)
          .then((res) => {
            if (res.data.status === 'success') {
              swal('You are authenticated', 'Redirecting to panel', 'success');
              this.$router.push({ path: '/'});
            } else {
              swal('Login fail!', 'Invalid credentials', 'error');
            }
          }).catch(error => {
              swal('Login fail!', `${error}`, 'error');
          })
      }
    }
  }
</script>
