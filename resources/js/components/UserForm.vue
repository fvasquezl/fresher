<template>
    <form @submit.prevent="edit_mode ? updateUser() : createUser()">
        <div class="modal-body">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input id="name"
                       type="text"
                       class="form-control"
                       :class="{'is-invalid': errors.name }"
                       name="name"
                       autocomplete="name"
                       autofocus
                       v-model="user.name">
                <span v-if="errors && errors.name" class="invalid-feedback" role="alert">
                    <strong>{{ errors.name[0] }}</strong>
                </span>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">E-Mail Address</label>
                <input id="email"
                       type="email"
                       class="form-control"
                       :class="{'is-invalid': errors.email }"
                       name="email"
                       autocomplete="email"
                       v-model="user.email">

                <span v-if="errors && errors.email" class="invalid-feedback" role="alert">
                    <strong>{{ errors.email[0] }}</strong>
                </span>
            </div>

            <div class="form-group">
                <label for="password"
                       class="form-label">Password</label>
                <input id="password"
                       type="password"
                       class="form-control"
                       :class="{'is-invalid': errors.password }"
                       name="password"
                       autocomplete="new-password"
                       v-model="user.password">
                <span v-if="errors && errors.password" class="invalid-feedback" role="alert">
                    <strong>{{ errors.password[0] }}</strong>
                </span>
            </div>


            <div class="form-group">
                <div><label class="form-label">Roles</label></div>
                <div class="form-check form-check-inline" v-for="role in roles" :key="role.id">
                    <input class="form-check-input" :class="{'is-invalid': errors.roles }" type="checkbox"
                           v-model="user.roles" :value="role.name">
                    <label class="form-check-label">
                        {{role.name}}
                    </label>
                </div>
                <div v-if="errors && errors.roles" class="text-danger" role="alert">
                    <strong>{{ errors.roles[0] }}</strong>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="close" dusk="submit-btn">Cancel</button>
            <button v-show="edit_mode" type="submit" class="btn btn-primary">Update User</button>
            <button v-show="!edit_mode" type="submit" class="btn btn-primary">Create User</button>
        </div>
    </form>
</template>

<script>
    export default {
        props:['edit_user','edit_mode'],
        data() {
            return {
                roles: [],
                errors: {},
                user: {
                    name: '',
                    email: '',
                    password: '',
                    roles: []
                },
            }
        },
        methods: {
            createUser() {
                this.$Progress.start();
                axios.post('/api/users', this.user)
                    .then(res => {
                        this.persistData(res);
                    }).catch(error => {
                    this.errors = error.response.data.errors || {};
                    this.$Progress.fail()
                });
            },
            updateUser() {
                this.$Progress.start();
                axios.put('/api/users/'+this.user.id, this.user)
                    .then((res) => {
                        this.persistData(res);
                    }).catch(error => {
                    this.errors = error.response.data.errors || {};
                    this.$Progress.fail()
                });
            },
            persistData(res) {
                Toast.fire({
                    type: 'success',
                    title: res.data.success
                });
                this.$Progress.finish();
                this.$emit("reload");
                this.$emit("close");
            },
            close() {
                this.$emit("close");
            },
        },
        mounted() {
            if(this.edit_mode){
                this.user = this.edit_user;
            }
            axios.get('/api/roles').then(res => {
                this.roles = res.data;
            }).catch(e => {
                console.log(e);
            });
        },
    }
</script>