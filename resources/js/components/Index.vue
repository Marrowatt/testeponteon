<template>
    <div class="container">
        <formulario @creating="create"></formulario>

        <div v-if="errors" class="bg-light border border-danger text-danger py-2 px-4 pr-0 pt-3 rounded font-bold my-3 shadow-lg">
            <div v-for="(v, k) in errors" :key="k">
                <h4 v-for="error in v" :key="error"> {{ error }} </h4>
            </div>
        </div>

        <table class="table table-striped table-hovered my-3">
            <thead>
                <th>Nome Completo</th>
                <th>Celular</th>
                <th>Cidade / UF</th>
                <th>Cadastrado em</th>
                <th>Pai Empresarial</th>
                <th>Rede</th>
                <th> - </th>
            </thead>

            <tbody>
                <tr v-for="(u, index) in users" :key="index">
                    <td>{{ u.name }}</td>
                    <td>{{ u.phone }}</td>
                    <td>{{ u.local }}</td>
                    <td>{{ u.created }}</td>
                    <td>{{ u.father }}</td>
                    <td> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#seeModal" @click="getRecursive(u.id)"> Ver rede </button> </td>
                    <td> <button type="button" class="btn btn-danger" @click="deleting(u.id)"> Excluir </button> </td>
                </tr>
            </tbody>
        </table>
        
        <recursive-modal :rec="rec" :user="user"></recursive-modal>
    </div>
</template>

<script>
    import Formulario from './Formulario.vue'
    import RecursiveModal from './RecursiveModal.vue'
    
    export default {
        components: { Formulario, RecursiveModal },
        data () {
            return {
                users: {},
                rec: [],
                user: "",
                errors: null
            }
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            getUsers () {
                axios.get('/getUsers').then(data => {
                    this.users = data.data;
                });
            },
            create (payload) {
                axios.post('/create', payload.user).then(data => {
                    this.getUsers();
                }).catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
            deleting (id) {
                this.$swal.fire({
                    title: 'Tem certeza disso?',
                    text: "Isso não poderá ser desfeito!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete('/delete/' + id).then(data => {
                            this.getUsers();
                        });
                    }
                });
            },
            getRecursive (id) {
                axios.get('/getRecursive/' + id).then(data => {
                    this.rec = data.data.web;
                    this.user = data.data.name;
                });
            }
        }
    }
</script>