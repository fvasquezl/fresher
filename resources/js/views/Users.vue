<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card d-flex flex-column">
                <div class="card-header">
                    <div class ="d-flex justify-content-between align-items-center">
                        <div class="font-size-4">Create Users</div>
                        <button class="btn btn-outline-secondary"
                                data-toggle="modal"
                                data-target="#exampleModal"
                                dusk="modal-btn"
                                @click="openModal">
                            <i class="fas fa-user-plus"></i> Create User
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <users-list :reload=reload_users></users-list>
                </div>
            </div>
        </div>
        <modal title="Create User" :is-small="false" v-if="show_modal" @close="show_modal = false">
            <user-form @close="show_modal=false" :edit_mode=false @reload="reload_users = true"></user-form>
        </modal>
    </div>
</template>

<script>
    import Modal from '../components/Modal';
    import UserForm from '../components/UserForm'
    import UsersList from '../components/UsersList'

    export default {
        components: {
            Modal,
            UserForm,
            UsersList,
        },
        data() {
            return {
                show_modal: false,
                reload_users: false,
            }
        },
        methods: {
            openModal() {
                this.show_modal = true
            },
            reloadUsers(message){
                console.log(message)
            }
        }
    }
</script>