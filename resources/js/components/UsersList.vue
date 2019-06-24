<template>
    <div>
        <table class="table table-hover table-bordered ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created_at</th>
                <th scope="col">Manage</th>
            </tr>
            </thead>
            <tbody>
            <user v-for="user in users" :user="user"
                  :key="user.id"
                  @userToDelete="deleteUser($event)"
                  @userToEdit="updateUserModal($event)"></user>
            </tbody>
        </table>
        <pagination class="pagination justify-content-end" :meta="meta" v-on:pagination:switched="getUsers"></pagination>

        <modal title="Update User" :is-small="false" v-if="show_modal" @close="show_modal = false">
            <user-form @close="show_modal = false" :edit_mode=true :edit_user=user @reload="getUsers(meta.current_page)"></user-form>
        </modal>
    </div>
</template>

<script>
    import User from '../components/User'
    import Pagination from '../components/Pagination'
    import Modal from '../components/Modal';
    import UserForm from '../components/UserForm'

    export default {
        props: ['reload'],
        components:{
            User,
            Pagination,
            Modal,
            UserForm
        },
        data(){
            return {
                users:[],
                user:{},
                meta: {},
                show_modal: false,
            }
        },
        watch:{
            reload:function () {
                this.getUsers()
            }
        },
        mounted() {
            this.getUsers()
        },
        methods:{
            getUsers(page = 1){
                this.$Progress.start();
                axios.get('/api/users',{
                    params:{
                        page
                    }
                }).then((res) => {
                    this.users = res.data.data;
                    this.meta = res.data.meta;
                    this.$Progress.finish();
                }).catch((e) => {
                    this.$Progress.fail()
                });
            },
            deleteUser(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/users/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            this.getUsers(this.meta.current_page)
                        }).catch(() => {
                            Swal.fire('Failed!', "There was something wrong", "warning");
                        });
                    }
                })

            },
            updateUserModal(user){
                this.user = user;
                this.show_modal = true
            },
        }
    };
</script>