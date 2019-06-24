<template>
    <tr>
        <td>{{user.id}}</td>
        <td>
            {{user.name}}
            <div class="small text-secondary">
                {{user.roles.join(', ')}}
            </div>
        </td>
        <td>{{user.email}}</td>
        <td>{{user.created_at}}</td>
        <td>
            <button class="btn btn-success" @click="userToEdit(user)"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger"  @click="userToDelete(user.id)"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['user'],
        methods:{
            userToDelete(id){
                this.$emit('userToDelete',id)
            },
            userToEdit(user){
                this.$emit('userToEdit',user)
            }
        }
    }
</script>