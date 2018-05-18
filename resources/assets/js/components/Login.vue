<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="email" required autofocus>
                            </div>
                            <br><br>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="password" required>
                            </div>
                            <br><br>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button
                                        type="submit"
                                        class="btn btn-primary"
                                        v-on:click="submit()"
                                        :disabled="loading"
                                >
                                    <i class="fa fa-spin fa-spinner" v-show="loading"> </i>
                                    Login
                                </button>

                                <a class="btn btn-link" href="/forget-password">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import fetchival from 'fetchival';
    import {clientId, clientSecret} from './../config.js'
    export default {
        data() {
            return {
                email: '',
                password: '',
                loading: false,
            }
        },
        methods: {
            submit() {
                self = this;
                self.loading = true;
                let data = {
                    grant_type: 'password',
                    client_id: clientId,
                    client_secret: clientSecret,
                    username: self.email,
                    password: self.password,
                    scope: '',
                }
                fetchival('/oauth/token').post(data)
                    .then((response) => {
                        self.$auth.setToken(response.access_token, response.expires_in + Date.now());
                        self.$router.push('home');
                    }).catch((error) => {
                    alert('Error');
                }).then(() => {
                    self.loading = false;
                })
            }
        }
    }
</script>