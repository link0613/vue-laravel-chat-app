<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <div :class="'form-group' + (errors.name !== undefined ? ' has-error' : '')">
                            <label for="name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" v-model="name" required autofocus>
                                 <span class="help-block" v-show="errors.name">{{ errors.name }}</span>
                            </div>
                            <br><br>
                        </div>
                        <div :class="'form-group' + (errors.email !== undefined ? ' has-error' : '')">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="email" required>
                                <span class="help-block" v-show="errors.email">{{ errors.email }}</span>
                            </div>
                            <br><br>
                        </div>
                        <div :class="'form-group' + (errors.password !== undefined ? ' has-error' : '')">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="password" required>
                                <span class="help-block" v-show="errors.password">{{ errors.password }}</span>
                            </div>
                            <br><br>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="button" @click="submit" class="btn btn-primary">
                                    Create Account
                                </button>

                                <a class="btn btn-link" href="Login">
                                    Login
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
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                errors : {}
            }
        },
        methods : {
            submit() {
                var self = this;
                self.errors = {};
                window.axios.post('/api/auth/register',{
                    name : this.name,
                    email : this.email,
                    password : this.password,
                }).then(function(response){
                    self.$router.go('/home');
                }).catch(function(error){
                    if(error.response.status === 422){
                        Object.keys(error.response.data).forEach(function(key){
                            self.$set(self.errors,key,error.response.data[key][0]);
                        });
                    }
                })
            }
        }
    }
</script>